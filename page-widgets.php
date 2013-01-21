<?php
/*
Template Name: Páginas (widgets)
*/
?>

<?php get_header(); ?>

        <div class="container-fluid">
          
            <div id="main" role="main" class="span6">

              <?php get_template_part( 'page', 'single' ); ?>

              <div class="row-fluid">

                <div class="span6">
                  <?php get_sidebar('info-1'); // sidebar info 1 ?>
                </div>

                <div class="span6">
                  <?php get_sidebar('info-2'); // sidebar info 1 ?>
                </div>
                
              </div>

            </div><!-- /.span6 -->
              
            <div class="span3">
              <?php get_sidebar(1); // sidebar info 1 ?>
            </div><!-- /.span3 -->

            <div class="span3">
              <?php get_sidebar(2); // sidebar info 2 ?>
            </div><!-- /.span3 -->

        </div><!-- /.container-fluid -->              

<?php get_footer(); ?>