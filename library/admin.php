<?php

// You right! You will say me: WTFM
// If I write the fucking manual, I will be ashamed
// not do it, so you know what I say...

global $blog_id;

/*****************************
 ****** ADMIN DASHBOARD ******
 *****************************/

function disable_default_dashboard_widgets() {
  
  
  remove_meta_box('dashboard_recent_comments', 'dashboard', 'core');
  remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');
  remove_meta_box('dashboard_plugins', 'dashboard', 'core');

  remove_meta_box('dashboard_quick_press', 'dashboard', 'core');
  remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');
  remove_meta_box('dashboard_primary', 'dashboard', 'core');
  remove_meta_box('dashboard_secondary', 'dashboard', 'core');

}
// removing default widgets
add_action('admin_menu', 'disable_default_dashboard_widgets');


/****************************
 ******* ADMIN FOOTER *******
 ****************************/

function pleroma_custom_admin_footer() {
  echo '<p><span id="footer-thankyou">
        <a href="http://www.filos.unam.mx">Pleroma Bootstrap</a>
        desarrollado inicialmente por <a href="http://github.com/markotom">Markotom</a></span>.
        Basado en <a href="http://twitter.github.com/bootstrap">Twitter Bootstrap</a>.</p>
        <p><strong>Source</strong>: <a href="http://github.com/markotom/pleroma_bootstrap">http://github.com/markotom/pleroma_bootstrap</a> (private repo)</p>';
}

// adding footer text
add_filter('admin_footer_text', 'pleroma_custom_admin_footer');


/*****************************
 ***** PLEROMA BOOTSTRAP *****
 *****************************/

add_action('admin_menu', 'pleroma_admin_menu');
add_action('admin_init', 'pleroma_add_init');

// select all categories!
$categories = get_categories('hide_empty=0&orderby=name');
$wp_cats = array('Elige una categoría');
foreach ( $categories as $category_list )
  $wp_cats[$category_list->cat_ID] = $category_list->cat_name;


// select all posts!
$args  = array( 'post_type' => array('post', 'page', 'event', 'book'), 'numberposts' => -1, 'orderby' => 'title', 'order' => 'ASC' ); 
$posts = get_posts($args);
$wp_posts = array('Elige un contenido');
foreach ( $posts as $post_list )
  $wp_posts[$post_list->ID] = $post_list->post_title;

// options!
$options = array (  
    
  array( "name" => "Página inicial",  
         "type" => "section"),

  array( "type" => "open"), 

  array(
      "name"    => "Categoría del slider",  
      "desc"    => "Elige una categoría para destacarla en el <strong>Slider</strong> de la página inicial.",  
      "id"      => "pleroma_home_slider",  
      "type"    => "select",  
      "options" => $wp_cats,
      "std"     => "Elige una categoría"
  ), 
           
  array(
        "name"    => "Categoría destacada",  
        "desc"    => "Elige una categoría para destacarla en la página inicial.",  
        "id"      => "pleroma_home_featured",  
        "type"    => "select",  
        "options" => $wp_cats,
        "std"     => "Elige una categoría"
  ),  

  array(
        "name"    => "Mostrar contenido destacado elegido manualmente",  
        "desc"    => "Si está activado podrá desplegarse el contenido que se añade manualmente.",  
        "id"      => "pleroma_home_manual",  
        "type"    => "checkbox",  
        "std"     => "0"
  ),

  array(
        "name"    => "#1 contenido destacado", 
        "desc"    => "En la primera columna (1/4)",  
        "id"      => "pleroma_home_featured_1",
        "type"    => "select",
        "options" => $wp_posts,  
        "std"     => ""
  ),

  array(
        "name"    => "#2 contenido destacado", 
        "desc"    => "En la segunda columna (2/4)",  
        "id"      => "pleroma_home_featured_2",
        "type"    => "select",
        "options" => $wp_posts,  
        "std"     => ""
  ),

  array(
        "name"    => "#3 contenido destacado", 
        "desc"    => "En la tercera columna (3/4)",  
        "id"      => "pleroma_home_featured_3",
        "type"    => "select",
        "options" => $wp_posts,  
        "std"     => ""
  ),

  array(
        "name"    => "#4 contenido destacado", 
        "desc"    => "En la cuarta columna (4/4)",  
        "id"      => "pleroma_home_featured_4",
        "type"    => "select",
        "options" => $wp_posts,  
        "std"     => ""
  ),

  array( "type" => "close"),

  // Social Media
  array( "name" => "Redes sociales",  
         "type" => "section"),

  array( "type" => "open"), 

  array("name" => "Facebook",  
        "desc" => "Agrega la URL de tu página o perfil de Facebook",  
        "id" => "pleroma_facebook",  
        "type" => "text",  
        "std" => ""),

  array("name" => "Twitter",  
        "desc" => "Agrega el <strong>nickname</strong> de tu cuenta de Twitter",  
        "id" => "pleroma_twitter",  
        "type" => "text",  
        "std" => ""),

  array("name" => "Youtube",  
        "desc" => "Agrega el <strong>nickname</strong> de tu cuenta de Youtube",  
        "id" => "pleroma_youtube",  
        "type" => "text",  
        "std" => ""),

  array("name" => "Vimeo",  
        "desc" => "Agrega el <strong>nickname</strong> de tu cuenta de Vimeo",  
        "id" => "pleroma_vimeo",  
        "type" => "text",  
        "std" => ""),

  array( "type" => "close"),
   
);

