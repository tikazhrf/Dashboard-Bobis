<?php

namespace App\Models;

use App\Models\Rute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = "jadwals";
    protected $primaryKey = "id";
    protected $fillable = [
        'start_at',
        'end_at',
        'operation_day',
        'rutes_id'
    ];

    public function setOperationDayAttribute($value)
    {
        $this->attributes['operation_day'] = json_encode($value);
    }

    public function getOperationDayAttribute($value)
    {
        return $this->attributes['operation_day'] = json_decode($value);
    }

    public function rutes()
    {
        return $this->belongsTo(Rute::class);
    }

    public function buses()
    {
        return $this->hasMany(Bus::class);
    }
}
