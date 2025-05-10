@extends('layouts.app')

@section('content')
    <h1>Scènes du jeu : {{ $game->title }}</h1>

    @if (session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @endif

    {{-- Lien pour créer une nouvelle scène --}}
    <a href="{{ route('games.scenes.create', $game) }}">➕ Ajouter une nouvelle scène</a>

    {{-- Liste des scènes --}}
    @if ($scenes->isEmpty())
        <p>Aucune scène pour ce jeu.</p>
    @else
        <ul>
            @foreach ($scenes as $scene)
                <li>
                    <strong>{{ $scene->title }}</strong><br>
                    {{ \Illuminate\Support\Str::limit($scene->content, 80) }}<br>

                    {{-- Boutons d’action --}}
                    <a href="{{ route('scenes.edit', $scene) }}">✏️ Modifier</a>

                    <form action="{{ route('scenes.destroy', $scene) }}" method="POST" style="display:inline" onsubmit="return confirm('Supprimer cette scène ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit">🗑 Supprimer</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @endif

    <br><a href="{{ route('games.show', $game) }}">← Retour au jeu</a>
@endsection