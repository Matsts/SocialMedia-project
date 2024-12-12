<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class post extends Model implements HasMedia
{
    use HasFactory; use InteractsWithMedia;


     protected $fillable = [
        'id',
        'caption',
        'userId',
        'username',
        'likes',
        'created_at',
        'uuid',
        'caption',
     ];

     public function getAllPost() {

        return $this->getMedia('*');
     }

}
