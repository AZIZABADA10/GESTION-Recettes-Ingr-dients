<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EtapePreparation extends Model
{
    protected $table = 'etapes_preparation';

    protected $fillable = ['titre', 'ordre', 'recette_id'];

    public function recette()
    {
        return $this->belongsTo(Recette::class);
    }
}
