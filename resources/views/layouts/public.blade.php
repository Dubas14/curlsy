<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Curlsy — магазин краси' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')
</head>
<body class="bg-white min-h-screen flex flex-col">
@include('partials.header')
<main class="flex-1">
    @yield('content')
</main>
@include('partials.footer')
</body>
</html>
