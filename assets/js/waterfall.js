/**
 * Custom JS for the WaterFall theme
 */
var Waterfall = {

    init: function () {
        this.lightbox();
        this.woocommerceGallery();
    },

    // Set-up the lightbox
    lightbox: function () {

        if( typeof swipebox === 'function' ) {
            jQuery('.waterfall-lightbox').not('.elementor-element').find('a[href$=".png"], a[href$=".gif"], a[href$=".jpg"], a[href$=".svg"], a[href$=".webp"]').swipebox();
        }

    },

    // Fixes height bug for gallery images inside a slider
    woocommerceGallery: function() {
        
        var slider = jQuery('.product').find('.woocommerce-product-gallery'),
            slides = slider.find('.woocommerce-product-gallery__image'),
            lazy = slides.find('.lazy');
        
        if( lazy.length > 0 && slides.length > 0 ) {
            
            setTimeout( function() {

                maxHeight = Array.prototype.map.call(slides, function(n) {
                    if( n.clientHeight != n.clientWidth ) {
                        return n.clientHeight;
                    }
                }).filter( function(n) {
                    return n != null;
                }).reduce( function(a, b) {
                    return Math.max(a, b);
                });

                slider.find('.flex-viewport').css( {'maxHeight' : maxHeight + 'px' } );

            }, 500);

        } 

    }
};

jQuery(document).ready(
    Waterfall.init()
);