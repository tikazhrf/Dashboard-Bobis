<?php

namespace App\Models;

use App\Models\Bus;
use App\Models\BusStops;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rute extends Model
{
    use HasFactory;

    protected $table = "rutes";
    protected $primaryKey = "id";
    protected $fillable = [
        'id','code_bus_id', 'bus_stops_id','price'
    ];

    public function buses() {
        
        return $this->belongsTo(Bus::class, 'code_bus_id', 'id');
    }

    public function busstops() {
        
        return $this->belongsToMany(BusStops::class, 'bus_stops_id', 'id');
    }

}
