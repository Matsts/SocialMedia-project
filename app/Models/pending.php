<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pending extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'username',
        'result',
        'agendaId'
     ];
}
