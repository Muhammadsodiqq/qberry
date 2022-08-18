<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'temperature',
        'location_id',
        'name',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function blocks()
    {
        return $this->hasMany(Block::class,"room_id");
    }


    // public function getCalculateAttribute()
    // {
    //     $data = $this->blocks()->get();
    // }
}
