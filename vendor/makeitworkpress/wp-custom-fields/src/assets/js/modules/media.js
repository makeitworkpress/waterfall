/**
 * Our jquery UI slider
 */
module.exports.init = function(framework) {
    
    /**
     * Enables Uploading using the Media-Uploader
     */
    jQuery(framework).find('.wp-custom-fields-upload-wrapper').each(function (index) {

        // Define the buttons for this specific group
        var add_media = jQuery(this).find('.wp-custom-fields-upload-add'),
            add_wrap = jQuery(this).find('.wp-custom-fields-single-media.empty'),
            button = jQuery(this).data('button'),
            multiple = jQuery(this).data('multiple'),   
            title = jQuery(this).data('title'),
            type = jQuery(this).data('type'),         
            url = jQuery(this).data('url'),         
            value_input = jQuery(this).find('.wp-custom-fields-upload-value'),
            frame;

        // Click function
        add_media.on('click', function (e) {

            e.preventDefault();

            // If the media frame already has been opened before, it can just be reopened.
            if (frame) {
                frame.open();
                return;
            }

            // Create the media frame.
            frame = wp.media({

                // Determine the title for the modal window
                title: title,

                // Show only the provided types
                library: {
                    type: type
                },

                // Determine the submit button text
                button: {
                    text: button
                },

                // Can we select multiple or only one?
                multiple: multiple

            });

            // If media is selected, add the input value
            frame.on('select', function () {

                // Grab the selected attachment.
                var attachments     = frame.state().get('selection').toJSON(),
                    attachment_ids  = value_input.val(),
                    urlWrapper      = '',
                    src;

                // We store the ids for each image
                attachments.forEach(function (attachment) {
                    attachment_ids += attachment.id + ',';

                    if( attachment.type === 'image') {
                        src = attachment.sizes.thumbnail.url;
                    } else {
                        src = attachment.icon;
                    }

                    // Return the url wrapper, if url is defined as a feature
                    if( url ) {
                        urlWrapper = '<div class="wp-custom-fields-media-url"><i class="material-icons">link</i><input type="text" value="' + attachment.url + '"></div>';
                    }

                    add_wrap.before('<div class="wp-custom-fields-single-media type-' + type + '" data-id="' + attachment.id + '"><img src="' + src + '" />' + urlWrapper + '<a href="#" class="wp-custom-fields-upload-remove"><i class="material-icons">clear</i></a></div>');
                
                });

                // Remove the , for single attachments
                if( ! multiple ) {
                    attachment_ids.replace(',', '');
                }

                value_input.val(attachment_ids);

            });

            // Open the media upload modal
            frame.open();

        });

        /**
         * Remove attachments
         */
        jQuery(this).on('click', '.wp-custom-fields-upload-remove', function (e) {
            e.preventDefault();

            var target = jQuery(this).closest('.wp-custom-fields-single-media'),
                target_id = target.data('id'),
                current_values = value_input.val(),
                new_values = current_values.replace(target_id + ',', '');

            target.remove();
            
            if( ! multiple )
                add_wrap.fadeIn();            

            value_input.val(new_values);

        });

    });

    /**
     * Make media items sortable
     */
    jQuery('.wp-custom-fields-media').sortable({
        placeholder: "wp-custom-fields-media-highlight",
        update: function(event, ui) {
            var input = jQuery(this).closest('.wp-custom-fields-upload-wrapper').find('.wp-custom-fields-upload-value'), values = [];
            
            jQuery(this).find('.wp-custom-fields-single-media').each( function(index, node) {
                values.push(node.dataset.id);        
            } );

            input.val( values.join(',') );

        }
    });
    
};