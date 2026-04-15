jQuery(document).ready( function($) {
    $(document).on('click', '#add_custom_site_event', function () {
        var html = $('#custom_site_event_template').html(),
            count = $('#custom_site_event').find('.welcome-panel').length;

        if(count > 0) {
            count = $('#custom_site_event').find('.welcome-panel:last-child').data('num') + 1;
        }

        html = html.replace(/%%num%%/g, count);
        html = html.replace(/%%name%%/g, 'name');

        $('#custom_site_event').append(html);
    });

    $(document).on('click', '.remove_custom_site_event', function () {
        $(this).closest('.welcome-panel').remove();
    });

    $(document).on('click', '#add_custom_status_event', function () {
        var html = $('#custom_status_event_template').html(),
            count = $('#custom_status_event').find('.welcome-panel').length;

        if(count > 0) {
            count = $('#custom_status_event').find('.welcome-panel:last-child').data('num') + 1;
        }

        html = html.replace(/%%num%%/g, count);
        html = html.replace(/%%name%%/g, 'name');

        $('#custom_status_event').append(html);
    });
});