var woorelTimeout = null;
jQuery( document ).ready( function( jQuery ) { //alert("lll");

	/**/
	jQuery(document).on('click', '#woorel_save_ajax', function() {

		var woorel_titlesmain = jQuery("#woorel_titlesmain").val();
	
		var get_all_ids = jQuery("input[name='get_all_ids[]']").map(function(){return jQuery(this).val();}).get();
		
		jQuery.ajax({
		    url: ajaxurl,
		    type: "POST",
		    data: {
		    	'action': 'woorel_woorel_save_changes', 
		    	'pid': woorel_vars.pid,
		    	'woorel_ids': jQuery('#woorel_ids').val(),
		    	'get_all_ids': get_all_ids,
		    	'woorel_titlesmain' : woorel_titlesmain
		    },
		    //dataType: 'json',
		    beforeSend: function(){
		      	jQuery('#woorel_save_ajax').val("Loding..");

		      	jQuery('.ajax_loading').show();
		    },
		    complete: function(){
		       	jQuery('#woorel_save_ajax').val("Update Changes");

		        jQuery('.ajax_loading').hide();
		    },
		    success: function (response) {

				window.location.href=window.location.href;
		    }
	    });
	});

	jQuery('.remove').click(function(){
		var target = jQuery(this);

		var remove_ids;
		
		var remove_ids = target.parent().attr('data-id');

		//alert('remove #'+remove_ids);

		var data = '<input type="hidden" class="get_all_ids" name="get_all_ids[]" value="'+remove_ids+'">';
		jQuery('#woorel_settings').append(data);

	});
	/**/


	woorel_active_settings();
	jQuery( '#product-type' ).on( 'change', function() {
		woorel_active_settings();
	} );

	// hide search result box by default
	jQuery( '#woorel_results' ).hide();
	jQuery( '#woorel_loading' ).hide();

	// total price
	if ( jQuery( '#product-type' ).val() == 'woorel' ) {
		woorel_change_total();
	}

	// set regular price
	jQuery( '#woorel_set_regular_price' ).on( 'click', function() {
		if ( jQuery( '#woorel_disable_auto_price' ).is( ':checked' ) ) {
			jQuery( 'li.general_tab a' ).trigger( 'click' );
			jQuery( '#_regular_price' ).prop( 'readonly', false );
			jQuery( '#_regular_price' ).focus();
		} else {
			jQuery( '#_regular_price' ).prop( 'readonly', true );
			alert( 'You must disable auto calculate regular price first!' );
		}
	} );

	// set sale price
	jQuery( '#woorel_set_sale_price' ).on( 'click', function() {
		jQuery( 'li.general_tab a' ).trigger( 'click' );
		if ( jQuery( '#woorel_disable_auto_price' ).is( ':checked' ) ) {
			jQuery( '#_regular_price' ).prop( 'readonly', false );
		} else {
			jQuery( '#_regular_price' ).prop( 'readonly', true );
		}
		jQuery( '#_sale_price' ).focus();
	} );

	// checkbox
	jQuery( '#woorel_disable_auto_price' ).change( function() {
		woorel_change_total();
	} );

	// search input
	jQuery( '#woorel_keyword' ).keyup( function() {
		if ( jQuery( '#woorel_keyword' ).val() != '' ) {
			jQuery( '#woorel_loading' ).show();
			if ( woorelTimeout != null ) {
				clearTimeout( woorelTimeout );
			}
			woorelTimeout = setTimeout( woorel_ajax_get_data, 300 );
			return false;
		}
	} );

	// actions on search result items
	jQuery( '#woorel_results' ).on( 'click', 'li', function() {
		jQuery( this ).children( 'span.qty' ).html( '<input type="text" name="woorel_titles[]" class="woorel_titles"/>' );
		jQuery( this ).children( 'span.remove' ).html( '×' );
		jQuery( '#woorel_selected ul' ).append( jQuery( this ) );
		jQuery( '#woorel_results' ).hide();
		jQuery( '#woorel_keyword' ).val( '' );
		woorel_get_ids();
		woorel_change_total();
		woorel_arrange();
		return false;
	} );

	// change qty of each item
	jQuery( '#woorel_selected' ).on( 'keyup change click', '.qty input', function() {
		var num = jQuery( this ).val();
		var cid = jQuery( this ).parent().parent().attr( 'data-id' );
		woorel_get_ids();
		woorel_change_total();
		return false;
	} );

	// actions on selected items
	jQuery( '#woorel_selected' ).on( 'click', 'span.remove', function() {
		jQuery( this ).parent().remove();
		woorel_get_ids();
		woorel_change_total();
		return false;
	} );

	// hide search result box if click outside
	jQuery( document ).on( 'click', function( e ) {
		if ( jQuery( e.target ).closest( jQuery( '#woorel_results' ) ).length == 0 ) {
			jQuery( '#woorel_results' ).hide();
		}
	} );

	// arrange
	woorel_arrange();

	jQuery( document ).on( 'woorelDragEndEvent', function() {
		woorel_get_ids();
	} );
} );

