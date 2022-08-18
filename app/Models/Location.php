<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        "country_name",
        "city_name",
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

}
