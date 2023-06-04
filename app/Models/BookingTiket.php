<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingTiket extends Model
{
    use HasFactory;

    protected $table = "booking_tikets";
    protected $primaryKey = "id";
    protected $fillable = [
        'seat',
        'jenis_tikets_id',
        'buses_id',
        'users_id',
        'penumpang_id'
    ];

    public function buses()
    {
        return $this->belongsTo(Bus::class, 'buses_id');
    }

    public function rute()
    {
        return $this->belongsTo(Rute::class, 'rutes_id');
    }

    public function jenisTikets()
    {
        return $this->belongsTo(JenisTiket::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function penumpang()
    {
        return $this->belongsTo(Penumpang::class);
    }
}
