<?php

class Pleroma_Nav_Menu extends Walker_Nav_Menu {
  function start_lvl(&$output, $depth = 0, $args = array()) {
    $output .= "\n<ul class=\"dropdown-menu\">\n";
  }
  function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
    $item_html = '';
    parent::start_el($item_html, $item, $depth, $args);

    if ($item->is_dropdown && ($depth === 0)) {
      $item_html = str_replace('<a', '<a class="dropdown-toggle" data-toggle="dropdown" data-target="#"', $item_html);
      $item_html = str_replace('</a>', ' <b class="caret"></b></a>', $item_html);
    }
    elseif (stristr($item_html, 'li class="divider')) {
      $item_html = preg_replace('/<a[^>]*>.*?<\/a>/iU', '', $item_html);    
    }
    elseif (stristr($item_html, 'li class="nav-header')) {
      $item_html = preg_replace('/<a[^>]*>(.*)<\/a>/iU', '$1', $item_html);
    }   

    $output .= $item_html;
  }
  function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {
    $element->is_dropdown = !empty($children_elements[$element->ID]);

    if ($element->is_dropdown) {
      if ($depth === 0) {
        $element->classes[] = 'dropdown';
      } elseif ($depth === 1) {
        $element->classes[] = 'dropdown-submenu';
      }
    }

    parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
  }
}


function pleroma_nav_menu_args( $args )
{   
    if(!$args['fallback_cb']){
      
      $args['items_wrap'] = '<ul class="nav nav-tabs nav-stacked %2$s">%3$s</ul>';
      $args['walker'] = new Pleroma_Nav_Menu();
      
    }

    if($args['fallback_cb'] == 'pleroma_nav_menu_args') {
      $args['walker'] = new Pleroma_Nav_Menu();
    }

    return $args;
}

function pleroma_nav_menu_css_class($classes, $item) {
  $slug    = sanitize_title($item->title);
  $classes = preg_replace('/(current(-menu-|[-_]page[-_])(item|parent|ancestor))/', 'active', $classes);
  $classes = preg_replace('/^((menu|page)[-_\w+]+)+/', '', $classes);

  $classes = array_unique($classes);
  return array_filter($classes);
}

add_filter('wp_nav_menu_args', 'pleroma_nav_menu_args');
add_filter('nav_menu_css_class', 'pleroma_nav_menu_css_class', 10, 2);
add_filter('nav_menu_item_id', '__return_null');
 
function network_primary_nav( $menu_items, $args )
{
  $menu_name = 'primary';

  if ( ( get_current_blog_id() > 1 ) && $menu_name == $args->theme_location && $args->fallback_cb != 'pleroma_nav_menu_args' )
  {
    // to parent blog
    switch_to_blog(1);

    $locations = get_nav_menu_locations();

    // get primary nav of parent blog
    if ( isset( $locations[ $menu_name ] ) )
    {
      $menu       = wp_get_nav_menu_object( $locations[ $menu_name ] );
      $menu_items = wp_get_nav_menu_items( $menu->term_id );
    }

    // to child blog
    restore_current_blog();
  }

  return $menu_items;
    
}

// override primary nav for multisites
add_filter( 'wp_nav_menu_objects', 'network_primary_nav', 100, 2 );

