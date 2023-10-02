<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'birthday',
        'gender',
        'phone',
        'image',
        'password',
    ];

    public $table = 'users';
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    public function image()
    {
        return $this->hasOne(Media::class);
    }
    public function page()
    {
        return $this->belongsTo(Page::class);
    }
    public function age(): Attribute
    {
        return Attribute::make(function () {
            $birthday = Carbon::now()->diff($this->birthday);
            $ageInYears = $birthday->y;
            $ageInMonths = $birthday->m;
            $years = $ageInYears > 1 ? "{$ageInYears} years" : "{$ageInYears} year";
            $months = $ageInMonths > 1 ? "{$ageInMonths} months" : "{$ageInMonths} month";

            return __('user.age', ['years' => $ageInYears, 'months' => $ageInMonths]);
        });
    }
    public function files()
    {
        return $this->hasMany(Media::class);
    }
}
