<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    protected $fillable = [
        'content',
        'user_id',
        'recette_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function recette()
    {
        return $this->belongsTo(Recette::class);
    }
}
