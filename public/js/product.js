$(function () {
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
            },
        });
    });
});
