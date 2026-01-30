<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier – {{ $recette->titre }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-orange-50 min-h-screen">

@include('layouts.header')

<div class="container mx-auto px-4 py-10 max-w-5xl">

    <!-- Titre -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-800 mb-2">
            <i class="fas fa-edit text-orange-500 mr-2"></i>
            Modifier la recette
        </h1>
        <p class="text-gray-600">
            Mettez à jour les informations de votre recette
        </p>
    </div>

    <!-- Formulaire -->
    <form action="{{ route('recettes.update', $recette->id) }}"
          method="POST"
          enctype="multipart/form-data"
          class="bg-white rounded-3xl shadow-xl p-8 space-y-8">

        @csrf
        @method('PUT')

        <!-- Titre -->
        <div>
            <label class="block font-semibold text-gray-700 mb-2">Titre</label>
            <input type="text" name="titre"
                   value="{{ old('titre', $recette->titre) }}"
                   class="w-full border-2 rounded-xl px-4 py-3 focus:border-orange-500 focus:ring-orange-200"
                   required>
        </div>

        <!-- Catégorie -->
        <div>
            <label class="block font-semibold text-gray-700 mb-2">Catégorie</label>
            <select name="categorie_id"
                    class="w-full border-2 rounded-xl px-4 py-3 focus:border-orange-500"
                    required>
                @foreach($categories as $categorie)
                    <option value="{{ $categorie->id }}"
                        {{ $recette->categorie_id == $categorie->id ? 'selected' : '' }}>
                        {{ $categorie->titre }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Description -->
        <div>
            <label class="block font-semibold text-gray-700 mb-2">Description</label>
            <textarea name="description" rows="4"
                class="w-full border-2 rounded-xl px-4 py-3 focus:border-orange-500"
                required>{{ old('description', $recette->description) }}</textarea>
        </div>

        <!-- Image -->
        <div>
            <label class="block font-semibold text-gray-700 mb-2">Image</label>
            <input type="file" name="image" class="w-full">
            @if($recette->image)
                <img src="{{ asset('images/'.$recette->image) }}"
                     class="mt-4 w-40 rounded-xl shadow">
            @endif
        </div>

        <!-- Ingrédients -->
        <div>
            <h2 class="text-2xl font-bold mb-4 text-gray-800">
                <i class="fas fa-carrot text-orange-500 mr-2"></i> Ingrédients
            </h2>

            <div id="ingredients-wrapper" class="space-y-4">
                @foreach($recette->ingredients as $i => $ingredient)
                    <div class="flex gap-4">
                        <input type="text"
                               name="ingredients[{{ $i }}][titre]"
                               value="{{ $ingredient->titre }}"
                               class="flex-1 border-2 rounded-xl px-4 py-2"
                               placeholder="Ingrédient">

                        <input type="text"
                               name="ingredients[{{ $i }}][quantite]"
                               value="{{ $ingredient->pivot->quantite }}"
                               class="w-32 border-2 rounded-xl px-4 py-2"
                               placeholder="Qté">
                    </div>
                @endforeach
            </div>

            <button type="button"
                    onclick="addIngredient()"
                    class="mt-4 text-orange-600 font-semibold">
                <i class="fas fa-plus mr-1"></i> Ajouter ingrédient
            </button>
        </div>

        <!-- Étapes -->
        <div>
            <h2 class="text-2xl font-bold mb-4 text-gray-800">
                <i class="fas fa-list-ol text-orange-500 mr-2"></i> Étapes
            </h2>

            <div id="etapes-wrapper" class="space-y-4">
                @foreach($recette->etapes as $i => $etape)
                    <textarea name="etapes[{{ $i }}][titre]"
                              class="w-full border-2 rounded-xl px-4 py-3"
                              rows="2">{{ $etape->titre }}</textarea>
                @endforeach
            </div>

            <button type="button"
                    onclick="addEtape()"
                    class="mt-4 text-orange-600 font-semibold">
                <i class="fas fa-plus mr-1"></i> Ajouter étape
            </button>
        </div>

        <!-- Actions -->
        <div class="flex justify-end gap-4 pt-6 border-t">
            <a href="{{ route('recettes.show', $recette->id) }}"
               class="px-6 py-3 rounded-xl bg-gray-200 font-semibold">
                Annuler
            </a>

            <button type="submit"
                    class="px-6 py-3 rounded-xl bg-orange-500 text-white font-semibold hover:bg-orange-600">
                <i class="fas fa-save mr-1"></i> Enregistrer
            </button>
        </div>

    </form>
</div>

<script>
let ingredientIndex = {{ $recette->ingredients->count() }};
let etapeIndex = {{ $recette->etapes->count() }};

function addIngredient() {
    document.getElementById('ingredients-wrapper').insertAdjacentHTML('beforeend', `
        <div class="flex gap-4">
            <input type="text" name="ingredients[${ingredientIndex}][titre]"
                   class="flex-1 border-2 rounded-xl px-4 py-2" placeholder="Ingrédient">
            <input type="text" name="ingredients[${ingredientIndex}][quantite]"
                   class="w-32 border-2 rounded-xl px-4 py-2" placeholder="Qté">
        </div>
    `);
    ingredientIndex++;
}

function addEtape() {
    document.getElementById('etapes-wrapper').insertAdjacentHTML('beforeend', `
        <textarea name="etapes[${etapeIndex}][titre]"
                  class="w-full border-2 rounded-xl px-4 py-3"
                  rows="2"
                  placeholder="Nouvelle étape"></textarea>
    `);
    etapeIndex++;
}
</script>

</body>
</html>
