<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une recette - Recettes App</title>
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

        .file-upload-wrapper {
            position: relative;
            overflow: hidden;
        }

        .file-upload-input {
            position: absolute;
            left: -9999px;
        }

        .file-upload-label {
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .file-upload-label:hover {
            background-color: #f97316;
            color: white;
        }

        .image-preview {
            display: none;
            max-width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 12px;
            margin-top: 12px;
        }
    </style>
</head>
<body class="recipe-pattern min-h-screen">

    @include('layouts.header')

    <div class="container mx-auto px-4 py-10">
        <div class="max-w-3xl mx-auto">
            
            <!-- Breadcrumb -->
            <nav class="mb-8 animate-fade-in">
                <ol class="flex items-center space-x-2 text-sm text-gray-600">
                    <li>
                        <a href="{{ route('recettes.index') }}" class="hover:text-orange-500 transition">
                            <i class="fas fa-home mr-1"></i>
                            Recettes
                        </a>
                    </li>
                    <li><i class="fas fa-chevron-right text-xs"></i></li>
                    <li class="text-orange-500 font-semibold">Nouvelle recette</li>
                </ol>
            </nav>

            <!-- Carte du formulaire -->
            <div class="bg-white rounded-3xl card-shadow p-10 animate-fade-in">
                
                <!-- En-tête -->
                <div class="text-center mb-8">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-orange-400 to-orange-600 rounded-full mb-4 shadow-lg">
                        <i class="fas fa-utensils text-white text-3xl"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">
                        Partagez votre recette
                    </h2>
                    <p class="text-gray-600">
                        Faites découvrir vos talents culinaires à la communauté
                    </p>
                </div>

                <!-- Formulaire -->
                <form action="{{ route('recettes.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- Titre -->
                    <div>
                        <label class="block font-semibold text-gray-700 mb-3">
                            <i class="fas fa-heading text-orange-500 mr-2"></i>
                            Titre de la recette
                        </label>
                        <input
                            type="text"
                            name="titre"
                            id="titre"
                            value="{{ old('titre') }}"
                            placeholder="Ex: Tajine marocain aux légumes"
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

                    <!-- Catégorie -->
                    <div>
                        <label class="block font-semibold text-gray-700 mb-3">
                            <i class="fas fa-folder-open text-orange-500 mr-2"></i>
                            Catégorie
                        </label>
                        <select
                            name="categorie_id"
                            id="categorie_id"
                            class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:outline-none input-focus transition-all text-lg"
                            required
                        >
                            <option value="">-- Choisir une catégorie --</option>
                            @foreach($categories as $categorie)
                                <option value="{{ $categorie->id }}" {{ old('categorie_id') == $categorie->id ? 'selected' : '' }}>
                                    {{ $categorie->titre }}
                                </option>
                            @endforeach
                        </select>
                        @error('categorie_id')
                            <p class="text-red-500 text-sm mt-2">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block font-semibold text-gray-700 mb-3">
                            <i class="fas fa-align-left text-orange-500 mr-2"></i>
                            Description & Instructions
                        </label>
                        <textarea
                            name="description"
                            id="description"
                            rows="8"
                            placeholder="Décrivez votre recette en détail : ingrédients, étapes de préparation, temps de cuisson..."
                            class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:outline-none input-focus transition-all resize-none"
                            required
                        >{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-2">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Image -->
                    <div>
                        <label class="block font-semibold text-gray-700 mb-3">
                            <i class="fas fa-image text-orange-500 mr-2"></i>
                            Photo de la recette
                        </label>
                        <div class="file-upload-wrapper">
                            <input
                                type="file"
                                name="image"
                                id="image"
                                class="file-upload-input"
                                accept="image/*"
                                required
                                onchange="previewImage(event)"
                            >
                            <label for="image" class="file-upload-label block w-full border-2 border-dashed border-gray-300 rounded-xl px-6 py-8 text-center hover:border-orange-500 transition-all">
                                <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-3"></i>
                                <p class="text-gray-600 font-medium">
                                    Cliquez pour choisir une image
                                </p>
                                <p class="text-gray-400 text-sm mt-1">
                                    PNG, JPG ou JPEG (Max. 2MB)
                                </p>
                            </label>
                        </div>
                        <img id="imagePreview" class="image-preview" alt="Aperçu de l'image">
                        @error('image')
                            <p class="text-red-500 text-sm mt-2">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- User ID (caché) -->
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                    <!-- Conseils -->
                    <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-lg">
                        <div class="flex items-start">
                            <i class="fas fa-lightbulb text-blue-500 mt-1 mr-3"></i>
                            <div>
                                <p class="font-semibold text-gray-800 mb-1">Conseils pour une belle recette</p>
                                <ul class="text-sm text-gray-600 space-y-1">
                                    <li>• Utilisez une photo claire et appétissante</li>
                                    <li>• Détaillez bien les ingrédients et les quantités</li>
                                    <li>• Expliquez chaque étape de préparation</li>
                                    <li>• Ajoutez des astuces personnelles</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Boutons d'action -->
                    <div class="flex items-center justify-between pt-6 border-t border-gray-100">
                        <a 
                            href="{{ route('recettes.index') }}" 
                            class="text-gray-600 hover:text-gray-800 font-medium transition flex items-center"
                        >
                            <i class="fas fa-arrow-left mr-2"></i>
                            Annuler
                        </a>
                        
                        <button
                            type="submit"
                            class="btn-orange text-white px-8 py-4 rounded-xl font-semibold shadow-lg flex items-center space-x-3 text-lg"
                        >
                            <i class="fas fa-paper-plane"></i>
                            <span>Publier la recette</span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Statistiques ou encouragements -->
            <div class="mt-8 bg-white/50 backdrop-blur rounded-2xl p-6 text-center animate-fade-in">
                <p class="text-gray-600 flex items-center justify-center space-x-2">
                    <i class="fas fa-users text-orange-500"></i>
                    <span>Rejoignez des milliers de passionnés de cuisine qui partagent leurs recettes</span>
                </p>
            </div>

        </div>
    </div>

    <script>
        function previewImage(event) {
            const preview = document.getElementById('imagePreview');
            const file = event.target.files[0];
            const label = document.querySelector('.file-upload-label');
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    label.style.display = 'none';
                }
                reader.readAsDataURL(file);
            }
        }
    </script>

</body>
</html>