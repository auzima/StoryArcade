@extends('layouts.app')

@section('content')
<h1>Liste des jeux</h1>

@if(session('success'))
<div style="color: green;">
    {{ session('success') }}
</div>
@endif

@auth
@if(Auth::user()->admin)
<a href="{{ route('games.create') }}" class="mb-4 inline-block px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
    ➕ Créer un jeu
</a>
@endif
@endauth

<ul>
    @foreach($games as $game)
    <li class="mb-4 border-b pb-2">
        <strong>{{ $game->title }}</strong> (v{{ $game->version }}) — par {{ $game->author }}<br>

        <a href="{{ route('play.start', $game) }}" class="text-blue-600 hover:underline">▶️ Jouer</a>

        @auth
        @if(Auth::user()->admin)
        | <a href="{{ route('games.edit', $game) }}">✏️ Modifier</a>

        <form action="{{ route('games.destroy', $game) }}" method="POST" style="display:inline" onsubmit="return confirm('Supprimer ce jeu ?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-600">🗑 Supprimer</button>
        </form>
        @endif
        @endauth
    </li>
    @endforeach
</ul>
@endsection