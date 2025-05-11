@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">📖 Scènes du jeu : {{ $game->title }}</h1>

    {{-- Message de succès --}}
    @if (session('success'))
        <div class="text-green-600 mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Bouton d’ajout --}}
    @if(auth()->user()?->admin)
        <div class="mb-4">
            <a href="{{ route('games.scenes.create', $game) }}"
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                ➕ Ajouter une nouvelle scène
            </a>
        </div>
    @endif

    {{-- Liste des scènes --}}
    @forelse($scenes as $scene)
        <div class="border p-4 rounded shadow mb-6 flex flex-col sm:flex-row gap-4">
            {{-- Image de la scène --}}
            @if($scene->image)
                <img src="{{ asset('storage/' . $scene->image) }}"
                     alt="Image de {{ $scene->title }}"
                     class="w-full sm:w-40 h-32 object-cover rounded">
            @endif

            {{-- Infos de la scène --}}
            <div class="flex-1">
                <h2 class="font-semibold text-lg">{{ $scene->title }}</h2>
                <p class="text-sm text-gray-700">{{ \Illuminate\Support\Str::limit($scene->description, 100) }}</p>

                {{-- Actions admin --}}
                @if(auth()->user()?->admin)
                    <div class="mt-2 flex gap-2">
                        <a href="{{ route('scenes.edit', $scene) }}"
                           class="text-yellow-600 hover:underline">✏️ Modifier</a>

                        <form action="{{ route('scenes.destroy', $scene) }}" method="POST" onsubmit="return confirm('Supprimer cette scène ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">🗑 Supprimer</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    @empty
        <p class="text-gray-500">Aucune scène disponible pour ce jeu.</p>
    @endforelse

    {{-- Retour au jeu --}}
    <div class="mt-6">
        <a href="{{ route('games.show', $game) }}" class="text-blue-600 hover:underline">← Retour à la fiche du jeu</a>
    </div>
</div>
@endsection