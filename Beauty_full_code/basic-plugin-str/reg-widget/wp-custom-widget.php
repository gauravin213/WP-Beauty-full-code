<?php
function wpiw_widget() {
  register_widget( 'null_custom_menu_widget' );
}
add_action( 'widgets_init', 'wpiw_widget' );

Class null_custom_menu_widget extends WP_Widget {

  function __construct() {
    parent::__construct(
      'null-custom-menu',
      __( 'Custom menu', 'wp-Custom menu-widget' ),
      array(
        'classname' => 'null-custom-menu',
        'description' => esc_html__( 'Displays custom menus', 'wp-Custom menu-widget' ),
        'customize_selective_refresh' => true,
      )
    );
  }

  function widget( $args, $instance ) {

    $title = empty( $instance['title'] ) ? '' : apply_filters( 'widget_title', $instance['title'] );
  
    $target = empty( $instance['target'] ) ? '_self' : $instance['target'];
    
    echo $args['before_widget'];

    if ( ! empty( $title ) ) { echo $args['before_title'] . wp_kses_post( $title ) . $args['after_title']; };

    do_action( 'wpiw_before_widget', $instance );

    $this->custom_menu_fun($target);

    do_action( 'wpiw_after_widget', $instance );

    echo $args['after_widget'];
  }

  function form( $instance ) {
    $instance = wp_parse_args( (array) $instance, array(
      'title' => __( 'Custom menu', 'wp-Custom menu-widget' ),
      'target' => '_self',
    ) );
    $title = $instance['title'];
    $target = $instance['target'];
    ?>
    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
        <?php esc_html_e( 'Title', 'wp-Custom menu-widget' ); ?>: 
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
      </label>
    </p>

    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>"><?php esc_html_e( 'Select menu', 'wp-Custom menu-widget' ); ?>:
      </label>

      <select id="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'target' ) ); ?>" class="widefat">

        <option value="regions_menu" <?php selected( 'regions_menu', $target ); ?>>
          <?php esc_html_e( 'regions_menu', 'wp-Custom menu-widget' ); ?>
        </option>

        <option value="popular_destinations_menu" <?php selected( 'popular_destinations_menu', $target ); ?>>
          <?php esc_html_e( 'popular_destinations_menu', 'wp-Custom menu-widget' ); ?>
        </option>

        <option value="interest_types_menu" <?php selected( 'interest_types_menu', $target ); ?>>
          <?php esc_html_e( 'interest_types_menu', 'wp-Custom menu-widget' ); ?>
        </option>

        <option value="safari_holidays_menu" <?php selected( 'safari_holidays_menu', $target ); ?>>
          <?php esc_html_e( 'safari_holidays_menu', 'wp-Custom menu-widget' ); ?>
        </option>

        <option value="ideas_by_month_menu" <?php selected( 'ideas_by_month_menu', $target ); ?>>
          <?php esc_html_e( 'ideas_by_month_menu', 'wp-Custom menu-widget' ); ?>
        </option>

        <option value="other_inspiration_menu" <?php selected( 'other_inspiration_menu', $target ); ?>>
          <?php esc_html_e( 'other_inspiration_menu', 'wp-Custom menu-widget' ); ?>
        </option>

      </select>
    </p>

    <?php

  }

  function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance['title'] = strip_tags( $new_instance['title'] );
  
    $instance['target'] = $new_instance['target'];

    return $instance;
  }



  function custom_menu_fun($menu_type){

    if ($menu_type == 'regions_menu') {

      ?>

      <ul class="<?php echo $menu_type;?>">
          <?php
          $locations = get_nav_menu_locations();
          if ( isset( $locations[ $menu_type ] ) ) {
              $menu = get_term( $locations[ $menu_type ], 'nav_menu' );
              if ( $items = wp_get_nav_menu_items( $menu->name ) ) {
                                  
                  foreach ( $items as $item ) { 

                      echo '<li>';

                        echo '<a href="'.$item->url.'">';
                          echo $item->title;
                        echo '</a>';
                       
                      echo '</li>';
                  }
              }
          }
          ?>
      </ul>

      <?php 

    }


    if ($menu_type == 'popular_destinations_menu') {

      ?>

      <ul class="<?php echo $menu_type;?>">
          <?php
          $locations = get_nav_menu_locations();
          if ( isset( $locations[ $menu_type ] ) ) {
              $menu = get_term( $locations[ $menu_type ], 'nav_menu' );
              if ( $items = wp_get_nav_menu_items( $menu->name ) ) {
                                  
                  foreach ( $items as $item ) { 

                    $country_val = get_post_meta( $item->object_id, '_country_code', true ); 

                      echo '<li>';

                        echo '<a href="'.$item->url.'">';
                          echo '<i class="flag flag-'.strtolower($country_val).'"></i>';
                          echo $item->title;
                        echo '</a>';
                       
                      echo '</li>';
                  }
              }
          }
          ?>
      </ul>

      <?php 

    }

    if ($menu_type == 'interest_types_menu') {

      ?>

      <ul class="<?php echo $menu_type;?>">
          <?php
          $locations = get_nav_menu_locations();
          if ( isset( $locations[ $menu_type ] ) ) {
              $menu = get_term( $locations[ $menu_type ], 'nav_menu' );
              if ( $items = wp_get_nav_menu_items( $menu->name ) ) {
                                  
                  foreach ( $items as $item ) { 

                      echo '<li>';

                        echo '<a href="'.$item->url.'">';
                          echo $item->title;
                        echo '</a>';
                       
                      echo '</li>';
                  }
              }
          }
          ?>
      </ul>

      <?php 

    }

    if ($menu_type == 'safari_holidays_menu') {

      ?>

      <ul class="<?php echo $menu_type;?>">
          <?php
          $locations = get_nav_menu_locations();
          if ( isset( $locations[ $menu_type ] ) ) {
              $menu = get_term( $locations[ $menu_type ], 'nav_menu' );
              if ( $items = wp_get_nav_menu_items( $menu->name ) ) {
                                  
                  foreach ( $items as $item ) { 

                      echo '<li>';

                        echo '<a href="'.$item->url.'">';
                          echo $item->title;
                        echo '</a>';
                       
                      echo '</li>';
                  }
              }
          }
          ?>
      </ul>


      <?php 

    }

    if ($menu_type == 'ideas_by_month_menu') {

      ?>

      <ul class="<?php echo $menu_type;?>">
          <?php
          $locations = get_nav_menu_locations();
          if ( isset( $locations[ $menu_type ] ) ) {
              $menu = get_term( $locations[ $menu_type ], 'nav_menu' );
              if ( $items = wp_get_nav_menu_items( $menu->name ) ) {
                                  
                  foreach ( $items as $item ) { 

                      echo '<li>';

                        echo '<a href="'.$item->url.'">';
                          echo $item->title;
                        echo '</a>';
                       
                      echo '</li>';
                  }
              }
          }
          ?>
      </ul>

       <a href="javascript://" class="collapse_menu">Collapse menu</a>

      <?php 

    }


    if ($menu_type == 'other_inspiration_menu') {

      ?>

      <ul class="<?php echo $menu_type;?>">
          <?php
          $locations = get_nav_menu_locations();
          if ( isset( $locations[ $menu_type ] ) ) {
              $menu = get_term( $locations[ $menu_type ], 'nav_menu' );
              if ( $items = wp_get_nav_menu_items( $menu->name ) ) {
                                  
                  foreach ( $items as $item ) { 

                      echo '<li>';

                        echo '<a class="custom-icone-'.$item->object_id.'" href="'.$item->url.'">';
                          echo $item->title;
                        echo '</a>';
                       
                      echo '</li>';
                  }
              }
          }
          ?>
      </ul>

      <?php 

    }
  }
}




