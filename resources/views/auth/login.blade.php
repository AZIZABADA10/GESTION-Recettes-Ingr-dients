<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Recettes App</title>
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

    <div class="flex justify-center items-center min-h-[calc(100vh-80px)] px-4 py-12">
        <div class="bg-white p-10 rounded-3xl card-shadow w-full max-w-md animate-fade-in">
            
            <!-- Icône décorative -->
            <div class="flex justify-center mb-6">
                <div class="bg-gradient-to-br from-orange-400 to-orange-600 w-20 h-20 rounded-full flex items-center justify-center shadow-lg">
                    <i class="fas fa-utensils text-white text-3xl"></i>
                </div>
            </div>
            
            <h2 class="text-3xl font-bold mb-2 text-center text-gray-800">
                Bon retour !
            </h2>
            <p class="text-center text-gray-500 mb-8">
                Connectez-vous pour partager vos recettes
            </p>

            {{-- Erreurs --}}
            @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-6 flex items-start">
                    <i class="fas fa-exclamation-circle mt-1 mr-3"></i>
                    <div>
                        {{ $errors->first() }}
                    </div>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf

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
                </div>

                

                <button
                    type="submit"
                    class="w-full btn-orange text-white py-3.5 rounded-xl font-semibold text-lg shadow-lg"
                >
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    Se connecter
                </button>
            </form>

            <div class="relative my-8">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-200"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-4 bg-white text-gray-500">Ou</span>
                </div>
            </div>

            <p class="text-center text-gray-600">
                Pas encore de compte ?
                <a href="{{ route('register') }}" class="text-orange-500 font-bold hover:text-orange-600 transition hover:underline">
                    Créer un compte
                </a>
            </p>
        </div>
    </div>

</body>
</html>