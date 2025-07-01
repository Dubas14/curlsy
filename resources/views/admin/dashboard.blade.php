@extends('layouts.admin')

@section('title', 'Категорії та товари')

@section('content')
    <div class="flex">
        {{-- Sidebar з категоріями --}}
        <div class="w-64 p-4 bg-white shadow h-screen overflow-y-auto">
            @livewire('admin.sidebar-menu')
        </div>

        {{-- Контент — товари вибраної категорії --}}
        <div class="flex-1 p-6 bg-gray-50">
            <h1 class="text-3xl font-bold text-pink-600 mb-4">Адмін-панель Curlsy</h1>
            <p class="mb-6 text-gray-600">Оберіть категорію для перегляду або редагування товарів.</p>

            @livewire('admin.product-table')
        </div>
    </div>
@endsection
