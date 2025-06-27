@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-lg mx-auto bg-white rounded-2xl shadow px-8 py-10 border border-gray-100">
            <h2 class="text-2xl font-bold mb-6">Кабінет користувача</h2>
            <div class="mb-6">
                <span class="text-gray-600">Імʼя:</span>
                <span class="font-medium">{{ Auth::user()->name }}</span>
            </div>
            <div class="mb-6">
                <span class="text-gray-600">Email:</span>
                <span class="font-medium">{{ Auth::user()->email }}</span>
            </div>
            <div class="mb-6">
                <a href="{{ route('profile.edit') }}" class="text-yellow-700 hover:underline">Редагувати профіль</a>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-red-600 hover:underline font-medium">Вийти</button>
            </form>
        </div>
    </div>
@endsection
