@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6 text-center">🎮 Jeux disponibles</h1>

    @if($games->isEmpty())
        <p class="text-center text-gray-500">Aucun jeu disponible pour le moment.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($games as $game)
                <div class="border p-4 rounded shadow text-center bg-white">
                    @php
                        $cover = $game->scenes->first()?->image;
                    @endphp

                    @if($cover)
                        <img src="{{ $cover }}" alt="{{ $game->title }}" class="mb-3 w-full h-40 object-cover rounded">
                    @else
                        <div class="w-full h-40 flex items-center justify-center bg-gray-100 text-gray-500 rounded mb-3">
                            Pas d’image
                        </div>
                    @endif

                    <h2 class="text-xl font-semibold">{{ $game->title }}</h2>
                    <p class="text-sm text-gray-600 mb-4">{{ \Illuminate\Support\Str::limit($game->description, 80) }}</p>

                    <a href="{{ route('play.start', $game) }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        ▶️ Jouer
                    </a>
                </div>
            @endforeach
        </div>
    @endif
@endsection