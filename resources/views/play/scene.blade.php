@extends('layouts.app')

@section('content')
<div class="flex flex-col items-center justify-center h-screen px-4 text-center space-y-4 bg-black text-white overflow-hidden">

    {{-- Image agrandie (max 80% hauteur écran) --}}
    @if ($scene->image)
    <div class="w-full max-w-xl">
        <img src="{{ asset('storage/' . $scene->image) }}"
            alt="Image de la scène"
            class="w-full h-auto max-h-[80vh] object-contain rounded shadow mx-auto">
    </div>
    @endif

    {{-- Description dans un bloc limité --}}
    <div class="max-w-2xl text-base leading-snug overflow-hidden px-4">
        <div class="max-h-[20vh] overflow-y-auto">
            {!! nl2br(e($scene->description)) !!}
        </div>
    </div>

    {{-- Choix dans un bloc limité --}}
    <div class="max-w-xl w-full space-y-3">
        @if ($scene->choices->isNotEmpty())
            @foreach($scene->choices as $choice)
                <a href="{{ route('play.scene', $choice->next_scene) }}"
                    class="block bg-pink-400 hover:bg-purple-400 text-white px-4 py-2 rounded-lg transition font-semibold shadow-md">
                    {{ $choice->text }}
                </a>
            @endforeach
        @else
            <p class="text-gray-300">🎉 Fin de l’histoire</p>
            <a href="{{ route('play.index') }}"
                class="inline-block bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 transition">
                🔄 Retour à la liste des jeux
            </a>
        @endif
    </div>

    {{-- Composants Vue (optionnel si utilisés) --}}
    {{-- 
    <div id="vue-app" class="max-w-xl w-full space-y-3">
        <theme-toggle></theme-toggle>
        <scene-choices :choices='@json($scene->choices)' route-base="{{ url('/play/scene/') }}/" />
    </div> 
    --}}
</div>
@endsection