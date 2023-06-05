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
        'price',
        'origin_id',
        'destination_id',
    ];

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class);
    }

    public function origin()
    {
        return $this->belongsTo(BusStops::class);
    }

    public function destination()
    {
        return $this->belongsTo(BusStops::class);
    }
}
