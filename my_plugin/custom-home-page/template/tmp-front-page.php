<?php
/*
 * Template Name: Custom Home Page
 */
get_header();
?>


<?php
$date = date("Y-m-d");
$d = date_parse_from_format("Y-m-d", $date);


//Change by next monbth
if ($d["day"] >= 25) 
{ 
  $date_next = date('Y-m-t',strtotime("+1 month"));
  $d = date_parse_from_format("Y-m-d", $date_next);
}


if ($d["month"] == 1) 
{
	?>
	<!----------------------------------------1---------------------------------------------->
	<div class="grid">
			<div class="grid-sizer"></div>
				<div class="grid-item-width1 item">
					<div class="current-event"><a href="#"><?php if (get_option('calender_title')) echo strtoupper(get_option('calender_title')); ?><br> <?php if (get_option('calender_description')) echo get_option('calender_description'); ?></a></div>
				</div>
				
				<a href="<?php if (get_option('home_1_link')) echo get_option('home_1_link'); ?>" title="<?php if (get_option('home_1_title')) echo get_option('home_1_title'); ?>">
				<div class="grid-item-width2 item">
					<div class="top-topic-container">
						<div class="top-topic-image">
							<img src="<?php echo wp_get_attachment_url( get_option('image_1') ); ?>">
						</div><!--top-topic-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('home_1_category_name')) echo get_option('home_1_category_name'); ?></div>
							<h2><?php if (get_option('home_1_title')) echo get_option('home_1_title'); ?> </h2>
							<p><?php if (get_option('home_1_description')) echo get_option('home_1_description'); ?></p>
							
						</div><!--event-detail-->
					</div><!--top-topic-container-->
				</div>
				</a>
				
				<div class="grid-item-width1 item">
					<div class="fav-event"><a href="#"><?php if (get_option('favorites_title')) echo strtoupper(get_option('favorites_title')); ?><br> <?php if (get_option('favorites_description')) echo get_option('favorites_description'); ?></a></div>
				</div>
				
				<a href="<?php if (get_option('home_2_link')) echo get_option('home_2_link'); ?>" title="<?php if (get_option('home_2_title')) echo get_option('home_2_title'); ?>">
					<div class="grid-item-width1 item">
					<div class="event-box">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('image_2') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('home_2_category_name')) echo get_option('home_2_category_name'); ?></div>
							<h2><?php if (get_option('home_2_title')) echo get_option('home_2_title'); ?> </h2>
							<p><?php if (get_option('home_2_description')) echo get_option('home_2_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
					</div>
				</a>
				
				<a href="<?php if (get_option('home_3_link')) echo get_option('home_3_link'); ?>" title="<?php if (get_option('home_3_title')) echo get_option('home_3_title'); ?>">	
					<div class="grid-item-width1 item">
					<div class="event-box box-color2">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('image_3') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('home_3_category_name')) echo get_option('home_3_category_name'); ?></div>
							<h2><?php if (get_option('home_3_title')) echo get_option('home_3_title'); ?> </h2>
							<p><?php if (get_option('home_3_description')) echo get_option('home_3_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('home_4_link')) echo get_option('home_4_link'); ?>" title="<?php if (get_option('home_4_title')) echo get_option('home_4_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="event-box box-color3">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('image_4') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('home_4_category_name')) echo get_option('home_4_category_name'); ?></div>
							<h2><?php if (get_option('home_4_title')) echo get_option('home_4_title'); ?> </h2>
							<p><?php if (get_option('home_4_description')) echo get_option('home_4_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				
				<a href="<?php if (get_option('home_5_link')) echo get_option('home_5_link'); ?>" title="<?php if (get_option('home_5_title')) echo get_option('home_5_title'); ?>">	
					<div class="grid-item-width1 item">
					<div class="event-box box-color1">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('image_5') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('home_5_category_name')) echo get_option('home_5_category_name'); ?></div>
							<h2><?php if (get_option('home_5_title')) echo get_option('home_5_title'); ?> </h2>
							<p><?php if (get_option('home_5_description')) echo get_option('home_5_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('home_6_link')) echo get_option('home_6_link'); ?>" title="<?php if (get_option('home_6_title')) echo get_option('home_6_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="event-box box-color6">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('image_6') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('home_6_category_name')) echo get_option('home_6_category_name'); ?></div>
							<h2><?php if (get_option('home_6_title')) echo get_option('home_6_title'); ?> </h2>
							<p><?php if (get_option('home_6_description')) echo get_option('home_6_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('home_7_link')) echo get_option('home_7_link'); ?>" title="<?php if (get_option('home_7_title')) echo get_option('home_7_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="new-event">
						<a href="<?php if (get_option('home_7_link')) echo get_option('home_7_link'); ?>"><?php if (get_option('home_7_title')) echo get_option('home_7_title'); ?></a>
					</div>
				</div>
				</a>
				
				
				<a href="<?php if (get_option('home_8_link')) echo get_option('home_8_link'); ?>" title="<?php if (get_option('home_8_title')) echo get_option('home_8_title'); ?>">
				<div class="grid-item-width2 item">
					<div class="event-box box-color4">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('image_8') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('home_8_category_name')) echo get_option('home_8_category_name'); ?></div>
							<h2><?php if (get_option('home_8_title')) echo get_option('home_8_title'); ?> </h2>
							<p><?php if (get_option('home_8_description')) echo get_option('home_8_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('home_9_link')) echo get_option('home_9_link'); ?>" title="<?php if (get_option('home_9_title')) echo get_option('home_9_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="event-box box-color2">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('image_9') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('home_9_category_name')) echo get_option('home_9_category_name'); ?></div>
							<h2><?php if (get_option('home_9_title')) echo get_option('home_9_title'); ?> </h2>
							<p><?php if (get_option('home_9_description')) echo get_option('home_9_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('home_10_link')) echo get_option('home_10_link'); ?>" title="<?php if (get_option('home_10_title')) echo get_option('home_10_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="event-box box-color5">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('image_10') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('home_10_category_name')) echo get_option('home_10_category_name'); ?></div>
							<h2><?php if (get_option('home_10_title')) echo get_option('home_10_title'); ?> </h2>
							<p><?php if (get_option('home_10_description')) echo get_option('home_10_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('home_11_link')) echo get_option('home_11_link'); ?>" title="<?php if (get_option('home_11_title')) echo get_option('home_11_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="event-box">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('image_11') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('home_11_category_name')) echo get_option('home_11_category_name'); ?></div>
							<h2><?php if (get_option('home_11_title')) echo get_option('home_11_title'); ?> </h2>
							<p><?php if (get_option('home_11_description')) echo get_option('home_11_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
</div><!--row-->
	<!----------------------------------------1---------------------------------------------->
	<?php
}
elseif ($d["month"] == 2) 
{
	?>
	<!----------------------------------------2---------------------------------------------->
	<div class="grid">
			<div class="grid-sizer"></div>
				<div class="grid-item-width1 item">
					<div class="current-event"><a href="#"><?php if (get_option('feb_calender_title')) echo strtoupper(get_option('feb_calender_title')); ?><br> <?php if (get_option('feb_calender_description')) echo get_option('feb_calender_description'); ?></a></div>
				</div>
				
				<a href="<?php if (get_option('feb_home_1_link')) echo get_option('feb_home_1_link'); ?>" title="<?php if (get_option('feb_home_1_title')) echo get_option('feb_home_1_title'); ?>">
				<div class="grid-item-width2 item">
					<div class="top-topic-container">
						<div class="top-topic-image">
							<img src="<?php echo wp_get_attachment_url( get_option('feb_image_1') ); ?>">
						</div><!--top-topic-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('feb_home_1_category_name')) echo get_option('feb_home_1_category_name'); ?></div>
							<h2><?php if (get_option('feb_home_1_title')) echo get_option('feb_home_1_title'); ?> </h2>
							<p><?php if (get_option('feb_home_1_description')) echo get_option('feb_home_1_description'); ?></p>
							
						</div><!--event-detail-->
					</div><!--top-topic-container-->
				</div>
				</a>
				
				<div class="grid-item-width1 item">
					<div class="fav-event"><a href="#"><?php if (get_option('feb_favorites_title')) echo strtoupper(get_option('feb_favorites_title')); ?><br> <?php if (get_option('feb_favorites_description')) echo get_option('feb_favorites_description'); ?></a></div>
				</div>
				
				<a href="<?php if (get_option('feb_home_2_link')) echo get_option('feb_home_2_link'); ?>" title="<?php if (get_option('feb_home_2_title')) echo get_option('feb_home_2_title'); ?>">
					<div class="grid-item-width1 item">
					<div class="event-box">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('feb_image_2') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('feb_home_2_category_name')) echo get_option('feb_home_2_category_name'); ?></div>
							<h2><?php if (get_option('feb_home_2_title')) echo get_option('feb_home_2_title'); ?> </h2>
							<p><?php if (get_option('feb_home_2_description')) echo get_option('feb_home_2_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
					</div>
				</a>
				
				<a href="<?php if (get_option('feb_home_3_link')) echo get_option('feb_home_3_link'); ?>" title="<?php if (get_option('feb_home_3_title')) echo get_option('feb_home_3_title'); ?>">	
					<div class="grid-item-width1 item">
					<div class="event-box box-color2">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('feb_image_3') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('feb_home_3_category_name')) echo get_option('feb_home_3_category_name'); ?></div>
							<h2><?php if (get_option('feb_home_3_title')) echo get_option('feb_home_3_title'); ?> </h2>
							<p><?php if (get_option('feb_home_3_description')) echo get_option('feb_home_3_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('feb_home_4_link')) echo get_option('feb_home_4_link'); ?>" title="<?php if (get_option('feb_home_4_title')) echo get_option('feb_home_4_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="event-box box-color3">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('feb_image_4') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('feb_home_4_category_name')) echo get_option('feb_home_4_category_name'); ?></div>
							<h2><?php if (get_option('feb_home_4_title')) echo get_option('feb_home_4_title'); ?> </h2>
							<p><?php if (get_option('feb_home_4_description')) echo get_option('feb_home_4_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				
				<a href="<?php if (get_option('feb_home_5_link')) echo get_option('feb_home_5_link'); ?>" title="<?php if (get_option('feb_home_5_title')) echo get_option('feb_home_5_title'); ?>">	
					<div class="grid-item-width1 item">
					<div class="event-box box-color1">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('feb_image_5') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('feb_home_5_category_name')) echo get_option('feb_home_5_category_name'); ?></div>
							<h2><?php if (get_option('feb_home_5_title')) echo get_option('feb_home_5_title'); ?> </h2>
							<p><?php if (get_option('feb_home_5_description')) echo get_option('feb_home_5_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('feb_home_6_link')) echo get_option('feb_home_6_link'); ?>" title="<?php if (get_option('feb_home_6_title')) echo get_option('feb_home_6_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="event-box box-color6">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('feb_image_6') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('feb_home_6_category_name')) echo get_option('feb_home_6_category_name'); ?></div>
							<h2><?php if (get_option('feb_home_6_title')) echo get_option('feb_home_6_title'); ?> </h2>
							<p><?php if (get_option('feb_home_6_description')) echo get_option('feb_home_6_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('feb_home_7_link')) echo get_option('feb_home_7_link'); ?>" title="<?php if (get_option('feb_home_7_title')) echo get_option('feb_home_7_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="new-event">
						<a href="<?php if (get_option('feb_home_7_link')) echo get_option('feb_home_7_link'); ?>"><?php if (get_option('feb_home_7_title')) echo get_option('feb_home_7_title'); ?></a>
					</div>
				</div>
				</a>
				
				
				<a href="<?php if (get_option('feb_home_8_link')) echo get_option('feb_home_8_link'); ?>" title="<?php if (get_option('feb_home_8_title')) echo get_option('feb_home_8_title'); ?>">
				<div class="grid-item-width2 item">
					<div class="event-box box-color4">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('feb_image_8') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('feb_home_8_category_name')) echo get_option('feb_home_8_category_name'); ?></div>
							<h2><?php if (get_option('feb_home_8_title')) echo get_option('feb_home_8_title'); ?> </h2>
							<p><?php if (get_option('feb_home_8_description')) echo get_option('feb_home_8_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('feb_home_9_link')) echo get_option('feb_home_9_link'); ?>" title="<?php if (get_option('feb_home_9_title')) echo get_option('feb_home_9_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="event-box box-color2">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('feb_image_9') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('feb_home_9_category_name')) echo get_option('feb_home_9_category_name'); ?></div>
							<h2><?php if (get_option('feb_home_9_title')) echo get_option('feb_home_9_title'); ?> </h2>
							<p><?php if (get_option('feb_home_9_description')) echo get_option('feb_home_9_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('feb_home_10_link')) echo get_option('feb_home_10_link'); ?>" title="<?php if (get_option('feb_home_10_title')) echo get_option('feb_home_10_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="event-box box-color5">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('feb_image_10') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('feb_home_10_category_name')) echo get_option('feb_home_10_category_name'); ?></div>
							<h2><?php if (get_option('feb_home_10_title')) echo get_option('feb_home_10_title'); ?> </h2>
							<p><?php if (get_option('feb_home_10_description')) echo get_option('feb_home_10_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('feb_home_11_link')) echo get_option('feb_home_11_link'); ?>" title="<?php if (get_option('feb_home_11_title')) echo get_option('feb_home_11_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="event-box">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('feb_image_11') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('feb_home_11_category_name')) echo get_option('feb_home_11_category_name'); ?></div>
							<h2><?php if (get_option('feb_home_11_title')) echo get_option('feb_home_11_title'); ?> </h2>
							<p><?php if (get_option('feb_home_11_description')) echo get_option('feb_home_11_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
</div><!--row-->
	<!----------------------------------------2---------------------------------------------->
	<?php
}
elseif ($d["month"] == 3) 
{
	?>
	<!----------------------------------------3---------------------------------------------->
	<div class="grid">
			<div class="grid-sizer"></div>
				<div class="grid-item-width1 item">
					<div class="current-event"><a href="#"><?php if (get_option('march_calender_title')) echo strtoupper(get_option('march_calender_title')); ?><br> <?php if (get_option('march_calender_description')) echo get_option('march_calender_description'); ?></a></div>
				</div>
				
				<a href="<?php if (get_option('march_home_1_link')) echo get_option('march_home_1_link'); ?>" title="<?php if (get_option('march_home_1_title')) echo get_option('march_home_1_title'); ?>">
				<div class="grid-item-width2 item">
					<div class="top-topic-container">
						<div class="top-topic-image">
							<img src="<?php echo wp_get_attachment_url( get_option('image_1') ); ?>">
						</div><!--top-topic-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('march_home_1_category_name')) echo get_option('march_home_1_category_name'); ?></div>
							<h2><?php if (get_option('march_home_1_title')) echo get_option('march_home_1_title'); ?> </h2>
							<p><?php if (get_option('march_home_1_description')) echo get_option('march_home_1_description'); ?></p>
							
						</div><!--event-detail-->
					</div><!--top-topic-container-->
				</div>
				</a>
				
				<div class="grid-item-width1 item">
					<div class="fav-event"><a href="#"><?php if (get_option('march_favorites_title')) echo strtoupper(get_option('march_favorites_title')); ?><br> <?php if (get_option('march_favorites_description')) echo get_option('march_favorites_description'); ?></a></div>
				</div>
				
				<a href="<?php if (get_option('march_home_2_link')) echo get_option('march_home_2_link'); ?>" title="<?php if (get_option('march_home_2_title')) echo get_option('march_home_2_title'); ?>">
					<div class="grid-item-width1 item">
					<div class="event-box">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('image_2') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('march_home_2_category_name')) echo get_option('march_home_2_category_name'); ?></div>
							<h2><?php if (get_option('march_home_2_title')) echo get_option('march_home_2_title'); ?> </h2>
							<p><?php if (get_option('march_home_2_description')) echo get_option('march_home_2_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
					</div>
				</a>
				
				<a href="<?php if (get_option('march_home_3_link')) echo get_option('march_home_3_link'); ?>" title="<?php if (get_option('march_home_3_title')) echo get_option('march_home_3_title'); ?>">	
					<div class="grid-item-width1 item">
					<div class="event-box box-color2">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('image_3') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('march_home_3_category_name')) echo get_option('march_home_3_category_name'); ?></div>
							<h2><?php if (get_option('march_home_3_title')) echo get_option('march_home_3_title'); ?> </h2>
							<p><?php if (get_option('march_home_3_description')) echo get_option('march_home_3_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('march_home_4_link')) echo get_option('march_home_4_link'); ?>" title="<?php if (get_option('march_home_4_title')) echo get_option('march_home_4_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="event-box box-color3">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('image_4') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('march_home_4_category_name')) echo get_option('march_home_4_category_name'); ?></div>
							<h2><?php if (get_option('march_home_4_title')) echo get_option('march_home_4_title'); ?> </h2>
							<p><?php if (get_option('march_home_4_description')) echo get_option('march_home_4_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				
				<a href="<?php if (get_option('march_home_5_link')) echo get_option('march_home_5_link'); ?>" title="<?php if (get_option('march_home_5_title')) echo get_option('march_home_5_title'); ?>">	
					<div class="grid-item-width1 item">
					<div class="event-box box-color1">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('image_5') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('march_home_5_category_name')) echo get_option('march_home_5_category_name'); ?></div>
							<h2><?php if (get_option('march_home_5_title')) echo get_option('march_home_5_title'); ?> </h2>
							<p><?php if (get_option('march_home_5_description')) echo get_option('march_home_5_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('march_home_6_link')) echo get_option('march_home_6_link'); ?>" title="<?php if (get_option('march_home_6_title')) echo get_option('march_home_6_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="event-box box-color6">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('image_6') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('march_home_6_category_name')) echo get_option('march_home_6_category_name'); ?></div>
							<h2><?php if (get_option('march_home_6_title')) echo get_option('march_home_6_title'); ?> </h2>
							<p><?php if (get_option('march_home_6_description')) echo get_option('march_home_6_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('march_home_7_link')) echo get_option('march_home_7_link'); ?>" title="<?php if (get_option('march_home_7_title')) echo get_option('march_home_7_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="new-event">
						<a href="<?php if (get_option('march_home_7_link')) echo get_option('march_home_7_link'); ?>"><?php if (get_option('march_home_7_title')) echo get_option('march_home_7_title'); ?></a>
					</div>
				</div>
				</a>
				
				
				<a href="<?php if (get_option('march_home_8_link')) echo get_option('march_home_8_link'); ?>" title="<?php if (get_option('march_home_8_title')) echo get_option('march_home_8_title'); ?>">
				<div class="grid-item-width2 item">
					<div class="event-box box-color4">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('image_8') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('march_home_8_category_name')) echo get_option('march_home_8_category_name'); ?></div>
							<h2><?php if (get_option('march_home_8_title')) echo get_option('march_home_8_title'); ?> </h2>
							<p><?php if (get_option('march_home_8_description')) echo get_option('march_home_8_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('march_home_9_link')) echo get_option('march_home_9_link'); ?>" title="<?php if (get_option('march_home_9_title')) echo get_option('march_home_9_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="event-box box-color2">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('image_9') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('march_home_9_category_name')) echo get_option('march_home_9_category_name'); ?></div>
							<h2><?php if (get_option('march_home_9_title')) echo get_option('march_home_9_title'); ?> </h2>
							<p><?php if (get_option('march_home_9_description')) echo get_option('march_home_9_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('march_home_10_link')) echo get_option('march_home_10_link'); ?>" title="<?php if (get_option('march_home_10_title')) echo get_option('march_home_10_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="event-box box-color5">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('image_10') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('march_home_10_category_name')) echo get_option('march_home_10_category_name'); ?></div>
							<h2><?php if (get_option('march_home_10_title')) echo get_option('march_home_10_title'); ?> </h2>
							<p><?php if (get_option('march_home_10_description')) echo get_option('march_home_10_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('march_home_11_link')) echo get_option('march_home_11_link'); ?>" title="<?php if (get_option('march_home_11_title')) echo get_option('march_home_11_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="event-box">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('image_11') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('march_home_11_category_name')) echo get_option('march_home_11_category_name'); ?></div>
							<h2><?php if (get_option('march_home_11_title')) echo get_option('march_home_11_title'); ?> </h2>
							<p><?php if (get_option('march_home_11_description')) echo get_option('march_home_11_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
</div><!--row-->
	<!----------------------------------------3---------------------------------------------->
	<?php
}
elseif ($d["month"] == 4) 
{
	?>
	<!----------------------------------------4---------------------------------------------->
	<div class="grid">
			<div class="grid-sizer"></div>
				<div class="grid-item-width1 item">
					<div class="current-event"><a href="#"><?php if (get_option('april_calender_title')) echo strtoupper(get_option('april_calender_title')); ?><br> <?php if (get_option('april_calender_description')) echo get_option('april_calender_description'); ?></a></div>
				</div>
				
				<a href="<?php if (get_option('april_home_1_link')) echo get_option('april_home_1_link'); ?>" title="<?php if (get_option('april_home_1_title')) echo get_option('april_home_1_title'); ?>">
				<div class="grid-item-width2 item">
					<div class="top-topic-container">
						<div class="top-topic-image">
							<img src="<?php echo wp_get_attachment_url( get_option('april_image_1') ); ?>">
						</div><!--top-topic-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('april_home_1_category_name')) echo get_option('april_home_1_category_name'); ?></div>
							<h2><?php if (get_option('april_home_1_title')) echo get_option('april_home_1_title'); ?> </h2>
							<p><?php if (get_option('april_home_1_description')) echo get_option('april_home_1_description'); ?></p>
							
						</div><!--event-detail-->
					</div><!--top-topic-container-->
				</div>
				</a>
				
				<div class="grid-item-width1 item">
					<div class="fav-event"><a href="#"><?php if (get_option('april_favorites_title')) echo strtoupper(get_option('april_favorites_title')); ?><br> <?php if (get_option('april_favorites_description')) echo get_option('april_favorites_description'); ?></a></div>
				</div>
				
				<a href="<?php if (get_option('april_home_2_link')) echo get_option('april_home_2_link'); ?>" title="<?php if (get_option('april_home_2_title')) echo get_option('april_home_2_title'); ?>">
					<div class="grid-item-width1 item">
					<div class="event-box">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('april_image_2') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('april_home_2_category_name')) echo get_option('april_home_2_category_name'); ?></div>
							<h2><?php if (get_option('april_home_2_title')) echo get_option('april_home_2_title'); ?> </h2>
							<p><?php if (get_option('april_home_2_description')) echo get_option('april_home_2_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
					</div>
				</a>
				
				<a href="<?php if (get_option('april_home_3_link')) echo get_option('april_home_3_link'); ?>" title="<?php if (get_option('april_home_3_title')) echo get_option('april_home_3_title'); ?>">	
					<div class="grid-item-width1 item">
					<div class="event-box box-color2">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('april_image_3') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('april_home_3_category_name')) echo get_option('april_home_3_category_name'); ?></div>
							<h2><?php if (get_option('april_home_3_title')) echo get_option('april_home_3_title'); ?> </h2>
							<p><?php if (get_option('april_home_3_description')) echo get_option('april_home_3_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('april_home_4_link')) echo get_option('april_home_4_link'); ?>" title="<?php if (get_option('april_home_4_title')) echo get_option('april_home_4_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="event-box box-color3">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('april_image_4') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('april_home_4_category_name')) echo get_option('april_home_4_category_name'); ?></div>
							<h2><?php if (get_option('april_home_4_title')) echo get_option('april_home_4_title'); ?> </h2>
							<p><?php if (get_option('april_home_4_description')) echo get_option('april_home_4_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				
				<a href="<?php if (get_option('april_home_5_link')) echo get_option('april_home_5_link'); ?>" title="<?php if (get_option('april_home_5_title')) echo get_option('april_home_5_title'); ?>">	
					<div class="grid-item-width1 item">
					<div class="event-box box-color1">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('april_image_5') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('april_home_5_category_name')) echo get_option('april_home_5_category_name'); ?></div>
							<h2><?php if (get_option('april_home_5_title')) echo get_option('april_home_5_title'); ?> </h2>
							<p><?php if (get_option('april_home_5_description')) echo get_option('april_home_5_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('april_home_6_link')) echo get_option('april_home_6_link'); ?>" title="<?php if (get_option('april_home_6_title')) echo get_option('april_home_6_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="event-box box-color6">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('april_image_6') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('april_home_6_category_name')) echo get_option('april_home_6_category_name'); ?></div>
							<h2><?php if (get_option('april_home_6_title')) echo get_option('april_home_6_title'); ?> </h2>
							<p><?php if (get_option('april_home_6_description')) echo get_option('april_home_6_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('april_home_7_link')) echo get_option('april_home_7_link'); ?>" title="<?php if (get_option('april_home_7_title')) echo get_option('april_home_7_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="new-event">
						<a href="<?php if (get_option('april_home_7_link')) echo get_option('april_home_7_link'); ?>"><?php if (get_option('april_home_7_title')) echo get_option('april_home_7_title'); ?></a>
					</div>
				</div>
				</a>
				
				
				<a href="<?php if (get_option('april_home_8_link')) echo get_option('april_home_8_link'); ?>" title="<?php if (get_option('april_home_8_title')) echo get_option('april_home_8_title'); ?>">
				<div class="grid-item-width2 item">
					<div class="event-box box-color4">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('april_image_8') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('april_home_8_category_name')) echo get_option('april_home_8_category_name'); ?></div>
							<h2><?php if (get_option('april_home_8_title')) echo get_option('april_home_8_title'); ?> </h2>
							<p><?php if (get_option('april_home_8_description')) echo get_option('april_home_8_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('april_home_9_link')) echo get_option('april_home_9_link'); ?>" title="<?php if (get_option('april_home_9_title')) echo get_option('april_home_9_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="event-box box-color2">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('april_image_9') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('april_home_9_category_name')) echo get_option('april_home_9_category_name'); ?></div>
							<h2><?php if (get_option('april_home_9_title')) echo get_option('april_home_9_title'); ?> </h2>
							<p><?php if (get_option('april_home_9_description')) echo get_option('april_home_9_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('april_home_10_link')) echo get_option('april_home_10_link'); ?>" title="<?php if (get_option('april_home_10_title')) echo get_option('april_home_10_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="event-box box-color5">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('april_image_10') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('april_home_10_category_name')) echo get_option('april_home_10_category_name'); ?></div>
							<h2><?php if (get_option('april_home_10_title')) echo get_option('april_home_10_title'); ?> </h2>
							<p><?php if (get_option('april_home_10_description')) echo get_option('april_home_10_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('april_home_11_link')) echo get_option('april_home_11_link'); ?>" title="<?php if (get_option('april_home_11_title')) echo get_option('april_home_11_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="event-box">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('april_image_11') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('april_home_11_category_name')) echo get_option('april_home_11_category_name'); ?></div>
							<h2><?php if (get_option('april_home_11_title')) echo get_option('april_home_11_title'); ?> </h2>
							<p><?php if (get_option('april_home_11_description')) echo get_option('april_home_11_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
</div><!--row-->
	<!----------------------------------------4---------------------------------------------->
	<?php
}
elseif ($d["month"] == 5) 
{
	?>
	<!----------------------------------------5---------------------------------------------->
	<div class="grid">
			<div class="grid-sizer"></div>
				<div class="grid-item-width1 item">
					<div class="current-event"><a href="#"><?php if (get_option('may_calender_title')) echo strtoupper(get_option('may_calender_title')); ?><br> <?php if (get_option('may_calender_description')) echo get_option('may_calender_description'); ?></a></div>
				</div>
				
				<a href="<?php if (get_option('may_home_1_link')) echo get_option('may_home_1_link'); ?>" title="<?php if (get_option('may_home_1_title')) echo get_option('may_home_1_title'); ?>">
				<div class="grid-item-width2 item">
					<div class="top-topic-container">
						<div class="top-topic-image">
							<img src="<?php echo wp_get_attachment_url( get_option('may_image_1') ); ?>">
						</div><!--top-topic-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('may_home_1_category_name')) echo get_option('may_home_1_category_name'); ?></div>
							<h2><?php if (get_option('may_home_1_title')) echo get_option('may_home_1_title'); ?> </h2>
							<p><?php if (get_option('may_home_1_description')) echo get_option('may_home_1_description'); ?></p>
							
						</div><!--event-detail-->
					</div><!--top-topic-container-->
				</div>
				</a>
				
				<div class="grid-item-width1 item">
					<div class="fav-event"><a href="#"><?php if (get_option('may_favorites_title')) echo strtoupper(get_option('may_favorites_title')); ?><br> <?php if (get_option('may_favorites_description')) echo get_option('may_favorites_description'); ?></a></div>
				</div>
				
				<a href="<?php if (get_option('may_home_2_link')) echo get_option('may_home_2_link'); ?>" title="<?php if (get_option('may_home_2_title')) echo get_option('may_home_2_title'); ?>">
					<div class="grid-item-width1 item">
					<div class="event-box">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('may_image_2') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('may_home_2_category_name')) echo get_option('may_home_2_category_name'); ?></div>
							<h2><?php if (get_option('may_home_2_title')) echo get_option('may_home_2_title'); ?> </h2>
							<p><?php if (get_option('may_home_2_description')) echo get_option('may_home_2_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
					</div>
				</a>
				
				<a href="<?php if (get_option('may_home_3_link')) echo get_option('may_home_3_link'); ?>" title="<?php if (get_option('may_home_3_title')) echo get_option('may_home_3_title'); ?>">	
					<div class="grid-item-width1 item">
					<div class="event-box box-color2">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('may_image_3') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('may_home_3_category_name')) echo get_option('may_home_3_category_name'); ?></div>
							<h2><?php if (get_option('may_home_3_title')) echo get_option('may_home_3_title'); ?> </h2>
							<p><?php if (get_option('may_home_3_description')) echo get_option('may_home_3_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('may_home_4_link')) echo get_option('may_home_4_link'); ?>" title="<?php if (get_option('may_home_4_title')) echo get_option('may_home_4_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="event-box box-color3">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('may_image_4') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('may_home_4_category_name')) echo get_option('may_home_4_category_name'); ?></div>
							<h2><?php if (get_option('may_home_4_title')) echo get_option('may_home_4_title'); ?> </h2>
							<p><?php if (get_option('may_home_4_description')) echo get_option('may_home_4_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				
				<a href="<?php if (get_option('may_home_5_link')) echo get_option('may_home_5_link'); ?>" title="<?php if (get_option('may_home_5_title')) echo get_option('may_home_5_title'); ?>">	
					<div class="grid-item-width1 item">
					<div class="event-box box-color1">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('may_image_5') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('may_home_5_category_name')) echo get_option('may_home_5_category_name'); ?></div>
							<h2><?php if (get_option('may_home_5_title')) echo get_option('may_home_5_title'); ?> </h2>
							<p><?php if (get_option('may_home_5_description')) echo get_option('may_home_5_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('may_home_6_link')) echo get_option('may_home_6_link'); ?>" title="<?php if (get_option('may_home_6_title')) echo get_option('may_home_6_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="event-box box-color6">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('may_image_6') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('may_home_6_category_name')) echo get_option('may_home_6_category_name'); ?></div>
							<h2><?php if (get_option('may_home_6_title')) echo get_option('may_home_6_title'); ?> </h2>
							<p><?php if (get_option('may_home_6_description')) echo get_option('may_home_6_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('may_home_7_link')) echo get_option('may_home_7_link'); ?>" title="<?php if (get_option('may_home_7_title')) echo get_option('may_home_7_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="new-event">
						<a href="<?php if (get_option('may_home_7_link')) echo get_option('may_home_7_link'); ?>"><?php if (get_option('may_home_7_title')) echo get_option('may_home_7_title'); ?></a>
					</div>
				</div>
				</a>
				
				
				<a href="<?php if (get_option('may_home_8_link')) echo get_option('may_home_8_link'); ?>" title="<?php if (get_option('may_home_8_title')) echo get_option('may_home_8_title'); ?>">
				<div class="grid-item-width2 item">
					<div class="event-box box-color4">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('may_image_8') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('may_home_8_category_name')) echo get_option('may_home_8_category_name'); ?></div>
							<h2><?php if (get_option('may_home_8_title')) echo get_option('may_home_8_title'); ?> </h2>
							<p><?php if (get_option('may_home_8_description')) echo get_option('may_home_8_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('may_home_9_link')) echo get_option('may_home_9_link'); ?>" title="<?php if (get_option('may_home_9_title')) echo get_option('may_home_9_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="event-box box-color2">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('may_image_9') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('may_home_9_category_name')) echo get_option('may_home_9_category_name'); ?></div>
							<h2><?php if (get_option('may_home_9_title')) echo get_option('may_home_9_title'); ?> </h2>
							<p><?php if (get_option('may_home_9_description')) echo get_option('may_home_9_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('may_home_10_link')) echo get_option('may_home_10_link'); ?>" title="<?php if (get_option('may_home_10_title')) echo get_option('may_home_10_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="event-box box-color5">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('may_image_10') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('may_home_10_category_name')) echo get_option('may_home_10_category_name'); ?></div>
							<h2><?php if (get_option('may_home_10_title')) echo get_option('may_home_10_title'); ?> </h2>
							<p><?php if (get_option('may_home_10_description')) echo get_option('may_home_10_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('may_home_11_link')) echo get_option('may_home_11_link'); ?>" title="<?php if (get_option('may_home_11_title')) echo get_option('may_home_11_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="event-box">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('may_image_11') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('may_home_11_category_name')) echo get_option('may_home_11_category_name'); ?></div>
							<h2><?php if (get_option('may_home_11_title')) echo get_option('may_home_11_title'); ?> </h2>
							<p><?php if (get_option('may_home_11_description')) echo get_option('may_home_11_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
</div><!--row-->
	<!----------------------------------------5---------------------------------------------->
	<?php
}
elseif ($d["month"] == 6) 
{
	?>
	<!----------------------------------------6---------------------------------------------->
	<div class="grid">
			<div class="grid-sizer"></div>
				<div class="grid-item-width1 item">
					<div class="current-event"><a href="#"><?php if (get_option('june_calender_title')) echo strtoupper(get_option('june_calender_title')); ?><br> <?php if (get_option('june_calender_description')) echo get_option('june_calender_description'); ?></a></div>
				</div>
				
				<a href="<?php if (get_option('june_home_1_link')) echo get_option('june_home_1_link'); ?>" title="<?php if (get_option('june_home_1_title')) echo get_option('june_home_1_title'); ?>">
				<div class="grid-item-width2 item">
					<div class="top-topic-container">
						<div class="top-topic-image">
							<img src="<?php echo wp_get_attachment_url( get_option('june_image_1') ); ?>">
						</div><!--top-topic-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('june_home_1_category_name')) echo get_option('june_home_1_category_name'); ?></div>
							<h2><?php if (get_option('june_home_1_title')) echo get_option('june_home_1_title'); ?> </h2>
							<p><?php if (get_option('june_home_1_description')) echo get_option('june_home_1_description'); ?></p>
							
						</div><!--event-detail-->
					</div><!--top-topic-container-->
				</div>
				</a>
				
				<div class="grid-item-width1 item">
					<div class="fav-event"><a href="#"><?php if (get_option('june_favorites_title')) echo strtoupper(get_option('june_favorites_title')); ?><br> <?php if (get_option('june_favorites_description')) echo get_option('june_favorites_description'); ?></a></div>
				</div>
				
				<a href="<?php if (get_option('june_home_2_link')) echo get_option('june_home_2_link'); ?>" title="<?php if (get_option('june_home_2_title')) echo get_option('june_home_2_title'); ?>">
					<div class="grid-item-width1 item">
					<div class="event-box">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('june_image_2') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('june_home_2_category_name')) echo get_option('june_home_2_category_name'); ?></div>
							<h2><?php if (get_option('june_home_2_title')) echo get_option('june_home_2_title'); ?> </h2>
							<p><?php if (get_option('june_home_2_description')) echo get_option('june_home_2_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
					</div>
				</a>
				
				<a href="<?php if (get_option('june_home_3_link')) echo get_option('june_home_3_link'); ?>" title="<?php if (get_option('june_home_3_title')) echo get_option('june_home_3_title'); ?>">	
					<div class="grid-item-width1 item">
					<div class="event-box box-color2">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('june_image_3') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('june_home_3_category_name')) echo get_option('june_home_3_category_name'); ?></div>
							<h2><?php if (get_option('june_home_3_title')) echo get_option('june_home_3_title'); ?> </h2>
							<p><?php if (get_option('june_home_3_description')) echo get_option('june_home_3_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('june_home_4_link')) echo get_option('june_home_4_link'); ?>" title="<?php if (get_option('june_home_4_title')) echo get_option('june_home_4_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="event-box box-color3">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('june_image_4') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('june_home_4_category_name')) echo get_option('june_home_4_category_name'); ?></div>
							<h2><?php if (get_option('june_home_4_title')) echo get_option('june_home_4_title'); ?> </h2>
							<p><?php if (get_option('june_home_4_description')) echo get_option('june_home_4_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				
				<a href="<?php if (get_option('june_home_5_link')) echo get_option('june_home_5_link'); ?>" title="<?php if (get_option('june_home_5_title')) echo get_option('june_home_5_title'); ?>">	
					<div class="grid-item-width1 item">
					<div class="event-box box-color1">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('june_image_5') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('june_home_5_category_name')) echo get_option('june_home_5_category_name'); ?></div>
							<h2><?php if (get_option('june_home_5_title')) echo get_option('june_home_5_title'); ?> </h2>
							<p><?php if (get_option('june_home_5_description')) echo get_option('june_home_5_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('june_home_6_link')) echo get_option('june_home_6_link'); ?>" title="<?php if (get_option('june_home_6_title')) echo get_option('june_home_6_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="event-box box-color6">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('june_image_6') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('june_home_6_category_name')) echo get_option('june_home_6_category_name'); ?></div>
							<h2><?php if (get_option('june_home_6_title')) echo get_option('june_home_6_title'); ?> </h2>
							<p><?php if (get_option('june_home_6_description')) echo get_option('june_home_6_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('june_home_7_link')) echo get_option('june_home_7_link'); ?>" title="<?php if (get_option('june_home_7_title')) echo get_option('june_home_7_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="new-event">
						<a href="<?php if (get_option('june_home_7_link')) echo get_option('june_home_7_link'); ?>"><?php if (get_option('june_home_7_title')) echo get_option('june_home_7_title'); ?></a>
					</div>
				</div>
				</a>
				
				
				<a href="<?php if (get_option('june_home_8_link')) echo get_option('june_home_8_link'); ?>" title="<?php if (get_option('june_home_8_title')) echo get_option('june_home_8_title'); ?>">
				<div class="grid-item-width2 item">
					<div class="event-box box-color4">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('june_image_8') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('june_home_8_category_name')) echo get_option('june_home_8_category_name'); ?></div>
							<h2><?php if (get_option('june_home_8_title')) echo get_option('june_home_8_title'); ?> </h2>
							<p><?php if (get_option('june_home_8_description')) echo get_option('june_home_8_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('june_home_9_link')) echo get_option('june_home_9_link'); ?>" title="<?php if (get_option('june_home_9_title')) echo get_option('june_home_9_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="event-box box-color2">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('june_image_9') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('june_home_9_category_name')) echo get_option('june_home_9_category_name'); ?></div>
							<h2><?php if (get_option('june_home_9_title')) echo get_option('june_home_9_title'); ?> </h2>
							<p><?php if (get_option('june_home_9_description')) echo get_option('june_home_9_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('june_home_10_link')) echo get_option('june_home_10_link'); ?>" title="<?php if (get_option('june_home_10_title')) echo get_option('june_home_10_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="event-box box-color5">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('june_image_10') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('june_home_10_category_name')) echo get_option('june_home_10_category_name'); ?></div>
							<h2><?php if (get_option('june_home_10_title')) echo get_option('june_home_10_title'); ?> </h2>
							<p><?php if (get_option('june_home_10_description')) echo get_option('june_home_10_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('june_home_11_link')) echo get_option('june_home_11_link'); ?>" title="<?php if (get_option('june_home_11_title')) echo get_option('june_home_11_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="event-box">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('june_image_11') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('june_home_11_category_name')) echo get_option('june_home_11_category_name'); ?></div>
							<h2><?php if (get_option('june_home_11_title')) echo get_option('june_home_11_title'); ?> </h2>
							<p><?php if (get_option('june_home_11_description')) echo get_option('june_home_11_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
</div><!--row-->
	<!----------------------------------------6---------------------------------------------->
	<?php
}
elseif ($d["month"] == 7) 
{
	?>
	<!----------------------------------------7---------------------------------------------->
	<div class="grid">
			<div class="grid-sizer"></div>
				<div class="grid-item-width1 item">
					<div class="current-event"><a href="#"><?php if (get_option('july_calender_title')) echo strtoupper(get_option('july_calender_title')); ?><br> <?php if (get_option('july_calender_description')) echo get_option('july_calender_description'); ?></a></div>
				</div>
				
				<a href="<?php if (get_option('july_home_1_link')) echo get_option('july_home_1_link'); ?>" title="<?php if (get_option('july_home_1_title')) echo get_option('july_home_1_title'); ?>">
				<div class="grid-item-width2 item">
					<div class="top-topic-container">
						<div class="top-topic-image">
							<img src="<?php echo wp_get_attachment_url( get_option('july_image_1') ); ?>">
						</div><!--top-topic-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('july_home_1_category_name')) echo get_option('july_home_1_category_name'); ?></div>
							<h2><?php if (get_option('july_home_1_title')) echo get_option('july_home_1_title'); ?> </h2>
							<p><?php if (get_option('july_home_1_description')) echo get_option('july_home_1_description'); ?></p>
							
						</div><!--event-detail-->
					</div><!--top-topic-container-->
				</div>
				</a>
				
				<div class="grid-item-width1 item">
					<div class="fav-event"><a href="#"><?php if (get_option('july_favorites_title')) echo strtoupper(get_option('july_favorites_title')); ?><br> <?php if (get_option('july_favorites_description')) echo get_option('july_favorites_description'); ?></a></div>
				</div>
				
				<a href="<?php if (get_option('july_home_2_link')) echo get_option('july_home_2_link'); ?>" title="<?php if (get_option('july_home_2_title')) echo get_option('july_home_2_title'); ?>">
					<div class="grid-item-width1 item">
					<div class="event-box">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('july_image_2') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('july_home_2_category_name')) echo get_option('july_home_2_category_name'); ?></div>
							<h2><?php if (get_option('july_home_2_title')) echo get_option('july_home_2_title'); ?> </h2>
							<p><?php if (get_option('july_home_2_description')) echo get_option('july_home_2_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
					</div>
				</a>
				
				<a href="<?php if (get_option('july_home_3_link')) echo get_option('july_home_3_link'); ?>" title="<?php if (get_option('july_home_3_title')) echo get_option('july_home_3_title'); ?>">	
					<div class="grid-item-width1 item">
					<div class="event-box box-color2">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('july_image_3') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('july_home_3_category_name')) echo get_option('july_home_3_category_name'); ?></div>
							<h2><?php if (get_option('july_home_3_title')) echo get_option('july_home_3_title'); ?> </h2>
							<p><?php if (get_option('july_home_3_description')) echo get_option('july_home_3_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('july_home_4_link')) echo get_option('july_home_4_link'); ?>" title="<?php if (get_option('july_home_4_title')) echo get_option('july_home_4_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="event-box box-color3">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('july_image_4') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('july_home_4_category_name')) echo get_option('july_home_4_category_name'); ?></div>
							<h2><?php if (get_option('july_home_4_title')) echo get_option('july_home_4_title'); ?> </h2>
							<p><?php if (get_option('july_home_4_description')) echo get_option('july_home_4_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				
				<a href="<?php if (get_option('july_home_5_link')) echo get_option('july_home_5_link'); ?>" title="<?php if (get_option('july_home_5_title')) echo get_option('july_home_5_title'); ?>">	
					<div class="grid-item-width1 item">
					<div class="event-box box-color1">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('july_image_5') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('july_home_5_category_name')) echo get_option('july_home_5_category_name'); ?></div>
							<h2><?php if (get_option('july_home_5_title')) echo get_option('july_home_5_title'); ?> </h2>
							<p><?php if (get_option('july_home_5_description')) echo get_option('july_home_5_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('july_home_6_link')) echo get_option('july_home_6_link'); ?>" title="<?php if (get_option('july_home_6_title')) echo get_option('july_home_6_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="event-box box-color6">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('july_image_6') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('july_home_6_category_name')) echo get_option('july_home_6_category_name'); ?></div>
							<h2><?php if (get_option('july_home_6_title')) echo get_option('july_home_6_title'); ?> </h2>
							<p><?php if (get_option('july_home_6_description')) echo get_option('july_home_6_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('july_home_7_link')) echo get_option('july_home_7_link'); ?>" title="<?php if (get_option('july_home_7_title')) echo get_option('july_home_7_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="new-event">
						<a href="<?php if (get_option('july_home_7_link')) echo get_option('july_home_7_link'); ?>"><?php if (get_option('july_home_7_title')) echo get_option('july_home_7_title'); ?></a>
					</div>
				</div>
				</a>
				
				
				<a href="<?php if (get_option('july_home_8_link')) echo get_option('july_home_8_link'); ?>" title="<?php if (get_option('july_home_8_title')) echo get_option('july_home_8_title'); ?>">
				<div class="grid-item-width2 item">
					<div class="event-box box-color4">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('july_image_8') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('july_home_8_category_name')) echo get_option('july_home_8_category_name'); ?></div>
							<h2><?php if (get_option('july_home_8_title')) echo get_option('july_home_8_title'); ?> </h2>
							<p><?php if (get_option('july_home_8_description')) echo get_option('july_home_8_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('july_home_9_link')) echo get_option('july_home_9_link'); ?>" title="<?php if (get_option('july_home_9_title')) echo get_option('july_home_9_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="event-box box-color2">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('july_image_9') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('july_home_9_category_name')) echo get_option('july_home_9_category_name'); ?></div>
							<h2><?php if (get_option('july_home_9_title')) echo get_option('july_home_9_title'); ?> </h2>
							<p><?php if (get_option('july_home_9_description')) echo get_option('july_home_9_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('july_home_10_link')) echo get_option('july_home_10_link'); ?>" title="<?php if (get_option('july_home_10_title')) echo get_option('july_home_10_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="event-box box-color5">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('july_image_10') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('july_home_10_category_name')) echo get_option('july_home_10_category_name'); ?></div>
							<h2><?php if (get_option('july_home_10_title')) echo get_option('july_home_10_title'); ?> </h2>
							<p><?php if (get_option('july_home_10_description')) echo get_option('july_home_10_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('july_home_11_link')) echo get_option('july_home_11_link'); ?>" title="<?php if (get_option('july_home_11_title')) echo get_option('july_home_11_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="event-box">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('july_image_11') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('july_home_11_category_name')) echo get_option('july_home_11_category_name'); ?></div>
							<h2><?php if (get_option('july_home_11_title')) echo get_option('july_home_11_title'); ?> </h2>
							<p><?php if (get_option('july_home_11_description')) echo get_option('july_home_11_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
</div><!--row-->
	<!----------------------------------------7---------------------------------------------->
	<?php
}
elseif ($d["month"] == 8) 
{
	?>
	<!----------------------------------------8---------------------------------------------->
	<div class="grid">
			<div class="grid-sizer"></div>
				<div class="grid-item-width1 item">
					<div class="current-event"><a href="#"><?php if (get_option('august_calender_title')) echo strtoupper(get_option('august_calender_title')); ?><br> <?php if (get_option('august_calender_description')) echo get_option('august_calender_description'); ?></a></div>
				</div>
				
				<a href="<?php if (get_option('august_home_1_link')) echo get_option('august_home_1_link'); ?>" title="<?php if (get_option('august_home_1_title')) echo get_option('august_home_1_title'); ?>">
				<div class="grid-item-width2 item">
					<div class="top-topic-container">
						<div class="top-topic-image">
							<img src="<?php echo wp_get_attachment_url( get_option('august_image_1') ); ?>">
						</div><!--top-topic-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('august_home_1_category_name')) echo get_option('august_home_1_category_name'); ?></div>
							<h2><?php if (get_option('august_home_1_title')) echo get_option('august_home_1_title'); ?> </h2>
							<p><?php if (get_option('august_home_1_description')) echo get_option('august_home_1_description'); ?></p>
							
						</div><!--event-detail-->
					</div><!--top-topic-container-->
				</div>
				</a>
				
				<div class="grid-item-width1 item">
					<div class="fav-event"><a href="#"><?php if (get_option('august_favorites_title')) echo strtoupper(get_option('august_favorites_title')); ?><br> <?php if (get_option('august_favorites_description')) echo get_option('august_favorites_description'); ?></a></div>
				</div>
				
				<a href="<?php if (get_option('august_home_2_link')) echo get_option('august_home_2_link'); ?>" title="<?php if (get_option('august_home_2_title')) echo get_option('august_home_2_title'); ?>">
					<div class="grid-item-width1 item">
					<div class="event-box">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('august_image_2') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('august_home_2_category_name')) echo get_option('august_home_2_category_name'); ?></div>
							<h2><?php if (get_option('august_home_2_title')) echo get_option('august_home_2_title'); ?> </h2>
							<p><?php if (get_option('august_home_2_description')) echo get_option('august_home_2_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
					</div>
				</a>
				
				<a href="<?php if (get_option('august_home_3_link')) echo get_option('august_home_3_link'); ?>" title="<?php if (get_option('august_home_3_title')) echo get_option('august_home_3_title'); ?>">	
					<div class="grid-item-width1 item">
					<div class="event-box box-color2">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('august_image_3') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('august_home_3_category_name')) echo get_option('august_home_3_category_name'); ?></div>
							<h2><?php if (get_option('august_home_3_title')) echo get_option('august_home_3_title'); ?> </h2>
							<p><?php if (get_option('august_home_3_description')) echo get_option('august_home_3_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('august_home_4_link')) echo get_option('august_home_4_link'); ?>" title="<?php if (get_option('august_home_4_title')) echo get_option('august_home_4_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="event-box box-color3">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('august_image_4') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('august_home_4_category_name')) echo get_option('august_home_4_category_name'); ?></div>
							<h2><?php if (get_option('august_home_4_title')) echo get_option('august_home_4_title'); ?> </h2>
							<p><?php if (get_option('august_home_4_description')) echo get_option('august_home_4_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				
				<a href="<?php if (get_option('august_home_5_link')) echo get_option('august_home_5_link'); ?>" title="<?php if (get_option('august_home_5_title')) echo get_option('august_home_5_title'); ?>">	
					<div class="grid-item-width1 item">
					<div class="event-box box-color1">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('august_image_5') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('august_home_5_category_name')) echo get_option('august_home_5_category_name'); ?></div>
							<h2><?php if (get_option('august_home_5_title')) echo get_option('august_home_5_title'); ?> </h2>
							<p><?php if (get_option('august_home_5_description')) echo get_option('august_home_5_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('august_home_6_link')) echo get_option('august_home_6_link'); ?>" title="<?php if (get_option('august_home_6_title')) echo get_option('august_home_6_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="event-box box-color6">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('august_image_6') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('august_home_6_category_name')) echo get_option('august_home_6_category_name'); ?></div>
							<h2><?php if (get_option('august_home_6_title')) echo get_option('august_home_6_title'); ?> </h2>
							<p><?php if (get_option('august_home_6_description')) echo get_option('august_home_6_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('august_home_7_link')) echo get_option('august_home_7_link'); ?>" title="<?php if (get_option('august_home_7_title')) echo get_option('august_home_7_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="new-event">
						<a href="<?php if (get_option('august_home_7_link')) echo get_option('august_home_7_link'); ?>"><?php if (get_option('august_home_7_title')) echo get_option('august_home_7_title'); ?></a>
					</div>
				</div>
				</a>
				
				
				<a href="<?php if (get_option('august_home_8_link')) echo get_option('august_home_8_link'); ?>" title="<?php if (get_option('august_home_8_title')) echo get_option('august_home_8_title'); ?>">
				<div class="grid-item-width2 item">
					<div class="event-box box-color4">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('august_image_8') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('august_home_8_category_name')) echo get_option('august_home_8_category_name'); ?></div>
							<h2><?php if (get_option('august_home_8_title')) echo get_option('august_home_8_title'); ?> </h2>
							<p><?php if (get_option('august_home_8_description')) echo get_option('august_home_8_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('august_home_9_link')) echo get_option('august_home_9_link'); ?>" title="<?php if (get_option('august_home_9_title')) echo get_option('august_home_9_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="event-box box-color2">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('august_image_9') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('august_home_9_category_name')) echo get_option('august_home_9_category_name'); ?></div>
							<h2><?php if (get_option('august_home_9_title')) echo get_option('august_home_9_title'); ?> </h2>
							<p><?php if (get_option('august_home_9_description')) echo get_option('august_home_9_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('august_home_10_link')) echo get_option('august_home_10_link'); ?>" title="<?php if (get_option('august_home_10_title')) echo get_option('august_home_10_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="event-box box-color5">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('august_image_10') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('august_home_10_category_name')) echo get_option('august_home_10_category_name'); ?></div>
							<h2><?php if (get_option('august_home_10_title')) echo get_option('august_home_10_title'); ?> </h2>
							<p><?php if (get_option('august_home_10_description')) echo get_option('august_home_10_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('august_home_11_link')) echo get_option('august_home_11_link'); ?>" title="<?php if (get_option('august_home_11_title')) echo get_option('august_home_11_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="event-box">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('august_image_11') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('august_home_11_category_name')) echo get_option('august_home_11_category_name'); ?></div>
							<h2><?php if (get_option('august_home_11_title')) echo get_option('august_home_11_title'); ?> </h2>
							<p><?php if (get_option('august_home_11_description')) echo get_option('august_home_11_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
</div><!--row-->
	<!----------------------------------------8---------------------------------------------->
	<?php
}
elseif ($d["month"] == 9) 
{
	?>
	<!----------------------------------------9---------------------------------------------->
	<div class="grid">
			<div class="grid-sizer"></div>
				<div class="grid-item-width1 item">
					<div class="current-event"><a href="#"><?php if (get_option('september_calender_title')) echo strtoupper(get_option('september_calender_title')); ?><br> <?php if (get_option('september_calender_description')) echo get_option('september_calender_description'); ?></a></div>
				</div>
				
				<a href="<?php if (get_option('september_home_1_link')) echo get_option('september_home_1_link'); ?>" title="<?php if (get_option('september_home_1_title')) echo get_option('september_home_1_title'); ?>">
				<div class="grid-item-width2 item">
					<div class="top-topic-container">
						<div class="top-topic-image">
							<img src="<?php echo wp_get_attachment_url( get_option('september_image_1') ); ?>">
						</div><!--top-topic-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('september_home_1_category_name')) echo get_option('september_home_1_category_name'); ?></div>
							<h2><?php if (get_option('september_home_1_title')) echo get_option('september_home_1_title'); ?> </h2>
							<p><?php if (get_option('september_home_1_description')) echo get_option('september_home_1_description'); ?></p>
							
						</div><!--event-detail-->
					</div><!--top-topic-container-->
				</div>
				</a>
				
				<div class="grid-item-width1 item">
					<div class="fav-event"><a href="#"><?php if (get_option('september_favorites_title')) echo strtoupper(get_option('september_favorites_title')); ?><br> <?php if (get_option('september_favorites_description')) echo get_option('september_favorites_description'); ?></a></div>
				</div>
				
				<a href="<?php if (get_option('september_home_2_link')) echo get_option('september_home_2_link'); ?>" title="<?php if (get_option('september_home_2_title')) echo get_option('september_home_2_title'); ?>">
					<div class="grid-item-width1 item">
					<div class="event-box">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('september_image_2') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('september_home_2_category_name')) echo get_option('september_home_2_category_name'); ?></div>
							<h2><?php if (get_option('september_home_2_title')) echo get_option('september_home_2_title'); ?> </h2>
							<p><?php if (get_option('september_home_2_description')) echo get_option('september_home_2_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
					</div>
				</a>
				
				<a href="<?php if (get_option('september_home_3_link')) echo get_option('september_home_3_link'); ?>" title="<?php if (get_option('september_home_3_title')) echo get_option('september_home_3_title'); ?>">	
					<div class="grid-item-width1 item">
					<div class="event-box box-color2">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('september_image_3') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('september_home_3_category_name')) echo get_option('september_home_3_category_name'); ?></div>
							<h2><?php if (get_option('september_home_3_title')) echo get_option('september_home_3_title'); ?> </h2>
							<p><?php if (get_option('september_home_3_description')) echo get_option('september_home_3_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('september_home_4_link')) echo get_option('september_home_4_link'); ?>" title="<?php if (get_option('september_home_4_title')) echo get_option('september_home_4_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="event-box box-color3">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('september_image_4') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('september_home_4_category_name')) echo get_option('september_home_4_category_name'); ?></div>
							<h2><?php if (get_option('september_home_4_title')) echo get_option('september_home_4_title'); ?> </h2>
							<p><?php if (get_option('september_home_4_description')) echo get_option('september_home_4_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				
				<a href="<?php if (get_option('september_home_5_link')) echo get_option('september_home_5_link'); ?>" title="<?php if (get_option('september_home_5_title')) echo get_option('september_home_5_title'); ?>">	
					<div class="grid-item-width1 item">
					<div class="event-box box-color1">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('september_image_5') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('september_home_5_category_name')) echo get_option('september_home_5_category_name'); ?></div>
							<h2><?php if (get_option('september_home_5_title')) echo get_option('september_home_5_title'); ?> </h2>
							<p><?php if (get_option('september_home_5_description')) echo get_option('september_home_5_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('september_home_6_link')) echo get_option('september_home_6_link'); ?>" title="<?php if (get_option('september_home_6_title')) echo get_option('september_home_6_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="event-box box-color6">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('september_image_6') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('september_home_6_category_name')) echo get_option('september_home_6_category_name'); ?></div>
							<h2><?php if (get_option('september_home_6_title')) echo get_option('september_home_6_title'); ?> </h2>
							<p><?php if (get_option('september_home_6_description')) echo get_option('september_home_6_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('september_home_7_link')) echo get_option('september_home_7_link'); ?>" title="<?php if (get_option('september_home_7_title')) echo get_option('september_home_7_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="new-event">
						<a href="<?php if (get_option('september_home_7_link')) echo get_option('september_home_7_link'); ?>"><?php if (get_option('september_home_7_title')) echo get_option('september_home_7_title'); ?></a>
					</div>
				</div>
				</a>
				
				
				<a href="<?php if (get_option('september_home_8_link')) echo get_option('september_home_8_link'); ?>" title="<?php if (get_option('september_home_8_title')) echo get_option('september_home_8_title'); ?>">
				<div class="grid-item-width2 item">
					<div class="event-box box-color4">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('september_image_8') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('september_home_8_category_name')) echo get_option('september_home_8_category_name'); ?></div>
							<h2><?php if (get_option('september_home_8_title')) echo get_option('september_home_8_title'); ?> </h2>
							<p><?php if (get_option('september_home_8_description')) echo get_option('september_home_8_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('september_home_9_link')) echo get_option('september_home_9_link'); ?>" title="<?php if (get_option('september_home_9_title')) echo get_option('september_home_9_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="event-box box-color2">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('september_image_9') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('september_home_9_category_name')) echo get_option('september_home_9_category_name'); ?></div>
							<h2><?php if (get_option('september_home_9_title')) echo get_option('september_home_9_title'); ?> </h2>
							<p><?php if (get_option('september_home_9_description')) echo get_option('september_home_9_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('september_home_10_link')) echo get_option('september_home_10_link'); ?>" title="<?php if (get_option('september_home_10_title')) echo get_option('september_home_10_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="event-box box-color5">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('september_image_10') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('september_home_10_category_name')) echo get_option('september_home_10_category_name'); ?></div>
							<h2><?php if (get_option('september_home_10_title')) echo get_option('september_home_10_title'); ?> </h2>
							<p><?php if (get_option('september_home_10_description')) echo get_option('september_home_10_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('september_home_11_link')) echo get_option('september_home_11_link'); ?>" title="<?php if (get_option('september_home_11_title')) echo get_option('september_home_11_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="event-box">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('september_image_11') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('september_home_11_category_name')) echo get_option('september_home_11_category_name'); ?></div>
							<h2><?php if (get_option('september_home_11_title')) echo get_option('september_home_11_title'); ?> </h2>
							<p><?php if (get_option('september_home_11_description')) echo get_option('september_home_11_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
</div><!--row-->
	<!----------------------------------------9---------------------------------------------->
	<?php
}
elseif ($d["month"] == 10) 
{
	?>
	<!----------------------------------------10---------------------------------------------->
	<div class="grid">
			<div class="grid-sizer"></div>
				<div class="grid-item-width1 item">
					<div class="current-event"><a href="#"><?php if (get_option('october_calender_title')) echo strtoupper(get_option('october_calender_title')); ?><br> <?php if (get_option('october_calender_description')) echo get_option('october_calender_description'); ?></a></div>
				</div>
				
				<a href="<?php if (get_option('october_home_1_link')) echo get_option('october_home_1_link'); ?>" title="<?php if (get_option('october_home_1_title')) echo get_option('october_home_1_title'); ?>">
				<div class="grid-item-width2 item">
					<div class="top-topic-container">
						<div class="top-topic-image">
							<img src="<?php echo wp_get_attachment_url( get_option('october_image_1') ); ?>">
						</div><!--top-topic-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('october_home_1_category_name')) echo get_option('october_home_1_category_name'); ?></div>
							<h2><?php if (get_option('october_home_1_title')) echo get_option('october_home_1_title'); ?> </h2>
							<p><?php if (get_option('october_home_1_description')) echo get_option('october_home_1_description'); ?></p>
							
						</div><!--event-detail-->
					</div><!--top-topic-container-->
				</div>
				</a>
				
				<div class="grid-item-width1 item">
					<div class="fav-event"><a href="#"><?php if (get_option('october_favorites_title')) echo strtoupper(get_option('october_favorites_title')); ?><br> <?php if (get_option('october_favorites_description')) echo get_option('october_favorites_description'); ?></a></div>
				</div>
				
				<a href="<?php if (get_option('october_home_2_link')) echo get_option('october_home_2_link'); ?>" title="<?php if (get_option('october_home_2_title')) echo get_option('october_home_2_title'); ?>">
					<div class="grid-item-width1 item">
					<div class="event-box">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('october_image_2') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('october_home_2_category_name')) echo get_option('october_home_2_category_name'); ?></div>
							<h2><?php if (get_option('october_home_2_title')) echo get_option('october_home_2_title'); ?> </h2>
							<p><?php if (get_option('october_home_2_description')) echo get_option('october_home_2_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
					</div>
				</a>
				
				<a href="<?php if (get_option('october_home_3_link')) echo get_option('october_home_3_link'); ?>" title="<?php if (get_option('october_home_3_title')) echo get_option('october_home_3_title'); ?>">	
					<div class="grid-item-width1 item">
					<div class="event-box box-color2">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('october_image_3') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('october_home_3_category_name')) echo get_option('october_home_3_category_name'); ?></div>
							<h2><?php if (get_option('october_home_3_title')) echo get_option('october_home_3_title'); ?> </h2>
							<p><?php if (get_option('october_home_3_description')) echo get_option('october_home_3_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('october_home_4_link')) echo get_option('october_home_4_link'); ?>" title="<?php if (get_option('october_home_4_title')) echo get_option('october_home_4_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="event-box box-color3">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('october_image_4') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('october_home_4_category_name')) echo get_option('october_home_4_category_name'); ?></div>
							<h2><?php if (get_option('october_home_4_title')) echo get_option('october_home_4_title'); ?> </h2>
							<p><?php if (get_option('october_home_4_description')) echo get_option('october_home_4_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				
				<a href="<?php if (get_option('october_home_5_link')) echo get_option('october_home_5_link'); ?>" title="<?php if (get_option('october_home_5_title')) echo get_option('october_home_5_title'); ?>">	
					<div class="grid-item-width1 item">
					<div class="event-box box-color1">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('october_image_5') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('october_home_5_category_name')) echo get_option('october_home_5_category_name'); ?></div>
							<h2><?php if (get_option('october_home_5_title')) echo get_option('october_home_5_title'); ?> </h2>
							<p><?php if (get_option('october_home_5_description')) echo get_option('october_home_5_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('october_home_6_link')) echo get_option('october_home_6_link'); ?>" title="<?php if (get_option('october_home_6_title')) echo get_option('october_home_6_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="event-box box-color6">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('october_image_6') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('october_home_6_category_name')) echo get_option('october_home_6_category_name'); ?></div>
							<h2><?php if (get_option('october_home_6_title')) echo get_option('october_home_6_title'); ?> </h2>
							<p><?php if (get_option('october_home_6_description')) echo get_option('october_home_6_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('october_home_7_link')) echo get_option('october_home_7_link'); ?>" title="<?php if (get_option('october_home_7_title')) echo get_option('october_home_7_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="new-event">
						<a href="<?php if (get_option('october_home_7_link')) echo get_option('october_home_7_link'); ?>"><?php if (get_option('october_home_7_title')) echo get_option('october_home_7_title'); ?></a>
					</div>
				</div>
				</a>
				
				
				<a href="<?php if (get_option('october_home_8_link')) echo get_option('october_home_8_link'); ?>" title="<?php if (get_option('october_home_8_title')) echo get_option('october_home_8_title'); ?>">
				<div class="grid-item-width2 item">
					<div class="event-box box-color4">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('october_image_8') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('october_home_8_category_name')) echo get_option('october_home_8_category_name'); ?></div>
							<h2><?php if (get_option('october_home_8_title')) echo get_option('october_home_8_title'); ?> </h2>
							<p><?php if (get_option('october_home_8_description')) echo get_option('october_home_8_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('october_home_9_link')) echo get_option('october_home_9_link'); ?>" title="<?php if (get_option('october_home_9_title')) echo get_option('october_home_9_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="event-box box-color2">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('october_image_9') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('october_home_9_category_name')) echo get_option('october_home_9_category_name'); ?></div>
							<h2><?php if (get_option('october_home_9_title')) echo get_option('october_home_9_title'); ?> </h2>
							<p><?php if (get_option('october_home_9_description')) echo get_option('october_home_9_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('october_home_10_link')) echo get_option('october_home_10_link'); ?>" title="<?php if (get_option('october_home_10_title')) echo get_option('october_home_10_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="event-box box-color5">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('october_image_10') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('october_home_10_category_name')) echo get_option('october_home_10_category_name'); ?></div>
							<h2><?php if (get_option('october_home_10_title')) echo get_option('october_home_10_title'); ?> </h2>
							<p><?php if (get_option('october_home_10_description')) echo get_option('october_home_10_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('october_home_11_link')) echo get_option('october_home_11_link'); ?>" title="<?php if (get_option('october_home_11_title')) echo get_option('october_home_11_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="event-box">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('october_image_11') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('october_home_11_category_name')) echo get_option('october_home_11_category_name'); ?></div>
							<h2><?php if (get_option('october_home_11_title')) echo get_option('october_home_11_title'); ?> </h2>
							<p><?php if (get_option('october_home_11_description')) echo get_option('october_home_11_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
</div><!--row-->
	<!----------------------------------------10---------------------------------------------->
	<?php
}
elseif ($d["month"] == 11) 
{
	?>
	<!----------------------------------------11---------------------------------------------->
	<div class="grid">
			<div class="grid-sizer"></div>
				<div class="grid-item-width1 item">
					<div class="current-event"><a href="#"><?php if (get_option('november_calender_title')) echo strtoupper(get_option('november_calender_title')); ?><br> <?php if (get_option('november_calender_description')) echo get_option('november_calender_description'); ?></a></div>
				</div>
				
				<a href="<?php if (get_option('november_home_1_link')) echo get_option('november_home_1_link'); ?>" title="<?php if (get_option('november_home_1_title')) echo get_option('november_home_1_title'); ?>">
				<div class="grid-item-width2 item">
					<div class="top-topic-container">
						<div class="top-topic-image">
							<img src="<?php echo wp_get_attachment_url( get_option('november_image_1') ); ?>">
						</div><!--top-topic-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('november_home_1_category_name')) echo get_option('november_home_1_category_name'); ?></div>
							<h2><?php if (get_option('november_home_1_title')) echo get_option('november_home_1_title'); ?> </h2>
							<p><?php if (get_option('november_home_1_description')) echo get_option('november_home_1_description'); ?></p>
							
						</div><!--event-detail-->
					</div><!--top-topic-container-->
				</div>
				</a>
				
				<div class="grid-item-width1 item">
					<div class="fav-event"><a href="#"><?php if (get_option('november_favorites_title')) echo strtoupper(get_option('november_favorites_title')); ?><br> <?php if (get_option('november_favorites_description')) echo get_option('november_favorites_description'); ?></a></div>
				</div>
				
				<a href="<?php if (get_option('november_home_2_link')) echo get_option('november_home_2_link'); ?>" title="<?php if (get_option('november_home_2_title')) echo get_option('november_home_2_title'); ?>">
					<div class="grid-item-width1 item">
					<div class="event-box">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('november_image_2') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('november_home_2_category_name')) echo get_option('november_home_2_category_name'); ?></div>
							<h2><?php if (get_option('november_home_2_title')) echo get_option('november_home_2_title'); ?> </h2>
							<p><?php if (get_option('november_home_2_description')) echo get_option('november_home_2_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
					</div>
				</a>
				
				<a href="<?php if (get_option('november_home_3_link')) echo get_option('november_home_3_link'); ?>" title="<?php if (get_option('november_home_3_title')) echo get_option('november_home_3_title'); ?>">	
					<div class="grid-item-width1 item">
					<div class="event-box box-color2">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('november_image_3') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('november_home_3_category_name')) echo get_option('november_home_3_category_name'); ?></div>
							<h2><?php if (get_option('november_home_3_title')) echo get_option('november_home_3_title'); ?> </h2>
							<p><?php if (get_option('november_home_3_description')) echo get_option('november_home_3_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('november_home_4_link')) echo get_option('november_home_4_link'); ?>" title="<?php if (get_option('november_home_4_title')) echo get_option('november_home_4_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="event-box box-color3">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('november_image_4') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('november_home_4_category_name')) echo get_option('november_home_4_category_name'); ?></div>
							<h2><?php if (get_option('november_home_4_title')) echo get_option('november_home_4_title'); ?> </h2>
							<p><?php if (get_option('november_home_4_description')) echo get_option('november_home_4_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				
				<a href="<?php if (get_option('november_home_5_link')) echo get_option('november_home_5_link'); ?>" title="<?php if (get_option('november_home_5_title')) echo get_option('november_home_5_title'); ?>">	
					<div class="grid-item-width1 item">
					<div class="event-box box-color1">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('november_image_5') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('november_home_5_category_name')) echo get_option('november_home_5_category_name'); ?></div>
							<h2><?php if (get_option('november_home_5_title')) echo get_option('november_home_5_title'); ?> </h2>
							<p><?php if (get_option('november_home_5_description')) echo get_option('november_home_5_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('november_home_6_link')) echo get_option('november_home_6_link'); ?>" title="<?php if (get_option('november_home_6_title')) echo get_option('november_home_6_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="event-box box-color6">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('november_image_6') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('november_home_6_category_name')) echo get_option('november_home_6_category_name'); ?></div>
							<h2><?php if (get_option('november_home_6_title')) echo get_option('november_home_6_title'); ?> </h2>
							<p><?php if (get_option('november_home_6_description')) echo get_option('november_home_6_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('november_home_7_link')) echo get_option('november_home_7_link'); ?>" title="<?php if (get_option('november_home_7_title')) echo get_option('november_home_7_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="new-event">
						<a href="<?php if (get_option('november_home_7_link')) echo get_option('november_home_7_link'); ?>"><?php if (get_option('november_home_7_title')) echo get_option('november_home_7_title'); ?></a>
					</div>
				</div>
				</a>
				
				
				<a href="<?php if (get_option('november_home_8_link')) echo get_option('november_home_8_link'); ?>" title="<?php if (get_option('november_home_8_title')) echo get_option('november_home_8_title'); ?>">
				<div class="grid-item-width2 item">
					<div class="event-box box-color4">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('november_image_8') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('november_home_8_category_name')) echo get_option('november_home_8_category_name'); ?></div>
							<h2><?php if (get_option('november_home_8_title')) echo get_option('november_home_8_title'); ?> </h2>
							<p><?php if (get_option('november_home_8_description')) echo get_option('november_home_8_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('november_home_9_link')) echo get_option('november_home_9_link'); ?>" title="<?php if (get_option('november_home_9_title')) echo get_option('november_home_9_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="event-box box-color2">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('november_image_9') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('november_home_9_category_name')) echo get_option('november_home_9_category_name'); ?></div>
							<h2><?php if (get_option('november_home_9_title')) echo get_option('november_home_9_title'); ?> </h2>
							<p><?php if (get_option('november_home_9_description')) echo get_option('november_home_9_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('november_home_10_link')) echo get_option('november_home_10_link'); ?>" title="<?php if (get_option('november_home_10_title')) echo get_option('november_home_10_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="event-box box-color5">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('november_image_10') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('november_home_10_category_name')) echo get_option('november_home_10_category_name'); ?></div>
							<h2><?php if (get_option('november_home_10_title')) echo get_option('november_home_10_title'); ?> </h2>
							<p><?php if (get_option('november_home_10_description')) echo get_option('november_home_10_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('november_home_11_link')) echo get_option('november_home_11_link'); ?>" title="<?php if (get_option('november_home_11_title')) echo get_option('november_home_11_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="event-box">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('november_image_11') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('november_home_11_category_name')) echo get_option('november_home_11_category_name'); ?></div>
							<h2><?php if (get_option('november_home_11_title')) echo get_option('november_home_11_title'); ?> </h2>
							<p><?php if (get_option('november_home_11_description')) echo get_option('november_home_11_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
</div><!--row-->
	<!----------------------------------------11---------------------------------------------->
	<?php
}
elseif ($d["month"] == 12) 
{
	?>
	<!----------------------------------------12---------------------------------------------->
	<div class="grid">
			<div class="grid-sizer"></div>
				<div class="grid-item-width1 item">
					<div class="current-event"><a href="#"><?php if (get_option('december_calender_title')) echo strtoupper(get_option('december_calender_title')); ?><br> <?php if (get_option('december_calender_description')) echo get_option('december_calender_description'); ?></a></div>
				</div>
				
				<a href="<?php if (get_option('december_home_1_link')) echo get_option('december_home_1_link'); ?>" title="<?php if (get_option('december_home_1_title')) echo get_option('december_home_1_title'); ?>">
				<div class="grid-item-width2 item">
					<div class="top-topic-container">
						<div class="top-topic-image">
							<img src="<?php echo wp_get_attachment_url( get_option('december_image_1') ); ?>">
						</div><!--top-topic-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('december_home_1_category_name')) echo get_option('december_home_1_category_name'); ?></div>
							<h2><?php if (get_option('december_home_1_title')) echo get_option('december_home_1_title'); ?> </h2>
							<p><?php if (get_option('december_home_1_description')) echo get_option('december_home_1_description'); ?></p>
							
						</div><!--event-detail-->
					</div><!--top-topic-container-->
				</div>
				</a>
				
				<div class="grid-item-width1 item">
					<div class="fav-event"><a href="#"><?php if (get_option('december_favorites_title')) echo strtoupper(get_option('december_favorites_title')); ?><br> <?php if (get_option('december_favorites_description')) echo get_option('december_favorites_description'); ?></a></div>
				</div>
				
				<a href="<?php if (get_option('december_home_2_link')) echo get_option('december_home_2_link'); ?>" title="<?php if (get_option('december_home_2_title')) echo get_option('december_home_2_title'); ?>">
					<div class="grid-item-width1 item">
					<div class="event-box">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('december_image_2') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('december_home_2_category_name')) echo get_option('december_home_2_category_name'); ?></div>
							<h2><?php if (get_option('december_home_2_title')) echo get_option('december_home_2_title'); ?> </h2>
							<p><?php if (get_option('december_home_2_description')) echo get_option('december_home_2_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
					</div>
				</a>
				
				<a href="<?php if (get_option('december_home_3_link')) echo get_option('december_home_3_link'); ?>" title="<?php if (get_option('december_home_3_title')) echo get_option('december_home_3_title'); ?>">	
					<div class="grid-item-width1 item">
					<div class="event-box box-color2">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('december_image_3') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('december_home_3_category_name')) echo get_option('december_home_3_category_name'); ?></div>
							<h2><?php if (get_option('december_home_3_title')) echo get_option('december_home_3_title'); ?> </h2>
							<p><?php if (get_option('december_home_3_description')) echo get_option('december_home_3_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('december_home_4_link')) echo get_option('december_home_4_link'); ?>" title="<?php if (get_option('december_home_4_title')) echo get_option('december_home_4_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="event-box box-color3">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('december_image_4') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('december_home_4_category_name')) echo get_option('december_home_4_category_name'); ?></div>
							<h2><?php if (get_option('december_home_4_title')) echo get_option('december_home_4_title'); ?> </h2>
							<p><?php if (get_option('december_home_4_description')) echo get_option('december_home_4_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				
				<a href="<?php if (get_option('december_home_5_link')) echo get_option('december_home_5_link'); ?>" title="<?php if (get_option('december_home_5_title')) echo get_option('december_home_5_title'); ?>">	
					<div class="grid-item-width1 item">
					<div class="event-box box-color1">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('december_image_5') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('december_home_5_category_name')) echo get_option('december_home_5_category_name'); ?></div>
							<h2><?php if (get_option('december_home_5_title')) echo get_option('december_home_5_title'); ?> </h2>
							<p><?php if (get_option('december_home_5_description')) echo get_option('december_home_5_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('december_home_6_link')) echo get_option('december_home_6_link'); ?>" title="<?php if (get_option('december_home_6_title')) echo get_option('december_home_6_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="event-box box-color6">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('december_image_6') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('december_home_6_category_name')) echo get_option('december_home_6_category_name'); ?></div>
							<h2><?php if (get_option('december_home_6_title')) echo get_option('december_home_6_title'); ?> </h2>
							<p><?php if (get_option('december_home_6_description')) echo get_option('december_home_6_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('december_home_7_link')) echo get_option('december_home_7_link'); ?>" title="<?php if (get_option('december_home_7_title')) echo get_option('december_home_7_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="new-event">
						<a href="<?php if (get_option('december_home_7_link')) echo get_option('december_home_7_link'); ?>"><?php if (get_option('december_home_7_title')) echo get_option('december_home_7_title'); ?></a>
					</div>
				</div>
				</a>
				
				
				<a href="<?php if (get_option('december_home_8_link')) echo get_option('december_home_8_link'); ?>" title="<?php if (get_option('december_home_8_title')) echo get_option('december_home_8_title'); ?>">
				<div class="grid-item-width2 item">
					<div class="event-box box-color4">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('december_image_8') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('december_home_8_category_name')) echo get_option('december_home_8_category_name'); ?></div>
							<h2><?php if (get_option('december_home_8_title')) echo get_option('december_home_8_title'); ?> </h2>
							<p><?php if (get_option('december_home_8_description')) echo get_option('december_home_8_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('december_home_9_link')) echo get_option('december_home_9_link'); ?>" title="<?php if (get_option('december_home_9_title')) echo get_option('december_home_9_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="event-box box-color2">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('december_image_9') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('december_home_9_category_name')) echo get_option('december_home_9_category_name'); ?></div>
							<h2><?php if (get_option('december_home_9_title')) echo get_option('december_home_9_title'); ?> </h2>
							<p><?php if (get_option('december_home_9_description')) echo get_option('december_home_9_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('december_home_10_link')) echo get_option('december_home_10_link'); ?>" title="<?php if (get_option('december_home_10_title')) echo get_option('december_home_10_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="event-box box-color5">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('december_image_10') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('december_home_10_category_name')) echo get_option('december_home_10_category_name'); ?></div>
							<h2><?php if (get_option('december_home_10_title')) echo get_option('december_home_10_title'); ?> </h2>
							<p><?php if (get_option('december_home_10_description')) echo get_option('december_home_10_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
				
				<a href="<?php if (get_option('december_home_11_link')) echo get_option('december_home_11_link'); ?>" title="<?php if (get_option('december_home_11_title')) echo get_option('december_home_11_title'); ?>">
				<div class="grid-item-width1 item">
					<div class="event-box">
						<div class="event-image">
							<img src="<?php echo wp_get_attachment_url( get_option('december_image_11') ); ?>">
						</div><!--event-image-->
						<div class="event-detail">
							<div class="event-name"><?php if (get_option('december_home_11_category_name')) echo get_option('december_home_11_category_name'); ?></div>
							<h2><?php if (get_option('december_home_11_title')) echo get_option('december_home_11_title'); ?> </h2>
							<p><?php if (get_option('december_home_11_description')) echo get_option('december_home_11_description'); ?></p>
							<span>mehr lesen</span>
						</div><!--event-detail-->
					</div><!--event-box-->
				</div>
				</a>
</div><!--row-->
	<!----------------------------------------12---------------------------------------------->
	<?php
}
else{
	echo "Error: No match found";
}
?>


<?php
get_footer();
?>