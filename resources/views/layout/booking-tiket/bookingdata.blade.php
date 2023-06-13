@extends('app')

@section('content')
    <div class="section-header">
        <h1>Booking Data</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/">Bobus Dashboard</a></div>
            <div class="breadcrumb-item">Booking Data</div>
        </div>
    </div>
    <div class="card mb-2">
        <table class="table table-md mt-1">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Tanggal Pemesanan</th>
                    <th scope="col">Seat</th>
                    <th scope="col">Jenis Tiket</th>
                    <th scope="col">Bus</th>
                    <th scope="col">Penumpang</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($booking as $book)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $book->created_at->format('l, d F Y') }}</td>
                        <td>{{ $book->seat }}</td>
                        <td>{{ $book->jenisTikets->ticket_category }}</td>
                        <td>{{ $book->jadwals->buses->code_bus }} - {{ $book->jadwals->buses->company->company_name }}</td>
                        @if ($book->penumpang)
                            <td>{{ $book->penumpang->name }}</td>
                        @else
                            <td class="text-danger">Anda belum memasukkan data penumpang.</td>
                        @endif
                        <td><a href="#" class="btn btn-danger rounded-circle fa fa-trash delete"
                                onclick="event.preventDefault(); showConfirmationModal({{ $book->id }});"></a>

                            <form id="delete-form-{{ $book->id }}" action="{{ route('booking.delete', $book->id) }}"
                                method="POST" style="display: none;">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('script')
    <script>
        function showConfirmationModal(id) {
            Swal.fire({
                title: "Konfirmasi Penghapusan",
                text: "Anda yakin ingin menghapus item ini?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Hapus",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }

        @if (Session::has('success'))
            toastr.success("{{ Session::get('success') }}")
        @endif
    </script>
@endsection
