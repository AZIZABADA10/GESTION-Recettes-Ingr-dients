<header class="bg-orange-500 text-white shadow">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <h1 class="text-xl font-bold">
            Recettes App
        </h1>

        <nav class="space-x-4">
            <a href="{{ route('recettes.index') }}" class="hover:underline">
                Recettes
            </a>

            @auth
                <a href="{{ route('recettes.create') }}" class="hover:underline">
                    Ajouter une recette
                </a>

                <span class="font-semibold">{{ auth()->user()->name }}</span>

                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button class="hover:underline">
                        Déconnexion
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="hover:underline">Login</a>
                <a href="{{ route('register') }}" class="hover:underline">Register</a>
            @endauth
        </nav>
    </div>
</header>
