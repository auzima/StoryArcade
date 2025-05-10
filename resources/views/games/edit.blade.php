@extends('layouts.app')

@section('content')
    <h1>Modifier le jeu : {{ $game->title }}</h1>

    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulaire unique avec encodage pour fichier --}}
    <form action="{{ route('games.update', $game) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label for="title">Titre :</label><br>
        <input type="text" name="title" id="title" value="{{ old('title', $game->title) }}" required><br>

        <label for="slug">Slug :</label><br>
        <input type="text" name="slug" id="slug" value="{{ old('slug', $game->slug) }}" required><br>

        <label for="version">Version :</label><br>
        <input type="text" name="version" id="version" value="{{ old('version', $game->version) }}" required><br>

        <label for="description">Description :</label><br>
        <textarea name="description" id="description">{{ old('description', $game->description) }}</textarea><br>

        {{-- Champ pour image de couverture --}}
        <label for="cover_image">Image de couverture :</label><br>
        <input type="file" name="cover_image" id="cover_image" accept="image/*"><br>

        {{-- Affichage actuel de l’image si elle existe --}}
        @if ($game->cover_image)
            <p>Image actuelle :</p>
            <img src="{{ asset('storage/' . $game->cover_image) }}" alt="Image de couverture" style="max-width: 300px;">
        @endif

        <br><br>
        <button type="submit">Enregistrer les modifications</button>
    </form>

    <br>
    <a href="{{ route('games.index') }}">← Retour à la liste</a>
@endsection