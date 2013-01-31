<?php

add_action('after_setup_theme', 'pleroma_init', 15);

function pleroma_init() {

  // head cleanup
  add_action('init', 'pleroma_head_cleanup');
  // remove generator (rss)
  add_filter('the_generator', 'pleroma_remove');
  // scripts and styles
  add_action('wp_enqueue_scripts', 'pleroma_assets', 999);
  // theme support
  add_action('after_setup_theme','pleroma_theme_support');
  // add sidebars
  add_action( 'widgets_init', 'pleroma_register_sidebars' );
  // remove default widgets
  add_action( 'widgets_init', 'pleroma_remove_widgets' );
  // adding custom search
  add_filter( 'get_search_form', 'pleroma_search' );

  // excerpt for pages
  add_post_type_support('page', 'excerpt');
  // custom excerpt
  add_filter('excerpt_length', 'pleroma_excerpt_length', 999);
  add_filter('the_excerpt',   'pleroma_the_excerpt');

  // featured image
  add_theme_support( 'post-thumbnails' );

}

function pleroma_head_cleanup(){

  // rsd link
  remove_action( 'wp_head', 'rsd_link' );                               
  // windows live writer
  remove_action( 'wp_head', 'wlwmanifest_link' );                       
  // index link
  remove_action( 'wp_head', 'index_rel_link' );                         
  // previous link
  remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );            
  // start link
  remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );             
  // links for adjacent posts
  remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); 
  // wp version
  remove_action( 'wp_head', 'wp_generator' );

}

function pleroma_remove(){ return false; }

function pleroma_assets(){
  if (!is_admin()) {

    $asset = get_stylesheet_directory_uri() . '/%2$s/%1$s.%2$s';

    // custom styles
    wp_register_style( 'pleroma',               sprintf($asset, 'style', 'css') );
    wp_register_style( 'pleroma-responsive',    sprintf($asset, 'style-responsive', 'css') );

    // bootstrap scripts
    wp_register_script( 'bootstrap',            sprintf($asset, 'bootstrap.min', 'js'), null, '', true );

    // enqueue styles
    wp_enqueue_style( 'bootstrap' );
    wp_enqueue_style( 'bootstrap-responsive' );
    wp_enqueue_style( 'pleroma' );
    wp_enqueue_style( 'pleroma-responsive' );

    // enqueue scripts
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'bootstrap' );

  }
}

function pleroma_theme_support(){
  global $blog_id;

  // rss
  add_theme_support('automatic-feed-links');

  // wp menus
  add_theme_support( 'menus' );  
  
  // registering wp menus
  register_nav_menus(                      
    array( 
        'primary'     => __( 'Primario',      'pleromabootstrap' )   // primary nav in header
      , 'secondary'   => __( 'Secundario',    'pleromabootstrap' )   // secondary nav in header
      , 'secondary-2' => __( 'Secundario 2',  'pleromabootstrap' )   // secondary nav in footer
      , 'secondary-3' => __( 'Secundario 3',  'pleromabootstrap' )   // secondary nav in footer
    )
  );

  // wp menus of child blogs
  if( $blog_id > 1 )
  {

    // change nav names
    register_nav_menus(                      
      array( 
          'secondary-2'   => __( 'Secundario 1',  'pleromabootstrap' )
        , 'secondary-3'   => __( 'Secundario 2',  'pleromabootstrap' )
      )
    );

    // remove secondary nav
    unregister_nav_menu( 'secondary' );

  }

}

function pleroma_remove_widgets(){
  unregister_widget( 'WP_Widget_Search' );
  unregister_widget( 'WP_Widget_Meta' );
  unregister_widget( 'WP_Widget_Recent_Posts' );
  unregister_widget( 'WP_Widget_Recent_Comments' );
  unregister_widget( 'WP_Widget_Tag_Cloud' );
  unregister_widget( 'WP_Widget_Archives' );
  unregister_widget( 'WP_Widget_Categories' );
}

/****************************
 ******** NAVIGATION ********
 ****************************/  

function pleroma_primary_nav() {

  // able as hook, whim of Priani
  $change = apply_filters("pleroma_primary_nav", NULL);

  if(empty($change)) {
    wp_nav_menu(array( 
        'theme_location'  => 'primary'                    // location in theme
      , 'container'       => false                        // remove nav container
      , 'depth'           => -1                           // depth of the nav
      , 'items_wrap'      => '<ul class="nav">%3$s</ul>'  // adapted to twitter bootstrap (not yet dropdown)    // 
      , 'fallback_cb'     => '__return_false'             // avoiding fallback default function
    ));
  }

}

