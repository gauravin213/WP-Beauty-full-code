jQuery(document).ready(function($) {   //alert("pp");

	/*
	* option js start
	*/
	var clrarray = {};

	jQuery('.selected-radio-image').each(function(index){
		var clr_name = jQuery(this).find('.radio-image-option').text();
		clrarray[clr_name] = clr_name;
		console.log(clrarray);
	});

	jQuery('.radio-image-label').click(function(){ 

		var target = jQuery(this);

		var clr_name = target.find('.radio-image-option').text();

		var n = target.attr('class');

		var res = n.replace("selected-radio-image", "selected-radio-image");

		if (res == 'radio-image-label selected-radio-image') {

			var nlength = jQuery( ".selected-radio-image" ).length - 1;
			//alert('un select '+nlength);
			clrarray[clr_name] = "";
			delete clrarray[clr_name];

			/**/
			/*var cuspricecal_qty = jQuery('#cuspricecal_qty').val();

			//var cuspricecal_amountofColor = jQuery('#cuspricecal_amountofColor').val();
			var cuspricecal_amountofColor = clrarray;

			var cuspricecal_location = jQuery('#cuspricecal_location').val();

			if (cuspricecal_qty && cuspricecal_amountofColor && cuspricecal_location) {
				cuspricecalajax(cuspricecal_qty, cuspricecal_amountofColor, cuspricecal_location, addonoptArray);
			}*/
			/**/

		}
		else{
			var nlength = jQuery( ".selected-radio-image" ).length + 1;
			//alert('select '+nlength+clr_name);
			clrarray[clr_name] = clr_name;

			/**/
			/*var cuspricecal_qty = jQuery('#cuspricecal_qty').val();

			//var cuspricecal_amountofColor = jQuery('#cuspricecal_amountofColor').val();
			var cuspricecal_amountofColor = clrarray;

			var cuspricecal_location = jQuery('#cuspricecal_location').val();

			if (cuspricecal_qty && cuspricecal_amountofColor && cuspricecal_location) {
				cuspricecalajax(cuspricecal_qty, cuspricecal_amountofColor, cuspricecal_location, addonoptArray);
			}*/
			/**/
		}
		console.log(clrarray);
	});
	/*
	* option js end
	*/




	/*
	* addon js start
	*/
	var addonoptArray = {};
	jQuery('.addon').each(function(index){

		var target = jQuery(this);

		target.addClass('index'+index);

		jQuery('.index'+index).change(function(){  //alert("==>"+index);

			addonoptArray['opt'+index] =  parseInt(jQuery(this).find('option:selected').data('price'));

			console.log(addonoptArray);

			/**/
			var cuspricecal_qty = jQuery('#cuspricecal_qty').val();

			var cuspricecal_amountofColor = jQuery('#cuspricecal_amountofColor').val();
			//var cuspricecal_amountofColor = get_color_arrray_function();

			var cuspricecal_location = jQuery('#cuspricecal_location').val();

			if (cuspricecal_qty && cuspricecal_amountofColor && cuspricecal_location) {
				cuspricecalajax(cuspricecal_qty, cuspricecal_amountofColor, cuspricecal_location, addonoptArray);
			}
			/**/

		});
	});
	/*
	* addon js start
	*/



	/*
	* validation
	*/
	jQuery(document).on('keyup', '#cuspricecal_qty', function(){

		var target = jQuery(this);
		
		var cuspricecal_qty_validate = target.val();

		if ($.isNumeric(cuspricecal_qty_validate)) {

			n = cuspricecal_qty_validate;
			if (Number(n) == n && n % 1 == 0) {
				//target.val('');
			}
			else{
				target.val('');
			}

		}
		else
		{
			target.val('');
		}

	});


 	/*
 	* custom price calculator js start
 	*/
	jQuery('#cuspricecal_qty').change(function(){  

		var target = jQuery(this);

		var cuspricecal_qty = jQuery('#cuspricecal_qty').val();

		var cuspricecal_amountofColor = jQuery('#cuspricecal_amountofColor').val();
		//var cuspricecal_amountofColor = get_color_arrray_function();

		var cuspricecal_location = jQuery('#cuspricecal_location').val();

		if (cuspricecal_qty && cuspricecal_amountofColor && cuspricecal_location) {
			cuspricecalajax(cuspricecal_qty, cuspricecal_amountofColor, cuspricecal_location, addonoptArray);
		}

	});

	jQuery('#cuspricecal_amountofColor').change(function(){ 

		var target = jQuery(this);

		var cuspricecal_qty = jQuery('#cuspricecal_qty').val();

		var cuspricecal_amountofColor = jQuery('#cuspricecal_amountofColor').val();
		//var cuspricecal_amountofColor = get_color_arrray_function();

		var cuspricecal_location = jQuery('#cuspricecal_location').val();

		if (cuspricecal_qty && cuspricecal_amountofColor && cuspricecal_location) {
			cuspricecalajax(cuspricecal_qty, cuspricecal_amountofColor, cuspricecal_location, addonoptArray);
		}


	});

	jQuery('#cuspricecal_location').change(function(){  

		var target = jQuery(this);

		var cuspricecal_qty = jQuery('#cuspricecal_qty').val();

		var cuspricecal_amountofColor = jQuery('#cuspricecal_amountofColor').val();
		//var cuspricecal_amountofColor = get_color_arrray_function();

		var cuspricecal_location = jQuery('#cuspricecal_location').val();

		if (cuspricecal_qty && cuspricecal_amountofColor && cuspricecal_location) {
			cuspricecalajax(cuspricecal_qty, cuspricecal_amountofColor, cuspricecal_location, addonoptArray);
		}

	});
	/*
 	* custom price calculator js end
 	*/


	/*
	* Choosen js start
	*/
	jQuery(".chosen-select").chosen({no_results_text: "Oops, nothing found!"}); 
	/*
	* Choosen js end
	*/

});


