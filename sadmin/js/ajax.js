(function($) {
    'use strict';
    if ($.support.pjax) {
        $.pjax.defaults.maxCacheLength = 0;
        var container = $('#view');
        $(document).on('click', 'a[data-pjax], [data-pjax] a, #aside .nav a', function(event) {
            if ($("#view").length == 0 || $(this).hasClass('no-ajax')) {
                return;
            }
            $.pjax.click(event, { type: "POST", container: container, timeout: 6000});
        });

        $(document).on('pjax:start', function() {
            $(document).trigger("pjaxStart");
        });

        $(document).on('pjax:end', function(event) {
            $(event.target).find('[ui-jp]').uiJp();
            $(event.target).uiInclude();

            $(document).trigger("pjaxEnd");
        });
    }
})(jQuery);
