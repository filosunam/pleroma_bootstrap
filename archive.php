<?php get_header(); ?>
<?php global $blog_id; ?>

        <div class="row-fluid">
        <?php if( $blog_id > 1 ) { ?>

            <div class="span3">
              <?php get_sidebar(1); // sidebar 1 ?>
            </div> <!-- /.span3 -->

            <div id="main" class="span6" role="main">
              <?php get_template_part( 'archive', 'single' ); ?>
              <?php page_navi(); ?>
            </div> <!-- /.span6#main -->

            <div class="span3">
              <?php get_sidebar(2); // sidebar 2 ?>
            </div> <!-- /.span3 -->

        <?php } else { ?>
        
            <div id="main" class="span6" role="main">
              <?php get_template_part( 'archive', 'single' ); ?>
              <?php page_navi(); ?>
            </div> <!-- /.span6#main -->
    
            <div class="span3">
              <?php get_sidebar(1); // sidebar 1 ?>
            </div> <!-- /.span3 -->

            <div class="span3">
              <?php get_sidebar(2); // sidebar 2 ?>
            </div> <!-- /.span3 -->
                
        <?php } ?>
        </div> <!-- /.container-fluid -->

<?php get_footer(); ?>