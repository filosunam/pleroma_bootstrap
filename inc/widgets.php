<?php

  // Slider
  require get_template_directory() . '/inc/widgets/slider.php';

  // Navbar
  require get_template_directory() . '/inc/widgets/navbar.php';

  // Remove default widgets
  function pleroma_remove_widgets(){

    // Search form
    unregister_widget( 'WP_Widget_Search' );

    // Meta
    unregister_widget( 'WP_Widget_Meta' );

    // Recent comments
    unregister_widget( 'WP_Widget_Recent_Comments' );

  }
