<?php
/*
  Template Name: Cuatro columnas
*/
?>

<?php get_header(); ?>

<!-- .container -->
<div class="container">
  <!-- .row -->
  <div class="row">
    <!-- #main.col-md-8.col-lg-6 -->
    <div id="main" role="main" class="col-md-8 col-lg-6">
      <?php

        // Get partial of single page
        get_template_part( 'partials/content-page', 'single' );

      ?>
      <!-- .row -->
      <div class="row">
        <!-- .col-sm-6 -->
        <div class="col-sm-6">
          <?php

            // Sidebar Info 1
            get_sidebar( 'info-1' );

          ?>
        </div><!-- /.col-sm-6 -->

        <!-- .col-sm-6 -->
        <div class="col-sm-6">
          <?php

            // Sidebar Info 2
            get_sidebar( 'info-2' );

          ?>
        </div><!-- /.col-sm-6 -->
      </div><!-- /.row -->
    </div><!-- /#main.col-md-8.col-lg-6 -->
    
    <!-- .col-md-4.col-lg-6 -->
    <div class="col-md-4 col-lg-6 hidden-xs">
      <!-- .row -->
      <div class="row">    
        <!-- .col-sm-6.col-md-12.col-lg-6 -->
        <div class="col-sm-6 col-md-12 col-lg-6">
          <?php

            // Sidebar 1
            get_sidebar( 1 );

          ?>
        </div><!-- /.col-sm-6.col-md-12.col-lg-6 -->

        <!-- .col-sm-6.col-md-12.col-lg-6 -->
        <div class="col-sm-6 col-md-12 col-lg-6">
          <?php

            // Sidebar 2
            get_sidebar( 2 );

          ?>
        </div><!-- /.col-sm-6.col-md-12.col-lg-6 -->
      </div><!-- /.row -->
    </div><!-- /.col-md-4.col-lg-6 -->
  </div><!-- /.row -->
</div><!-- /.container -->

<?php get_footer(); ?>
