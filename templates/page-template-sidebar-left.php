<?php
/*
  Template Name: Columna izquierda
*/
?>

<?php get_header(); ?>

<!-- .container -->
<div class="container">
  <!-- .row -->
  <div class="row">
    <!-- .col-md-4.col-lg-3 -->
    <div class="col-md-3">
      <?php

        // Sidebars depending on current blog
        if( is_main_site() ) {

          // Displays "Sidebar Page 1" in parent blog
          get_sidebar( 'page-1' );

        } else {

          // Displays "Sidebar 1" in child blog
          get_sidebar( 1 );

        }

      ?>
    </div><!-- /.col-md-4.col-lg-3 -->

    <!-- #main.col-md-8.col-lg-9 -->
    <div id="main" role="main" class="col-md-9">
      <?php

        if ( ! is_main_site() ) {

          // Displays the breadcrumb
          the_breadcrumb();

        }

        // Get partial of single page
        get_template_part( 'partials/content-page', 'single' );

      ?>
    </div><!-- /#main.col-md-8.col-lg-9 -->
  </div><!-- /.row -->
</div><!-- /.container -->

<?php get_footer(); ?>
