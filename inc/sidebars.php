<?php

  // Register sidebars
  function pleroma_register_sidebars() {

    // Sidebar 1
    register_sidebar(
      array(
        'id'            => 'sidebar-1',
        'name'          => 'Sidebar 1',
        'description'   => 'Sidebar 1',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>'
      )
    );

    // Sidebar 2
    register_sidebar(
      array(
        'id'            => 'sidebar-2',
        'name'          => 'Sidebar 2',
        'description'   => 'Sidebar 2',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>'
      )
    );

    // Bottom
    register_sidebar(
      array(
        'id'            => 'bottom',
        'name'          => 'Bottom',
        'description'   => 'Bottom',
        'before_widget' => '<div id="%1$s" class="widget %2$s col-sm-6 col-md-4 col-lg-3">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>'
      )
    );

    // Only apply to parent blog
    if ( is_main_site() ) {

      // Sidebar Page 1
      register_sidebar(
        array(
          'id'            => 'sidebar-page-1',
          'name'          => 'Sidebar Page 1',
          'description'   => 'Sidebar Page 1',
          'before_widget' => '<div id="%1$s" class="widget %2$s">',
          'after_widget'  => '</div>',
          'before_title'  => '<h4 class="widget-title">',
          'after_title'   => '</h4>'
        )
      );

      // Sidebar Page 2
      register_sidebar(
        array(
          'id'            => 'sidebar-page-2',
          'name'          => 'Sidebar Page 2',
          'description'   => 'Sidebar Page 2',
          'before_widget' => '<div id="%1$s" class="widget %2$s">',
          'after_widget'  => '</div>',
          'before_title'  => '<h4 class="widget-title">',
          'after_title'   => '</h4>'
        )
      );

      // Sidebar Info 1
      register_sidebar(
        array(
          'id'            => 'sidebar-info-1',
          'name'          => 'Sidebar Info 1',
          'description'   => 'Sidebar Info 1',
          'before_widget' => '<div id="%1$s" class="widget %2$s">',
          'after_widget'  => '</div>',
          'before_title'  => '<h4 class="widget-title">',
          'after_title'   => '</h4>'
        )
      );

      // Sidebar Info 2
      register_sidebar(
        array(
          'id'            => 'sidebar-info-2',
          'name'          => 'Sidebar Info 2',
          'description'   => 'Sidebar Info 2',
          'before_widget' => '<div id="%1$s" class="widget %2$s">',
          'after_widget'  => '</div>',
          'before_title'  => '<h4 class="widget-title">',
          'after_title'   => '</h4>'
        )
      );

      // Sidebar Home
      register_sidebar(
        array(
          'id'            => 'sidebar-home',
          'name'          => 'Sidebar Home',
          'description'   => 'Sidebar Home',
          'before_widget' => '<div id="%1$s" class="widget %2$s">',
          'after_widget'  => '</div>',
          'before_title'  => '<h4 class="widget-title">',
          'after_title'   => '</h4>'
        )
      );

    }

  }
