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
            
            <p style="background: #464C5D; color: white; list-style: none; padding: 10px 0; text-align: center;">648 graduados licenciatura (2012)</p>
            <p style="background: #464C5D; color: white; list-style: none; padding: 10px 0; text-align: center">594 graduados posgrado (2012)</p>
          </div>
        </div>  

        <div class="row-fluid">
          <div class="span12">
            <?php get_template_part( 'index', 'featured' ); ?>
          </div>
        </div>

<?php get_footer(); ?>