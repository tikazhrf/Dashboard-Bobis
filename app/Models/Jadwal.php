<?php

namespace App\Models;

use App\Models\Rute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $fillable = [
        'code_bus',
        'origin',
        'destination',
        'start_at',
        'end_at',
        'duration_journey',
        'operation_day'
    ];

    public function setOperationDayAttribute($value)
    {
        $this->attributes['operation_day'] = json_encode($value);
    }

    public function getOperationDayAttribute($value)
    {
        return $this->attributes['operation_day'] = json_decode($value);
    }

    public function rutes() {
        
        return $this->belongsTo(Rute::class, 'code_bus_id', 'origin_id', 'destination_id', 'id');
    }
}

