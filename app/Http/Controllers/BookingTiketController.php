<?php

namespace App\Http\Controllers;

use App\Models\BookingTiket;
use App\Models\Bus;
use App\Models\Jadwal;
use App\Models\JenisTiket;
use App\Models\KontakPenumpang;
use App\Models\Penumpang;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class BookingTiketController extends Controller
{
    public function bookingdata()
    {
        $booking = BookingTiket::all();
        return view('layout.booking-tiket.bookingdata', compact('booking'));
    }

    public function deleteBooking($id)
    {
        $booking = BookingTiket::find($id);
        if ($booking && Auth::user()->role == 'Superadmin' || Auth::user()->role == 'managementPO') {
            $booking->delete();
            Alert::toast('Data booking berhasil dihapus!', 'success')->persistent(false, false)->autoClose(3000);
            return redirect('bookingdata');
        }
    }

    public function bookingtiket()
    {
        $user = Auth::user();
        if ($user->role == 'Superadmin' || $user->role == 'user') {
            $dataJadwal = Jadwal::all();
        } else {
            $dataJadwal = Jadwal::whereHas('buses', function ($query) {
                $query->where('company_id', Auth::user()->company_id);
            })->get();
        }
        $jenisTiket = JenisTiket::all();

        return view('layout.booking-tiket.bookingtiket', compact('dataJadwal', 'jenisTiket'));
    }


    public function bookingStore(Request $request)
    {
        $selectedSeats = json_decode($request->input('selected_seats'));
        $seatCategories = json_decode($request->input('seat_category_id'));
        $busId = $request->input('bus_id');
        $jadwalsId = $request->input('jadwals_id');

        $bookingTikets = [];
        $selectedSeatsByBookingId = [];

        foreach ($selectedSeats as $index => $seat) {
            $category = $seatCategories[$index] ?? null;
            if ($category) {
                $jenisTiket = JenisTiket::where('ticket_category', $category)->first();

                if ($jenisTiket) {
                    // Simpan data ke dalam database
                    $booking = new BookingTiket();
                    $booking->seat = $seat;
                    $booking->buses_id = $busId;
                    $booking->users_id = Auth::user()->id;
                    $booking->jadwals_id = $jadwalsId;
                    $booking->jenis_tikets_id = $jenisTiket->id;
                    $booking->save();

                    $bookingTikets[] = $booking;
                    $selectedSeatsByBookingId[$booking->id] = [
                        'seat_numbers' => $seat,
                        'seat_type' => $jenisTiket->ticket_category,
                    ];
                }
            }
        }
        return redirect()->route('penumpang.create', [
            'bookingTikets' => $bookingTikets,
            'selectedSeats' => $selectedSeatsByBookingId
        ]);
    }

    public function createPenumpang(Request $request)
    {
        $selectedSeats = $request->input('selectedSeats', []);
        $seatNumbers = array_column($selectedSeats, 'seat_numbers');
        $seatType = array_column($selectedSeats, 'seat_type');

        $bookingTikets = BookingTiket::whereIn('id', array_keys($selectedSeats))->get();

        return view('layout.booking-tiket.inputpenumpang', compact('selectedSeats', 'bookingTikets'));
    }

    public function storePenumpang(Request $request)
    {
        $selectedSeats = json_decode($request->input('selectedSeats', '{}'), true);

        // Hitung total harga
        $totalPrice = intval($request->input('total_price'));

        // Simpan data kontak ke database
        $contact = new KontakPenumpang();
        $contact->email = $request->input('email');
        $contact->phone = $request->input('phone');
        $contact->save();

        // Simpan data penumpang ke database
        $penumpang = $request->input('bookingTikets');
        foreach ($penumpang as $bookingTiketId => $data) {
            $passenger = new Penumpang();
            $passenger->name = $data['name'];
            $passenger->age = $data['age'];
            $passenger->kontak_penumpang_id = $contact->id;
            $passenger->save();

            $booking = BookingTiket::find($bookingTiketId);
            $booking->penumpang_id = $passenger->id;
            $booking->save();
        }

        $bookingTikets = BookingTiket::whereIn('booking_tikets.id', array_keys($selectedSeats))
            ->with(['jadwals.rutes', 'penumpang'])
            ->get();


        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        // Buat transaksi pembayaran dengan Midtrans
        $transactionDetails = [
            'order_id' => uniqid(),
            'gross_amount' => $totalPrice,
        ];

        $items = [];
        foreach ($bookingTikets as $bookingTiket) {
            $items[] = [
                'id' => $bookingTiket->id,
                'price' => $bookingTiket->jadwals->rutes->price,
                'quantity' => 1,
                'name' => 'Ticket ' . $bookingTiket->seat,
                'passenger' => $bookingTiket->penumpang->name,
            ];
        }

        $customerDetails = [
            'first_name' => $bookingTikets[0]->penumpang->name,
            'last_name' => '',
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
        ];

        $transaction = [
            'transaction_details' => $transactionDetails,
            'item_details' => $items,
            'customer_details' => $customerDetails,
        ];

        $midtransParams = [
            'transaction_details' => $transactionDetails,
            'item_details' => $items,
            'customer_details' => $customerDetails,
        ];

        // Lakukan pembayaran menggunakan Midtrans
        $snapToken = \Midtrans\Snap::getSnapToken($midtransParams);

        // Simpan data transaksi ke database
        $transaction = new Transaction();
        $transaction->order_id = $transactionDetails['order_id'];
        $transaction->total_price = $transactionDetails['gross_amount'];
        $transaction->total_ticket = count($bookingTikets);
        $transaction->contact_id = $contact->id;
        $transaction->bus_id = $bookingTikets[0]['jadwals']['buses']['id'];
        $transaction->user_id = auth()->user()->id;
        $transaction->status = 'Unpaid';
        $transaction->save();
        return redirect()->route('checkout', [
            'snapToken' => $snapToken,
            'transactionDetails' => $transactionDetails,
            'items' => $items,
            'customerDetails' => $customerDetails,
            'transaction' => $transaction,
            'bookingTikets' => $bookingTikets,
        ]);
    }

    public function checkout(Request $request)
    {
        $snapToken = $request->input('snapToken');
        $transactionDetails = $request->input('transactionDetails');
        $items = $request->input('items');
        $customerDetails = $request->input('customerDetails');
        $transaction = $request->input('transaction');
        $bookingTikets = $request->input('bookingTikets');

        return view('layout.booking-tiket.checkout', compact('snapToken', 'transactionDetails', 'items', 'customerDetails', 'transaction', 'bookingTikets'));
    }

    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                Transaction::where('order_id', $request->order_id)->update(['status' => 'Paid', 'payment_type' => $request->payment_type]);
            } elseif ($request->transaction_status == 'pending') {
                Transaction::where('order_id', $request->order_id)->update(['status' => 'Pending', 'payment_type' => $request->payment_type]);
            }
        }
    }


    public function invoice($id)
    {
        $transaction = Transaction::with('contact.penumpang.bookingTikets.jadwals.rutes')->find($id);
        return view('layout.booking-tiket.invoice', compact('transaction'));
    }


    public function tampilimage($id)
    {
        $data = Bus::find($id);
        //dd($data);

        return view('layout.booking-tiket.bookingtiket', compact('data'));
    }
}
