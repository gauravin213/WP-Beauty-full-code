jQuery(document).ready(function($) { 

	var editor_id = "wp-content-editor-container";
	var textarea_id = "content";

	var content = tmce_getContent(editor_id, textarea_id);
	jQuery('#spin_textarea_content').text(content);

	jQuery(document).on('click', '#spin_content_btn',function(){

		var spin_content = jQuery('#spin_textarea_content').val();
		
		/**/
		jQuery.ajax({
		    url: spindata.ajaxurl,
		    type: "POST",
		    data: {
		    	'action': 'cusspintool_spin_action', 
		    	'product_id': spindata.product_id,
		    	'spin_content': spin_content
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
		    	//console.log(response);
		    	jQuery('#spin_textarea_content').text(response['response']);
		    	jQuery('#spin_textarea_content').val(response['response']);
				tmce_setContent(response['response'], editor_id, textarea_id);
		    }
	    });
		/**/

	});


});




function tmce_getContent(editor_id, textarea_id) {
  if ( typeof editor_id == 'undefined' ) editor_id = wpActiveEditor;
  if ( typeof textarea_id == 'undefined' ) textarea_id = editor_id;
  
  if ( jQuery('#wp-'+editor_id+'-wrap').hasClass('tmce-active') && tinyMCE.get(editor_id) ) {
    return tinyMCE.get(editor_id).getContent();
  }else{
    return jQuery('#'+textarea_id).val();
  }
}

function tmce_setContent(content, editor_id, textarea_id) {
  if ( typeof editor_id == 'undefined' ) editor_id = wpActiveEditor;
  if ( typeof textarea_id == 'undefined' ) textarea_id = editor_id;
  
  if ( jQuery('#wp-'+editor_id+'-wrap').hasClass('tmce-active') && tinyMCE.get(editor_id) ) {
    return tinyMCE.get(editor_id).setContent(content);
  }else{
    return jQuery('#'+textarea_id).val(content);
  }
}

function tmce_focus(editor_id, textarea_id) {
  if ( typeof editor_id == 'undefined' ) editor_id = wpActiveEditor;
  if ( typeof textarea_id == 'undefined' ) textarea_id = editor_id;
  
  if ( jQuery('#wp-'+editor_id+'-wrap').hasClass('tmce-active') && tinyMCE.get(editor_id) ) {
    return tinyMCE.get(editor_id).focus();
  }else{
    return jQuery('#'+textarea_id).focus();
  }
}