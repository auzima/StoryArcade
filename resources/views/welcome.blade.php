@extends('layouts.app')

@section('content')
<div style="display: flex; justify-content: center; align-items: center; height: 80vh; flex-direction: column; text-align: center; padding: 2rem;">
    <h1 style="font-size: 2.5rem; font-weight: bold; margin-bottom: 1rem;">
        Bienvenue sur <span style="color: #4B5563;">StoryArcade</span>
    </h1>

    <p style="max-width: 600px; font-size: 1.1rem; margin-bottom: 2rem;">
        Découvrez une sélection de jeux narratifs où chaque décision que vous prenez façonne le cours de l’histoire.
    </p>

    <p style="max-width: 600px; font-size: 1rem; margin-bottom: 2.5rem;">
        Entrez dans des univers variés — fantastiques, mystérieux, futuristes ou réalistes — et vivez des aventures interactives uniques. Chaque jeu vous propose un scénario différent, à explorer à votre rythme.
    </p>
    <!-- 
        <div style="display: flex; gap: 20px;">
            <a href="{{ route('games.index') }}" style="padding: 12px 24px; background-color: #4CAF50; color: white; font-weight: bold; border-radius: 10px; text-decoration: none; font-size: 1rem;">
                🎮 Explorer les jeux disponibles
            </a> -->

    <a href="{{ route('play.index') }}" class="bg-green-600 text-white px-6 py-3 rounded hover:bg-green-700">
        🎮 Découvrir les jeux
    </a>

    {{-- Bouton admin facultatif --}}
    {{-- <a href="{{ route('login') }}" style="padding: 12px 24px; background-color: #2196F3; color: white; border-radius: 10px; text-decoration: none; font-size: 1rem;">
    🔐 Se connecter (Admin)
    </a> --}}
</div>
</div>
@endsection