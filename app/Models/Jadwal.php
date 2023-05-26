<?php

namespace App\Models;

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
}

