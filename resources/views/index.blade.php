@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto py-10 px-4">
        <h1 class="text-2xl font-bold mb-6 text-center">🎮 Jeux disponibles</h1>

        @if($games->isEmpty())
            <p class="text-center text-gray-500">Aucun jeu disponible pour le moment.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach($games as $game)
                    <div class="border rounded shadow p-4 text-center">
                        <h2 class="text-xl font-semibold mb-2">{{ $game->title }}</h2>
                        @if($game->cover_image)
                            <img src="{{ $game->cover_image }}" alt="{{ $game->title }}" class="w-full h-40 object-cover mb-3 rounded">
                        @endif
                        <a href="{{ route('games.show', $game) }}" class="inline-block mt-2 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                            ▶️ Jouer
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection