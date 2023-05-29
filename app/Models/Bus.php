<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;

    protected $table = "buses";
    protected $primaryKey = "id";
    protected $fillable = [
        'id', 'image', 'code_bus', 'vin', 'plate_number', 'bpkb_expired', 'driver', 'seat', 'namapo' 
    ];

    public function rutes() {
        
        return $this->hasMany(Rute::class);
    }
}
?>
