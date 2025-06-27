@extends('layouts.public')

@section('content')
    {{--
    <section class="text-center py-20">
        <h1 class="text-5xl font-extrabold text-pink-600 mb-4">Краса твого волосся починається тут</h1>
        <p class="text-xl text-gray-600 mb-8">Лаки, шампуні, маски і все для догляду — магазин Curlsy</p>
        <a href="{{ route('register') }}" class="bg-pink-500 hover:bg-pink-600 text-white px-8 py-4 rounded-xl text-lg font-bold shadow">
            Спробуй Curlsy зараз!
        </a>
    </section>
    --}}

    @include('partials.hero')
    @include('partials.features')
@endsection
