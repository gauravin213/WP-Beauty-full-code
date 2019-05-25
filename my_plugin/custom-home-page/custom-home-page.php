<?php
/*
* Plugin Name: Custom Home Page
* Author: Gaurav Sharma
* Text Domain: custom-home-page
* Description: This is the custom-home-page plugin
* Version: 1.0.0
*/


function custom_home_page_shortcode_fun() {
    ob_start();
    
    include 'template/tmp-front-page.php';

    $output = ob_get_contents(); // end output buffering
    ob_end_clean(); // grab the buffer contents and empty the buffer
    return $output;
}
add_shortcode('custom_home_page_shortcode', 'custom_home_page_shortcode_fun');



add_action( 'admin_enqueue_scripts', 'consultant_include_myuploadscript' );
function consultant_include_myuploadscript() {

  if ( ! did_action( 'wp_enqueue_media' ) ) {
    wp_enqueue_media();
  }

}


add_action('admin_menu', 'add_frontpage_admin');
function add_frontpage_admin() {
  if (function_exists('add_options_page')) {
  add_options_page('FrontPage Options', 'FrontPage Options', 9, basename(__FILE__), 'custom_frontpage_admin');
  }
}
function custom_frontpage_admin() {
?>

<div class="wrap">

<style>
li.clag-bar-item.clag-button {
    float: left;
    margin-right: 10px;
    background: #008EC2;
    color: #ffffff;
    padding: 5px 10px;
    cursor: pointer;
}

a.consultant_upload_image_button.button {margin: 10px auto;}
.thumb-img-front{width:200px;}
input, textarea {width: 100%;}
.optiontable td{width:80%;}
table tr:nth-child(5n) th, table tr:nth-child(5n) td {
    border-bottom: 2px solid #000;
    padding-bottom: 25px;
}
table tr:nth-child(5n+1) th, table tr:nth-child(5n+1) td {padding-top: 20px;}

.active_tab {
    background-color: #54a554 !important;
}
#current_nect_month {
    color: red;
}
</style>



<div>

<span style="font-weight: bold;font-size: 22px;">Custom Countdown</span>

<span style="font-size: 24px;margin-left: 20px;">
	Currently next month (<span id="current_nect_month" class="current_nect_month"></span>) will be display at 25th<span id="crrnectmonth" class="crrnectmonth"></span>
<span id="crrnectdate" class="crrnectdate"></span>
</span>


</div>

<div class="clag-bar" style="display: flex;">
<ul>
  <li class="clag-bar-item clag-button" data-month="january">Januar</li>
  <li class="clag-bar-item clag-button" data-month="february">Februar</li>
  <li class="clag-bar-item clag-button" data-month="march">März</li>
  <li class="clag-bar-item clag-button" data-month="april">April</li>
  <li class="clag-bar-item clag-button" data-month="may">Mai</li>
  <li class="clag-bar-item clag-button" data-month="june">Juni</li>
  <li class="clag-bar-item clag-button" data-month="july">Juli</li>
  <li class="clag-bar-item clag-button" data-month="august">August</li>
  <li class="clag-bar-item clag-button" data-month="september">September</li>
  <li class="clag-bar-item clag-button" data-month="october">Oktober</li>
  <li class="clag-bar-item clag-button" data-month="november">November</li>
  <li class="clag-bar-item clag-button" data-month="december">Dezember</li>


<ul>
</div>





<!--includes templates-->
<?php
include 'admin/template/home-tmp1-january.php';
include 'admin/template/home-tmp2-february.php';
include 'admin/template/home-tmp3-march.php';   
include 'admin/template/home-tmp4-april.php';  
include 'admin/template/home-tmp5-may.php'; 
include 'admin/template/home-tmp6-june.php'; 
include 'admin/template/home-tmp7-july.php'; 
include 'admin/template/home-tmp8-august.php';  
include 'admin/template/home-tmp9-september.php';
include 'admin/template/home-tmp10-october.php';  
include 'admin/template/home-tmp11-november.php';  
include 'admin/template/home-tmp12-december.php'; 
?>
<!--includes templates-->








