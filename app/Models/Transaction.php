<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = "transactions";
    protected $primaryKey = "id";
    protected $fillable = [
        'order_id',
        'total_price',
        'total_ticket',
        'contact_id',
        'bus_id',
        'user_id',
        'payment_status',
    ];

    public function contact()
    {
        return $this->belongsTo(KontakPenumpang::class, 'contact_id');
    }

    public function bus()
    {
        return $this->belongsTo(Bus::class, 'bus_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function penumpangs()
    {
        return $this->hasMany(Penumpang::class, 'transaction_id');
    }
}
