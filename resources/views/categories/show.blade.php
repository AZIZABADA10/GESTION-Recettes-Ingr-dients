<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $categorie->titre }} - Recettes App</title>
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
        
        .btn-orange {
            background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
            transition: all 0.3s ease;
        }
        
        .btn-orange:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(249, 115, 22, 0.3);
        }
        
        .animate-fade-in {
            animation: fadeIn 0.6s ease-out;
        }
        
        .animate-slide-up {
            animation: slideUp 0.5s ease-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
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

        .image-placeholder {
            background: linear-gradient(135deg, #fed7aa 0%, #fdba74 100%);
        }
    </style>
</head>
<body class="recipe-pattern min-h-screen">

    @include('layouts.header')

    <div class="container mx-auto px-4 py-10">
        
        <!-- Breadcrumb -->
        <nav class="mb-8 animate-fade-in">
            <ol class="flex items-center space-x-2 text-sm text-gray-600">
                <li>
                    <a href="{{ route('categories.index') }}" class="hover:text-orange-500 transition">
                        <i class="fas fa-list mr-1"></i>
                        Catégories
                    </a>
                </li>
                <li><i class="fas fa-chevron-right text-xs"></i></li>
                <li class="text-orange-500 font-semibold">{{ $categorie->titre }}</li>
            </ol>
        </nav>

        <!-- En-tête de la catégorie -->
        <div class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-3xl shadow-2xl p-10 text-white mb-10 animate-fade-in">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="flex items-center space-x-4 mb-4 md:mb-0">
                    <div class="w-20 h-20 bg-white/20 backdrop-blur rounded-2xl flex items-center justify-center">
                        <i class="fas fa-tag text-white text-3xl"></i>
                    </div>
                    <div>
                        <h1 class="text-4xl font-bold mb-2">{{ $categorie->titre }}</h1>
                        <p class="text-orange-100 flex items-center space-x-4">
                            @if(isset($categorie->recettes))
                                <span>
                                    <i class="fas fa-book-open mr-2"></i>
                                    {{ $categorie->recettes->count() }} recette{{ $categorie->recettes->count() > 1 ? 's' : '' }}
                                </span>
                            @endif
                            <span>
                                <i class="fas fa-calendar mr-2"></i>
                                Créée {{ $categorie->created_at->diffForHumans() }}
                            </span>
                        </p>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center space-x-3">
                    <a 
                        href="{{ route('categories.edit', $categorie->id) }}" 
                        class="bg-white text-orange-600 px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 flex items-center space-x-2"
                    >
                        <i class="fas fa-edit"></i>
                        <span>Modifier</span>
                    </a>
                    <a 
                        href="{{ route('categories.index') }}" 
                        class="bg-white/20 backdrop-blur text-white px-6 py-3 rounded-xl font-semibold hover:bg-white/30 transition flex items-center space-x-2"
                    >
                        <i class="fas fa-arrow-left"></i>
                        <span>Retour</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Recettes de cette catégorie -->
        @if(isset($categorie->recettes) && $categorie->recettes->isNotEmpty())
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-utensils text-orange-500 mr-3"></i>
                    Recettes dans cette catégorie
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($categorie->recettes as $index => $recette)
                        <div class="recipe-card bg-white rounded-2xl shadow-lg overflow-hidden animate-slide-up" style="animation-delay: {{ $index * 0.1 }}s;">
                            
                            <!-- Image de la recette -->
                            <div class="relative h-56 overflow-hidden">
                                @if($recette->image)
                                    <img 
                                        src="{{ asset('storage/' . $recette->image) }}" 
                                        alt="{{ $recette->titre }}"
                                        class="w-full h-full object-cover"
                                    >
                                @else
                                    <div class="image-placeholder w-full h-full flex items-center justify-center">
                                        <i class="fas fa-utensils text-white text-6xl opacity-50"></i>
                                    </div>
                                @endif
                            </div>

                            <!-- Contenu -->
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-800 mb-3 line-clamp-2 hover:text-orange-500 transition-colors">
                                    {{ $recette->titre }}
                                </h3>

                                <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                    {{ \Illuminate\Support\Str::limit($recette->description, 100) }}
                                </p>

                                <div class="border-t border-gray-100 my-4"></div>

                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-4 text-sm text-gray-500">
                                        @if(isset($recette->commentaires))
                                        <div class="flex items-center space-x-1">
                                            <i class="fas fa-comments text-orange-500"></i>
                                            <span class="font-medium">{{ $recette->commentaires->count() }}</span>
                                        </div>
                                        @endif
                                    </div>

                                    <a 
                                        href="{{ route('recettes.show', $recette->id) }}"
                                        class="btn-orange text-white px-5 py-2 rounded-lg font-semibold text-sm flex items-center space-x-2 shadow"
                                    >
                                        <span>Voir</span>
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <!-- Aucune recette -->
            <div class="bg-white rounded-3xl shadow-lg p-12 text-center animate-slide-up">
                <div class="mb-6">
                    <i class="fas fa-inbox text-gray-300 text-8xl"></i>
                </div>
                <h3 class="text-3xl font-bold text-gray-800 mb-3">
                    Aucune recette dans cette catégorie
                </h3>
                <p class="text-gray-600 text-lg mb-8 max-w-md mx-auto">
                    Soyez le premier à ajouter une recette dans la catégorie "{{ $categorie->titre }}" !
                </p>
                @auth
                    <a href="{{ route('recettes.create') }}" class="btn-orange inline-flex items-center text-white px-8 py-4 rounded-xl font-semibold shadow-lg">
                        <i class="fas fa-plus-circle mr-3"></i>
                        Ajouter une recette
                    </a>
                @else
                    <a href="{{ route('register') }}" class="btn-orange inline-flex items-center text-white px-8 py-4 rounded-xl font-semibold shadow-lg">
                        <i class="fas fa-user-plus mr-3"></i>
                        Créer un compte
                    </a>
                @endauth
            </div>
        @endif

        <!-- Statistiques de la catégorie -->
        <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6 animate-fade-in">
            <div class="bg-white rounded-2xl shadow-lg p-6 text-center">
                <div class="w-16 h-16 bg-gradient-to-br from-orange-400 to-orange-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-book-open text-white text-2xl"></i>
                </div>
                <div class="text-3xl font-bold text-gray-800 mb-1">
                    {{ isset($categorie->recettes) ? $categorie->recettes->count() : 0 }}
                </div>
                <div class="text-gray-600">Recettes</div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-6 text-center">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-calendar-alt text-white text-2xl"></i>
                </div>
                <div class="text-3xl font-bold text-gray-800 mb-1">
                    {{ $categorie->created_at->format('d/m/Y') }}
                </div>
                <div class="text-gray-600">Date de création</div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-6 text-center">
                <div class="w-16 h-16 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-chart-line text-white text-2xl"></i>
                </div>
                <div class="text-3xl font-bold text-gray-800 mb-1">
                    Active
                </div>
                <div class="text-gray-600">Statut</div>
            </div>
        </div>
    </div>

</body>
</html>