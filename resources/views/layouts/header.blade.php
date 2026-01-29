<header class="bg-white shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-4 py-4">
        <div class="flex justify-between items-center">
            <!-- Logo et titre -->
            <div class="flex items-center space-x-3">
                <div class="bg-gradient-to-br from-orange-400 to-orange-600 w-12 h-12 rounded-full flex items-center justify-center shadow-lg">
                    <i class="fas fa-utensils text-white text-xl"></i>
                </div>
                <a href="{{ route('recettes.index') }}" class="flex flex-col">
                    <h1 class="text-2xl font-bold text-gray-800">
                        Recettes<span class="text-orange-500">App</span>
                    </h1>
                    <p class="text-xs text-gray-500 -mt-1">Partagez vos saveurs</p>
                </a>
            </div>

            <!-- Navigation Desktop -->
            <nav class="hidden md:flex items-center space-x-6">
                <a href="{{ route('recettes.index') }}" class="flex items-center text-gray-700 hover:text-orange-500 font-medium transition-colors">
                    <i class="fas fa-home mr-2"></i>
                    Recettes
                </a>
                
                @auth
                    <a href="{{ route('recettes.create') }}" class="flex items-center bg-gradient-to-r from-orange-500 to-orange-600 text-white px-4 py-2 rounded-lg hover:shadow-lg transition-all hover:-translate-y-0.5">
                        <i class="fas fa-plus-circle mr-2"></i>
                        Ajouter une recette
                    </a>
                    
                    <div class="flex items-center space-x-3 border-l pl-6">
                        <div class="flex items-center space-x-2">
                            <div class="w-10 h-10 bg-gradient-to-br from-orange-400 to-orange-600 rounded-full flex items-center justify-center text-white font-bold shadow">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <span class="font-semibold text-gray-800">{{ auth()->user()->name }}</span>
                        </div>
                        
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button class="text-gray-600 hover:text-red-500 transition-colors p-2 rounded-lg hover:bg-red-50" title="Déconnexion">
                                <i class="fas fa-sign-out-alt"></i>
                            </button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="flex items-center text-gray-700 hover:text-orange-500 font-medium transition-colors">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Connexion
                    </a>
                    <a href="{{ route('register') }}" class="flex items-center bg-gradient-to-r from-orange-500 to-orange-600 text-white px-4 py-2 rounded-lg hover:shadow-lg transition-all hover:-translate-y-0.5">
                        <i class="fas fa-user-plus mr-2"></i>
                        Inscription
                    </a>
                @endauth
            </nav>

            <!-- Menu Mobile Toggle -->
            <button id="mobile-menu-btn" class="md:hidden text-gray-700 hover:text-orange-500 focus:outline-none">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>

        <!-- Navigation Mobile -->
        <nav id="mobile-menu" class="hidden md:hidden mt-4 pb-4 border-t pt-4 space-y-3">
            <a href="{{ route('recettes.index') }}" class="flex items-center text-gray-700 hover:text-orange-500 font-medium py-2 transition-colors">
                <i class="fas fa-home mr-3 w-5"></i>
                Recettes
            </a>
            
            @auth
                <a href="{{ route('recettes.create') }}" class="flex items-center text-gray-700 hover:text-orange-500 font-medium py-2 transition-colors">
                    <i class="fas fa-plus-circle mr-3 w-5"></i>
                    Ajouter une recette
                </a>
                
                <div class="flex items-center justify-between py-2 border-t mt-2 pt-3">
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-gradient-to-br from-orange-400 to-orange-600 rounded-full flex items-center justify-center text-white font-bold text-sm shadow">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <span class="font-semibold text-gray-800">{{ auth()->user()->name }}</span>
                    </div>
                    
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button class="text-red-500 hover:text-red-600 font-medium flex items-center">
                            <i class="fas fa-sign-out-alt mr-2"></i>
                            Déconnexion
                        </button>
                    </form>
                </div>
            @else
                <a href="{{ route('login') }}" class="flex items-center text-gray-700 hover:text-orange-500 font-medium py-2 transition-colors">
                    <i class="fas fa-sign-in-alt mr-3 w-5"></i>
                    Connexion
                </a>
                <a href="{{ route('register') }}" class="flex items-center bg-gradient-to-r from-orange-500 to-orange-600 text-white px-4 py-2 rounded-lg hover:shadow-lg transition-all justify-center">
                    <i class="fas fa-user-plus mr-2"></i>
                    Inscription
                </a>
            @endauth
        </nav>
    </div>
</header>

<script>
    // Toggle mobile menu
    document.getElementById('mobile-menu-btn').addEventListener('click', function() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });
</script>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
    
    header {
        font-family: 'Poppins', sans-serif;
    }
</style>