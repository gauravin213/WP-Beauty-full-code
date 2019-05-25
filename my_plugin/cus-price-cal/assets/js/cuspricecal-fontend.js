jQuery(document).ready(function($) { 


	/*
	* Move color option below the multi select location option
	*/
	jQuery('.product-options').insertAfter('.cuspricecal-location');
	jQuery('.radio-image-radio').removeAttr('name');


	/*
	* option js start
	*/
    var CrlArray = '';

    CrlArray = getclr();
    console.log(CrlArray);
    
    jQuery('.radio-image-label').click(function(){ 
	    var target = jQuery(this);
    	var n = target.attr('class');
		var res = n.replace("selected-radio-image", "selected-radio-image");
		if (res == 'radio-image-label selected-radio-image') { // un select
			var myVar = setInterval(function(){ 
				CrlArray = getclr();
    			console.log(CrlArray);

    		/**/
			var cuspricecal_qty = jQuery('#cuspricecal_qty').val();

			//var cuspricecal_amountofColor = jQuery('#cuspricecal_amountofColor').val();
			var cuspricecal_amountofColor = getclr();

			var cuspricecal_location = jQuery('#cuspricecal_location').val();

			if (cuspricecal_qty && cuspricecal_amountofColor && cuspricecal_location) {
				cuspricecalajax(cuspricecal_qty, cuspricecal_amountofColor, cuspricecal_location, addonoptArray);
			}
			/**/

				clearInterval(myVar);
			}, 500);
		}
		else{
			//select
			var myVar = setInterval(function(){ 
				CrlArray = getclr();
    			console.log(CrlArray);

    		/**/
			var cuspricecal_qty = jQuery('#cuspricecal_qty').val();

			//var cuspricecal_amountofColor = jQuery('#cuspricecal_amountofColor').val();
			var cuspricecal_amountofColor = getclr();

			var cuspricecal_location = jQuery('#cuspricecal_location').val();

			if (cuspricecal_qty && cuspricecal_amountofColor && cuspricecal_location) {
				cuspricecalajax(cuspricecal_qty, cuspricecal_amountofColor, cuspricecal_location, addonoptArray);
			}
			/**/

				clearInterval(myVar);
			}, 500);
		}
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

			//console.log(addonoptArray);

			/**/
			var cuspricecal_qty = jQuery('#cuspricecal_qty').val();

			//var cuspricecal_amountofColor = jQuery('#cuspricecal_amountofColor').val();
			var cuspricecal_amountofColor = getclr();

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

		//var cuspricecal_amountofColor = jQuery('#cuspricecal_amountofColor').val();
		var cuspricecal_amountofColor = getclr();

		var cuspricecal_location = jQuery('#cuspricecal_location').val();

		if (cuspricecal_qty && cuspricecal_amountofColor && cuspricecal_location) {
			cuspricecalajax(cuspricecal_qty, cuspricecal_amountofColor, cuspricecal_location, addonoptArray);
		}

	});

	jQuery('#cuspricecal_amountofColor').change(function(){ 

		var target = jQuery(this);

		var cuspricecal_qty = jQuery('#cuspricecal_qty').val();

		//var cuspricecal_amountofColor = jQuery('#cuspricecal_amountofColor').val();
		var cuspricecal_amountofColor = getclr();

		var cuspricecal_location = jQuery('#cuspricecal_location').val();

		if (cuspricecal_qty && cuspricecal_amountofColor && cuspricecal_location) {
			cuspricecalajax(cuspricecal_qty, cuspricecal_amountofColor, cuspricecal_location, addonoptArray);
		}


	});

	jQuery('#cuspricecal_location').change(function(){  

		var target = jQuery(this);

		var cuspricecal_qty = jQuery('#cuspricecal_qty').val();

		//var cuspricecal_amountofColor = jQuery('#cuspricecal_amountofColor').val();
		var cuspricecal_amountofColor = getclr();

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


function getclr(){

	var mainCrlArray ={};
	jQuery('.product-option-radio_image .product-option-id').each(function(){

        var ids = jQuery(this).val();  

        var titlestr = jQuery('.product-option-'+ids+' .product-option-title').text(); 
        var title = titlestr.replace('+ ', '');
        var title = title.replace('- ', '');

        var radioImageLabel = jQuery('.product-option-'+ids+' .selected-radio-image')
              .map(function(){return jQuery(this).text();}).get();

        mainCrlArray[title] = radioImageLabel;   
    }); 

    return mainCrlArray;
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

			//jQuery('#separate_name').val(JSON.stringify(response['separate_name']));

			//console.log(response);

			if (response['ammountOfcolor']) {
		
				jQuery('.cart .qty').val(qty);

				jQuery('#cuspricecal_price').text(response['price']);
				jQuery('#cuspricecal_color').text(response['ammountOfcolor']);
				jQuery('#cuspricecal_loc').text(response['locationside']);
				jQuery('#cuspricecal_total').text(response['totalprice']);
				jQuery('#cuspricecal_totalprice').val(response['totalprice']);
				jQuery('#cuspricecal_price_per_price').text(response['price_per_price']);
				jQuery('#cuspricecal_price_per_price_input').val(response['price_per_price']);

				
				if (response['standard_fee']) {
					jQuery('.cuspricecal_standard_fee').show();
					jQuery('#cuspricecal_standard_fee').text(response['standard_fee']);
				}
				else{
					jQuery('.cuspricecal_standard_fee').hide();
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