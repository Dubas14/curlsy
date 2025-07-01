<div class="flex">
    {{-- Сайдбар --}}
    <div class="w-64 p-4 bg-white shadow h-screen overflow-y-auto">
        @livewire('admin.sidebar-menu')
    </div>

    {{-- Основна зона --}}
    <div class="flex-1 p-6 bg-gray-50">
        @livewire('admin.product-table')
    </div>
</div>
