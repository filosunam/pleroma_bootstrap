<?php

// no support for child blogs
if( 1 == get_current_blog_id() )
{

  register_nav_menus(                      
    array( 'boletin' => __( 'Boletín', 'pleromabootstrap' ) )  // register menu
  );

  function pleroma_boletin_nav() {
    wp_nav_menu(array( 
        'theme_location'  => 'boletin'                      // location in theme
      , 'container'       => false                          // remove nav container
      , 'depth'           => -1                             // depth of the nav
      , 'items_wrap'      => '<ul class="nav">%3$s</ul>'    // adapted to twitter bootstrap (not yet dropdown)    // 
      , 'fallback_cb'     => '__return_false'               // avoiding fallback default function
    ));
    return true; // required if you enjoy a hook
  }

  function load_cat_parent_template()
  {
      global $wp_query;

      if ($wp_query->is_page)
          return true; // apply to category & single

      // get current object
      $cat = $wp_query->get_queried_object();

      // trace back the parent hierarchy and locate a template
      while ($cat && !is_wp_error($cat) && get_bloginfo('language') == 'es-ES') {
          $template = TEMPLATEPATH . "/category-{$cat->slug}.php";

          // overriding default style
          wp_register_style( 'pleroma',    get_stylesheet_directory_uri() . '/css/style-boletin.css' );

          // overriding primary nav
          add_filter('pleroma_primary_nav', 'pleroma_boletin_nav');

          if (file_exists($template)) {
              load_template($template);
              exit;
          }

          $cat = $cat->parent ? get_category($cat->parent) : false;
      }
  }

  add_action('template_redirect', 'load_cat_parent_template');


}
