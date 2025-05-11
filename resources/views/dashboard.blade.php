@extends('layouts.app')

@section('content')
@if(session('success'))
<div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
    {{ session('success') }}
</div>
@endif

<h1 class="text-2xl font-bold mb-6">🎮 Tableau de bord</h1>

@if(auth()->user()->admin)
<a href="{{ route('games.create') }}" class="mb-4 inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
    ➕ Ajouter un nouveau jeu
</a>
@endif

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($games as $game)
    <div class="border p-4 rounded shadow bg-white">
        @php
        $cover = $game->scenes->first()?->image;
        @endphp

        @if($cover)
        <img src="{{ asset('storage/' . $cover) }}" alt="{{ $game->title }}" class="mb-3 w-full h-40 object-cover rounded">
        @endif

        <h2 class="text-xl font-semibold">{{ $game->title }} <span class="text-sm text-gray-500">v{{ $game->version }}</span></h2>
        <p class="text-sm mb-3">{{ $game->description }}</p>

        @if(auth()->user()->admin)
        <div class="flex flex-wrap gap-2 mt-2">
            <a href="{{ route('games.scenes.index', $game) }}"
                class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">
                📖 Scènes
            </a>
            <!-- <a href="{{ route('games.scenes.index', $game) }}" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">📖 Scènes</a> -->
            <a href="{{ route('games.edit', $game) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">✏️ Modifier</a>
            <form action="{{ route('games.destroy', $game) }}" method="POST" onsubmit="return confirm('Supprimer ce jeu ?')">
                @csrf
                @method('DELETE')
                <button class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">🗑 Supprimer</button>
            </form>
        </div>
        @endif
    </div>
    @endforeach
</div>
@endsection