@extends('layouts.app')
@guest
    <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">🔐 Se connecter (Admin)</a>
@endguest

@section('content')
<div class="flex flex-col justify-center items-center min-h-screen text-center px-4 space-y-6">

    <h1 class="text-3xl font-bold">
        Bienvenue sur <span class="text-gray-600 dark:text-gray-300">StoryArcade</span>
    </h1>

    <p class="max-w-xl text-lg text-gray-700 dark:text-gray-200">
        Découvrez une sélection de jeux narratifs où chaque décision façonne le cours de l’histoire.
    </p>

    <p class="max-w-xl text-base text-gray-600 dark:text-gray-400">
        Plongez dans des univers variés — fantastiques, mystérieux, futuristes ou réalistes — et vivez des aventures interactives uniques.
    </p>

    <div class="flex gap-4 mt-6">
        <a href="{{ route('play.index') }}" class="bg-green-600 text-white px-6 py-3 rounded hover:bg-green-700 font-semibold">
            🎮 Découvrir les jeux
        </a>
    </div>

    {{-- Composant Vue pour changer le thème --}}
    <div id="theme-toggle" class="mt-6">
        <theme-toggle></theme-toggle>
    </div>

</div>
@endsection

