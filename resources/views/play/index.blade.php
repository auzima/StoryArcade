@extends('layouts.app')

@section('content')


<div id="app">
    <games-list></games-list>
</div>
@endsection

@section('app')
@vite(['resources/css/app.css', 'resources/js/app-list.js'])
@endsection