<script type="text/javascript">
jQuery(document).ready(function(){

  var cmonth = fungetmonths();
  var compare_with_current_date = cmonth['dd'];
  var switch_tab_limit_date = 25;
  var final_switch_date = switch_tab_limit_date - 1;

  //compare_with_current_date = 1;

  if (compare_with_current_date > final_switch_date) 
  {
    //Switch tab  
    var crrnextMonth = getCurrentNextMonthDateTime();

    console.log(crrnextMonth);

    openTab(crrnextMonth[0]);
    jQuery('.clag-button').each(function(index){
      var ppp = jQuery(this).data('month');
      if (ppp == crrnextMonth[0]) {
        jQuery('.clag-button').removeClass('active_tab');
          jQuery(this).addClass('active_tab');
      }

    });


    //Current Next Month
    var month = new Array();
    month[0] = "january";
    month[1] = "february";
    month[2] = "march";
    month[3] = "april";
    month[4] = "may";
    month[5] = "june";
    month[6] = "july";
    month[7] = "august";
    month[8] = "september";
    month[9] = "october";
    month[10] = "november";
    month[11] = "december";
    jQuery('#current_nect_month').text( month[ crrnextMonth[2] + 1] );


  }
  else
  {
    //Not Switch tab

   //var cmonth = fungetmonths();
    openTab(cmonth['mm']);
    jQuery('.clag-button').each(function(index){
      var ppp = jQuery(this).data('month');
      if (ppp == cmonth['mm']) {
        jQuery('.clag-button').removeClass('active_tab');
          jQuery(this).addClass('active_tab');
      }
    });

    //Current Next Month
    var getCurrentNextMonth_val = getCurrentNextMonth();
    jQuery('#current_nect_month').text(getCurrentNextMonth_val[0]);

  }

	
	jQuery(document).on('click', '.clag-button', function(){
		var target = jQuery(this);
		var month_name = target.data('month');
		openTab(month_name);
		jQuery('.clag-button').removeClass('active_tab');
    	target.addClass('active_tab');
	});

  //Current Next Month
  //var getCurrentNextMonth_val = getCurrentNextMonth();
  //jQuery('#current_nect_month').text(getCurrentNextMonth_val[0]);
  //jQuery('#crrnectmonth').text(getCurrentNextMonth_val[1]);
  //jQuery('#crrnectdate').text(getCurrentNextMonth_val[2]);


});


function fungetmonths() {
    var month = new Array();
    month[0] = "january";
    month[1] = "february";
    month[2] = "march";
    month[3] = "april";
    month[4] = "may";
    month[5] = "june";
    month[6] = "july";
    month[7] = "august";
    month[8] = "september";
    month[9] = "october";
    month[10] = "november";
    month[11] = "december";

    var d = new Date();
    /*var n = month[d.getMonth()];
    return n;*/

    var csu_ddmmyy = new Array();
    csu_ddmmyy['dd'] = d.getDate();
    csu_ddmmyy['mm'] = month[d.getMonth()];
    csu_ddmmyy['yy'] = d.getFullYear();

    return csu_ddmmyy;
}

function getCurrentNextMonth() {
    
    var now = new Date();
	if (now.getMonth() == 11) {
	    var current = new Date(now.getFullYear() + 1, 0, 1);
	} else {
	    var current = new Date(now.getFullYear(), now.getMonth() + 1, 1);
	}

	var month = new Array();
    month[0] = "Januar";
    month[1] = "Februar";
    month[2] = "März";
    month[3] = "April";
    month[4] = "Mai";
    month[5] = "Juni";
    month[6] = "Juli";
    month[7] = "August";
    month[8] = "September";
    month[9] = "Oktober";
    month[10] = "November";
    month[11] = "Dezember";

    var a = month[current.getMonth()];

    var b = pad(current.getMonth()+1, 2);

    var c = pad(current.getDate(), 2);

    var n = [a, b, c]; 
    return n;

}


