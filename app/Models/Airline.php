<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Airline extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'airlines';

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name'
    ];
    public function flights()
    {
        return $this->hasMany(Flight::class);
    }
}
