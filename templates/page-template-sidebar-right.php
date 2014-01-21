<?php
/*
  Template Name: Columna derecha
*/
?>

<?php get_header(); ?>

<!-- .container -->
<div class="container">
  <!-- .row -->
  <div class="row">
    <!-- #main.col-md-8.col-lg-9 -->
    <div id="main" role="main" class="col-md-8 col-lg-9">
      <?php

        // Get partial of single page
        get_template_part( 'partials/content-page', 'single' );

      ?>
    </div><!-- /#main.col-md-8.col-lg-9 -->

    <!-- .col-md-4.col-lg-3 -->
    <div class="col-md-4 col-lg-3">
      <?php

        // Sidebars depending on current blog
        if( is_main_site() ) {

          // Displays "Sidebar Page 2" in parent blog
          get_sidebar( 'page-2' );

        } else {

          // Displays "Sidebar 2" in child blog
          get_sidebar( 2 );

        }

      ?>
    </div><!-- /.col-md-4.col-lg-3 -->
  </div><!-- /.row -->
</div><!-- /.container -->

<?php get_footer(); ?>
