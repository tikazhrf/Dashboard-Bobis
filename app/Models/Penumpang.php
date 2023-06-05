<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penumpang extends Model
{
    use HasFactory;
    protected $table = "penumpang";
    protected $primaryKey = "id";
    protected $fillable = [
        'name',
        'age',
        'kontak_penumpang_id'
    ];

    public function kontakPenumpang()
    {
        return $this->belongsTo(KontakPenumpang::class);
    }

    public function bookingTikets()
    {
        return $this->hasMany(BookingTiket::class);
    }
}
