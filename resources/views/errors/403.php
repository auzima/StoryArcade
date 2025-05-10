@extends('layouts.app')

@section('content')
    <h1>⛔ Accès refusé</h1>
    <p>Cette page est réservée aux administrateurs.</p>
    <a href="{{ url('/') }}">← Retour à l’accueil</a>
@endsection