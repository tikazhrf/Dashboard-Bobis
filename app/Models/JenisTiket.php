<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisTiket extends Model
{
    use HasFactory;

    protected $table = "jenis_tikets";
    protected $primaryKey = "id";
    protected $fillable = [
        'ticket_category'
    ];

    public function bookingTikets()
    {
        return $this->hasMany(BookingTiket::class);
    }
}
