$(function () {
    $('table.table-steppie').stickyTableHeaders();

    $('.btn-done').on('click', function () {
        var matterId = $(this).data('matter-id');
        var stepId = $(this).data('step-id');
        var now = new Date;
        var todayString = now.getFullYear() + '/' + (now.getMonth() + 1) + '/' + now.getDate();

        $.ajax({
            type: 'POST',
            async: true,
            url: Routing.generate('api_v1_steppie_app_post_content', { _format: 'json' }),
            data: {
                value: todayString,
                matter: matterId,
                step: stepId
            },
            dataType: 'json',
            context: this,
            success: function (data) {
                $(this).closest('td').text(data.value);
            }
        });
    });
});
