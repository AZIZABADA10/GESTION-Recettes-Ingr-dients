<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body class="bg-gray-100 min-h-screen">

    @include('layouts.header')

    <div class="flex justify-center items-center mt-10">
        <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
            <h2 class="text-2xl font-bold mb-6 text-center text-orange-500">
                Connexion
            </h2>

            {{-- Erreurs --}}
            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block font-semibold">Email</label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-orange-300"
                        required
                    >
                </div>

                <div>
                    <label class="block font-semibold">Mot de passe</label>
                    <input
                        type="password"
                        name="password"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-orange-300"
                        required
                    >
                </div>

                <button
                    type="submit"
                    class="w-full bg-orange-500 text-white py-2 rounded hover:bg-orange-600 transition"
                >
                    Se connecter
                </button>
            </form>

            <p class="text-center mt-4 text-sm">
                Pas encore de compte ?
                <a href="{{ route('register') }}" class="text-orange-500 font-semibold hover:underline">
                    S’inscrire
                </a>
            </p>
        </div>
    </div>

</body>
</html>
