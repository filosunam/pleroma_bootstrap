<?php

  // If you've problems with Wordpress: GIYF, don't forget it!

  // Initializer
  require get_template_directory() . '/inc/initializer.php';

  // Navigation
  require get_template_directory() . '/inc/navigation.php';

  // Sidebars
  require get_template_directory() . '/inc/sidebars.php';

  // Widgets
  require get_template_directory() . '/inc/widgets.php';

  // Content
  require get_template_directory() . '/inc/content.php';

  // Backend
  require get_template_directory() . '/inc/backend.php';

  // Extra
  require get_template_directory() . '/inc/extra.php';


  // For web development purposes
  if ( $_SERVER["SERVER_ADDR"] == '127.0.0.1' ) {

    // Set livereload only in the front end
    if ( ! is_admin () ) {

      // Add to init hook
      add_action( 'init', 'register_livereload' );

      // Register livereload
      function register_livereload() {
        
        // Register livereload script (Take a look to Gruntfile.js for more info)
        wp_register_script( 'livereload', 'http://localhost:35729/livereload.js' );
        
        // Enqueue livereload script
        wp_enqueue_script( 'livereload' );

      }

    }

  }
