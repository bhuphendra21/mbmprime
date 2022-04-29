(function ($) {
    'use strict';

    $(function () {
        $('#upload_image').click(open_custom_media_window);
        function open_custom_media_window() {
            if (this.window === undefined) {
                this.window = wp.media({
                    title: 'Insert Image',
                    library: { type: 'image' },
                    multiple: false,
                    button: { text: 'Insert Image' }
                });
                var self = this;
                this.window.on('select', function () {
                    var response = self.window.state().get('selection').first().toJSON();
                    $('.image_id').val(response.id);
                    $('.image').attr('src', response.sizes.thumbnail.url);
                    $('.image').show();
                });
            }
            this.window.open();
            return false;
        }
    });

    $(function () {
        $('#upload_broucher').click(open_custom_media_window);
        function open_custom_media_window() {
            if (this.window === undefined) {
                this.window = wp.media({
                    title: 'Insert Broucher',
                    multiple: false,
                    button: { text: 'Insert Broucher' }
                });
                var self = this;
                this.window.on('select', function () {
                    var response = self.window.state().get('selection').first().toJSON();
                    $('.broucher_id').val(response.id);
                    $('.image').attr('src', response.sizes.thumbnail.url);
                    $('.image').show();
                });
            }
            this.window.open();
            return false;
        }
    });

    $(function () {
        $('#upload_logo').click(open_custom_media_window);
        function open_custom_media_window() {
            if (this.window === undefined) {
                this.window = wp.media({
                    title: 'Insert Logo',
                    library: { type: 'image' },
                    multiple: false,
                    button: { text: 'Insert Logo' }
                });
                var self = this;
                this.window.on('select', function () {
                    var response = self.window.state().get('selection').first().toJSON();
                    $('.logo_id').val(response.id);
                    $('.image').attr('src', response.sizes.thumbnail.url);
                    $('.image').show();
                });
            }
            this.window.open();
            return false;
        }
    });
})(jQuery);