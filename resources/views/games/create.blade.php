@extends('layouts.app')

@section('content')
    <h1>Créer un nouveau jeu</h1>

    {{-- Affichage des erreurs de validation --}}
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulaire de création d’un jeu --}}
    <form action="{{ route('games.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div>
            <label for="title">Titre :</label><br>
            <input type="text" name="title" id="title" value="{{ old('title') }}" required>
        </div>

        <div>
            <label for="slug">Slug :</label><br>
            <input type="text" name="slug" id="slug" value="{{ old('slug') }}" required>
        </div>

        <div>
            <label for="description">Description :</label><br>
            <textarea name="description" id="description">{{ old('description') }}</textarea>
        </div>

        <div>
            <label for="version">Version :</label><br>
            <input type="text" name="version" id="version" value="{{ old('version', '1.0') }}" required>
        </div>

        <div>
            <label for="cover_image">Image de couverture :</label><br>
            <input type="file" name="cover_image" id="cover_image" accept="image/*">
        </div>

        <br>
        <button type="submit">Créer</button>
    </form>
@endsection