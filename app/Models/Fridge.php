<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fridge extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'block_id',
    ];
}
