<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="api-base-url" content="{{ url('api/v1') }}">
  <title>@yield('title')</title>
  @routes
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @yield('app')
</head>

<body>
  <div id="app">
    @yield('content')
  </div>
  <script>
    window.Ziggy = @json(\Ziggy\ Ziggy::config());
  </script>
</body>

</html>