@extends('layouts.app')

@section('content')
    <h1>Liste des jeux</h1>

    @if(session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('games.create') }}">➕ Créer un nouveau jeu</a>

    <ul>
        @foreach($games as $game)
            <li>
                <strong>{{ $game->title }}</strong> (v{{ $game->version }}) — par {{ $game->author }}
                <br>
                <a href="{{ route('games.show', $game) }}">Voir</a> |
                <a href="{{ route('games.edit', $game) }}">Modifier</a> |
                <form action="{{ route('games.destroy', $game) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Supprimer ce jeu ?')">Supprimer</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection