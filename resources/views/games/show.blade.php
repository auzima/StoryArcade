@extends('layouts.app')

@section('content')
    <h1>{{ $game->title }} (v{{ $game->version }})</h1>

    <p><strong>Slug :</strong> {{ $game->slug }}</p>
    <p><strong>Auteur :</strong> {{ $game->author }}</p>
    <p><strong>Description :</strong><br>{{ $game->description }}</p>

    @if ($game->initial_state)
        <p><strong>État initial :</strong></p>
        <pre>{{ json_encode($game->initial_state, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
    @endif

    <a href="{{ route('games.edit', $game) }}">✏️ Modifier</a> |
    <a href="{{ route('games.index') }}">← Retour à la liste</a>

    {{-- Formulaire de suppression --}}
    <form action="{{ route('games.destroy', $game) }}" method="POST" style="display:inline" onsubmit="return confirm('Supprimer ce jeu ? Cette action est irréversible.')">
        @csrf
        @method('DELETE')
        <button type="submit" style="color: red;">🗑 Supprimer</button>
    </form>

    <hr>

    <h2>Scènes du jeu</h2>
    <a href="{{ route('games.scenes.index', $game) }}">📖 Voir les scènes du jeu</a>

    @if ($game->scenes->isEmpty())
        <p>Aucune scène pour ce jeu pour l’instant.</p>
    @else
        <ul>
            @foreach ($game->scenes as $scene)
                <li>
                    <strong>{{ $scene->title }}</strong> – {{ \Illuminate\Support\Str::limit($scene->content, 50) }}
                    <a href="{{ route('scenes.show', $scene) }}">Voir</a>
                </li>
            @endforeach
        </ul>
    @endif

    {{-- Lien vers la création d’une nouvelle scène liée à ce jeu --}}
    <a href="{{ route('scenes.create') }}?game_id={{ $game->id }}">➕ Ajouter une scène à ce jeu</a>
@endsection