function pleroma_secondary_nav($class = 'nav-tabs nav-stacked') {

  wp_nav_menu(array( 
        'theme_location'  => 'secondary'                  // location in theme
      , 'container'       => false                        // remove nav container
      , 'depth'           => 2                            // depth nav
      , 'items_wrap'      => '<ul class="nav '. $class .'">%3$s</ul>'  // adapted to twitter bootstrap (not yet dropdown)
      , 'fallback_cb'     => 'pleroma_nav_menu_args'      // set fallback
  ));
}

function pleroma_secondary_nav_2() {
    wp_nav_menu(array( 
        'theme_location'  => 'secondary-2'                // location in theme
      , 'container'       => false                        // remove nav container
      , 'depth'           => -1                           // depth nav
      , 'items_wrap'      => '<ul class="nav nav-pills nav-stacked">%3$s</ul>'  // adapted to twitter bootstrap (not yet dropdown)
      , 'fallback_cb'     => '__return_false'             // avoiding fallback default function
  ));
}

function pleroma_secondary_nav_3() {
    wp_nav_menu(array( 
        'theme_location'  => 'secondary-3'                // location in theme
      , 'container'       => false                        // remove nav container
      , 'depth'           => -1                           // depth nav
      , 'items_wrap'      => '<ul class="nav nav-pills nav-stacked">%3$s</ul>'  // adapted to twitter bootstrap (not yet dropdown)
      , 'fallback_cb'     => '__return_false'             // avoiding fallback default function
  ));
}

/****************************
 ********** SEARCH **********
 ****************************/

function pleroma_search($form) {
  $form = ' <form role="search" class="navbar-search pull-right" action="%1$s">
              <input type="text" value="%2$s" name="s" id="s" class="search-query" placeholder="%3$s">
            </form> ';
  return sprintf( $form, home_url( '/' ), get_search_query(), esc_attr__('Buscar', 'pleromabootstrap') );

}


/****************************
 ********* EXCERPT **********
 ****************************/

function pleroma_the_excerpt($excerpt) {
  global $post;

  $format = '<a href="%1$s" class="btn" title="%2$s">%3$s <i class="icon-chevron-right"></i></a>';
  $more   = sprintf($format, get_permalink($post->ID), get_the_title($post->ID), __('Leer más', 'pleromabootstrap') );

  return $excerpt . $more;
}
function pleroma_excerpt_length($length) {
  return 20;
}


/****************************
 **** NUMERIC PAGINATION ****
 ****************************/

function page_navi($before = '', $after = '') {
  global $wpdb, $wp_query;
  $request = $wp_query->request;
  $posts_per_page = intval(get_query_var('posts_per_page'));
  $paged = intval(get_query_var('paged'));
  $numposts = $wp_query->found_posts;
  $max_page = $wp_query->max_num_pages;
  if ( $numposts <= $posts_per_page ) { return; }
  if(empty($paged) || $paged == 0) {
    $paged = 1;
  }
  $pages_to_show = 5;
  $pages_to_show_minus_1 = $pages_to_show-1;
  $half_page_start = floor($pages_to_show_minus_1/2);
  $half_page_end = ceil($pages_to_show_minus_1/2);
  $start_page = $paged - $half_page_start;
  if($start_page <= 0) {
    $start_page = 1;
  }
  $end_page = $paged + $half_page_end;
  if(($end_page - $start_page) != $pages_to_show_minus_1) {
    $end_page = $start_page + $pages_to_show_minus_1;
  }
  if($end_page > $max_page) {
    $start_page = $max_page - $pages_to_show_minus_1;
    $end_page = $max_page;
  }
  if($start_page <= 0) {
    $start_page = 1;
  }
    
  echo $before.'<div class="pagination"><ul class="clearfix">'."";
  if ($paged > 1) {
    $first_page_text = "«";
    echo '<li class="prev"><a href="'.get_pagenum_link().'" title="Primera">'.$first_page_text.'</a></li>';
  }
    
  $prevposts = get_previous_posts_link('← Anterior');
  if($prevposts) { echo '<li>' . $prevposts  . '</li>'; }
  else { echo '<li class="disabled"><a href="#">← Anterior</a></li>'; }
  
  for($i = $start_page; $i  <= $end_page; $i++) {
    if($i == $paged) {
      echo '<li class="active"><a href="#">'.$i.'</a></li>';
    } else {
      echo '<li><a href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
    }
  }
  echo '<li class="">';
  next_posts_link('Siguiente →');
  echo '</li>';
  if ($end_page < $max_page) {
    $last_page_text = "»";
    echo '<li class="next"><a href="'.get_pagenum_link($max_page).'" title="Anterior">'.$last_page_text.'</a></li>';
  }
  echo '</ul></div>'.$after."";
}