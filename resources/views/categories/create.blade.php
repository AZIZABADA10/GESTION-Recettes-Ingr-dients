<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une catégorie - Recettes App</title>
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
        
        .input-focus:focus {
            border-color: #f97316;
            box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.1);
        }
        
        .btn-orange {
            background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
            transition: all 0.3s ease;
        }
        
        .btn-orange:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(249, 115, 22, 0.3);
        }
        
        .card-shadow {
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        }
        
        .animate-fade-in {
            animation: fadeIn 0.6s ease-out;
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body class="recipe-pattern min-h-screen">

    @include('layouts.header')

    <div class="container mx-auto px-4 py-10">
        <div class="max-w-2xl mx-auto">
            
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
                    <li class="text-orange-500 font-semibold">Nouvelle catégorie</li>
                </ol>
            </nav>

            <!-- Carte du formulaire -->
            <div class="bg-white rounded-3xl card-shadow p-10 animate-fade-in">
                
                <!-- En-tête -->
                <div class="text-center mb-8">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-orange-400 to-orange-600 rounded-full mb-4 shadow-lg">
                        <i class="fas fa-folder-plus text-white text-2xl"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">
                        Ajouter une catégorie
                    </h2>
                    <p class="text-gray-600">
                        Créez une nouvelle catégorie pour organiser vos recettes
                    </p>
                </div>

                <!-- Formulaire -->
                <form action="{{ route('categories.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block font-semibold text-gray-700 mb-3">
                            <i class="fas fa-tag text-orange-500 mr-2"></i>
                            Titre de la catégorie
                        </label>
                        <input
                            type="text"
                            name="titre"
                            value="{{ old('titre') }}"
                            placeholder="Ex: Desserts, Plats principaux, Entrées..."
                            class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:outline-none input-focus transition-all text-lg"
                            required
                        >
                        @error('titre')
                            <p class="text-red-500 text-sm mt-2">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Info box -->
                    <div class="bg-orange-50 border-l-4 border-orange-500 p-4 rounded-lg">
                        <div class="flex items-start">
                            <i class="fas fa-lightbulb text-orange-500 mt-1 mr-3"></i>
                            <div>
                                <p class="font-semibold text-gray-800 mb-1">Conseil</p>
                                <p class="text-sm text-gray-600">
                                    Choisissez un nom clair et descriptif pour faciliter la navigation des utilisateurs.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Boutons d'action -->
                    <div class="flex items-center justify-between pt-4">
                        <a 
                            href="{{ route('categories.index') }}" 
                            class="text-gray-600 hover:text-gray-800 font-medium transition flex items-center"
                        >
                            <i class="fas fa-arrow-left mr-2"></i>
                            Retour
                        </a>
                        
                        <button
                            type="submit"
                            class="btn-orange text-white px-8 py-3 rounded-xl font-semibold shadow-lg flex items-center space-x-2"
                        >
                            <i class="fas fa-plus-circle"></i>
                            <span>Ajouter la catégorie</span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Exemples de catégories -->
            <div class="mt-8 bg-white/50 backdrop-blur rounded-2xl p-6 animate-fade-in">
                <h3 class="font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-lightbulb text-orange-500 mr-2"></i>
                    Exemples de catégories populaires
                </h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                    <div class="bg-white px-4 py-2 rounded-lg text-center text-sm text-gray-700 shadow-sm">
                        🍰 Desserts
                    </div>
                    <div class="bg-white px-4 py-2 rounded-lg text-center text-sm text-gray-700 shadow-sm">
                        🍝 Plats principaux
                    </div>
                    <div class="bg-white px-4 py-2 rounded-lg text-center text-sm text-gray-700 shadow-sm">
                        🥗 Entrées
                    </div>
                    <div class="bg-white px-4 py-2 rounded-lg text-center text-sm text-gray-700 shadow-sm">
                        🥤 Boissons
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>
</html>