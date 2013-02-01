          <?php global $blog_id; ?>
          <?php
            if ( $blog_id > 1 )
            {
              wp_nav_menu(array( 
                  'theme_location'  => 'primary'                  
                , 'container'       => false                      
                , 'depth'           => 2                          
                , 'items_wrap'      => '<ul class="nav nav-tabs nav-stacked">%3$s</ul>'
                , 'fallback_cb'     => 'pleroma_nav_menu_args'
              ));
            }
          ?>
          <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>

            <?php dynamic_sidebar( 'sidebar-1' ); ?>
            
          <?php endif; ?>