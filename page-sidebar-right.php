<?php
/*
Template Name: Páginas (sidebar derecho)
*/
?>

<?php get_header(); ?>

<div class="row-fluid">

  <div id="main" role="main" class="span9">
    <?php get_template_part( 'page', 'single' ); ?>
  </div><!-- /.span9 -->

  <div class="span3">
    <?php
      if( get_current_blog_id() > 1 )
      {
        get_sidebar(2);        // sidebar 2
      } else
      {
        get_sidebar('page-2'); // sidebar page 2
      }
    ?>
  </div><!-- /.span3 -->

</div><!-- /.row-fluid -->

<?php get_footer(); ?>