function woorel_arrange() {
	jQuery( '#woorel_selected li' ).arrangeable( {
		dragEndEvent: 'woorelDragEndEvent',
		dragSelector: '.move'
	} );
}

function woorel_get_ids() {
	var listId = new Array();
	jQuery( '#woorel_selected li' ).each( function() {
		//listId.push( jQuery( this ).attr( 'data-id' ) + '//' + jQuery( this ).find( 'input' ).val() );
		listId.push( jQuery( this ).attr( 'data-id' ));
	} );
	if ( listId.length > 0 ) {
		jQuery( '#woorel_ids' ).val( listId.join( ',' ) );
	} else {
		jQuery( '#woorel_ids' ).val( '' );
	}
}

function woorel_active_settings() {
	if ( jQuery( '#product-type' ).val() == 'woorel' ) {
		jQuery( 'input#_downloadable' ).prop( 'checked', false );
		jQuery( 'input#_virtual' ).removeAttr( 'checked' );
		jQuery( '.show_if_external' ).hide();
		jQuery( '.show_if_simple' ).show();
		jQuery( '.show_if_woorel' ).show();
		jQuery( 'input#_downloadable' ).closest( '.show_if_simple' ).hide();
		jQuery( 'input#_virtual' ).closest( '.show_if_simple' ).hide();
		jQuery( '.product_data_tabs li' ).removeClass( 'active' );
		jQuery( '.woorel_tab' ).addClass( 'active' );
		jQuery( '.panel-wrap .panel' ).hide();
		jQuery( '#woorel_settings' ).show();
		jQuery( '#_regular_price' ).prop( 'readonly', true );
	} else {
		jQuery( '#_regular_price' ).prop( 'readonly', false );
		//jQuery( '.show_if_woorel' ).hide();
	}
}

/*function woorel_change_total() {
	var total = 0;
	var total_max = 0;
	jQuery( '#woorel_selected li' ).each( function() {
		total += jQuery( this ).attr( 'data-price' ) * jQuery( this ).find( 'input' ).val();
		total_max += jQuery( this ).attr( 'data-price-max' ) * jQuery( this ).find( 'input' ).val();
	} );
	if ( total == total_max ) {
		jQuery( '#woorel_regular_price' ).html( total );
	} else {
		jQuery( '#woorel_regular_price' ).html( total + ' - ' + total_max );
	}
	if ( ! jQuery( '#woorel_disable_auto_price' ).is( ':checked' ) ) {
		jQuery( '#_regular_price' ).val( total );
	}
}*/

function woorel_ajax_get_data() {
	// ajax search product
	woorelTimeout = null;
	data = {
		action: 'woorel_get_search_results',
		woorel_keyword: jQuery( '#woorel_keyword' ).val(),
		woorel_ids: jQuery( '#woorel_ids' ).val(),
		woorel_nonce: woorel_vars.woorel_nonce,
		woorel_admin_pid: woorel_vars.pid,
	};
	jQuery.post( ajaxurl, data, function( response ) { 
		jQuery( '#woorel_results' ).show();
		jQuery( '#woorel_results' ).html( response );
		jQuery( '#woorel_loading' ).hide();
	} );
}