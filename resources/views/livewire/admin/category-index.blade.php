<div class="space-y-6">
    <h2 class="text-2xl font-bold text-pink-600">Категорії</h2>

    {{-- Форма --}}
    <form wire:submit.prevent="save" class="space-y-2 bg-white p-4 shadow rounded">
        <div>
            <input type="text" wire:model="name" class="w-full border px-3 py-2 rounded" placeholder="Назва категорії">
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-pink-600 text-white px-4 py-2 rounded hover:bg-pink-700">
            {{ $isEditing ? 'Оновити' : 'Створити' }}
        </button>
    </form>

    {{-- Список категорій --}}
    <ul class="space-y-2">
        @foreach($categories as $category)
            <li class="flex justify-between items-center bg-gray-50 p-3 rounded shadow-sm">
                <div>
                    <strong>{{ $category->name }}</strong>
                    <span class="text-gray-500 text-sm">({{ $category->slug }})</span>
                </div>
                <div class="flex gap-2">
                    <button wire:click="edit({{ $category->id }})"
                            class="text-blue-600 hover:underline text-sm">Редагувати</button>
                    <button wire:click="delete({{ $category->id }})"
                            class="text-red-600 hover:underline text-sm"
                            onclick="return confirm('Видалити категорію?')">Видалити</button>
                </div>
            </li>
        @endforeach
    </ul>
</div>
