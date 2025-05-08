@extends('layouts.app')

@section('content')
    <h1>{{ $game->title }} (v{{ $game->version }})</h1>

    <p><strong>Auteur :</strong> {{ $game->author }}</p>
    <p><strong>Description :</strong><br>{{ $game->description }}</p>

    <a href="{{ route('games.edit', $game) }}">Modifier</a> |
    <a href="{{ route('games.index') }}">← Retour à la liste</a>
@endsection