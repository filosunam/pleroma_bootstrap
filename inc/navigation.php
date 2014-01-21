<?php

  // Register Nav Menus
  function pleroma_register_nav_menus() {

    // Registering menus
    register_nav_menus(                      
      array( 
        'primary' => 'Primario',
        'secondary' => 'Secundario',
        'secondary-2' => 'Secundario 2',
        'secondary-3' => 'Secundario 3'
      )
    );

    // Only apply to child blogs
    if ( ! is_main_site() ) {
      // Change nav names
      register_nav_menus(
        array( 
          'secondary-2' => 'Secundario 1',
          'secondary-3' => 'Secundario 2'
        )
      );

      // Remove unnecessary navs
      unregister_nav_menu( 'secondary' );
    }

  }

  // Primary navigation
  function pleroma_primary_nav() {

    // Enabled as hook cause of Priani's whim
    $change = apply_filters( 'pleroma_primary_nav', NULL );

    if ( empty( $change ) ) {
      wp_nav_menu(
        array(
          'theme_location'  => 'primary',
          'container'       => false,
          'depth'           => 1,
          // Adapted to twitter bootstrap (no dropdown)
          'items_wrap'      => '<ul class="nav navbar-nav">%3$s</ul>',
          // Avoiding fallback default function
          'fallback_cb'     => '__return_false'
        )
      );
    }

  }

  // Secondary navigation
  function pleroma_secondary_nav( $class = 'nav-tabs nav-stacked' ) {

    // Switch to parent blog
    if ( ! is_main_site() )
      switch_to_blog( 1 );

    // Get 'secondary' nav from parent blog
    wp_nav_menu(
      array(
        'theme_location'  => 'secondary',
        'container'       => false,
        'depth'           => 2,
        // Adapted to twitter bootstrap (no dropdown)
        'items_wrap'      => '<ul class="nav '. $class .'">%3$s</ul>',
        // Set 'pleroma_nav_menu_args' fallback
        'fallback_cb'     => 'pleroma_nav_menu_args'
      )
    );

    // Restore to child blog
    restore_current_blog();

  }

  // Secondary navigation (2)
  function pleroma_secondary_nav_2() {

    // Get 'secondary-2' nav
    wp_nav_menu(
      array(
        'theme_location'  => 'secondary-2',
        'container'       => false,
        'depth'           => 1,
        // Adapted to twitter bootstrap (no dropdown)
        'items_wrap'      => '<ul class="nav nav-pills nav-stacked">%3$s</ul>',
        // Avoiding fallback default function
        'fallback_cb'     => '__return_false'
      )
    );

  }

  // Secondary navigation (3)
  function pleroma_secondary_nav_3() {

    // Get 'secondary-3' nav
    wp_nav_menu(
      array(
        'theme_location'  => 'secondary-3',
        'container'       => false,
        'depth'           => 1,
        // Adapted to twitter bootstrap (no dropdown)
        'items_wrap'      => '<ul class="nav nav-pills nav-stacked">%3$s</ul>',
        // Avoiding fallback default function
        'fallback_cb'     => '__return_false'
      )
    );

  }

  // Extends Walker_Nav_Menu to Pleroma_Nav_Menu
  // http://codex.wordpress.org/Class_Reference/Walker_Nav_Menu
  // http://wp.tutsplus.com/tutorials/creative-coding/understanding-the-walker-class/
  class Pleroma_Nav_Menu extends Walker_Nav_Menu {

    function start_lvl( &$output, $depth = 0, $args = array() ) {

      $output .= "\n<ul class=\"dropdown-menu\">\n";

    }

    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

      $item_html = '';

      parent::start_el( $item_html, $item, $depth, $args );

      if ( $item->is_dropdown && ( $depth === 0 ) ) {
        $item_html = str_replace( '<a', '<a class="dropdown-toggle" data-toggle="dropdown" data-target="#"', $item_html );
        $item_html = str_replace( '</a>', ' <b class="caret"></b></a>', $item_html );
      } elseif ( stristr( $item_html, 'li class="divider' ) ) {
        $item_html = preg_replace( '/<a[^>]*>.*?<\/a>/iU', '', $item_html );    
      } elseif ( stristr( $item_html, 'li class="nav-header' ) ) {
        $item_html = preg_replace( '/<a[^>]*>(.*)<\/a>/iU', '$1', $item_html );
      }   

      $output .= $item_html;

    }

    function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {

      $element->is_dropdown = !empty( $children_elements[$element->ID] );

      if ( $element->is_dropdown ) {
        if ( $depth === 0 ) {
          $element->classes[] = 'dropdown';
        } elseif ( $depth === 1 ) {
          $element->classes[] = 'dropdown-submenu';
        }
      }

      parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);

    }

  }


  // To be used as fallback (bootstrap nav styles)
  function pleroma_nav_menu_args( $args ){

    if ( !$args['fallback_cb'] ) {
      $args['items_wrap'] = '<ul class="nav nav-tabs nav-stacked %2$s">%3$s</ul>';
      $args['walker'] = new Pleroma_Nav_Menu();
    }

    if ( $args['fallback_cb'] == 'pleroma_nav_menu_args') {
      $args['walker'] = new Pleroma_Nav_Menu();
    }

    return $args;

  }

  // Change default classes to bootstrap classes (for each item)
  function pleroma_nav_menu_css_class( $classes, $item ) {

    // Title to slug
    $slug = sanitize_title( $item->title );

    // Replaces 'current-{*}' classes to 'active'
    $classes = preg_replace( '/(current(-menu-|[-_]page[-_])(item|parent|ancestor))/', 'active', $classes );

    // Remove other classes
    $classes = preg_replace( '/^((menu|page)[-_\w+]+)+/', '', $classes );

    // Remove duplicated classes
    $classes = array_unique( $classes );

    // Remove empty classes
    $classes = array_filter( $classes );

    return $classes;

  }

  // Set network primary nav to child blogs
  function network_primary_nav( $menu_items, $args ) {

    // Only apply to child blogs
    if ( ! is_main_site() ) {

      // As long as the primary nav to override exists
      if ( 'primary' == $args->theme_location && 'pleroma_nav_menu_args' != $args->fallback_cb ) {
      
        // Switch to parent blog
        switch_to_blog(1);

        // Get locations
        $locations = get_nav_menu_locations();

        // Get primary nav from parent blog
        if ( isset( $locations[ 'primary' ] ) ) {
          $menu = wp_get_nav_menu_object( $locations[ 'primary' ] );
          $menu_items = wp_get_nav_menu_items( $menu->term_id );
        }

        // Restore to child blog
        restore_current_blog();

      }

    }

    return $menu_items;
    
  }

  // Add 'pleroma_nav_menu_args' filter to hook 'wp_nav_menu_args'
  add_filter('wp_nav_menu_args', 'pleroma_nav_menu_args');

  // Add 'pleroma_nav_menu_css_class' filter to hook 'nav_menu_css_class'
  add_filter('nav_menu_css_class', 'pleroma_nav_menu_css_class', 10, 2);

  // Override child primary nav to network primary nav
  add_filter( 'wp_nav_menu_objects', 'network_primary_nav', 100, 2 );

  // Avoid menu item id
  add_filter('nav_menu_item_id', '__return_null');

  // Custom search form
  add_filter( 'get_search_form', 'pleroma_search_form' );
  

  // Pleroma search form
  function pleroma_search_form( $form ) {
    
    $form = ' <form role="search" class="navbar-form navbar-right" action="%1$s">
                <div class="form-group">
                  <input type="text" value="%2$s" name="s" id="s" class="form-control" placeholder="%3$s">
                </div>
                <button type="submit" class="btn btn-default">%3$s</button>
              </form> ';

    return sprintf( $form, home_url( '/' ), get_search_query(), esc_attr__( 'Buscar', 'pleromabootstrap' ) );

  }

  // Breadcumb trail
  function the_breadcrumb() {
    // Use bullets for same level categories (parent . parent)
    $bullet       = ' &bull; ';
    // Text link for the homepage
    $main         = __( 'Home' );
    // Display only the first 40 characters of the post title.
    $maxLength    = 40;

    if ( is_archive() ) {
      
      // Variable for archived year
      $arc_year     = get_the_time( 'Y' );
      // Variable for archived month
      $arc_month    = get_the_time( 'F' );
      // Variables for archived day number + full
      $arc_day      = get_the_time( 'd' );
      $arc_day_full = get_the_time( 'l' );  
      // Variable for the URL for the Year
      $url_year     = get_year_link( $arc_year );
      // Variable for the URL for the Month
      $url_month    = get_month_link( $arc_year,$arc_month );

    }
 
    /* is_front_page(): If the front of the site is displayed, whether it is posts or a Page. This is true
    when the main blog page is being displayed and the 'Settings > Reading -> Front page displays'
    is set to "Your latest posts", or when 'Settings > Reading ->Front page displays' is set to
    "A static page" and the "Front Page" value is the current Page being displayed. In this case
    no need to add breadcrumb navigation. is_home() is a subset of is_front_page() */
 
    // Check if not the front page (whether your latest posts or a static page) is displayed. Then add breadcrumb trail.
    // Don't display the breadcrumb trail if not category "boletin" as well (I hate this!)
    if ( !is_front_page() && !is_category( 'boletin' ) ) {
        // If breadcrumb exists, wrap it up in a div container for styling
        // You need to define the breadcrumb class in CSS file
        echo '<ul class="breadcrumb">';
 
        // Global Wordpress variable $post and $cat (needed to display multi-page navigations)
        global $post, $cat;

        // A safe way of getting values for a named option from the options database table
        $homeLink = get_option( 'home' );

        // Display homelink + delimiter
        echo '<li><a href="' . $homeLink . '"><span class="glyphicon glyphicon-home"></span> ' . $main . '</a></li>';
 
        // Display breadcrumb for single post
        if ( is_single() ) {
          // Returns an array of objects, one object for each category assigned to the post.
          // This code does not work well (wrong delimiters) if a single post is listed
          // at the same time in a top category AND in a sub-category. But this is highly unlikely
          $category = get_the_category();

          // Counts the number of categories the post is listed in
          $num_cat  = count( $category );

          // If you have a single post assigned to one category
          // If you don't set a post to a category, Wordpress will assign it a default category
          if ( $num_cat <= 1 ) {
            if ( isset( $category[0] ) ) {
              // Display all category parents
              echo '<li class="active">' . get_category_parents( $category[0], true, false ) . '</li>';
            }

            // Display the full post title
            echo '<li class="active">' . get_the_title() . '</li> ';
          // Then the post is listed in more than 1 category...
          } else {
            // Put bullets between categories, since they are at the same level in the hierarchy
            echo ' / ' . get_the_category_list( $bullet ) . ' / ';

            // Display partial post title, in order to save space
            // If the title is long, then don't display it all.
            if ( strlen( get_the_title() ) >= $maxLength ) {
              echo '<li class="active">' . trim( substr( get_the_title(), 0, $maxLength ) ) . ' …</li> ';
            } else {
              // If the title is short, display all post title
              echo '<li class="active">' . get_the_title() . '</li> ';
            }
          }

        // Display breadcrumb for category and sub-category archive
        // Check if category archive page is being displayed
        } elseif ( is_category() ) {
          // Returns the category title for the current page
          // If it is a subcategory, it will display the full path to the subcategory
          // Returns the parent categories of the current category
          echo '<li class="active">' . __( 'Archivos de categoría' , 'pleromabootstrap' ) . ': ' .
                get_category_parents( $cat, true, ' ' ) . '</li> ';
        }
        // Display breadcrumb for tag archive
        // Check if a Tag archive page is being displayed
        elseif ( is_tag() ) {
          // Returns the current tag title for the current page
          echo '<li class="active">' . __( 'Entradas etiquetadas', 'pleromabootstrap' ) . ': "' .
                single_tag_title( '', false ) . '"' . '</li> ';
        // Display breadcrumb for calendar (day, month, year) archive
        // Check if the page is a date (day) based archive page
        } elseif ( is_day() ) {
          echo '<li class="active"><a href="' . $url_year . '">' . $arc_year . '</a></li>';
          echo '<li class="active"><a href="' . $url_month . '">' . $arc_month . '</a> ' . $arc_day . ' (' . $arc_day_full . ')' . '</li>';
        // Check if the page is a date (month) based archive page
        } elseif ( is_month() ) {
          echo '<li class="active"><a href="' . $url_year . '">' . $arc_year . '</a> ' . $arc_month . '</li>';
        // Check if the page is a date (year) based archive page
        } elseif ( is_year() ) {
          echo $arc_year;
        // Display breadcrumb for search result page
        // Check if search result page archive is being displayed
        } elseif ( is_search() ) {
          echo '<li class="active">' . sprintf( __("Resultados de búsqueda de: \"%s\"", 'pleromabootstrap'), get_search_query() ) . '</li>';
        // Display breadcrumb for top-level pages (top-level menu)
        // Check if this is a top Level page being displayed
        } elseif ( is_page() && !$post->post_parent ) {
          echo '<li class="active">' . get_the_title() . '</li> ';
        // Display breadcrumb trail for multi-level subpages (multi-level submenus)
        // Check if this is a subpage (submenu) being displayed
        } elseif ( is_page() && $post->post_parent ) {
          // Get the ancestor of the current page/post_id, with the numeric ID
          // of the current post as the argument.
          // get_post_ancestors() returns an indexed array containing the list of all the parent categories.
          $post_array = get_post_ancestors( $post );

          // Sorts in descending order by key, since the array is from top category to bottom.
          krsort( $post_array ); 

          // Loop through every post id which we pass as an argument to the get_post() function.
          // $post_ids contains a lot of info about the post, but we only need the title.
          foreach ( $post_array as $key=>$postid ) {
              // Returns the object $post_ids
              $post_ids = get_post( $postid );
              // Returns the name of the currently created objects
              $title = $post_ids->post_title;
              // Create the permalink of $post_ids
              echo '<li class="active"><a href="' . get_permalink( $post_ids ) . '">' . $title . '</a></li>';
          }

          // Returns the title of the current page
          echo '<li class="active">' . get_the_title() . '</li>';
        // Display breadcrumb for author archive
        // Check if an Author archive page is being displayed
        } elseif ( is_author() ) {
          global $author;
          // Returns the user's data, where it can be retrieved using member variables
          $user_info = get_userdata( $author );
          echo '<li class="active">' . __( 'Publicado por', 'pleromabootstrap' ) . ': "' . $user_info->display_name . '"</li>';
        // Display breadcrumb for 404 Error
        // Checks if 404 error is being displayed
        } elseif ( is_404() ) {
          echo '<li class="active">' . __('Error 404 - Artículo no encontrado', 'pleromabootstrap') . '</li>';
        } else {
          // All other cases that missed. No breadcrumb trail.
        }
       echo '</ul>';

    }

  }

  // Pagination
  function the_pagination() {
    global $wpdb, $wp_query;

    $request = $wp_query->request;
    $posts_per_page = intval( get_query_var( 'posts_per_page' ) );
    $paged = intval( get_query_var( 'paged' ) );
    $numposts = $wp_query->found_posts;
    $max_page = $wp_query->max_num_pages;
    if ( $numposts <= $posts_per_page ) { return; }
    if( empty( $paged ) || $paged == 0 ) {
      $paged = 1;
    }
    $pages_to_show = 5;
    $pages_to_show_minus_1 = $pages_to_show-1;
    $half_page_start = floor( $pages_to_show_minus_1 / 2 );
    $half_page_end = ceil( $pages_to_show_minus_1 / 2 );
    $start_page = $paged - $half_page_start;
    if( $start_page <= 0 ) {
      $start_page = 1;
    }
    $end_page = $paged + $half_page_end;
    if( ( $end_page - $start_page ) != $pages_to_show_minus_1 ) {
      $end_page = $start_page + $pages_to_show_minus_1;
    }
    if( $end_page > $max_page ) {
      $start_page = $max_page - $pages_to_show_minus_1;
      $end_page = $max_page;
    }
    if( $start_page <= 0 ) {
      $start_page = 1;
    }
      
    echo '<ul class="pagination">';
    $prevposts = get_previous_posts_link( '« Anterior' );

    if( $prevposts ) {
      echo '<li>' . $prevposts  . '</li>';
    }
    
    for( $i = $start_page; $i <= $end_page; $i++ ) {
      if( $i == $paged ) {
        echo '<li class="active"><a href="#">' . $i . '</a></li>';
      } else {
        echo '<li><a href="' . get_pagenum_link( $i ) . '">' . $i . '</a></li>';
      }
    }

    echo '<li>'; echo next_posts_link( 'Siguiente »' ); echo '</li>';
    echo '</ul>';

  }
