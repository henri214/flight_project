<?php

namespace App\Models;

use App\Utilities\FilterBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'airline_id',
        'departure_time',
        'arrival_time',
        'price',
        'pasangers',
        'two_way_departure_time',
        'two_way_arrival_time',
        'two_way',
        'is_available'
    ];
    // public function scopeOrderBy($query)
    // {
    //     return $query->orderBy('departure_time');
    // }
    public function scopeAvailability($query)
    {
        return $query->where('is_available', true);
    }
    public function scopeFilter($query, $filters)
    {
        if (isset($filters['price'])) {
            $query->where('price', $filters['price']);
        }
        if (isset($filters['id'])) {
            $query->where('id', '=', $filters['id']);
        }
        if (isset($filters['departure_time'])) {
            $query->where('departure_time', '<=', $filters['departure_time']);
        }
        if (isset($filters['pasangers'])) {
            $query->where('pasangers', '<=', $filters['pasangers']);
        }
        if (isset($filters['two_way'])) {
            $query->where('two_way', true);
        }
    }
    protected $table = 'flights';

    public function airline()
    {
        return $this->belongsTo(Airline::class);
    }
}
