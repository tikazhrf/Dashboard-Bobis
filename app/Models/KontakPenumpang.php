<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontakPenumpang extends Model
{
    use HasFactory;
    protected $table = "kontak_penumpang";
    protected $primaryKey = "id";
    protected $fillable = [
        'email',
        'phone',
    ];

    public function bookingTikets()
    {
        return $this->hasMany(BookingTiket::class);
    }

    public function penumpang()
    {
        return $this->hasMany(Penumpang::class);
    }
}
