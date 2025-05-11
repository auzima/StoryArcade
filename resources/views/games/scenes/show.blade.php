@extends('layouts.app')

@section('content')
<h1>{{ $scene->title }}</h1>

<p><strong>Jeu :</strong> {{ $scene->game->title }}</p>

<p><strong>Contenu :</strong><br>
    {{ $scene->description }}
</p>

@if ($scene->image)
<p><strong>Image :</strong><br>
    <img src="{{ asset('storage/' . $scene->image) }}" alt="Image de la scène" style="max-width: 300px;">
</p>
@endif

<p><strong>Scène finale :</strong> {{ $scene->is_ending ? 'Oui' : 'Non' }}</p>

<a href="{{ route('scenes.edit', $scene) }}">✏️ Modifier</a>

<form action="{{ route('scenes.destroy', $scene) }}" method="POST" style="display:inline" onsubmit="return confirm('Supprimer cette scène ?')">
    @csrf
    @method('DELETE')
    <button type="submit">🗑 Supprimer</button>
</form>

<br><br>
<a href="{{ route('games.scenes.index', $scene->game_id) }}">← Retour à la liste des scènes</a>


@endsection