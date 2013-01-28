<?php
/*
Template Name: Páginas (sidebar derecho)
*/
?>

<?php get_header(); ?>

        <div class="container-fluid">

          <div id="main" role="main" class="span9">
            <?php get_template_part( 'page', 'single' ); ?>
          </div><!-- /.span9 -->

          <div class="span3">
            <?php get_sidebar('page-2'); // sidebar page 2 ?>
          </div><!-- /.span3 -->

        </div><!-- /.container-fluid -->

<?php get_footer(); ?>