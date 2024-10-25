<?php

namespace App\Models;

use App\Enums\CarAvailabilityEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Veelasky\LaravelHashId\Eloquent\HashableId;

class Car extends Model
{
    use HasFactory, SoftDeletes,HashableId;
    protected $fillable = [
        'name',
        'model',
        'price',
        'availability',
    ];
  
    protected $casts = [
        'price'=>'float',
        'availability'=> CarAvailabilityEnum::class
    ];

    public function scopeAvailable($query)
    {
        return $query->where('availability', CarAvailabilityEnum::available());
    }

}
