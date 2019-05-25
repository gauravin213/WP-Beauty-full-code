jQuery(document).ready(function($) { 


	jQuery(document).on('click', '#cusspintool_front_spin_btn',function(){ 

		var front_spin_content = jQuery('#cusspintool_front_textarea').val();

		/**/
		jQuery.ajax({
		    url: spinfrontdata.ajaxurl,
		    type: "POST",
		    data: {
		    	'action': 'cusspintool_front_action', 
		    	'post_id': spinfrontdata.post_id,
		    	'front_spin_content': front_spin_content
		    },
		   	dataType: 'json',
		    beforeSend: function(){
		      	jQuery('.cuspricecal_ajax_loading').show();
		    },
		    complete: function(){
		       	jQuery('.cuspricecal_ajax_loading').hide();
		    },
		    success: function (response) { 
		    	//alert(response['response']); 
		    	console.log(response);
		    	jQuery('#cusspintool_front_textarea').text(response['response']);
		    	jQuery('#cusspintool_front_textarea').val(response['response']);
		    }
	    });
		/**/

	});


});