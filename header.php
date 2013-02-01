<!doctype html>
<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
<html>
<head>
  <meta charset="utf-8">
  <title><?php

    global $page, $paged;

    // Add page numeral if needed
    if ( $paged > 1 || $page > 1 )
      $page_title = '&lsaquo; ' . sprintf( __( 'Página %s', 'pleromabootstrap' ), max( $paged, $page ) ) . ' |';

    // Add page title
    wp_title( $page_title ? $page_title : '|', true, 'right' );

    // Add sitename
    bloginfo( 'name' );

  ?></title>

  <!-- Google Chrome Frame for IE -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <!-- mobile meta -->
  <meta name="HandheldFriendly" content="True">
  <meta name="MobileOptimized" content="320">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- icons & favicons -->
  <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
  
  <!-- pingback -->
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

  <!-- wordpress head -->
    <?php wp_head(); ?>

  <!-- end wordpress head -->
</head>
<body class="home blog">

  <?php if( !is_home() && has_nav_menu( 'secondary' ) ) : ?>   
    <div class="navbar navbar-inverse navbar-static-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse-secondary">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>

          <a class="brand">Información</a>

          <div class="nav-collapse nav-collapse-secondary collapse">
            <?php pleroma_secondary_nav(''); ?>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>

  <div class="container">
    <div class="row">
      <div class="span12">

        <!-- header -->
        <div class="row-fluid">
          <div class="logo pull-left">
            <a href="http://www.unam.mx" class="unam"></a>
          </div>
          <div class="logo pull-right">
            <a href="http://www.filos.unam.mx" class="ffyl"></a>
          </div>
        </div>
        <!-- end header -->

        <!-- navigation -->
        <div class="row-fluid">
          <div class="navbar navbar-primary span12">
            <div class="navbar-inner">
              <div class="container">

                <a class="btn btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse-primary">
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </a>

                <a class="brand" href="/"><?php bloginfo( 'name' ); ?></a>

                <div class="nav-collapse nav-collapse-primary collapse">
                  <?php get_search_form(); ?>
                  <?php pleroma_primary_nav(); ?>
                </div>
              </div>
            </div>
          </div><!--/.navbar -->
        </div>
        <!-- end navigation -->

        <!-- content -->
        <div class="row-fluid">
          <?php the_breadcrumb(); ?>

          <?php
            global $blog_id;
            if ( $blog_id > 1 ) {
          ?>
          <div class="row-fluid">
            <div class="span12">
              <div class="offset3">
                <h3><a href="<?php bloginfo('url') ?>"><?php bloginfo('name') ?></a></h3>
              </div>
              <hr>
            </div>
          </div>
          <?php } ?>