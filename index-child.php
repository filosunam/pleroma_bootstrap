<?php get_header(); ?>

        <div class="row-fluid">
          <div class="span3">
            <?php
              wp_nav_menu(array( 
                  'theme_location'  => 'primary'                  
                , 'container'       => false                      
                , 'depth'           => 2                          
                , 'items_wrap'      => '<ul class="nav nav-tabs nav-stacked">%3$s</ul>'
                , 'fallback_cb'     => 'pleroma_nav_menu_args'
              ));
            ?>
            <?php get_sidebar(1); // sidebar page 1 ?>
          </div>
          <div class="span9">
            
          </div>
        </div>
<?php get_footer(); ?>