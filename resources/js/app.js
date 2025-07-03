import './bootstrap';
import 'livewire-sortable';
import Sortable from 'sortablejs';

window.initSortable = function () {
    console.log('🔥 initSortable (from app.js)');
    document.querySelectorAll('.sortable-category').forEach(container => {
        if (!container) return;
        if (container._sortable) container._sortable.destroy();

        container._sortable = new Sortable(container, {
            animation: 150,
            group: 'product-categories',
            onEnd(evt) {
                const productId = evt.item.dataset.id;
                const newCategoryId = evt.to.dataset.categoryId;
                const orderedIds = Array.from(evt.to.querySelectorAll('.sortable-item')).map(el => el.dataset.id);

                console.log('📦 Перетягнуто товар:', productId, '->', newCategoryId, orderedIds);
                window.dispatchEvent(new CustomEvent('product-reorder', {
                    detail: {
                        product_id: productId,
                        new_category_id: newCategoryId,
                        ordered_ids: orderedIds,
                    }
                }));
            },
        });
    });
};
