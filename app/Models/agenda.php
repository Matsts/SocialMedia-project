<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class agenda extends Model
{
    use HasFactory;

    protected $casts = [
        'begin' => 'datetime',
        'eind' => 'datetime',
    ];

    protected $fillable = [
        'id',
        'titel',
        'slots',
     ];
}
