<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_date_booking',
        'end_date_booking',
        'user_id',
        'block_id',
    ];
}
