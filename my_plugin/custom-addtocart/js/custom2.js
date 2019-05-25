//alert(dataobj.ajaxurl);

jQuery(document).on('change','#custom_checkbox',function(){ 
   
    var pid = jQuery('#pid').val();

    var cus_cart_status = "";

    if(jQuery(this).is(":checked")) { //alert(":Checked");
        cus_cart_status = 1;
    }
    else{ //alert(":Unchecked");
        cus_cart_status = 0;

    }

    jQuery.ajax({
        url: dataobj.ajaxurl,
        type: "POST",
        data: {'action': 'woocus_my_action', 'pid': pid, cus_cart_status: cus_cart_status},
        cache: false,
        beforeSend: function(){
            //jQuery('#woorel_loader').show();
        },
        complete: function(){
            //jQuery('#woorel_loader').hide();
        },
        success: function (response) {

            jQuery(document.body).trigger("update_checkout");

            //alert(response);
             //console.log(response);
        }
    });


});


