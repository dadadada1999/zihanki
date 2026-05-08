'use strict';

const delete_forms = document.querySelectorAll('.product_index-delete-form');

delete_forms.forEach((delete_form) => {
    delete_form.addEventListener('submit', (event) => {
        const result = confirm('本当に削除しますか？');

        if (!result) {
            event.preventDefault();
        }
    });
});