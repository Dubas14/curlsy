<header class="bg-white shadow-sm px-8 py-4 flex items-center justify-between border-b border-gray-200">
    <a href="/" class="text-3xl font-bold tracking-widest text-gray-900 uppercase">Curlsy</a>
    <nav class="flex gap-6 items-center">
        <a href="#" class="text-gray-700 hover:text-yellow-500 font-medium transition">Каталог</a>
        <a href="#" class="text-gray-700 hover:text-yellow-500 font-medium transition">Акції</a>
        <a href="#" class="text-gray-700 hover:text-yellow-500 font-medium transition">Про нас</a>
        @auth
            <a href="{{ route('dashboard') }}" class="font-medium hover:text-blue-600 transition">Кабінет</a>
            @if(auth()->user()->is_admin)
                <a href="/admin" class="font-medium hover:text-yellow-700 transition">Адмінка</a>
            @endif
            <form class="inline" method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="ml-4 text-gray-500 hover:text-red-500">Вийти</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="font-medium hover:text-blue-600 transition">Вхід</a>
            <a href="{{ route('register') }}" class="font-medium hover:text-yellow-600 transition">Реєстрація</a>
        @endauth
    </nav>
</header>
