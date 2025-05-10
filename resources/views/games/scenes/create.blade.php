@extends('layouts.app')

@section('content')
    <h1>Ajouter une scène au jeu : {{ $game->title }}</h1>

    <form action="{{ route('games.scenes.store', $game) }}" method="POST">
        @csrf

        <label>Titre :</label>
        <input type="text" name="title" required><br>

        <label>Contenu :</label>
        <textarea name="content" required></textarea><br>

        <label>Image (URL) :</label>
        <input type="text" name="image"><br>

        <label>Scène finale ?</label>
        <input type="checkbox" name="is_ending" value="1"><br>

        <button type="submit">Créer</button>
    </form>

    <a href="{{ route('games.scenes.create', $game) }}">➕ Ajouter une nouvelle scène</a>
@endsection
