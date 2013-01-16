<?php
/*
Template Name: Páginas (sidebar izquierdo)
*/
?>

<?php get_header(); ?>

        <div class="container-fluid">

          <div class="span3">
            <?php get_sidebar('page-1'); // sidebar page 1 ?>
          </div><!-- /.span3 -->

          <div id="main" role="main" class="span9">
            <?php get_template_part( 'page', 'single' ); ?>
          </div><!-- /.span9 -->

        </div><!-- /.container-fluid -->

<?php get_footer(); ?>