function getCurrentNextMonthDateTime() {
    
  var now = new Date();
  if (now.getMonth() == 11) {
      var current = new Date(now.getFullYear() + 1, 0, 1);
  } else {
      var current = new Date(now.getFullYear(), now.getMonth() + 1, 1);
  }
 var month = new Array();
    month[0] = "january";
    month[1] = "february";
    month[2] = "march";
    month[3] = "april";
    month[4] = "may";
    month[5] = "june";
    month[6] = "july";
    month[7] = "august";
    month[8] = "september";
    month[9] = "october";
    month[10] = "november";
    month[11] = "december";

    /*var a = month[current.getMonth()];

    var b = pad(current.getMonth()+1, 2);

    var c = pad(current.getDate(), 2);

     var n = [a, b, c]; 
    return n;*/

    var a = month[current.getMonth()];

    var b = current.getDate();

    var c = current.getMonth();

    var d = current.getFullYear();

    var n = [a, b, c, d]; 
    return n;

}

function pad (str, max) {
  str = str.toString();
  return str.length < max ? pad("0" + str, max) : str;
}

function openTab(tabName) {
    var i;
    var x = document.getElementsByClassName("clag-tab");
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    document.getElementById(tabName).style.display = "block";
}
</script>


<script type="text/javascript">
jQuery(function($){
/*
* Select/Upload image(s) event
*/
$('body').on('click', '.consultant_upload_image_button', function(e){
e.preventDefault();

var button = $(this),
custom_uploader = wp.media({
title: 'Insert image',
library : {
// uncomment the next line if you want to attach image to the current post
// uploadedTo : wp.media.view.settings.post.id, 
type : 'image'
},
button: {
text: 'Use this image' // button label text
},
multiple: false // for multiple image selection set to true
}).on('select', function() { // it also has "open" and "close" events 
var attachment = custom_uploader.state().get('selection').first().toJSON();
$(button).removeClass('button').html('<img class="true_pre_image" src="' + attachment.url + '" style="max-width:50%;display:block;" />').next().val(attachment.id).next().show();
/* if you sen multiple to true, here is some code for getting the image IDs
var attachments = frame.state().get('selection'),
attachment_ids = new Array(),
i = 0;
attachments.each(function(attachment) {
attachment_ids[i] = attachment['id'];
console.log( attachment );
i++;
});
*/
})
.open();
});

/*
* Remove image event
*/
$('body').on('click', '.misha_remove_image_button', function(){
$(this).hide().prev().val('').prev().addClass('button').html('Upload image');
return false;
});

});
</script>
</div>


<?php
}

/*
* End::Front Page Options
*/


function consultant_image_uploader_field( $name, $value = '') {

$image = ' button">Upload Banner';
$image_size = 'full'; // it would be better to use thumbnail size here (150x150 or so)
$display = 'none'; // display state ot the "Remove image" button

if( $image_attributes = wp_get_attachment_image_src( $value, $image_size ) ) {

	/*echo "<pre>";
	print_r($image_attributes);
	echo "</pre>";*/

$image = '"><img src="' . $image_attributes[0] . '" style="max-width:50%;display:block;" />';
$display = 'inline-block';
}

return '<div>
<a href="#" class="consultant_upload_image_button' . $image . '</a>
<input type="hidden" name="' . $name . '" id="' . $name . '" value="' . $value . '" />
<a href="#" class="misha_remove_image_button" style="display:inline-block;display:' . $display . '">Remove image</a>
</div>';

}

function consultant_logo_uploader_field( $name, $value = '') {
$image = ' button">Upload Logo';
$image_size = 'full'; // it would be better to use thumbnail size here (150x150 or so)
$display = 'none'; // display state ot the "Remove image" button

if( $image_attributes = wp_get_attachment_image_src( $value, $image_size ) ) {
$image = '"><img src="' . $image_attributes[0] . '" style="max-width:50%;display:block;" />';
$display = 'inline-block';
}

return '
<div>
<a href="#" class="consultant_upload_image_button' . $image . '</a>
<input type="hidden" name="' . $name . '" id="' . $name . '" value="' . $value . '" />
<a href="#" class="misha_remove_image_button" style="display:inline-block;display:' . $display . '">Remove image</a>
</div>';

}



