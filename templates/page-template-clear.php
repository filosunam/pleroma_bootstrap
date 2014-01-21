<?php
/*
  Template Name: Sin columnas
*/
?>

<?php get_header(); ?>

<!-- .container -->
<div class="container">
  <!-- #main -->
  <div id="main" role="main">
    <?php

      // Get partial of single page
      get_template_part( 'partials/content-page', 'single' );

    ?>
  </div><!-- /#main -->
</div><!-- /.container -->

<?php get_footer(); ?>
