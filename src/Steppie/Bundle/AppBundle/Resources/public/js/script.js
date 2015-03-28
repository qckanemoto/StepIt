$(function () {
    $('table.table-steppie').stickyTableHeaders();
    $('select').select2({
        placeholder: $(this).data('placeholder')
    });

    // 'Done' button action.
    $(document).on('click', '.btn-done', function () {
        var matterId = $(this).data('matter-id');
        var stepId = $(this).data('step-id');

        $(this).html('<i class="fa fa-spinner fa-spin"></i>').attr('disabled', true);

        $.ajax({
            type: 'POST',
            url: Routing.generate('api_v1_steppie_app_post_content', { _format: 'json' }),
            data: {
                matter: matterId,
                step: stepId
            },
            dataType: 'json',
            context: this

        }).done(function (data) {
            var $prototype = $($('#edit-content-prototype').text());
            $prototype.find('.link').text(data.value);
            $prototype.find('.form input')
                .data('content-id', data.id)
                .data('matter-id', data.matter.id)
                .data('step-id', data.step.id)
                .val(data.value)
            ;
            $(this).closest('td').width('');
            $(this).closest('td').html($prototype);
        });
    });

    // 'Enter' key action for edit content form.
    $(document).on('keyup', '.edit-content > .form input', function (e) {
        if (e.keyCode != 13) {
            return;
        }

        var contentId = $(this).data('content-id');
        var matterId = $(this).data('matter-id');
        var stepId = $(this).data('step-id');

        $(this).attr('readonly', true);
        $(this).next('.form-control-feedback').show();

        if ($(this).val() == '') {
            $.ajax({
                type: 'DELETE',
                url: Routing.generate('api_v1_steppie_app_delete_content', { content: contentId, _format: 'json' }),
                data: null,
                dataType: 'json',
                context: this

            }).done(function (data) {
                var $prototype = $($('#btn-done-prototype').text());
                $prototype
                    .data('matter-id', data.matter.id)
                    .data('step-id', data.step.id)
                ;
                $(this).closest('td').width('');
                $(this).closest('td').html($prototype);
            });
        } else {
            $.ajax({
                type: 'PUT',
                url: Routing.generate('api_v1_steppie_app_put_content', { content: contentId, _format: 'json' }),
                data: {
                    value: $(this).val(),
                    matter: matterId,
                    step: stepId
                },
                dataType: 'json',
                context: this

            }).done(function (data) {
                var $prototype = $($('#edit-content-prototype').text());
                $prototype.find('.link').text(data.value);
                $prototype.find('.form input')
                    .data('content-id', data.id)
                    .data('matter-id', data.matter.id)
                    .data('step-id', data.step.id)
                    .val(data.value)
                ;
                $(this).closest('td').width('');
                $(this).closest('td').html($prototype);
            });
        }
    });

    // toggle edit content link and form.
    $(document)
        .on('click', '.edit-content > .link', function () {
            var w = $(this).closest('td').width();
            $(this).closest('td').width(w);
            $(this).closest('.edit-content').find('.link, .form').toggle();
            $(this).closest('.edit-content').find('.form input').focus();
        })
        .on('blur', '.edit-content > .form input', function () {
            if ($(this).attr('readonly')) {
                return;
            }
            $this = $(this).closest('.form');
            $this.closest('td').width('');
            $this.closest('.edit-content').find('.link, .form').toggle();
        })
    ;
});
