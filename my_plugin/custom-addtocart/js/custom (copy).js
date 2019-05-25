//url: wc_cart_fragments_params.wc_ajax_url.toString().replace( '%%endpoint%%', 'get_refreshed_fragments' ),

/*var  dataurl = '/wordpress4.9.5/?wc-ajax=get_refreshed_fragments';

console.log(dataurl);

// Ajax add to cart on the product page
var jQuerywarp_fragment_refresh = {
    url: dataurl,
    type: 'POST',
    success: function( data ) {
        if ( data && data.fragments ) {

            jQuery.each( data.fragments, function( key, value ) {
                jQuery( key ).replaceWith( value );
            });

            jQuery( document.body ).trigger( 'wc_fragments_refreshed' );
        }
    }
};
jQuery('.entry-summary form.cart').on('submit', function (e)
{
    e.preventDefault();

    jQuery('.entry-summary').block({
        message: null,
        overlayCSS: {
            cursor: 'none'
        }
    });

    var product_url = window.location,
        form = jQuery(this);

    jQuery.post(product_url, form.serialize() + '&_wp_http_referer=' + product_url, function (result)
    {
        var cart_dropdown = jQuery('.widget_shopping_cart', result)

        // update dropdown cart
        jQuery('.widget_shopping_cart').replaceWith(cart_dropdown);

        // update fragments
        jQuery.ajax(jQuerywarp_fragment_refresh);

        jQuery('.entry-summary').unblock();

    });
});*/


//alert(dataobj.ajaxurl);