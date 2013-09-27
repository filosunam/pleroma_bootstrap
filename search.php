<?php get_header(); ?>

        <div class="row-fluid">
        <?php if ( get_current_blog_id() == 1 ) { ?>

          <div id="main" class="span6" role="main">
      
            <h1 class="lead h4"><span><?php _e('Search for:'); ?></span> <?php echo esc_attr(get_search_query()); ?></h1>
          
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
            
        <?php } else { ?>

          <div class="span3">
            <?php get_sidebar(1); // sidebar 1 ?>
          </div><!-- /.span3 -->

          <div id="main" class="span6" role="main">
      
            <h1 class="lead h4"><span><?php _e('Search for:'); ?></span> <?php echo esc_attr(get_search_query()); ?></h1>
          
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
            <?php get_sidebar(2); // sidebar 2 ?>
          </div><!-- /.span3 -->

        <?php } ?>
        </div> <!-- /.row-fluid -->

<?php get_footer(); ?>
