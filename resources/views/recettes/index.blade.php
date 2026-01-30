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
                        <form id="search-form"
                    class="bg-white rounded-2xl shadow-lg p-6 mb-10 animate-fade-in">

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="fas fa-search text-orange-500 mr-1"></i>
                                Rechercher
                            </label>
                            <input type="text"
                                name="search"
                                placeholder="Titre ou description..."
                                class="w-full border-2 border-gray-200 rounded-xl px-4 py-2 focus:border-orange-500 focus:ring-orange-500 outline-none transition">
                        </div>


                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="fas fa-tag text-orange-500 mr-1"></i>
                                Catégorie
                            </label>
                            <select name="categorie"
                                    class="w-full border-2 border-gray-200 rounded-xl px-4 py-2 focus:border-orange-500 focus:ring-orange-500 outline-none transition">
                                <option value="">Toutes</option>
                                @foreach($categories as $categorie)
                                    <option value="{{ $categorie->id }}">
                                        {{ $categorie->titre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
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

                 <!-- Formulaire de filtrage AJAX -->


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
            <div id="recipes-container"
                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                @include('recettes.partials.cards', ['recettes' => $recettes])

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
<script>
const form = document.getElementById('search-form');
const container = document.getElementById('recipes-container');

let timeout = null;

form.addEventListener('input', () => {
    clearTimeout(timeout);

    timeout = setTimeout(() => {
        const params = new URLSearchParams(new FormData(form));

        fetch(`{{ route('recettes.search') }}?` + params)
            .then(res => res.text())
            .then(html => {
                container.innerHTML = html;
            });
    }, 300);
});
</script>

</body>
</html>