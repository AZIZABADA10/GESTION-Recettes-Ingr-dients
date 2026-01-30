<?php
namespace App\Http\Controllers;

use App\Models\Commentaire;
use Illuminate\Http\Request;

class CommentaireController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|min:3',
            'recette_id' => 'required|exists:recettes,id',
        ]);

        Commentaire::create([
            'content' => $request->content,
            'recette_id' => $request->recette_id,
            'user_id' => auth()->id(),
        ]);

        return back()->with('success', 'Commentaire ajouté');
    }

    public function update(Request $request, $id)
    {
        $commentaire = Commentaire::findOrFail($id);

        abort_if($commentaire->user_id !== auth()->id(), 403);

        $request->validate([
            'content' => 'required|string|min:3',
        ]);

        $commentaire->update([
            'content' => $request->content,
        ]);

        return back()->with('success', 'Commentaire modifié');
    }

    public function destroy($id)
    {
        $commentaire = Commentaire::findOrFail($id);

        abort_if($commentaire->user_id !== auth()->id(), 403);

        $commentaire->delete();

        return back()->with('success', 'Commentaire supprimé');
    }
}
