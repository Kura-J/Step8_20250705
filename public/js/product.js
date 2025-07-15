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
            },
        });
    });
});
