<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toutes les recettes - Recettes App</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
        }
        
        .recipe-pattern {
            background-color: #fff7ed;
            background-image: 
                radial-gradient(circle at 20% 50%, rgba(251, 146, 60, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(249, 115, 22, 0.05) 0%, transparent 50%);
        }

        .recipe-card {
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .recipe-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(249, 115, 22, 0.15);
        }

        .recipe-card img {
            transition: transform 0.5s ease;
        }

        .recipe-card:hover img {
            transform: scale(1.1);
        }

        .badge {
            background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
        }

        .btn-view {
            background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
            transition: all 0.3s ease;
        }

        .btn-view:hover {
            box-shadow: 0 4px 15px rgba(249, 115, 22, 0.4);
            transform: translateX(4px);
        }

        .image-placeholder {
            background: linear-gradient(135deg, #fed7aa 0%, #fdba74 100%);
        }

        .animate-fade-in {
            animation: fadeIn 0.6s ease-out;
        }

        .animate-slide-up {
            animation: slideUp 0.5s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .empty-state {
            background: linear-gradient(135deg, #fff7ed 0%, #ffedd5 100%);
        }
    </style>
</head>
<body class="recipe-pattern min-h-screen">

    @include('layouts.header')

    <div class="container mx-auto px-4 py-10">
        
        <!-- En-tête de la section -->
        <div class="mb-10 animate-fade-in">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <h2 class="text-4xl font-bold text-gray-800 mb-2">
                        <i class="fas fa-utensils text-orange-500 mr-3"></i>
                        Découvrez nos recettes
                    </h2>
                    <p class="text-gray-600 text-lg">
                        {{ $recettes->count() }} {{ $recettes->count() > 1 ? 'recettes délicieuses' : 'recette délicieuse' }} à explorer
                    </p>
                </div>

                 Filtres ou actions
                 <div class="mt-4 md:mt-0 flex items-center space-x-3">
                    <button class="bg-white px-4 py-2 rounded-lg shadow hover:shadow-md transition flex items-center space-x-2">
                        <i class="fas fa-filter text-orange-500"></i>
                        <span class="text-gray-700 font-medium">Filtrer</span>
                    </button>
                    <button class="bg-white px-4 py-2 rounded-lg shadow hover:shadow-md transition flex items-center space-x-2">
                        <i class="fas fa-sort text-orange-500"></i>
                        <span class="text-gray-700 font-medium">Trier</span>
                    </button>
                </div> 
            </div>
        </div>

        @if($recettes->isEmpty())
            <!-- État vide -->
            <div class="empty-state rounded-3xl shadow-lg p-12 text-center animate-slide-up">
                <div class="mb-6">
                    <i class="fas fa-pizza-slice text-orange-300 text-8xl"></i>
                </div>
                <h3 class="text-3xl font-bold text-gray-800 mb-3">
                    Aucune recette disponible
                </h3>
                <p class="text-gray-600 text-lg mb-8 max-w-md mx-auto">
                    Soyez le premier à partager une délicieuse recette avec la communauté !
                </p>
                @auth
                    <a href="{{ route('recettes.create') }}" class="inline-flex items-center bg-gradient-to-r from-orange-500 to-orange-600 text-white px-8 py-4 rounded-xl font-semibold text-lg shadow-lg hover:shadow-xl transition-all hover:-translate-y-1">
                        <i class="fas fa-plus-circle mr-3"></i>
                        Ajouter ma première recette
                    </a>
                @else
                    <a href="{{ route('register') }}" class="inline-flex items-center bg-gradient-to-r from-orange-500 to-orange-600 text-white px-8 py-4 rounded-xl font-semibold text-lg shadow-lg hover:shadow-xl transition-all hover:-translate-y-1">
                        <i class="fas fa-user-plus mr-3"></i>
                        Rejoindre la communauté
                    </a>
                @endauth
            </div>
        @else
            <!-- Grille de recettes -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($recettes as $index => $recette)
                    <div class="recipe-card bg-white rounded-2xl shadow-lg overflow-hidden animate-slide-up" style="animation-delay: {{ $index * 0.1 }}s;">
                        
                        <!-- Image de la recette -->
                        <div class="relative h-56 overflow-hidden">
                            @if($recette->image)
                                <img 
                                    src="{{ asset('images/' . $recette->image) }}" 
                                    alt="{{ $recette->titre }}"
                                    class="w-full h-full object-cover"
                                >
                            @else
                                <div class="image-placeholder w-full h-full flex items-center justify-center">
                                    <i class="fas fa-utensils text-white text-6xl opacity-50"></i>
                                </div>
                            @endif

                            <!-- Badge catégorie -->
                            <div class="absolute top-4 right-4">
                                <span class="badge text-white px-4 py-2 rounded-full text-xs font-semibold shadow-lg flex items-center space-x-1">
                                    <i class="fas fa-tag"></i>
                                    <span>{{ $recette->categorie->titre ?? 'Non définie' }}</span>
                                </span>
                            </div>

                            <!-- Overlay au hover -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 hover:opacity-100 transition-opacity duration-300"></div>
                        </div>

                        <!-- Contenu de la carte -->
                        <div class="p-6">
                            <!-- Titre -->
                            <h3 class="text-xl font-bold text-gray-800 mb-3 line-clamp-2 hover:text-orange-500 transition-colors">
                                {{ $recette->titre }}
                            </h3>

                            <!-- Description -->
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                {{ \Illuminate\Support\Str::limit($recette->description, 16) }}
                            </p>

                            <!-- Séparateur -->
                            <div class="border-t border-gray-100 my-4"></div>

                            <!-- Footer de la carte -->
                            <div class="flex items-center justify-between">
                                <!-- Stats -->
                                <div class="flex items-center space-x-4 text-sm text-gray-500">
                                    <div class="flex items-center space-x-1" title="Commentaires">
                                        <i class="fas fa-comments text-orange-500"></i>
                                        <span class="font-medium">{{ $recette->commentaires->count() }}</span>
                                    </div>
                                    <div class="flex items-center space-x-1" title="Vues">
                                        <i class="fas fa-eye text-orange-500"></i>
                                        <span class="font-medium">{{ rand(0, 999) }}</span>
                                    </div>
                                </div>

                                <!-- Bouton -->
                                <a 
                                    href="{{ route('recettes.show', $recette->id) }}"
                                    class="btn-view text-white px-5 py-2 rounded-lg font-semibold text-sm flex items-center space-x-2 shadow"
                                >
                                    <span>Voir</span>
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>

                        <!-- Auteur (optionnel) -->
                        @if(isset($recette->user))
                        <div class="px-6 pb-4 flex items-center space-x-2 text-sm text-gray-500">
                            <div class="w-6 h-6 bg-gradient-to-br from-orange-400 to-orange-600 rounded-full flex items-center justify-center text-white text-xs font-bold">
                                {{ strtoupper(substr($recette->user->name, 0, 1)) }}
                            </div>
                            <span>Par <span class="font-semibold text-gray-700">{{ $recette->user->name }}</span></span>
                        </div>
                        @endif
                    </div>
                @endforeach
            </div>

            <!-- Pagination (si applicable) -->
            @if(method_exists($recettes, 'links'))
                <div class="mt-12 animate-fade-in">
                    {{ $recettes->links() }}
                </div>
            @endif
        @endif

        <!-- Call to action -->
        @auth
            <div class="mt-16 bg-gradient-to-r from-orange-500 to-orange-600 rounded-3xl shadow-2xl p-10 text-center text-white animate-fade-in">
                <i class="fas fa-lightbulb text-6xl mb-4 opacity-90"></i>
                <h3 class="text-3xl font-bold mb-3">
                    Vous avez une recette à partager ?
                </h3>
                <p class="text-lg mb-6 opacity-90">
                    Rejoignez notre communauté de passionnés de cuisine et partagez vos meilleures créations !
                </p>
                <a href="{{ route('recettes.create') }}" class="inline-flex items-center bg-white text-orange-500 px-8 py-4 rounded-xl font-semibold text-lg shadow-lg hover:shadow-xl transition-all hover:-translate-y-1">
                    <i class="fas fa-plus-circle mr-3"></i>
                    Ajouter une recette
                </a>
            </div>
        @endauth
    </div>

</body>
</html>