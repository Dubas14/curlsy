<header class="bg-white shadow-sm px-8 py-4 flex items-center justify-between border-b border-gray-200">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&family=Montserrat:wght@300;400;500&display=swap" rel="stylesheet">
    <div class="flex items-center gap-6">
        <a href="/" class="flex items-center">
            <img src="{{ asset('images/logo.png') }}" alt="Curlsy Logo" class="h-20 w-auto">
        </a>
        <div class="ml-4 border-l-2 border-[#19314a] pl-4 py-1">
            <span class="text-2xl font-medium text-[#19314a] tracking-wide leading-tight" style="font-family: 'Playfair Display', serif;">
                Краса твого волосся<br>
                <span class="text-xl font-light" style="font-family: 'Montserrat', sans-serif;">починається тут</span>
            </span>
        </div>
    </div>
    @livewire('search-bar')
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
