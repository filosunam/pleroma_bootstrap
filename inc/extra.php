<?php

// Applying only to parent blog
if ( is_main_site() ) {

  // Register nav menu for bulletin
  // register_nav_menus(                      
  //   array( 'boletin' => __( 'Boletín', 'pleromabootstrap' ) )
  // );

  // 
  // function pleroma_bulletin_nav() {
  //   wp_nav_menu(array( 
  //     'theme_location'  => 'boletin',
  //     'container'       => false,
  //     'depth'           => 1,
  //     // Adapted to twitter bootstrap (no dropdown)
  //     'items_wrap'      => '<ul class="nav navbar-nav">%3$s</ul>',
  //     // Avoiding fallback default function
  //     'fallback_cb'     => '__return_false'
  //   ));
  // }

  //
  // function pleroma_bulletin_template() {
  //   global $wp_query;

  //   // Applying to category & single
  //   if ( $wp_query->is_category || $wp_query->is_singular( 'post' ) ) {

  //     // Get current queried object
  //     $queried = $wp_query->get_queried_object();

  //     // Trace back the parent hierarchy and locate a template
  //     while ( $queried && !is_wp_error( $queried ) ) {

  //       // Location of template
  //       $template = get_template_directory() . "/category-{$queried->slug}.php";

  //       // Overriding default style
  //       wp_register_style( 'pleroma', get_stylesheet_directory_uri() . '/css/style-bulletin.css' );

  //       // Overriding primary nav
  //       add_filter( 'pleroma_primary_nav', 'pleroma_bulletin_nav' );

  //       // Load the template if exists
  //       if ( file_exists( $template ) ) {
  //         load_template( $template );
  //         exit;
  //       }

  //       $queried = $queried->parent ? get_category( $queried->parent ) : false;
  //     }
  //   }
  // }

  // add_action( 'template_redirect', 'pleroma_bulletin_template' );

}
