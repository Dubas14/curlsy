<div class="p-6 bg-white rounded-lg shadow-sm">
    @if ($selectedCategoryId)
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">
                Товари категорії
                <span class="text-blue-600">{{ $categoryName }}</span>
            </h2>
            <span class="px-3 py-1 text-sm font-medium bg-blue-100 text-blue-800 rounded-full">
                {{ $products->count() }} товарів
            </span>
        </div>

        <div class="overflow-x-auto border border-gray-200 rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Назва</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ціна</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Країна</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Артикул</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Дії</th>
                </tr>
                </thead>

                <tbody
                    wire:sortable="reorder"
                    data-category-id="{{ $selectedCategoryId }}"
                    wire:sortable.options="{ animation: 150 }"
                    class="bg-white divide-y divide-gray-200 sortable-category"
                    data-category-id="{{ $selectedCategoryId }}"
                >
                @foreach ($products as $product)
                    @if ($editProductId === $product->id)
                        <tr wire:key="product-edit-{{ $product->id }}" class="bg-blue-50">
                            <td colspan="5" class="px-6 py-4">
                                <div class="grid md:grid-cols-4 gap-4">
                                    {{-- Назва --}}
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Назва</label>
                                        <input type="text" wire:model.defer="editData.name"
                                               class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    </div>

                                    {{-- Ціна --}}
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Ціна</label>
                                        <input type="text" wire:model.defer="editData.sale_price"
                                               class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    </div>

                                    {{-- Країна --}}
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Країна</label>
                                        <input type="text" wire:model.defer="editData.country"
                                               class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    </div>

                                    {{-- Опис --}}
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Опис</label>
                                        <textarea wire:model.defer="editData.description"
                                                  class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" rows="1"></textarea>
                                    </div>

                                    {{-- Категорія --}}
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Категорія</label>
                                        <select wire:model.defer="editData.category_id"
                                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="flex justify-end space-x-3 mt-4">
                                    <button wire:click="$set('editProductId', null)"
                                            class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                                        Скасувати
                                    </button>
                                    <button wire:click="update"
                                            class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                                        Зберегти зміни
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @else
                        <tr
                            wire:sortable.item="{{ $product->id }}"
                            wire:key="product-{{ $product->id }}"
                            class="hover:bg-gray-50 cursor-move sortable-item"
                            data-id="{{ $product->id }}"
                            draggable="true"
                        >
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="font-medium text-gray-900">{{ $product->name }}</div>
                                @if($product->description)
                                    <div class="text-sm text-gray-500 mt-1 line-clamp-1">{{ $product->description }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 font-medium">
                                {{ number_format($product->sale_price, 2) }} грн
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    {{ $product->country ?? '—' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $product->sku ?? '—' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button wire:click="edit({{ $product->id }})"
                                        class="text-blue-600 hover:text-blue-900 mr-3" title="Редагувати">✏️</button>
                                <button onclick="if(!confirm('Ви впевнені, що хочете видалити цей товар?')){ event.stopImmediatePropagation(); }"
                                        wire:click="delete({{ $product->id }})"
                                        class="text-red-600 hover:text-red-900" title="Видалити">🗑️</button>
                            </td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>

        @if($products->isEmpty())
            <div class="text-center py-12">
                <h3 class="text-sm font-medium text-gray-900">Немає товарів</h3>
                <p class="text-sm text-gray-500">У цій категорії ще не додано жодного товару.</p>
            </div>
        @endif
    @else
        <div class="text-center py-12">
            <h3 class="text-sm font-medium text-gray-900">Оберіть категорію</h3>
            <p class="text-sm text-gray-500">Щоб переглянути товари, оберіть категорію зі списку.</p>
        </div>
    @endif
</div>

<script>
    function attachDragDropHandlers() {
        let draggedItem = null;

        document.querySelectorAll('.sortable-item').forEach(item => {
            item.addEventListener('dragstart', (e) => {
                draggedItem = item;
                e.dataTransfer.effectAllowed = 'move';
                e.dataTransfer.setData('product-id', item.dataset.id);
                console.log('Dragging:', item.dataset.id);
            });
        });

        document.querySelectorAll('.sortable-category').forEach(container => {
            container.addEventListener('dragover', e => e.preventDefault());

            container.addEventListener('drop', e => {
                e.preventDefault();

                const productId = e.dataTransfer.getData('product-id');
                const newCategoryId = container.dataset.categoryId;

                if (!productId || !newCategoryId) {
                    console.warn('Missing productId or categoryId during drop', { productId, newCategoryId });
                    return;
                }

                const orderedIds = Array.from(container.querySelectorAll('.sortable-item'))
                    .map(el => el.dataset.id);

                console.log('Drop fired:', { productId, newCategoryId, orderedIds });

                Livewire.emitTo('admin.product-table', 'reorder-product', {
                    product_id: productId,
                    new_category_id: newCategoryId,
                    ordered_ids: orderedIds,
                });
            });
        });
        document.querySelectorAll('.sortable-category-target').forEach(target => {
            target.addEventListener('dragover', e => e.preventDefault());

            target.addEventListener('drop', e => {
                e.preventDefault();

                const productId = e.dataTransfer.getData('product-id');
                const newCategoryId = e.currentTarget.dataset.categoryId;

                if (!productId || !newCategoryId) {
                    console.warn('Missing productId or categoryId during drop', { productId, newCategoryId });
                    return;
                }

                Livewire.emitTo('admin.product-table', 'reorder-product', {
                    product_id: productId,
                    new_category_id: newCategoryId,
                    ordered_ids: [],
                });
            });
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        attachDragDropHandlers();
    });

    document.addEventListener('livewire:update', () => {
        attachDragDropHandlers();
    });
</script>
