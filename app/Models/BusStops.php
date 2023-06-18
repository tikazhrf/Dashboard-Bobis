<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusStops extends Model
{
    use HasFactory;

    protected $table = "bus_stops";
    protected $primaryKey = "id";
    protected $fillable = [
        'id', 'bus_stops', 'latitude', 'longitude'
    ];

    public function rutes()
    {
        return $this->hasMany(Rute::class);
    }
}
