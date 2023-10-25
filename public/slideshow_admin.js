jQuery(function ($) {
    jQuery('#slideshow_sortable').sortable({ axis: 'y' });
    jQuery('#slideshow_add_image').click(function(){
        var upload = wp.media({
            title: 'Choose images',  
            multiple: true,
            library: {
                type: [ 'image' ]
            } 
        })
        .on('select', function(){
            var selection = upload.state().get('selection');
            selection.map( function( attachment ) {
                console.log( attachment.toJSON() );
                var new_li = "<li class=\"ui-state-default ui-sortable-handle\"> \
                                <div class=\"slideshow_thumbnail_centered\"> \
                                    <img src=\"" + attachment.toJSON().url +  "\"> \
                                </div> \
                                <span class=\"dashicons dashicons-dismiss\" onclick=\"jQuery(this).closest('li').remove();\"></span> \
                              </li>";
                jQuery('#slideshow_sortable').append(new_li);
            });           
        }).open();
    });

    jQuery('#slideshow_save_settings').click( function(){
        var button = jQuery(this);
        var regular_value = button.attr('value');
        var urls = [];
        jQuery( '#slideshow_sortable > li' ).each(function(){
            if( jQuery(this).find('img').attr('src') != 'undefined' ){
                urls.push( jQuery(this).find('img').attr('src') );
            }
        });
 
        button.attr('value', slideshowl10n.saving_images );
        button.prop('disabled', true);
        jQuery('.slideshow_save_result').remove();
        jQuery.ajax( slideshowl10n.rest_url  + 'slideshow/v1/save-settings', {
            method: 'POST',
            beforeSend: function(xhr) {
                xhr.setRequestHeader('X-WP-Nonce', slideshowl10n.nonce);
            },
            data: JSON.stringify({ 'urls': urls }),
            contentType: 'application/json',
         
        }).done(function(respone) {
            button.after('<span class="slideshow_save_result"><br/>' + respone.message + '</span>' );
        })
        .fail(function(respone) {
            button.after('<span class="slideshow_save_result"><br/>' + respone.responseJSON.message + '</span>' );
        })
        .always(function() {
            button.prop('disabled', false);
            button.attr('value', regular_value );
            jQuery('.slideshow_save_result')
                .delay(3000)
                .fadeOut('slow', function () {
                    jQuery(this.remove());
                });
        });
        
    });
});

