<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recette extends Model
{
    protected $fillable = [
        'titre',
        'description',
        'image',
        'user_id',
        'categorie_id'
    ];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'recette_ingredient')
                    ->withPivot('quantite');
    }

    public function etapes()
    {
        return $this->hasMany(EtapePreparation::class);
    }

    public function commentaires()
    {
        return $this->hasMany(Commentaire::class);
    }
}

