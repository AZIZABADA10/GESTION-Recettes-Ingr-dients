<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $recette->titre }} - Recettes App</title>
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

        .comment-card {
            transition: all 0.3s ease;
        }

        .comment-card:hover {
            transform: translateX(4px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .delete-btn:hover {
            background-color: #dc2626;
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
                    <a href="{{ route('recettes.index') }}" class="hover:text-orange-500 transition">
                        <i class="fas fa-home mr-1"></i>
                        Recettes
                    </a>
                </li>
                <li><i class="fas fa-chevron-right text-xs"></i></li>
                @if($recette->categorie)
                <li>
                    <a href="{{ route('categories.show', $recette->categorie->id) }}" class="hover:text-orange-500 transition">
                        {{ $recette->categorie->titre }}
                    </a>
                </li>
                <li><i class="fas fa-chevron-right text-xs"></i></li>
                @endif
                <li class="text-orange-500 font-semibold">{{ \Illuminate\Support\Str::limit($recette->titre, 30) }}</li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Contenu principal -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Carte principale de la recette -->
                <div class="bg-white rounded-3xl shadow-2xl overflow-hidden animate-fade-in">
                    
                    <!-- Image de la recette -->
                    @if($recette->image)
                        <div class="relative h-96 overflow-hidden">
                            <img 
                                src="{{ asset('images/' . $recette->image) }}" 
                                alt="{{ $recette->titre }}"
                                class="w-full h-full object-cover"
                            >
                            <!-- Overlay gradient -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                            
                            <!-- Badge catégorie -->
                            @if($recette->categorie)
                            <div class="absolute top-6 right-6">
                                <a href="{{ route('categories.show', $recette->categorie->id) }}" class="bg-orange-500 text-white px-5 py-2 rounded-full text-sm font-semibold shadow-lg hover:bg-orange-600 transition flex items-center space-x-2">
                                    <i class="fas fa-tag"></i>
                                    <span>{{ $recette->categorie->titre }}</span>
                                </a>
                            </div>
                            @endif
                        </div>
                    @endif

                    <!-- Contenu -->
                    <div class="p-8">
                        
                        <!-- Titre et auteur -->
                        <div class="mb-6">
                            <h1 class="text-4xl font-bold text-gray-800 mb-4">
                                {{ $recette->titre }}
                            </h1>
                            
                            <div class="flex items-center justify-between flex-wrap gap-4">
                                <!-- Info auteur -->
                                <div class="flex items-center space-x-3">
                                    <div class="w-12 h-12 bg-gradient-to-br from-orange-400 to-orange-600 rounded-full flex items-center justify-center text-white font-bold shadow">
                                        {{ strtoupper(substr($recette->user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Partagé par</p>
                                        <p class="font-semibold text-gray-800">{{ $recette->user->name }}</p>
                                    </div>
                                </div>

                                <!-- Stats -->
                                <div class="flex items-center space-x-6 text-sm text-gray-600">
                                    <div class="flex items-center space-x-2">
                                        <i class="fas fa-calendar text-orange-500"></i>
                                        <span>{{ $recette->created_at->diffForHumans() }}</span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <i class="fas fa-comments text-orange-500"></i>
                                        <span>{{ $recette->commentaires->count() }} commentaire{{ $recette->commentaires->count() > 1 ? 's' : '' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Séparateur -->
                        <div class="border-t border-gray-100 my-6"></div>

                        <!-- Description -->
                        <div class="prose max-w-none">
                            <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                                <i class="fas fa-book-open text-orange-500 mr-3"></i>
                                Préparation
                            </h2>
                            <div class="text-gray-700 leading-relaxed whitespace-pre-line">
                                {{ $recette->description }}
                            </div>
                        </div>

                        <!-- Actions propriétaire -->
                        @auth
                            @if($recette->user_id == auth()->id())
                                <div class="mt-8 pt-6 border-t border-gray-100 flex items-center justify-between">
                                    <p class="text-gray-600 flex items-center">
                                        <i class="fas fa-info-circle text-blue-500 mr-2"></i>
                                        Vous êtes l'auteur de cette recette
                                    </p>
                                    <div class="flex items-center space-x-3">
                                        <a 
                                            href="{{ route('recettes.edit', $recette->id) }}" 
                                            class="bg-orange-50 hover:bg-orange-100 text-orange-600 px-6 py-3 rounded-xl font-semibold transition flex items-center space-x-2"
                                        >
                                            <i class="fas fa-edit"></i>
                                            <span>Modifier</span>
                                        </a>
                                        <form action="{{ route('recettes.destroy', $recette->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette recette ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button 
                                                type="submit" 
                                                class="delete-btn bg-red-50 hover:bg-red-500 text-red-600 hover:text-white px-6 py-3 rounded-xl font-semibold transition flex items-center space-x-2"
                                            >
                                                <i class="fas fa-trash-alt"></i>
                                                <span>Supprimer</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>

                <!-- Section commentaires -->
                <div class="bg-white rounded-3xl shadow-lg p-8 animate-slide-up">
                    <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                        <i class="fas fa-comments text-orange-500 mr-3"></i>
                        Commentaires ({{ $recette->commentaires->count() }})
                    </h3>

                    <!-- Formulaire d'ajout de commentaire -->
                    @auth
                        <form action="#" method="POST" class="mb-8">
                            @csrf
                            <input type="hidden" name="recette_id" value="{{ $recette->id }}">
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                            
                            <div class="flex items-start space-x-4">
                                <div class="w-10 h-10 bg-gradient-to-br from-orange-400 to-orange-600 rounded-full flex items-center justify-center text-white font-bold shadow flex-shrink-0">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                                <div class="flex-1">
                                    <textarea
                                        name="contenu"
                                        rows="3"
                                        placeholder="Partagez votre avis sur cette recette..."
                                        class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-all resize-none"
                                        required
                                    ></textarea>
                                    <div class="mt-3 flex justify-end">
                                        <button type="submit" class="btn-orange text-white px-6 py-2 rounded-lg font-semibold shadow-lg flex items-center space-x-2">
                                            <i class="fas fa-paper-plane"></i>
                                            <span>Commenter</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @else
                        <div class="bg-orange-50 border-l-4 border-orange-500 p-4 rounded-lg mb-8">
                            <p class="text-gray-700">
                                <i class="fas fa-info-circle text-orange-500 mr-2"></i>
                                <a href="{{ route('login') }}" class="font-semibold text-orange-600 hover:underline">Connectez-vous</a> pour laisser un commentaire
                            </p>
                        </div>
                    @endauth

                    <!-- Liste des commentaires -->
                    @forelse($recette->commentaires as $commentaire)
                        <div class="comment-card bg-gray-50 rounded-xl p-6 mb-4">
                            <div class="flex items-start space-x-4">
                                <div class="w-10 h-10 bg-gradient-to-br from-gray-400 to-gray-600 rounded-full flex items-center justify-center text-white font-bold shadow flex-shrink-0">
                                    {{ strtoupper(substr($commentaire->user->name, 0, 1)) }}
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center justify-between mb-2">
                                        <div>
                                            <p class="font-semibold text-gray-800">{{ $commentaire->user->name }}</p>
                                            <p class="text-xs text-gray-500">{{ $commentaire->created_at->diffForHumans() }}</p>
                                        </div>
                                        @auth
                                            @if($commentaire->user_id == auth()->id())
                                                <!-- <form action="{{ route('commentaires.destroy', $commentaire->id) }}" method="POST" onsubmit="return confirm('Supprimer ce commentaire ?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-500 hover:text-red-600 text-sm">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form> -->
                                            @endif
                                        @endauth
                                    </div>
                                    <p class="text-gray-700">{{ $commentaire->contenu }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <i class="fas fa-comment-slash text-gray-300 text-6xl mb-4"></i>
                            <p class="text-gray-500">Aucun commentaire pour le moment</p>
                            <p class="text-sm text-gray-400">Soyez le premier à donner votre avis !</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1 space-y-6">
                
                <!-- Informations rapides -->
                <div class="bg-white rounded-2xl shadow-lg p-6 animate-fade-in sticky top-24">
                    <h4 class="font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-info-circle text-orange-500 mr-2"></i>
                        Informations
                    </h4>
                    
                    <div class="space-y-4">
                        <div class="flex items-center justify-between py-3 border-b border-gray-100">
                            <span class="text-gray-600 flex items-center">
                                <i class="fas fa-folder text-orange-500 mr-2 w-5"></i>
                                Catégorie
                            </span>
                            <span class="font-semibold text-gray-800">
                                {{ $recette->categorie->titre ?? 'Non définie' }}
                            </span>
                        </div>

                        <div class="flex items-center justify-between py-3 border-b border-gray-100">
                            <span class="text-gray-600 flex items-center">
                                <i class="fas fa-user text-orange-500 mr-2 w-5"></i>
                                Auteur
                            </span>
                            <span class="font-semibold text-gray-800">
                                {{ $recette->user->name }}
                            </span>
                        </div>

                        <div class="flex items-center justify-between py-3 border-b border-gray-100">
                            <span class="text-gray-600 flex items-center">
                                <i class="fas fa-calendar-plus text-orange-500 mr-2 w-5"></i>
                                Publiée
                            </span>
                            <span class="font-semibold text-gray-800">
                                {{ $recette->created_at->format('d/m/Y') }}
                            </span>
                        </div>

                        <div class="flex items-center justify-between py-3">
                            <span class="text-gray-600 flex items-center">
                                <i class="fas fa-comments text-orange-500 mr-2 w-5"></i>
                                Commentaires
                            </span>
                            <span class="font-semibold text-gray-800">
                                {{ $recette->commentaires->count() }}
                            </span>
                        </div>
                    </div>

                    <div class="mt-6 pt-4 border-t border-gray-100">
                        <a href="{{ route('recettes.index') }}" class="block w-full bg-orange-50 hover:bg-orange-100 text-orange-600 px-4 py-3 rounded-xl font-semibold transition text-center">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Retour aux recettes
                        </a>
                    </div>
                </div>

                <!-- Partage (optionnel) -->
                <div class="bg-gradient-to-br from-orange-400 to-orange-600 rounded-2xl shadow-lg p-6 text-white text-center animate-fade-in">
                    <i class="fas fa-heart text-5xl mb-3 opacity-90"></i>
                    <h4 class="font-bold text-xl mb-2">Vous aimez cette recette ?</h4>
                    <p class="text-orange-100 text-sm mb-4">
                        Partagez-la avec vos amis !
                    </p>
                    <div class="flex justify-center space-x-3">
                        <button class="bg-white/20 hover:bg-white/30 backdrop-blur w-10 h-10 rounded-full flex items-center justify-center transition">
                            <i class="fab fa-facebook-f"></i>
                        </button>
                        <button class="bg-white/20 hover:bg-white/30 backdrop-blur w-10 h-10 rounded-full flex items-center justify-center transition">
                            <i class="fab fa-twitter"></i>
                        </button>
                        <button class="bg-white/20 hover:bg-white/30 backdrop-blur w-10 h-10 rounded-full flex items-center justify-center transition">
                            <i class="fab fa-whatsapp"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>