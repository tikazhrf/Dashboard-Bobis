<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $table = "company";
    protected $primaryKey = "id";
    protected $fillable = [
        'company_name'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function buses()
    {
        return $this->hasMany(Bus::class);
    }
}
