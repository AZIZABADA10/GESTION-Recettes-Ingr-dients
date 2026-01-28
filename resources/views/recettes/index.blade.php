<h2 class="text-2xl font-bold mb-6">Toutes les recettes</h2>

@if($recettes->isEmpty())
    <p class="text-gray-600">Aucune recette disponible.</p>
@else
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($recettes as $recette)
            <div class="bg-white rounded-lg shadow p-4">

                @if($recette->image)
                    <img 
                        src="{{ asset('storage/' . $recette->image) }}" 
                        alt="{{ $recette->titre }}"
                        class="h-40 w-full object-cover rounded mb-3"
                    >
                @endif

                <h3 class="text-lg font-semibold">
                    {{ $recette->titre }}
                </h3>

                <p class="text-sm text-gray-600 mb-2">
                    Catégorie :
                    {{ $recette->categorie->titre ?? 'Non définie' }}
                </p>

                <p class="text-gray-700 text-sm mb-3">
                    {{ \Illuminate\Support\Str::limit($recette->description, 80) }}
                </p>

                <div class="flex justify-between items-center">
                    <a 
                        href="{{ route('recettes.show', $recette->id) }}"
                        class="text-orange-600 hover:underline font-semibold"
                    >
                        Voir détails
                    </a>

                    <span class="text-sm text-gray-500">
                        {{ $recette->commentaires->count() }} commentaires
                    </span>
                </div>
            </div>
        @endforeach
    </div>
@endif

