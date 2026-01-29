@include('layouts.header')

<h2>Détails de la catégorie</h2>

<p><strong>Titre :</strong> {{ $categorie->titre }}</p>

<a href="{{ route('categories.index') }}">Retour</a>
