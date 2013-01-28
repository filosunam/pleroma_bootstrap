<?php get_header(); ?>
        
        <div class="row-fluid">
          <div class="span9">
            
          <?php

            $category_slides = get_option('pleroma_home_slider');

            if( is_home() && $category_slides ) : 

              $query = new wp_query(array(
                'cat' => $category_slides,
                'posts_per_page' => 8        
              ));

              if ( $query->post_count > 0 ) :

          ?>
            <div id="myCarousel" class="carousel carousel-fade slide">
              <div class="carousel-inner">
                <?php

                  $i = 0; while ( $query->have_posts() ) : $i++;

                    $active = ($i == 1) ? 'active ' : '';
                    $query->the_post();

                ?>
                <div class="<?php print $active ?>item">
                  <?php 
                    if ( has_post_thumbnail() ) {
                      $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
                      echo '<img src="' . $large_image_url[0] . '" alt="' . the_title_attribute('echo=0') . '">';
                    }
                  ?>
                  <div class="carousel-caption">
                    <p><?php the_title() ?></p>
                  </div>
                </div>
                <?php endwhile; ?>
              </div>

              <?php if ( $query->post_count > 1 ) : ?>
              <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
              <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
              <?php endif; ?>
            
            </div>
            <?php endif; // end if slides > 0 ?>
          <?php endif; // end if home ?>

          </div>

          <div class="span3">
            
            <?php if ( has_nav_menu( 'secondary' ) ) : ?>
            <nav class="nav-info">
              <h4>Información</h4>
              <?php pleroma_secondary_nav() ?>
            </nav>
            <?php endif; // has_nav_menu ?>
            
            <p style="background: #464C5D; color: white; list-style: none; padding: 10px 0; text-align: center;">365 graduados licenciatura</p>
            <p style="background: #464C5D; color: white; list-style: none; padding: 10px 0; text-align: center">330 graduados posgrado</p>
            <p>
              <a class="btn btn-large btn-secondary btn-block" href="/cat/boletin"><?php echo __('Boletín', 'pleromabootstrap'); ?></a>
              <a class="btn btn-medium btn-primary btn-block" href="http://estacionamiento.filos.unam.mx">Tarjeta de estacionamiento</a>
            </p>
          </div>
        </div>  

        <div class="row-fluid">
          <div class="span12">

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
          <?php endforeach; ?>
          <?php endif; // if is array $ids ?>
        </div>
      </div>

<?php get_footer(); ?>