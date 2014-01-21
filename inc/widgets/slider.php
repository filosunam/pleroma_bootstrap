<?php

  // Pleroma Shortcode Slider
  function pleroma_shortcode_slider( $atts ){

    global $wp_query;

    // Set default arguments
    // Example: [slider slides="5" title="1" description="1" size="large"]
    //
    $args = array(
      'slides'       => 5,
      'title'        => true,
      'description'  => true,
      'size'         => 'large'
    );

    // Combines default and custom attributes
    $shortcode_atts = shortcode_atts( $args, $atts );

    // Import variables to current symbol table 
    extract( $shortcode_atts );

    // Set arguments to get images
    $args = array(
      'post_parent'     => get_the_ID(),
      'post_status'     => 'inherit',
      'post_type'       => 'attachment',
      'post_mime_type'  => 'image',
      'order'           => 'ASC',
      'orderby'         => 'menu_order ID',
      'posts_per_page'  => $slides
    );

    // Set query posts
    query_posts( $args );

    // If have posts
    if ( have_posts() ) {

      // .carousel
      echo '<div id="CarouselPost" class="carousel carousel-post slide">';
      
      // Shows indicators if there is more than one
      if ( $wp_query->post_count > 1 ) {
        // .carousel-indicators
        echo '<ol class="carousel-indicators">';
          // Shows indicators
          for ( $i = 0; $i < $wp_query->post_count; $i++ ) { 
            echo '<li data-target="#CarouselPost" data-slide-to="' . $i . '" class="' . ( $i == 0 ? ' active' : '' ) . '"></li> ';
          }
        echo '</ol>';
      }

      // .carousel-inner
      echo '<div class="carousel-inner">';

        // Iterate the attachment posts
        while ( have_posts() ) {

          // Retrieve the attachment post
          the_post();

          // Get thumbnail ID
          $thumbnail_id = get_post_thumbnail_id();

          // Get image attributes
          $image_atts = wp_get_attachment_image_src( $thumbnail_id, $size );

          // Get image url
          $image_url = $image_atts[ 0 ];

          // Get image link
          $image_link = wp_get_attachment_url( $thumbnail_id );

          // Set 'active' class the first post in the loop
          $active = $wp_query->current_post == 0 ? 'active' : '';

          // Displays carousel item
          
          echo '<div class="item ' . $active . '">';

          echo '<a href="' . $image_link . '">'
              . '<img src="' . $image_url . '" alt="' . get_the_title() . '" class="wp-post-image img-thumbnail">'
              . '</a>';

          echo '<div class="carousel-caption">';

            if ( true == ( bool ) $title ) {
              // Show title
              echo '<h4>' . get_the_title() . '</h4>';
            }

            if ( true == ( bool ) $description ) {
              // Show excerpt (caption)
              the_excerpt();
            }

          echo '</div>';
          echo '</div>';

        }

      // /.carousel-inner
      echo '</div>';

      // Shows carousel controls if there is more than one
      if ( $wp_query->post_count > 1 ) {

        echo '<div class="carousel-controls">        
                <a class="left carousel-control" href="#CarouselPost" data-slide="prev">
                  <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#CarouselPost" data-slide="next">
                  <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
              </div>';

      }

      // /.carousel
      echo '</div>';

    }

    // Reset query
    wp_reset_query();

  }

  // Register [slider] shortcode
  add_shortcode( 'slider', 'pleroma_shortcode_slider' );
