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

    public function fridges()
    {
        return $this->hasMany(Fridge::class);
    }

    public function getCostAttribute()
    {
            $datetime1 = date_create($this->start_date_booking);
            $datetime2 = date_create(date("Y-m-d"));

            $interval = date_diff($datetime1, $datetime2);
            $days = $interval->format('%a');
            return [
                "current_cost" => $this->price * $days,
                "general_cost" => $this->price * $this->booking_day,
                "how_many_days" => $days,
            ];
    }
}