if( 1 == $blog_id )
{

  $page  = get_page_by_path('investigacion/proyectos');

  if ($page) {

    $pages = get_children(
      array( 
          'post_parent' => $page->ID
        , 'post_type'   => 'page'
        , 'post_status' => 'publish' 
      )
    );
    $wp_researches = array('Elige un contenido');
    foreach ( $pages as $page_list )
      $wp_researches[$page_list->ID] = $page_list->post_title;

    $proyectos = array(

    array( "name" => "Proyectos de Investigación",  
           "type" => "section"),

    array( "type" => "open"),

    array(
          "name"    => "Producto de investigación", 
          "desc"    => "Producto de investigación promocionado en la página principal",  
          "id"      => "pleroma_research_product",
          "type"    => "select",
          "options" => $wp_posts,  
          "std"     => ""
    ),

    array(
          "name"    => "#1 proyecto destacado", 
          "desc"    => "",  
          "id"      => "pleroma_project_featured_1",
          "type"    => "select",
          "options" => $wp_researches,  
          "std"     => ""
    ),

    array(
          "name"    => "#2 proyecto destacado", 
          "desc"    => "",  
          "id"      => "pleroma_project_featured_2",
          "type"    => "select",
          "options" => $wp_researches,  
          "std"     => ""
    ),

    array(
          "name"    => "#3 proyecto destacado", 
          "desc"    => "",  
          "id"      => "pleroma_project_featured_3",
          "type"    => "select",
          "options" => $wp_researches,  
          "std"     => ""
    ),

    array(
          "name"    => "#4 proyecto destacado", 
          "desc"    => "",  
          "id"      => "pleroma_project_featured_4",
          "type"    => "select",
          "options" => $wp_researches,  
          "std"     => ""
    ),

    array(
          "name"    => "#5 proyecto destacado", 
          "desc"    => "",  
          "id"      => "pleroma_project_featured_5",
          "type"    => "select",
          "options" => $wp_researches,  
          "std"     => ""
    ),

    array( "type" => "close")

    );

    $options = array_merge($options, $proyectos);

  }

  $boletin = array(
  // Boletín
  array( "name" => "Boletín",  
         "type" => "section"),

  array( "type" => "open"), 

  array(
      "name"    => "Categoría del boletín",  
      "desc"    => "Elige una categoría para destacarla en el <strong>Slider</strong> del Boletín.",  
      "id"      => "pleroma_boletin_slider",  
      "type"    => "select",  
      "options" => $wp_cats,
      "std"     => "Elige una categoría"
  ), 

  array(
        "name"    => "Mostrar contenido destacado elegido manualmente",  
        "desc"    => "Si está activado podrá desplegarse el contenido que se añade manualmente.",  
        "id"      => "pleroma_boletin_manual",  
        "type"    => "checkbox",  
        "std"     => "0"
  ),

  array(
        "name"    => "#1 contenido destacado", 
        "desc"    => "",  
        "id"      => "pleroma_boletin_featured_1",
        "type"    => "select",
        "options" => $wp_posts,  
        "std"     => ""
  ),

  array(
        "name"    => "#2 contenido destacado", 
        "desc"    => "",  
        "id"      => "pleroma_boletin_featured_2",
        "type"    => "select",
        "options" => $wp_posts,  
        "std"     => ""
  ),

  array(
        "name"    => "#3 contenido destacado", 
        "desc"    => "",  
        "id"      => "pleroma_boletin_featured_3",
        "type"    => "select",
        "options" => $wp_posts,  
        "std"     => ""
  ),

  array(
        "name"    => "#4 contenido destacado", 
        "desc"    => "",  
        "id"      => "pleroma_boletin_featured_4",
        "type"    => "select",
        "options" => $wp_posts,  
        "std"     => ""
  ),

  array(
        "name"    => "#5 contenido destacado", 
        "desc"    => "",  
        "id"      => "pleroma_boletin_featured_5",
        "type"    => "select",
        "options" => $wp_posts,  
        "std"     => ""
  ),

  array( "type" => "close")

  );

  $options = array_merge($options, $boletin);

}



