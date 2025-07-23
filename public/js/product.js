$(function () {

    $('#productListTable').tablesorter({
        theme: 'default',
        headers: {
            1: { sorter: false },
            6: { sorter: false },
        },
        widgets: ['zebra']
    });

    $('#searchForm').on('submit', function (e) {
        e.preventDefault();

        const url = $('#searchButton').data('url');

        $.ajax({
            url: url,
            type: 'get',
            data: $(this).serialize(),
            dataType: 'html',
            success: function (response) {
                $('#productTable').html(response);

                $('#productListTable').tablesorter({
                    theme: 'default',
                    headers: {
                        1: { sorter: false },
                        6: { sorter: false },
                    },
                    widgets: ['zebra']
                });
                $('#productListTable').trigger('update');
            },
        });
    });

    $('#productTable').on('click', '.product-list__delete-button', function (e) {
        e.preventDefault();

        if(!confirm('本当に削除しますか')) return;

        const $form = $(this).closest('.product-list__delete-form');
        const productId = $form.data('id');
        const token = $('meta[name="csrf-token"]').attr('content');
        const url = $form.data('url');

        $.ajax({
            url: url,
            type: 'post',
            data: {
                _method: 'delete',
                _token: token
            },
            success: function() {
                $form.closest('tr').fadeOut(500, function () {
                    $(this).remove();
                });
            },
            error: function () {
                alert('削除に失敗しました');
            }
        });
    });
});
