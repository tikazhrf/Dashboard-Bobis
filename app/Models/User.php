<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'password_confirm',
        'role',
        'image',
        'notelp',
        'address',
        'pregnancy_start_date',
        'pregnancy_end_date',
        'status',
        'company_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function bookingTikets()
    {
        return $this->hasMany(BookingTiket::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    protected $dates = [
        'pregnancy_start_date',
    ];

    protected static function booted()
    {
        static::creating(function ($user) {
            if ($user->status === 'Ibu Hamil') {
                $user->pregnancy_start_date = Carbon::now('Asia/Jakarta')->format('Y-m-d');
                $user->pregnancy_end_date = Carbon::now('Asia/Jakarta')->addDays(60)->format('Y-m-d');
            }
        });

        static::updating(function ($user) {
            if ($user->status === 'Ibu Hamil' && $user->pregnancy_start_date !== null) {
                $user->pregnancy_start_date = Carbon::now('Asia/Jakarta')->format('Y-m-d');
                $user->pregnancy_end_date = $user->pregnancy_start_date->copy()->addDays(60);

                $now = Carbon::now('Asia/Jakarta');

                if ($now->greaterThanOrEqualTo($user->pregnancy_end_date)) {
                    $user->pregnancy_start_date = null;
                    $user->pregnancy_end_date = null;
                    $user->status = 'Umum';
                }
            }
        });
    }
}
