<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des catégories - Recettes App</title>
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
        
        .category-card {
            transition: all 0.3s ease;
        }
        
        .category-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 30px rgba(249, 115, 22, 0.15);
        }
        
        .btn-orange {
            background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
            transition: all 0.3s ease;
        }
        
        .btn-orange:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(249, 115, 22, 0.3);
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

        .delete-btn:hover {
            background-color: #dc2626;
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
                        <i class="fas fa-folder-open text-orange-500 mr-3"></i>
                        Gestion des catégories
                    </h2>
                    <p class="text-gray-600 text-lg">
                        {{ $categories->count() }} {{ $categories->count() > 1 ? 'catégories' : 'catégorie' }} disponible{{ $categories->count() > 1 ? 's' : '' }}
                    </p>
                </div>

                <!-- Bouton d'ajout -->
                <div class="mt-4 md:mt-0">
                    <a 
                        href="{{ route('categories.create') }}" 
                        class="btn-orange inline-flex items-center text-white px-6 py-3 rounded-xl font-semibold shadow-lg"
                    >
                        <i class="fas fa-plus-circle mr-2"></i>
                        Ajouter une catégorie
                    </a>
                </div>
            </div>
        </div>

        <!-- Messages de succès -->
        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-8 flex items-start animate-fade-in">
                <i class="fas fa-check-circle mt-1 mr-3 text-xl"></i>
                <div class="flex-1">
                    <p class="font-semibold">Succès !</p>
                    <p>{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @forelse ($categories as $index => $categorie)
            @if($loop->first)
                <!-- Grille des catégories -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @endif
            
            <!-- Carte de catégorie -->
            <div class="category-card bg-white rounded-2xl shadow-lg p-6 animate-slide-up" style="animation-delay: {{ $index * 0.1 }}s;">
                
                <!-- En-tête de la carte -->
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-orange-400 to-orange-600 rounded-xl flex items-center justify-center shadow-md">
                            <i class="fas fa-tag text-white text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">
                                {{ $categorie->titre }}
                            </h3>
                            @if(isset($categorie->recettes))
                                <p class="text-sm text-gray-500">
                                    {{ $categorie->recettes->count() }} recette{{ $categorie->recettes->count() > 1 ? 's' : '' }}
                                </p>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Badge de statut (optionnel) -->
                    <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-xs font-semibold">
                        Active
                    </span>
                </div>

                <!-- Description ou info supplémentaire -->
                <div class="mb-4 pb-4 border-b border-gray-100">
                    <p class="text-gray-600 text-sm">
                        Créée {{ $categorie->created_at->diffForHumans() }}
                    </p>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-between space-x-2">
                    <!-- Bouton Voir -->
                    <a 
                        href="{{ route('categories.show', $categorie->id) }}" 
                        class="flex-1 bg-blue-50 hover:bg-blue-100 text-blue-600 px-4 py-2 rounded-lg font-medium transition text-center flex items-center justify-center space-x-2"
                        title="Voir les détails"
                    >
                        <i class="fas fa-eye"></i>
                        <span>Voir</span>
                    </a>

                    <!-- Bouton Modifier -->
                    <a 
                        href="{{ route('categories.edit', $categorie->id) }}" 
                        class="flex-1 bg-orange-50 hover:bg-orange-100 text-orange-600 px-4 py-2 rounded-lg font-medium transition text-center flex items-center justify-center space-x-2"
                        title="Modifier"
                    >
                        <i class="fas fa-edit"></i>
                        <span>Modifier</span>
                    </a>

                    <!-- Bouton Supprimer -->
                    <form action="{{ route('categories.destroy', $categorie->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?');">
                        @csrf
                        @method('DELETE')
                        <button 
                            type="submit" 
                            class="w-full delete-btn bg-red-50 hover:bg-red-500 text-red-600 hover:text-white px-4 py-2 rounded-lg font-medium transition flex items-center justify-center space-x-2"
                            title="Supprimer"
                        >
                            <i class="fas fa-trash-alt"></i>
                            <span>Supprimer</span>
                        </button>
                    </form>
                </div>
            </div>

            @if($loop->last)
                </div> <!-- Fin de la grille -->
            @endif
        @empty
            <!-- État vide -->
            <div class="empty-state rounded-3xl shadow-lg p-12 text-center animate-slide-up">
                <div class="mb-6">
                    <i class="fas fa-folder-open text-orange-300 text-8xl"></i>
                </div>
                <h3 class="text-3xl font-bold text-gray-800 mb-3">
                    Aucune catégorie disponible
                </h3>
                <p class="text-gray-600 text-lg mb-8 max-w-md mx-auto">
                    Commencez par créer votre première catégorie pour organiser vos recettes !
                </p>
                <a 
                    href="{{ route('categories.create') }}" 
                    class="btn-orange inline-flex items-center text-white px-8 py-4 rounded-xl font-semibold shadow-lg"
                >
                    <i class="fas fa-plus-circle mr-3"></i>
                    Créer ma première catégorie
                </a>

                <!-- Exemples de catégories -->
                <div class="mt-10">
                    <p class="text-sm text-gray-500 mb-4">Suggestions de catégories :</p>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 max-w-2xl mx-auto">
                        <div class="bg-white px-4 py-2 rounded-lg text-sm text-gray-700 shadow-sm">
                            🍰 Desserts
                        </div>
                        <div class="bg-white px-4 py-2 rounded-lg text-sm text-gray-700 shadow-sm">
                            🍝 Plats principaux
                        </div>
                        <div class="bg-white px-4 py-2 rounded-lg text-sm text-gray-700 shadow-sm">
                            🥗 Entrées
                        </div>
                        <div class="bg-white px-4 py-2 rounded-lg text-sm text-gray-700 shadow-sm">
                            🥤 Boissons
                        </div>
                    </div>
                </div>
            </div>
        @endforelse

        <!-- Statistiques globales (optionnel) -->
        @if($categories->isNotEmpty())
        <div class="mt-12 bg-gradient-to-r from-orange-500 to-orange-600 rounded-3xl shadow-2xl p-8 text-white animate-fade-in">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
                <div>
                    <div class="text-4xl font-bold mb-2">{{ $categories->count() }}</div>
                    <div class="text-orange-100">Catégories totales</div>
                </div>
                <div>
                    <div class="text-4xl font-bold mb-2">
                        {{ $categories->sum(function($cat) { return isset($cat->recettes) ? $cat->recettes->count() : 0; }) }}
                    </div>
                    <div class="text-orange-100">Recettes organisées</div>
                </div>
                <div>
                    <div class="text-4xl font-bold mb-2">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="text-orange-100">Organisation optimale</div>
                </div>
            </div>
        </div>
        @endif
    </div>

</body>
</html>