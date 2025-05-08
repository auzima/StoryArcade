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

    <form action="{{ route('games.update', $game) }}" method="POST">
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

        <button type="submit">Enregistrer les modifications</button>
    </form>

    <a href="{{ route('games.index') }}">← Retour à la liste</a>
@endsection