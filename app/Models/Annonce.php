<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Annonce extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function images(){
        return $this->hasMany(AnnonceImage::class);
    }

    protected $fillable = [
        'title',
        'description',
        'price',
        'location',
        'user_id',
    ];
}
