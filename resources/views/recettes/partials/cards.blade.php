@if($recettes->isEmpty())
    <div class="col-span-full text-center text-gray-500 py-12">
        <i class="fas fa-search text-4xl mb-3"></i>
        <p>Aucune recette trouvée</p>
    </div>
@else
    @foreach($recettes as $index => $recette)
        <div class="recipe-card bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="relative h-56 overflow-hidden">
                @if($recette->image)
                    <img src="{{ asset('images/'.$recette->image) }}"
                         class="w-full h-full object-cover">
                @endif
            </div>

            <div class="p-6">
                <h3 class="text-xl font-bold mb-2">
                    {{ $recette->titre }}
                </h3>

                <p class="text-gray-600 text-sm mb-4">
                    {{ \Str::limit($recette->description, 80) }}
                </p>

                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-500">
                        <i class="fas fa-comments text-orange-500"></i>
                        {{ $recette->commentaires->count() }}
                    </span>

                    <a href="{{ route('recettes.show', $recette->id) }}"
                       class="btn-view text-white px-4 py-2 rounded-lg">
                        Voir
                    </a>
                </div>
            </div>
        </div>
    @endforeach
@endif
