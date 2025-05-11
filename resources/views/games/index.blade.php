@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6 text-center">🎮 Gestion des jeux</h1>

    @auth
        @if(Auth::user()->admin)
            <div class="mb-4 text-right">
                <a href="{{ route('games.create') }}"
                   class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    ➕ Créer un nouveau jeu
                </a>
            </div>
        @endif
    @endauth

    @if($games->isEmpty())
        <p class="text-center text-gray-500">Aucun jeu disponible.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($games as $game)
                <div class="border p-4 rounded shadow bg-white dark:bg-gray-900 text-center">
                    @php
                        $cover = $game->scenes->first()?->image;
                    @endphp

                    @if($cover)
                        <img src="{{ asset('storage/' . $cover) }}" alt="{{ $game->title }}" class="w-full h-40 object-cover rounded mb-3">
                    @else
                        <div class="w-full h-40 bg-gray-200 dark:bg-gray-700 text-gray-500 flex items-center justify-center rounded mb-3">
                            Pas d’image
                        </div>
                    @endif

                    <h2 class="text-xl font-semibold">{{ $game->title }}</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-300 mb-1">Version : {{ $game->version }}</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                        {{ \Illuminate\Support\Str::limit($game->description, 80) }}
                    </p>

                    <a href="{{ route('play.start', $game) }}" class="block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-2">
                        ▶️ Jouer
                    </a>

                    @auth
                        @if(Auth::user()->admin)
                            <a href="{{ route('games.scenes.index', $game) }}" class="block bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700 mb-2">
                                📖 Scènes
                            </a>
                            <a href="{{ route('choices.index', ['game_id' => $game->id]) }}" class="block bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 mb-2">
                                🔗 Choix
                            </a>
                            <a href="{{ route('games.edit', $game) }}" class="block bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 mb-2">
                                ✏️ Modifier
                            </a>
                            <form action="{{ route('games.destroy', $game) }}" method="POST" onsubmit="return confirm('Supprimer ce jeu ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                                    🗑 Supprimer
                                </button>
                            </form>
                        @endif
                    @endauth
                </div>
            @endforeach
        </div>
    @endif
@endsection