<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
</head>
<body class="bg-gray-100 min-h-screen">

    @include('layouts.header')

    <div class="flex justify-center items-center mt-10">
        <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
            <h2 class="text-2xl font-bold mb-6 text-center text-orange-500">
                Inscription
            </h2>

            {{-- Erreurs --}}
            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                    <ul class="list-disc pl-4">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block font-semibold">Nom</label>
                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-orange-300"
                        required
                    >
                </div>

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
                    S’inscrire
                </button>
            </form>

            <p class="text-center mt-4 text-sm">
                Déjà un compte ?
                <a href="{{ route('login') }}" class="text-orange-500 font-semibold hover:underline">
                    Se connecter
                </a>
            </p>
        </div>
    </div>

</body>
</html>