function get_color_arrray_function(){

	var clrarray = {};
	jQuery('.selected-radio-image').each(function(index){
		var clr_name = jQuery(this).find('.radio-image-option').text();
		clrarray[clr_name] = clr_name;
	});
	return clrarray;
}


function cuspricecalajax(qty,color,location, addonoptiontotal){ 

	jQuery.ajax({
		url: data.ajaxurl,
		type: "POST",
		data: {'action': 'cuspricecal_my_action', 'productId': data.product_id,enterd_qty: qty, ammountofcolor: color, locationsides: location, addonoptiontotal: addonoptiontotal},
		cache: false,
		dataType: 'json',
		beforeSend: function(){
		    jQuery('#cuspricecal_ajax_loader').show();
		},
		complete: function(){
		    jQuery('#cuspricecal_ajax_loader').hide();
		},
		success: function (response) { 

			if (response['ammountOfcolor']) {
		
				jQuery('.cart .qty').val(qty);

				jQuery('#cuspricecal_price').text(response['price']);
				jQuery('#cuspricecal_color').text(response['ammountOfcolor']);
				jQuery('#cuspricecal_loc').text(response['locationside']);
				jQuery('#cuspricecal_total').text(response['totalprice']);
				jQuery('#cuspricecal_totalprice').val(response['totalprice']);
				jQuery('#cuspricecal_price_per_price').text(response['price_per_price']);
				jQuery('#cuspricecal_price_per_price_input').val(response['price_per_price']);

				
				if (response['standard_free']) {
					jQuery('.cuspricecal_standard_free').show();
					jQuery('#cuspricecal_standard_free').text(response['standard_free']);
				}
				else{
					jQuery('.cuspricecal_standard_free').hide();
				}

				if (response['addon_opt_total']) {
				jQuery('.cusprice-addon').show();
				jQuery('#cuspricecal_opt_total').text(response['addon_opt_total']);
				}else{
					jQuery('.cusprice-addon').hide();
				}

				jQuery('#cuspricecal_grand_total').text(response['grand_total']);
				

				jQuery('#product-addons-total').hide();
				jQuery('#cuspricecal-body').show();

				jQuery('#cuspricecal-body2').hide();
			}
			else{
				jQuery('#cuspricecal_totalprice').val('');
				jQuery('#cuspricecal_price_per_price_input').val('');
				jQuery('.cart .qty').val(1);
				jQuery('#cuspricecal-body').hide();

				//addon 
				jQuery('#product-addons-total').show();

				jQuery('#cuspricecal-body2').show();
				jQuery('#mtchqty').text(qty);
			}
		}
	});
}