<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\EtapePreparation;
use App\Models\Ingredient;
use App\Models\Recette;
use Illuminate\Http\Request;

class RecetteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recettes = Recette::all();
        return view('recettes.index',compact('recettes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories =Categorie::all();
        return view('recettes.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titre'=>'required|string|min:5',
            'categorie_id'=>'required|exists:categories,id',
            'description'=>'required|string',
            'ingredients.*titre'=>'required|string',
            'ingredients.*quantite'=>'required',
            'etapes.*titre'=>'required',
            'image'=>'required|mimes:jpeg,png,svg,jpg',
            'user_id'=>'required|exists:users,id'
        ]);
        
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'),$imageName);
        };

        $recette = Recette::create([
            'titre'=>$request->titre,
            'categorie_id'=>$request->categorie_id,
            'description'=>$request->description,
            'user_id'=>$request->user_id,
            'image'=>$request->image,
        ]);

      foreach ($request->ingredients as $value) {
        $ingredient = Ingredient::FirstOrCreate(['titre'=>$value['titre']]);
        $recette->ingredients()->attach($ingredient->id,['quantite'=>$value['quantite']]);
      }


      foreach ($request->etapes as $index => $value) {
        $recette->etapes()->create([
            'titre'=>$value['titre'],
            'ordre'=> $index+1
        ]);
      }

      return redirect()->route('recettes.index')->with('succese','recette a été bien créer !');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $recette = Recette::with([
        'commentaires',
        'categorie',
        'ingredients',
        'etapes'])->findOrFail($id);
        return view('recettes.show',compact('recette'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
