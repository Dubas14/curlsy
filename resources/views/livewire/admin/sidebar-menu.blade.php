<div class="bg-white rounded-lg shadow-sm p-4 h-full">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-semibold text-gray-800">Категорії</h3>
        <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-full">
            {{ $categories->count() }} категорій
        </span>
    </div>

    <div class="space-y-1">
        @foreach($categories as $category)
            <button
                wire:click="selectCategory({{ $category->id }})"
                @class([
                    'w-full text-left px-3 py-2 rounded-md transition-all flex items-center justify-between',
                    'bg-blue-50 text-blue-700 font-medium' => $selectedCategoryId == $category->id,
                    'hover:bg-gray-50 text-gray-700' => $selectedCategoryId != $category->id
                ])
            >
                <span>{{ $category->name }}</span>

                @if($selectedCategoryId == $category->id)
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                @endif
            </button>
        @endforeach
    </div>

    @if($categories->isEmpty())
        <div class="text-center py-6 text-sm text-gray-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-8 w-8 text-gray-300 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
            </svg>
            Категорії не знайдено
        </div>
    @endif
</div>
