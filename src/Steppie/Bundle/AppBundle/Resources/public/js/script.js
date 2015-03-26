$(function () {
    $('table.table-steppie').stickyTableHeaders();

    $('.btn-done').on('click', function () {
        var matterId = $(this).data('matter-id');
        var stepId = $(this).data('step-id');

        $.ajax({
            type: 'POST',
            async: true,
            url: Routing.generate('api_v1_steppie_app_post_content', { _format: 'json' }),
            data: {
                matter: matterId,
                step: stepId
            },
            dataType: 'json',
            context: this

        }).done(function (data) {
            $(this).closest('td').text(data.value);
        });
    });
});
