<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];

    protected $table = 'pages';
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
