<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shorten extends Model
{
    use HasFactory;
    public $fillable = [
        'original_url',
        'code'
    ];
}
