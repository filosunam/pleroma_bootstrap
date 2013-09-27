<?php get_header(); ?>
      
<div class="row-fluid">

  <?php if( get_current_blog_id() != 1 ) { ?>

  <div class="span3">
    <?php get_sidebar(1); // sidebar 1 ?>
  </div> <!-- /.span3 -->        

  <div id="main" class="span6" role="main">
    <?php get_template_part( 'single', 'part' ); ?>
  </div> <!-- /.span6#main -->

  <div class="span3">
    <?php get_sidebar(2); // sidebar 2 ?>
  </div> <!-- /.span3 -->

  <?php } else { ?>

  <div id="main" class="span6" role="main">
    <?php get_template_part( 'single', 'part' ); ?>
  </div> <!-- /.span6#main -->
  
  <div class="span3">
    <?php get_sidebar(1); // sidebar 1 ?>
  </div> <!-- /.span3 -->

  <div class="span3">
    <?php get_sidebar(2); // sidebar 2 ?>
  </div> <!-- /.span3 -->

  <?php } ?>

</div> <!-- /.row-fluid -->

<?php get_footer(); ?>
