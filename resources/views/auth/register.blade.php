<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Recettes App</title>
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

        .password-strength {
            height: 4px;
            background: #e5e7eb;
            border-radius: 2px;
            overflow: hidden;
            margin-top: 8px;
        }

        .password-strength-bar {
            height: 100%;
            transition: all 0.3s ease;
            background: linear-gradient(90deg, #ef4444 0%, #f59e0b 50%, #10b981 100%);
        }
    </style>
</head>
<body class="recipe-pattern min-h-screen">

    @include('layouts.header')

    <div class="flex justify-center items-center min-h-[calc(100vh-80px)] px-4 py-12">
        <div class="bg-white p-10 rounded-3xl card-shadow w-full max-w-md animate-fade-in">
            
            <!-- Icône décorative -->
            <div class="flex justify-center mb-6">
                <div class="bg-gradient-to-br from-orange-400 to-orange-600 w-20 h-20 rounded-full flex items-center justify-center shadow-lg">
                    <i class="fas fa-user-plus text-white text-3xl"></i>
                </div>
            </div>
            
            <h2 class="text-3xl font-bold mb-2 text-center text-gray-800">
                Rejoignez-nous !
            </h2>
            <p class="text-center text-gray-500 mb-8">
                Créez un compte et partagez vos meilleures recettes
            </p>

            {{-- Erreurs --}}
            @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-6">
                    <div class="flex items-start">
                        <i class="fas fa-exclamation-circle mt-1 mr-3"></i>
                        <ul class="list-none space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label class="block font-semibold text-gray-700 mb-2">
                        <i class="fas fa-user text-orange-500 mr-2"></i>
                        Nom complet
                    </label>
                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Votre nom"
                        class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:outline-none input-focus transition-all"
                        required
                    >
                </div>

                <div>
                    <label class="block font-semibold text-gray-700 mb-2">
                        <i class="fas fa-envelope text-orange-500 mr-2"></i>
                        Adresse email
                    </label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="votre@email.com"
                        class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:outline-none input-focus transition-all"
                        required
                    >
                </div>

                <div>
                    <label class="block font-semibold text-gray-700 mb-2">
                        <i class="fas fa-lock text-orange-500 mr-2"></i>
                        Mot de passe
                    </label>
                    <input
                        type="password"
                        name="password"
                        placeholder="••••••••"
                        class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:outline-none input-focus transition-all"
                        required
                    >
                    <p class="text-xs text-gray-500 mt-2">
                        <i class="fas fa-info-circle mr-1"></i>
                        Minimum 8 caractères
                    </p>
                </div>

                <div class="bg-orange-50 border border-orange-200 rounded-xl p-4">
                    <div class="flex items-start">
                        <i class="fas fa-shield-alt text-orange-500 mt-1 mr-3"></i>
                        <p class="text-sm text-gray-700">
                            En créant un compte, vous acceptez nos conditions d'utilisation et notre politique de confidentialité.
                        </p>
                    </div>
                </div>

                <button
                    type="submit"
                    class="w-full btn-orange text-white py-3.5 rounded-xl font-semibold text-lg shadow-lg"
                >
                    <i class="fas fa-rocket mr-2"></i>
                    Créer mon compte
                </button>
            </form>

            <div class="relative my-8">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-200"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-4 bg-white text-gray-500">Déjà membre ?</span>
                </div>
            </div>

            <p class="text-center text-gray-600">
                Vous avez déjà un compte ?
                <a href="{{ route('login') }}" class="text-orange-500 font-bold hover:text-orange-600 transition hover:underline">
                    Se connecter
                </a>
            </p>

            <!-- Avantages de l'inscription -->
            <div class="mt-8 pt-6 border-t border-gray-100">
                <p class="text-xs text-gray-500 text-center mb-4 font-semibold">
                    En rejoignant notre communauté :
                </p>
                <div class="grid grid-cols-3 gap-3 text-center">
                    <div>
                        <i class="fas fa-book-open text-orange-500 text-xl mb-2"></i>
                        <p class="text-xs text-gray-600">Recettes illimitées</p>
                    </div>
                    <div>
                        <i class="fas fa-heart text-orange-500 text-xl mb-2"></i>
                        <p class="text-xs text-gray-600">Favoris</p>
                    </div>
                    <div>
                        <i class="fas fa-users text-orange-500 text-xl mb-2"></i>
                        <p class="text-xs text-gray-600">Communauté</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>