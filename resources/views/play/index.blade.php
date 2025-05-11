@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-6 text-center text-gray-900 dark:text-white">🎮 Jeux disponibles</h1>

@if($games->isEmpty())
<p class="text-center text-gray-500 dark:text-gray-400">Aucun jeu disponible pour le moment.</p>
@else
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($games as $game)
    <div class="border p-4 rounded shadow text-center bg-white dark:bg-gray-800 dark:border-gray-700">
        @php
        $cover = $game->scenes->first()?->image;
        @endphp

        @if($cover)
        <img src="{{ asset('storage/' . $cover) }}" alt="{{ $game->title }}" class="mb-3 w-full h-40 object-cover rounded">
        @else
        <div class="w-full h-40 flex items-center justify-center bg-gray-100 dark:bg-gray-700 text-gray-500 dark:text-gray-300 rounded mb-3">
            Pas d'image
        </div>
        @endif

        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">{{ $game->title }}</h2>
        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4 whitespace-pre-line">{{ $game->description }}</p>

        <a href="{{ route('play.start', $game) }}"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 dark:bg-purple-600 dark:hover:bg-purple-700 transition">
            ▶️ Jouer
        </a>
    </div>
    @endforeach
</div>
@endif
@endsection