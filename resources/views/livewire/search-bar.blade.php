<div class="relative w-full max-w-md">
    <input type="text"
           class="form-input w-full"
           placeholder="Знайти товар..."
           wire:model.debounce.400ms="query">
    @if(!empty($query) && count($results) > 0)
        <ul class="absolute left-0 z-10 w-full bg-white shadow-lg mt-1 rounded-lg">
            @foreach($results as $item)
                <li class="p-2 hover:bg-gray-100 cursor-pointer">
                    <a href="{{ route('product.show', $item->slug) }}">{{ $item->name }}</a>
                </li>
            @endforeach
        </ul>
    @endif
</div>
