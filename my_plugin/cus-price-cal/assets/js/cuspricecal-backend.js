jQuery(document).ready(function($) {  


	jQuery(document).on('click', '#cuspricecal_save_ajax', function() { 


		/*
		* Start Backend validation
		*/
		var flag1 = 1;
		var flag2 = 0;
		var enteredValude = "";
		var alerterrromsg = "";
		jQuery.each(jQuery("input[name='cuspricecalQty[]']"), function(index){

			var cuspricecal_qty_validate = jQuery(this).val().split("-");

			if (cuspricecal_qty_validate!="") 
			{
				if (parseInt(cuspricecal_qty_validate[0]) < parseInt(cuspricecal_qty_validate[1])) {
			
					//console.log("valide");
					jQuery(this).css('border-color', '');

					/*price validation*/
					var cuspricecal_price_validate = jQuery('#cuspricecalPrice'+index).val();
					if (parseInt(cuspricecal_price_validate) || parseFloat(cuspricecal_price_validate)){
						flag1 = 1;
						jQuery('#cuspricecalPrice'+index).css('border-color', '');

						/*color validation*/
						var cuspricecal_clr1_validate = jQuery('#cuspricecalClr1'+index).val();
						if (parseInt(cuspricecal_clr1_validate) || parseFloat(cuspricecal_clr1_validate)){
							flag1 = 1;
							jQuery('#cuspricecalClr1'+index).css('border-color', '');
						}
						else{
							flag2 = 1;
							jQuery('#cuspricecalClr1'+index).css('border-color', 'red');
							alerterrromsg = 'Invalid entry Please enter the Color price';
						}
						/*color validation*/
					}
					else{
						flag2 = 1;
						jQuery('#cuspricecalPrice'+index).css('border-color', 'red');
						alerterrromsg = 'Invalid entry Please enter the price';
					}
					/*price validation*/
				}
				else{
					enteredValude = cuspricecal_qty_validate[0]+" < "+cuspricecal_qty_validate[1];
					alerterrromsg = 'Invalid entry min qty must be less then max qty :: '+enteredValude;
					//console.log("not valide");
					flag2 = 1;
					jQuery(this).css('border-color', 'red');
					
				}
			}
		});
		//console.log(flag1+" > "+flag2);
		/*
		* End Backend validation
		*/




		if (flag1 > flag2) {

		//alert('valide');

		/*-----------------*/
		var pluginStatus = "";

		if (jQuery('#cuspricecalStatus').attr('checked')){
		    pluginStatus = 1;
		}else{
			pluginStatus = 0;
		}
		
		var cuspricecal_qty = jQuery("input[name='cuspricecalQty[]']")
              .map(function(){return jQuery(this).val();}).get(); //alert(cuspricecal_qty);

        var cuspricecal_price = jQuery("input[name='cuspricecalPrice[]']")
              .map(function(){return jQuery(this).val();}).get(); //alert(cuspricecal_price);

        var cuspricecal_clr1 = jQuery("input[name='cuspricecalClr1[]']")
              .map(function(){return jQuery(this).val();}).get(); //alert(cuspricecal_clr1);
        var cuspricecal_clr2 = jQuery("input[name='cuspricecalClr2[]']")
              .map(function(){return jQuery(this).val();}).get(); //alert(cuspricecal_clr2);
        var cuspricecal_clr3 = jQuery("input[name='cuspricecalClr3[]']")
              .map(function(){return jQuery(this).val();}).get(); //alert(cuspricecal_clr3);
        var cuspricecal_clr4 = jQuery("input[name='cuspricecalClr4[]']")
              .map(function(){return jQuery(this).val();}).get(); //alert(cuspricecal_clr4);
        var cuspricecal_clr5 = jQuery("input[name='cuspricecalClr5[]']")
              .map(function(){return jQuery(this).val();}).get(); //alert(cuspricecal_clr5);
        var cuspricecal_clr6 = jQuery("input[name='cuspricecalClr6[]']")
              .map(function(){return jQuery(this).val();}).get(); //alert(cuspricecal_clr6);
        var cuspricecal_clr7 = jQuery("input[name='cuspricecalClr7[]']")
              .map(function(){return jQuery(this).val();}).get(); //alert(cuspricecal_clr7);
        var cuspricecal_clr8 = jQuery("input[name='cuspricecalClr8[]']")
              .map(function(){return jQuery(this).val();}).get(); //alert(cuspricecal_clr8);


        var standard_fee = jQuery('#cuspricecal_fee').val(); 

        

		jQuery.ajax({
		    url: datab.ajaxurl,
		    type: "POST",
		    data: {
		    	'action': 'cuspricecal_myback_action', 
		    	'product_id': datab.product_id,
		    	'cuspricecalQty': cuspricecal_qty,
		    	'cuspricecalPrice': cuspricecal_price,
		    	'cuspricecalClr1': cuspricecal_clr1,
		    	'cuspricecalClr2': cuspricecal_clr2,
		    	'cuspricecalClr3': cuspricecal_clr3,
		    	'cuspricecalClr4': cuspricecal_clr4,
		    	'cuspricecalClr5': cuspricecal_clr5,
		    	'cuspricecalClr6': cuspricecal_clr6,
		    	'cuspricecalClr7': cuspricecal_clr7,
		    	'cuspricecalClr8': cuspricecal_clr8,
		    	'pluginStatus': pluginStatus,
		    	'cuspricecal_fee': standard_fee
		    },
		    //dataType: 'json',
		    beforeSend: function(){
		      	jQuery('#cuspricecal_save_ajax').val("Loding..");
		      	jQuery('.cuspricecal_ajax_loading').show();
		    },
		    complete: function(){
		       	jQuery('#cuspricecal_save_ajax').val("Save Changes");
		        jQuery('.cuspricecal_ajax_loading').hide();
		    },
		    success: function (response) { 
		    	//alert(response); 
		    	//console.log(response);
				//window.location.href=window.location.href;
		    }
	    });

	    /*-----------------*/

		}
		else
		{
			alert(alerterrromsg);
		}

	});
	

});
