<?php
/*
Template Name: Páginas principales
*/
?>

<?php get_header(); ?>

<div class="row-fluid">

  <div class="span3">
    <?php get_sidebar('page-1'); // sidebar page 1 ?>
  </div><!-- /.span3 -->

  <div id="main" role="main" class="span6">
    <?php get_template_part( 'page', 'single' ); ?>
  </div><!-- /.span6 -->

  <div class="span3">
    <?php get_sidebar('page-2'); // sidebar page 2 ?>
  </div><!-- /.span3 -->

</div><!-- /.row-fluid -->

<?php get_footer(); ?>