function pleroma_admin_menu ()
{

  global $options;  
     
  

  if ( isset($_REQUEST['page']) && 'pleroma_admin_home' == $_REQUEST['page'] )
  {
      
    if ( isset($_REQUEST['action']) && 'save' == $_REQUEST['action'] )
    {  
      
   
        foreach ($options as $value)
        {  
          update_option( $value['id'], $_REQUEST[ $value['id'] ] );
        }  
     
        foreach ($options as $value) {
          if( isset( $_REQUEST[ $value['id'] ] ) )
          {
            update_option( $value['id'], $_REQUEST[ $value['id'] ]  );
          } else
          {
            delete_option( $value['id'] );
          }
        }  
       
        header("Location: admin.php?page=pleroma_admin_home&saved=true");  
        die;  

    } else if( isset($_REQUEST['action']) && 'reset' == $_REQUEST['action'] )
    {
       
        foreach ($options as $value)
        {  
          delete_option( $value['id'] );
        } 
       
        header("Location: admin.php?page=pleroma_admin_home&reset=true");  
        die;  
    }
  }

  add_theme_page( 'Pleroma', 'Pleroma', 'switch_themes', 'pleroma_admin_home', 'pleroma_admin_home');
    
}

function pleroma_add_init() {
  wp_enqueue_style("functions", get_template_directory_uri() . "/css/admin.css");
}  


function pleroma_admin_home() {
  global $options;

    if ( isset($_REQUEST['saved']) )
      echo '<div id="message" class="updated fade"><p><strong>Opciones guardadas.</strong></p></div>';

    if ( isset($_REQUEST['reset']) )
      echo '<div id="message" class="updated fade"><p><strong>Valores predeterminados guardados.</strong></p></div>'; 

  $format = '
              <div class="wrap rm_wrap">
                <h2>%1$s. Opciones del sitio</h2>
                <div class="rm_opts">
                  <form method="post">

            ';
  
  printf($format, 'Pleroma Theme', get_bloginfo('name'));

  $i = 0;

  foreach ($options as $value)
  {
    switch ( $value['type'] )
    { 
      case 'open': break;
      case "close":
        print '
                  </div>  
                </div>  
                <br />';
      break;

      case "text":

        $format = '
                    <div class="rm_input rm_text">  
                      <label for="%1$s">%3$s</label>  
                      <input name="%1$s" id="%1$s" type="%2$s" value="%5$s" />  
                      <small>%4$s</small>
                    </div>
                  ';

        $default  = get_settings( $value['id'] )
                  ? stripslashes(get_settings( $value['id'] ))
                  : $value['std'];

        printf( $format, $value['id'], $value['type'], $value['name'], $value['desc'], $default );

      break;

      case 'textarea':
        $format = '
                    <div class="rm_input rm_textarea">  
                      <label for="%1$s">%3$s</label>  
                      <textarea name="%1$s" type="%2$s" cols="" rows="">%5$s</textarea>  
                      <small>%4$s</small>
                    </div>
                  ';

        $default  = get_settings( $value['id'] )
                  ? stripslashes(get_settings( $value['id'] ))
                  : $value['std'];

        printf( $format, $value['id'], $value['type'], $value['name'], $value['desc'], $default );

      break;

      case 'select':

        $format = '
                    <div class="rm_input rm_select">  
                      <label for="%1$s">%2$s</label>  
                      <select name="%1$s" id="%1$s">  
                        %4$s
                      </select>
                      <small>%3$s</small>
                    </div>
                  ';
        if ( is_array( $value['options'] ) )
        {
          $options_select = '';
          foreach ($value['options'] as $id => $option)
          {
            $selected = (get_settings( $value['id'] ) == $id)
                      ? ' selected="selected"'
                      : '';
            $options_select .= "<option value=\"$id\"$selected>$option</option>\n";
          }
        }

        printf( $format, $value['id'], $value['name'], $value['desc'], $options_select );

      break;

      case 'checkbox':
        $format = '
                    <div class="rm_input rm_checkbox">  
                      <label for="%1$s">%2$s</label>  
                      <input type="checkbox" name="%1$s" id="%1$s" value="true" %4$s/>  
                      <small>%3$s</small>
                    </div>
                  ';
        $checked = get_option($value['id'])
                  ? 'checked="checked"'
                  : '';
        printf( $format, $value['id'], $value['name'], $value['desc'], $checked );

      break;


      case "section":  
        $i++;

        print '
              <div class="rm_section">  
              <div class="rm_title">
                <h3>'. $value['name'] .'</h3>
                <span class="submit">
                  <input name="save'. $i .'" type="submit" value="Guardar cambios" />  
                </span>
              </div>  
              <div class="rm_options">  
              ';
      break;

    }

  }

  print '
                    <input type="hidden" name="action" value="save" />  
                  </form>

                  <form method="post">  
                    <p class="submit">  
                      <input name="reset" type="submit" value="Reset" />  
                      <input type="hidden" name="action" value="reset" />  
                    </p>  
                  </form> 
               </div>

            ';

}


