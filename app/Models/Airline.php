<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
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
    // public function setDeletedAtAttribute()
    // {
    //     return Carbon::createFromFormat('Y-m-d H:i:s', $this->deleted_at)->format('Y-m-d');
    // }
}
