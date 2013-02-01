<?php get_header(); ?>
<?php global $blog_id; ?>

        <div class="row-fluid">

          <?php if( $blog_id > 1 ) { // if child blog?>

          
          <?php } else { // if parent blog ?>

          <div id="main" role="main" class="span6">
            <?php get_template_part( 'page', 'single' ); ?>
          </div><!-- /.span6#main -->

          <div class="span3">
            <?php get_sidebar('page-1'); // sidebar page 1 ?>
          </div><!-- /.span3 -->

          <div class="span3">
            <?php get_sidebar('page-2'); // sidebar page 2 ?>
          </div><!-- /.span3 -->

          <?php } ?>

          <div class="span3">
            <?php get_sidebar(1); // sidebar 1 ?>
          </div><!-- /.span3 -->

          <div id="main" role="main" class="span6">
            <?php get_template_part( 'page', 'single' ); ?>
          </div><!-- /.span6#main -->

          <div class="span3">
            <?php get_sidebar(2); // sidebar 2 ?>
          </div><!-- /.span3 -->

        </div><!-- /.container-fluid -->

<?php get_footer(); ?>