function the_breadcrumb() {
    //Variable (symbol >> encoded) and can be styled separately.
    //Use >> for different level categories (parent >> child >> grandchild)
    $delimiter    = ' <span class="divider">/</span> ';
    //Use bullets for same level categories ( parent . parent )
    $delimiter1   = ' <span class="divider">&bull;</span> ';
    //text link for the 'Home' page
    $main         = __('Home');
    //Display only the first 30 characters of the post title.
    $maxLength    = 40;
    //variable for archived year
    $arc_year     = get_the_time('Y');
    //variable for archived month
    $arc_month    = get_the_time('F');
    //variables for archived day number + full
    $arc_day      = get_the_time('d');
    $arc_day_full = get_the_time('l');  
    //variable for the URL for the Year
    $url_year     = get_year_link($arc_year);
    //variable for the URL for the Month
    $url_month    = get_month_link($arc_year,$arc_month);
 
    /*is_front_page(): If the front of the site is displayed, whether it is posts or a Page. This is true
    when the main blog page is being displayed and the 'Settings > Reading ->Front page displays'
    is set to "Your latest posts", or when 'Settings > Reading ->Front page displays' is set to
    "A static page" and the "Front Page" value is the current Page being displayed. In this case
    no need to add breadcrumb navigation. is_home() is a subset of is_front_page() */
 
    //Check if NOT the front page (whether your latest posts or a static page) is displayed. Then add breadcrumb trail.
    if ( !is_front_page() and !is_category('boletin') )
    {
        //If Breadcrump exists, wrap it up in a div container for styling.
        //You need to define the breadcrumb class in CSS file.
        echo '<ul class="breadcrumb">';
 
        //global WordPress variable $post. Needed to display multi-page navigations.
        global $post, $cat;
        //A safe way of getting values for a named option from the options database table.
        $homeLink = get_option('home'); //same as: $homeLink = get_bloginfo('url');
        //If you don't like "You are here:", just remove it.
        echo '<li><a href="' . $homeLink . '">' . $main . '</a>' . $delimiter . '</li>';
 
        //Display breadcrumb for single post
        if (is_single())
        {   //check if any single post is being displayed.
            //Returns an array of objects, one object for each category assigned to the post.
            //This code does not work well (wrong delimiters) if a single post is listed
            //at the same time in a top category AND in a sub-category. But this is highly unlikely.
            $category = get_the_category();
            $num_cat = count($category); //counts the number of categories the post is listed in.
 
            //If you have a single post assigned to one category.
            //If you don't set a post to a category, WordPress will assign it a default category.
            if ($num_cat <= 1)  //I put less or equal than 1 just in case the variable is not set (a catch all).
            {
                if(isset($category[0]))
                {
                  echo get_category_parents($category[0],  true, ' ' . $delimiter . ' ');
                  
                }
                //Display the full post title.
                echo ' <li>' . get_the_title() . '</li>';
            } else
            {   //then the post is listed in more than 1 category.
                //Put bullets between categories, since they are at the same level in the hierarchy.
                    echo "<li>" . get_the_category_list($delimiter1) . "</li>";
                    //Display partial post title, in order to save space.
                    if (strlen(get_the_title()) >= $maxLength)
                    {   //If the title is long, then don't display it all.
                        echo ' <li>' . $delimiter . trim(substr(get_the_title(), 0, $maxLength)) . ' ...</li>';
                    } else
                    {   //the title is short, display all post title.
                        echo ' <li>' . $delimiter . get_the_title() . '</li>';
                    }
            }
        }
        //Display breadcrumb for category and sub-category archive
        elseif (is_category()) { //Check if Category archive page is being displayed.
            //returns the category title for the current page.
            //If it is a subcategory, it will display the full path to the subcategory.
            //Returns the parent categories of the current category with links separated by '»'
            echo '<li>' . _e("Archivos de categoría", "pleromabootstrap") . ": " . get_category_parents($cat, true,' ' . $delimiter . ' ') . '</li>' ;
        }
        //Display breadcrumb for tag archive
        elseif ( is_tag() ) { //Check if a Tag archive page is being displayed.
            //returns the current tag title for the current page.
            echo '<li>' . _e("Entradas etiquetadas", "pleromabootstrap") . ': "' . single_tag_title("", false) . '"' . '</li>';
        }
        //Display breadcrumb for calendar (day, month, year) archive
        elseif ( is_day()) { //Check if the page is a date (day) based archive page.
            echo '<li><a href="' . $url_year . '">' . $arc_year . '</a> ' . $delimiter . '</li>';
            echo '<li><a href="' . $url_month . '">' . $arc_month . '</a> ' . $delimiter . $arc_day . ' (' . $arc_day_full . ')' . '</li>';
        }
        elseif ( is_month() ) {  //Check if the page is a date (month) based archive page.
            echo '<li><a href="' . $url_year . '">' . $arc_year . '</a> ' . $delimiter . $arc_month . '</li>';
        }
        elseif ( is_year() ) {  //Check if the page is a date (year) based archive page.
            echo $arc_year;
        }
        //Display breadcrumb for search result page
        elseif ( is_search() ) {  //Check if search result page archive is being displayed.
            echo '<li>' . sprintf( __("Resultados de búsqueda de: \"%s\"", 'pleromabootstrap'), get_search_query() ) . '</li>';
        }
        //Display breadcrumb for top-level pages (top-level menu)
        elseif ( is_page() && !$post->post_parent ) { //Check if this is a top Level page being displayed.
            echo '<li class="active">' . get_the_title() . '</li>';
        }
        //Display breadcrumb trail for multi-level subpages (multi-level submenus)
        elseif ( is_page() && $post->post_parent ) {  //Check if this is a subpage (submenu) being displayed.
            //get the ancestor of the current page/post_id, with the numeric ID
            //of the current post as the argument.
            //get_post_ancestors() returns an indexed array containing the list of all the parent categories.
            $post_array = get_post_ancestors($post);
 
            //Sorts in descending order by key, since the array is from top category to bottom.
            krsort($post_array); 
 
            //Loop through every post id which we pass as an argument to the get_post() function.
            //$post_ids contains a lot of info about the post, but we only need the title.
            foreach($post_array as $key=>$postid){
                //returns the object $post_ids
                $post_ids = get_post($postid);
                //returns the name of the currently created objects
                $title = $post_ids->post_title;
                //Create the permalink of $post_ids
                echo '<li><a href="' . get_permalink($post_ids) . '">' . $title . '</a>' . $delimiter . '</li>';
            }
            the_title(); //returns the title of the current page.
        }
        //Display breadcrumb for author archive
        elseif ( is_author() ) {//Check if an Author archive page is being displayed.
            global $author;
            //returns the user's data, where it can be retrieved using member variables.
            $user_info = get_userdata($author);
            echo  _e("Publicado por", "pleromabootstrap") . ': ' . $user_info->display_name ;
        }
        //Display breadcrumb for 404 Error
        elseif ( is_404() ) {//checks if 404 error is being displayed
            echo  _e("Error 404 - Artículo no encontrado", "pleromabootstrap");
        }
        else {
            //All other cases that I missed. No Breadcrumb trail.
        }
       echo '</ul>';
    }
}
