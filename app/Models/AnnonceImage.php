<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;



class AnnonceImage extends Model
{
    public function annonce(){
        return $this->belongsTo(Annonce::class);
    }
    protected $fillable = [
        'path',
        'annonce_id',
    ];
}
