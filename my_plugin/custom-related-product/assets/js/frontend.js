jQuery(document).ready(function($) {  //alert("ppp");


	//jQuery('.entry-summary > .entry-title').append('<span id="woorel_loader">Lodding...</span>');
//jQuery('#woorel_loader2').show();
	jQuery('#wooppt_select_btn').change(function(){  

		var target = jQuery(this);

		var Product_title = jQuery("#wooppt_select_btn option:selected").text(); 

		if (target.val()!="") {

			jQuery.ajax({
		        url: dataobj.ajaxurl,
		        type: "POST",
		        data: {'action': 'woorel_my_action', 'pid': target.val()},
		        cache: false,
		        dataType: 'json',
		        beforeSend: function(){
		            //jQuery('#woorel_loader').show();
		            jQuery('#woorel_loader2').show();
		            jQuery('#woorel_loadertext2_title').text(Product_title);
		        },
		        complete: function(){
		            //jQuery('#woorel_loader').hide();
		        },
		        success: function (response) {

					//alert(response['product_url']);
					console.log(response);

					jQuery(location).attr('href', response['product_url']);
		               
		        }



		        /**/
		        /*jQuery.each(data, function() { 

								li_htm = li_htm + '<li class="form2_emptyli"><a class="form2_pname" href="JavaScript://" id="'+this.product_id+'">'+this.name+'</a></li>';	

								
							});*/
		        /**/
	        });
		}


	});

});