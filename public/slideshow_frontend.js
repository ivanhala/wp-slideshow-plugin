jQuery(function ($) {
    
    if( jQuery('.bxslider').find('img').length == 0 ){
        return;
    }
    jQuery('.bxslider').bxSlider({
        mode: 'fade',
        captions: false,
        adaptiveHeight: true
       
    });
});

