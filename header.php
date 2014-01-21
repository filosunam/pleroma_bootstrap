<!doctype html>
<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
<html>
<head>
  <meta charset="utf-8">
  <title><?php

    global $paged;

    // Set empty variable
    $page_title = '';

    // Add page numeral if needed
    if ( $paged > 1 ) {
      $page_title = '&lsaquo; ' . sprintf( __( 'Página %s', 'pleromabootstrap' ), $paged ) . ' |';
    }

    // Add page title
    wp_title( $page_title ? $page_title : '|', true, 'right' );

    // Add sitename
    bloginfo( 'name' );

  ?></title>
  <!-- Google Chrome Frame for IE -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <!-- Mobile meta -->
  <meta name="HandheldFriendly" content="True">
  <meta name="MobileOptimized" content="320">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Favicon -->
  <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
  <!-- Pingback -->
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
  <!-- Wordpress head -->
  <?php wp_head(); ?>
</head>
<body class="home blog">
  <?php if ( has_nav_menu( 'secondary' ) || ! is_main_site() ) : ?>
    <nav class="navbar navbar-inverse navbar-static-top <?php if ( is_main_site() && is_home() ) print 'visible-xs visible-sm' ?>" role="navigation">
      <div class="container">      
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#secondary-navbar-collapse">
            <span class="sr-only">Navegación</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <span class="navbar-brand">
            <?php
              
              // Switch to parent blog
              if ( ! is_main_site() )
                switch_to_blog( 1 );

              // Get menu locations
              $menus = get_nav_menu_locations();

              // Check if secondary nav exists
              if ( isset( $menus['secondary'] ) ) {
                $menu = wp_get_nav_menu_object( $menus['secondary'] );
                echo $menu->name;
              }

              // Restore to child blog
              if ( ! is_main_site() )
                restore_current_blog();

            ?>
          </span>
        </div>

        <div class="collapse navbar-collapse" id="secondary-navbar-collapse">
          <?php
            
            // Use empty string for avoiding default classes
            pleroma_secondary_nav( 'navbar-nav' );

          ?>
        </div>
      </div>
    </nav>
  <?php endif; ?>

  <!-- #header -->
  <div id="header" class="container">
    <div class="row">
      <!-- .col-xs-6 (logo unam) -->
      <div class="col-xs-6">
        <a href="http://www.unam.mx" rel="nofollow" class="logo unam">Universidad Nacional Autónoma de México</a>
      </div><!-- /.col-xs-6 -->

      <!-- .col-xs-6 (logo filosunam) -->
      <div class="col-xs-6">
        <?php if( ! is_main_site() ) : ?> 
        <a href="http://www.filos.unam.mx" rel="nofollow" class="logo filosunam">Facultad de Filosofía y Letras, UNAM</a>
        <?php else : ?>
        <a href="<?php echo get_option( 'siteurl' ) ?>" rel="home" class="logo filosunam"><?php echo get_option( 'blogname' ) ?></a>
        <?php endif; ?>
      </div><!-- /.col-xs-6 -->
    </div>
  </div><!-- /#header -->

  <div class="container">
    <!-- .navbar-primary -->
    <nav class="navbar navbar-default navbar-primary" role="navigation">
      <!-- .navbar-header -->
      <div class="navbar-header">
        <a class="navbar-brand visible-xs" href="http://www.filos.unam.mx">Facultad de Filosofía y Letras</a>
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#primary-navbar-collapse">
          <span class="sr-only">Navegación</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div><!-- /.navbar-header -->
      
      <!-- .navbar-collapse -->
      <div class="collapse navbar-collapse" id="primary-navbar-collapse">
        <?php

          // Displays primary nav
          pleroma_primary_nav();

          // Displays search form
          get_search_form();

        ?>
      </div><!-- /.navbar-collapse -->
    </nav><!-- /.navbar-primary -->
    
    <?php

      // Displays blog name of child blog
      if ( ! is_main_site() ) {

        // Displays the blogname
        echo '<div class="page-header page-childblog col-md-9 col-md-offset-3 hidden-xs">'
            . '<h1 class="h3">' . get_option( 'blogname' ) . '</h1>'
            . '</div>';

      } else {

        // Displays the breadcrumb
        the_breadcrumb();

      }

    ?>
  </div>

