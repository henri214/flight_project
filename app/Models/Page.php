<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Page extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name'
    ];
    protected $dates = ['deleted_at'];

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
