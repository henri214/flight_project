<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'bookings';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'user_id',
        'flight_id',
        'user_email',
        'page_name',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function page()
    {
        return $this->belongsTo(Page::class);
    }
    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }
    public function scopeFilter($query, $filters)
    {
        if (isset($filters['page_name'])) {
            $query->where('page_name', $filters['page_name']);
        }
        if (isset($filters['id'])) {
            $query->where('id', $filters['id']);
        }
        if (isset($filters['user_email'])) {
            $query->where('user_email', $filters['user_email']);
        }
    }
    public function scopeByFlight($query, $flight_id)
    {
        return $query->where('flight_id', $flight_id);
    }
}
