<?php get_header(); ?>

        <div class="container-fluid">
      
          <div id="main" class="span6" role="main">
        
            <h1 class="lead h4"><span><?php _e("Buscar por:", "pleromabootstrap"); ?></span> <?php echo esc_attr(get_search_query()); ?></h1>
            
              <?php get_template_part( 'archive', 'single' ); ?>
              
              <?php page_navi(); ?>    

              <?php if (!have_posts()) : ?>
          
                  <div class="well">
                    <h1 class="lead"><?php _e("Disculpa, no hay resultados.", "pleromabootstrap"); ?></h1>
                    <p><?php _e("Intenta de nuevo la búsqueda.", "pleromabootstrap"); ?></p>
                  </div><!-- /.well -->
          
              <?php endif; ?>
      
            </div> <!-- end #main -->

            <div class="span3">
              <?php get_sidebar(1); // sidebar 1 ?>
            </div><!-- /.span3 -->

            <div class="span3">
              <?php get_sidebar(2); // sidebar 2 ?>
            </div><!-- /.span3 -->

          </div> <!-- /.container-fluid -->

<?php get_footer(); ?>