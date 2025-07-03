<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Curlsy Admin')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-900">
<div class="min-h-screen flex">
    {{-- Сайдбар, якщо буде --}}
    <div class="w-64 bg-white shadow-md p-4">
        <h2 class="text-xl font-bold mb-4">Адмінка</h2>
        <ul>
            <li><a href="{{ route('admin.dashboard') }}" class="block py-2 text-pink-600">Dashboard</a></li>
            {{-- Додай інші пункти --}}
        </ul>
        <a href="{{ url('/') }}" target="_blank"
           class="mt-4 inline-block px-4 py-2 text-center bg-pink-600 text-white rounded hover:bg-pink-700 transition">
            ← Назад на сайт
        </a>
    </div>
    <div class="flex-1 p-6">
        @yield('content')
    </div>
</div>
</body>
</html>
