          <?php
            if ( get_current_blog_id() > 1 )
            {
              wp_nav_menu(array( 
                  'theme_location'  => 'primary'                  
                , 'container'       => false                      
                , 'depth'           => 3                          
                , 'items_wrap'      => '<ul class="nav nav-tabs nav-stacked">%3$s</ul>'
                , 'fallback_cb'     => 'pleroma_nav_menu_args'
              ));
            }
          ?>
          <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>

            <?php dynamic_sidebar( 'sidebar-1' ); ?>
            
          <?php endif; ?>