@extends('layouts.app')

@section('content')
<h1>Ajouter une scène au jeu : {{ $game->title }}</h1>

<form action="{{ route('games.scenes.store', $game) }}" method="POST" enctype="multipart/form-data">
    @csrf

    <label>Titre :</label>
    <input type="text" name="title" required><br>

    <label>Contenu :</label>
    <textarea name="content" required></textarea><br>

    <label>Image :</label>
    <input type="file" name="image" accept="image/*"><br>

    <label>Scène finale ?</label>
    <input type="checkbox" name="is_ending" value="1"><br>

    <button type="submit">Créer</button>
</form>

<a href="{{ route('games.scenes.index', $game) }}">← Retour à la liste des scènes</a>
@endsection