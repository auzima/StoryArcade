@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">{{ $scene->title }}</h1>

    <p class="mb-4">{{ $scene->content }}</p>

    @if ($scene->choices->isNotEmpty())
    <ul class="space-y-2">
        @foreach($scene->choices as $choice)
            <li>
                <a href="{{ route('play.scene', $choice->next_scene) }}"
                   class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    👉 {{ $choice->text }}
                </a>
            </li>
        @endforeach
    </ul>
@else
    <div class="mt-10 text-center">
        <p class="text-xl font-semibold text-gray-700 mb-2">🎉 Bravo, vous avez terminé l’histoire !</p>

        {{-- Résumé / message facultatif --}}
        <p class="text-gray-500 text-sm mb-4">
            Merci d’avoir joué à <strong>{{ $scene->game->title ?? 'ce jeu' }}</strong>. <br>
            Chaque aventure est différente selon vos choix !
        </p>

        {{-- Bouton retour à la liste --}}
        <a href="{{ route('play.index') }}"
           class="inline-block mt-4 bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
           🔄 Explorer d’autres jeux
        </a>
    </div>
@endif
@endsection