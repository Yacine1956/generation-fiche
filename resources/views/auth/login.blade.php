<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-[#f4f6fb] flex items-center justify-center px-4">

    <div class="w-full max-w-sm bg-white rounded-2xl p-7 shadow-sm border border-slate-100">

        <!-- LOGO -->
        <div class="flex justify-center">
            <img
                src="{{ asset('images/logo.png') }}"
                class="w-14 h-14 object-contain"
                alt="logo"
            >
        </div>

        <!-- TITLE -->
        <div class="text-center mt-4">
            <h1 class="text-2xl font-semibold text-slate-800">
                Connexion
            </h1>
            <p class="text-xs text-slate-500 mt-1">
                Espace universitaire
            </p>
        </div>

        <!-- FORM -->
        <form action="{{ route('login') }}" method="POST" class="mt-6 space-y-4">

            @csrf

            <!-- EMAIL -->
            <div>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Email universitaire"
                    class="w-full h-10 px-3 rounded-lg border border-slate-200 bg-slate-50 text-sm focus:outline-none focus:ring-2 focus:ring-blue-100"
                >
            </div>

            <!-- PASSWORD -->
            <div>
                <input
                    type="password"
                    name="password"
                    placeholder="Mot de passe"
                    class="w-full h-10 px-3 rounded-lg border border-slate-200 bg-slate-50 text-sm focus:outline-none focus:ring-2 focus:ring-blue-100"
                >
            </div>

            <!-- OPTIONS -->
            <div class="flex items-center justify-between text-xs text-slate-500">

                <label class="flex items-center gap-2">
                    <input type="checkbox">
                    Se souvenir
                </label>

                <a href="#" class="hover:text-slate-800">
                    Mot de passe ?
                </a>

            </div>

            <!-- BUTTON -->
            <button
                type="submit"
                class="w-full h-10 rounded-lg bg-slate-900 text-white text-sm hover:bg-slate-800"
            >
                Se connecter
            </button>

        </form>

    </div>

</body>
</html>
