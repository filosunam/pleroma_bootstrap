<?php
/*
Template Name: Páginas (sidebar izquierdo)
*/
?>

<?php get_header(); ?>
<?php global $blog_id; ?>

        <div class="row-fluid">

          <div class="span3">
            <?php
              if( $blog_id > 1 )
              {
                get_sidebar(1);        // sidebar 1
              } else
              {
                get_sidebar('page-1'); // sidebar page 1
              }
            ?>
          </div><!-- /.span3 -->

          <div id="main" role="main" class="span9">
            <?php get_template_part( 'page', 'single' ); ?>
          </div><!-- /.span9 -->

        </div><!-- /.row-fluid -->

<?php get_footer(); ?>