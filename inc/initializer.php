<?php

  // Initialize!
  add_action( 'after_setup_theme', 'pleroma_initializer', 1 );

  // Initializer
  function pleroma_initializer() {

    // After switch theme
    add_action( 'after_switch_theme', 'pleroma_after_switch_theme' );

    // After setup theme
    add_action( 'after_setup_theme', 'pleroma_after_setup_theme' );

    // Head cleanup
    add_action( 'init', 'pleroma_head_cleanup' );

    // Remove version
    add_filter( 'the_generator', 'pleroma_remove_version_rss' );

    // Scripts and styles
    add_action( 'wp_enqueue_scripts', 'pleroma_assets', 999 );

    // Set up sidebars
    add_action( 'widgets_init', 'pleroma_register_sidebars' );

    // Remove default widgets
    add_action( 'widgets_init', 'pleroma_remove_widgets' );

    // Set up images
    add_action( 'init', 'pleroma_images' );

    // Set up languages
    add_action( 'init', 'pleroma_languages' );

  }

  // After to switch theme
  function pleroma_after_switch_theme() {
    
    // Flush rewrite rules
    flush_rewrite_rules();

  }

  // After theme support
  function pleroma_after_setup_theme() {

    // RSS
    add_theme_support('automatic-feed-links');

    // Add menus support
    add_theme_support( 'menus' );

    // Add post formats
    add_theme_support( 'post-formats', array( 'link', 'image', 'audio', 'video' ) );

    // Register Nav Menus
    pleroma_register_nav_menus();

  }

  // Remove Wordpress version of RSS Feeds
  function pleroma_remove_version_rss() {
    return false;
  }

  // Clean head element
  function pleroma_head_cleanup(){

    // Rsd link
    remove_action( 'wp_head', 'rsd_link' );
    
    // Windows live writer
    remove_action( 'wp_head', 'wlwmanifest_link' );

    // Index link
    remove_action( 'wp_head', 'index_rel_link' );
    
    // Previous link
    remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
    
    // Start link
    remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );

    // Links for adjacent posts
    remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );

    // Remove Wordpress version
    remove_action( 'wp_head', 'wp_generator' );

  }

  // Enqueue assets for the front end
  function pleroma_assets() {
    
    if ( ! is_admin () ) {

      // Asset format (css and js files)
      $asset = get_stylesheet_directory_uri() . '/%2$s/%1$s.%2$s';

      // Register main styles
      wp_register_style( 'pleroma_style', sprintf( $asset, 'style', 'css' ) );
      
      // Enqueue main styles
      wp_enqueue_style( 'pleroma_style' );

      // Register bootstrap scripts
      wp_register_script( 'bootstrap', get_stylesheet_directory_uri() . '/components/bootstrap/dist/js/bootstrap.min.js', array( 'jquery' ), false, true );

      // Register main scripts
      wp_register_script( 'pleroma_script', sprintf( $asset, 'pleroma.min', 'js' ), array( 'jquery', 'bootstrap' ), false, true );

      // Enqueue bootstrap scripts
      wp_enqueue_script( 'bootstrap' );

      // Enqueue main scripts
      wp_enqueue_script( 'pleroma_script' );

    }

  }

  // Set up images
  function pleroma_images() {
    
    // Add thumbnails support
    add_theme_support( 'post-thumbnails' );

    // Add small size
    add_image_size( 'small', 347, 161, 1 );

    // Update thumbnail size
    update_option( 'thumbnail_size_w', 125 );
    update_option( 'thumbnail_size_h', 125 );
    update_option( 'thumbnail_crop', 1 );

    // Update medium size
    update_option( 'medium_size_w', 700 );
    update_option( 'medium_size_h', 322 );
    update_option( 'medium_crop', 1 );

    // Update large size
    update_option( 'large_size_w', 870 );
    update_option( 'large_size_h', 403 );
    update_option( 'large_crop', 1 );

  }

  // Add language support
  function pleroma_languages() {

    // Set languages directory
    load_theme_textdomain( 'pleromabootstrap', get_template_directory() . '/languages' );

  }
