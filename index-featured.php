          <?php
            
            $manual            = get_option('pleroma_home_manual');
            $category_featured = get_option('pleroma_home_featured');

            if ( $manual ) {
              $ids = array(
                        get_option('pleroma_home_featured_1')
                      , get_option('pleroma_home_featured_2')
                      , get_option('pleroma_home_featured_3')
                      , get_option('pleroma_home_featured_4')
                    );
              
              $ids = array_filter($ids); // remove nulls

            } else
            {
              $query = new wp_query(array(
                  'cat' => $category_featured
                , 'posts_per_page' => 4
              ));

              $ids = array();
              while($query->have_posts()):
                $query->the_post();
                $ids[] = get_the_ID();
              endwhile;
            }

            if ( is_array($ids) ) :
              foreach( $ids as $id ) :

                $post = get_post( $id );
             
          ?>
          
            <div id="post-<?php the_ID(); ?>" role="article" class="span3">
              <header class="article-header">
                  <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                    <?php the_post_thumbnail( 'small' ); ?>
                  </a>
                <h4>
                  <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                    <?php the_title(); ?>
                  </a>
                </h4>    
              </header> <!-- end article header -->
              <?php the_excerpt(); ?>
            </div> <!-- end article -->
            <hr class="hidden-desktop">
          <?php endforeach; ?>
          <?php endif; // if is array $ids ?>