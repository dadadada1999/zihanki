'use strict';

$(function () {
    $(document).on('submit', '.product_index-delete-form', function (event) {
        event.preventDefault();

        const result = confirm('本当に削除しますか？');

        if (!result) {
            return;
        }

        const delete_form = $(this);
        const delete_url = delete_form.attr('action');

        $.ajax({
            url: delete_url,
            type: 'POST',
            data: delete_form.serialize(),
            dataType: 'json',
        })
            .done(function (response) {
                if (response.result) {
                    delete_form.closest('tr').remove();
                } else {
                    alert('商品の削除に失敗しました。');
                }
            })
            .fail(function () {
                alert('商品の削除に失敗しました。');
            });
    });

    $(document).on('click', '.product_index-sort', function () {
        const sort_column = $(this).data('sort-column');
        const current_column = $('#productIndexSortColumn').val();
        const current_direction = $('#productIndexSortDirection').val();
        let next_direction = 'asc';

        if (sort_column === current_column && current_direction === 'asc') {
            next_direction = 'desc';
        }

        $('#productIndexSortColumn').val(sort_column);
        $('#productIndexSortDirection').val(next_direction);
        $('#productIndexSearchForm').submit();
    });

    $(document).on('submit', '#productIndexSearchForm', function (event) {
        event.preventDefault();

        $.ajax({
            url: $(this).attr('action'),
            type: 'GET',
            data: $(this).serialize(),
            dataType: 'json',
        })
            .done(function (response) {
                let html = '';

                $.each(response.products, function (index, product) {
                    let img_html = '商品画像';

                    if (product.img_path) {
                        img_html = '<img class="product_index-image" src="/zihanki/public/storage/' + product.img_path + '" alt="商品画像">';
                    }

                    html += '<tr>';
                    html += '<td>' + product.id + '.</td>';
                    html += '<td>' + img_html + '</td>';
                    html += '<td>' + product.product_name + '</td>';
                    html += '<td>¥' + product.price + '</td>';
                    html += '<td>' + product.stock + '</td>';
                    html += '<td>' + product.company.company_name + '</td>';
                    html += '<td class="product_index-action-cell">';
                    html += '<form class="product_index-detail-form" action="/zihanki/public/product/detail/' + product.id + '" method="GET">';
                    html += '<button class="product_index-detail-button" type="submit">詳細</button>';
                    html += '</form>';
                    html += '</td>';
                    html += '<td class="product_index-action-cell">';
                    html += '<form class="product_index-delete-form" action="/zihanki/public/product/delete/' + product.id + '" method="POST">';
                    html += '<input type="hidden" name="_token" value="' + $('meta[name="csrf-token"]').attr('content') + '">';
                    html += '<input type="hidden" name="_method" value="DELETE">';
                    html += '<button class="product_index-delete-button" type="submit">削除</button>';
                    html += '</form>';
                    html += '</td>';
                    html += '</tr>';
                });

                $('#productIndexTableBody').html(html);
            })
            .fail(function () {
                alert('検索に失敗しました。');
            });
    });
});