<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-white">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-white">
            <div>
                <a href="/" class="block mb-2">
                    <img
                            src="{{ asset('images/logo.png') }}"
                            alt="Curlsy Logo"
                            class="mx-auto h-32 md:h-40"  {{-- h-32 = 128px, md:h-40 = 160px на більших екранах --}}
                            style="max-width: 260px;"
                    >
                </a>
            </div>

            <div >
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
