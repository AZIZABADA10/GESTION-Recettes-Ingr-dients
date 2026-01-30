<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>{{ $recette->titre }} - Recettes App</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-orange-50 min-h-screen">

@include('layouts.header')

<div class="container mx-auto px-4 py-10">

    <!-- Breadcrumb -->
    <nav class="mb-6 text-sm text-gray-600">
        <a href="{{ route('recettes.index') }}" class="hover:text-orange-500">
            <i class="fas fa-home mr-1"></i> Recettes
        </a>
        <span class="mx-2">/</span>
        <span class="text-orange-600 font-semibold">{{ $recette->titre }}</span>
    </nav>

    <div class="bg-white rounded-3xl shadow-xl overflow-hidden">

        <!-- Image -->
        @if($recette->image)
            <img src="{{ asset('images/'.$recette->image) }}"
                 alt="{{ $recette->titre }}"
                 class="w-full h-96 object-cover">
        @endif

        <div class="p-8 space-y-8">

            <!-- Titre -->
            <div>
                <h1 class="text-4xl font-bold text-gray-800 mb-2">
                    {{ $recette->titre }}
                </h1>

                <div class="flex flex-wrap items-center gap-6 text-sm text-gray-600">
                    <span>
                        <i class="fas fa-folder text-orange-500 mr-1"></i>
                        {{ $recette->categorie->titre ?? 'Sans catégorie' }}
                    </span>

                    <span>
                        <i class="fas fa-user text-orange-500 mr-1"></i>
                        {{ $recette->user->name }}
                    </span>

                    <span>
                        <i class="fas fa-calendar text-orange-500 mr-1"></i>
                        {{ $recette->created_at->format('d/m/Y') }}
                    </span>
                </div>
            </div>

            <!-- Description -->
            <div>
                <h2 class="text-2xl font-bold text-gray-800 mb-3">
                    <i class="fas fa-book-open text-orange-500 mr-2"></i>
                    Description
                </h2>

                <p class="text-gray-700 leading-relaxed whitespace-pre-line">
                    {{ $recette->description }}
                </p>
            </div>

            <!-- Ingrédients -->
            <div>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">
                    <i class="fas fa-carrot text-orange-500 mr-2"></i>
                    Ingrédients
                </h2>

                <ul class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($recette->ingredients as $ingredient)
                        <li class="flex justify-between bg-orange-100 px-5 py-3 rounded-xl">
                            <span class="font-medium text-gray-800">
                                {{ $ingredient->titre }}
                            </span>
                            <span class="text-gray-600">
                                {{ $ingredient->pivot->quantite }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Étapes -->
            <div>
                <h2 class="text-2xl font-bold text-gray-800 mb-6">
                    <i class="fas fa-list-ol text-orange-500 mr-2"></i>
                    Étapes de préparation
                </h2>

                <div class="space-y-4">
                    @foreach($recette->etapes as $etape)
                        <div class="flex items-start space-x-4 bg-gray-50 p-5 rounded-xl">
                            <div class="w-10 h-10 flex items-center justify-center bg-orange-500 text-white font-bold rounded-full">
                                {{ $etape->ordre }}
                            </div>
                            <p class="text-gray-700">
                                {{ $etape->titre }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Actions -->
            @auth
                @if(auth()->id() === $recette->user_id)
                    <div class="flex gap-4 pt-6 border-t">
                        <a href="{{ route('recettes.edit', $recette->id) }}"
                           class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-xl font-semibold">
                            <i class="fas fa-edit mr-1"></i> Modifier
                        </a>

                        <form action="{{ route('recettes.destroy', $recette->id) }}"
                              method="POST"
                              onsubmit="return confirm('Supprimer cette recette ?');">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-xl font-semibold">
                                <i class="fas fa-trash mr-1"></i> Supprimer
                            </button>
                        </form>
                    </div>
                @endif
            @endauth

        </div>
    </div>

</div>

</body>
</html>
