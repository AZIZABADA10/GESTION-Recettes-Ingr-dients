<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Recette;
use Illuminate\Http\Request;

class RecetteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recettes = Recette::with([
        'commentaires',
        'categorie',
        'ingredients',
        'etapes'])->get();
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
        'titre' => 'required|min:4',
        'description'=>'required',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        'user_id'=>'required|exists:users,id',
        'categorie_id'=>'required|exists:categories,id'
        ]);

        $recette = Recette::create([
            'titre' => $request->titre,
            'description'=>$request->description,
            'image' => $request->image,
            'user_id'=>$request->user_id,
            'categorie_id'=>$request->categorie_id]
        );
        return redirect()->route('recettes.index');
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
