<?php

namespace App\Models;

use App\Enums\CarAvailabilityEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'model',
        'price',
        'availability',
        'user_id'
    ];
  
    protected $casts = [
        'price'=>'float',
        'availability'=> CarAvailabilityEnum::class
    ];

    public function scopeAvailable($query)
    {
        return $query->where('availability', CarAvailabilityEnum::available());
    }

    public function user(){
        return  $this->belongsTo(User::class);
     }

}
