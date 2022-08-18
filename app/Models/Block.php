<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'width',
        'height',
        'length',
        'room_id',
        "user_id",
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    // public function getCurrentCostAttribute()
    // {

    // }
}
