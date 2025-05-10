@extends('layouts.app')

@section('content')
    <h1>Modifier la scène : {{ $scene->title }}</h1>

    <form action="{{ route('scenes.update', $scene) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="game_id">Jeu :</label>
        <select name="game_id" required>
            @foreach($games as $game)
                <option value="{{ $game->id }}" {{ $scene->game_id == $game->id ? 'selected' : '' }}>
                    {{ $game->title }}
                </option>
            @endforeach
        </select><br>

        <label for="title">Titre :</label>
        <input type="text" name="title" value="{{ old('title', $scene->title) }}" required><br>

        <label for="content">Contenu :</label>
        <textarea name="content" required>{{ old('content', $scene->content) }}</textarea><br>

        <label for="image">Image (URL) :</label>
        <input type="text" name="image" value="{{ old('image', $scene->image) }}"><br>

        <label for="is_ending">Scène finale ?</label>
        <input type="checkbox" name="is_ending" value="1" {{ $scene->is_ending ? 'checked' : '' }}><br>

        <button type="submit">💾 Enregistrer</button>
    </form>

    <a href="{{ route('games.scenes.index', $scene->game_id) }}">← Retour aux scènes</a>
@endsection