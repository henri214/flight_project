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
        'page_id',
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
        if (isset($filters['pageName'])) {
            $query->where('page_name', $filters['pageName']);
        }
        if (isset($filters['id'])) {
            $query->where('id', $filters['id']);
        }
        if (isset($filters['userEmail'])) {
            $query->where('user_email', $filters['userEmail']);
        }
    }
    public function scopeByFlight($query, $flightId)
    {
        return $query->where('flight_id', $flightId);
    }
    public function file()
    {
        return $this->hasOne(File::class);
    }
}
