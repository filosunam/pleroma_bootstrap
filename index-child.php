<?php get_header(); ?>

        <div class="row-fluid">
          <div class="span3">
            <?php get_sidebar(1); // sidebar page 1 ?>
          </div>
          <div class="span9">
          	<div class="row-fluid">
          		<div class="span12">
			          <?php

			            $category_slides = get_option('pleroma_home_slider');

			            if( is_home() && $category_slides ) : 

			              $query = new wp_query(array(
			                'cat' => $category_slides,
			                'posts_per_page' => 8        
			              ));

			              if ( $query->post_count > 0 ) :

			          ?>
			            <div id="homeCarousel" class="carousel carousel-fade slide">
			              <div class="carousel-inner">
			                <?php

			                  $i = 0; while ( $query->have_posts() ) : $i++;

			                    $active = ($i == 1) ? 'active ' : '';
			                    $query->the_post();

			                ?>
			                <?php if ( has_post_thumbnail() ) { ?>
			                <div class="<?php print $active ?>item">
			                  <?php 
		                      $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
		                      echo '<img src="' . $large_image_url[0] . '" alt="' . the_title_attribute('echo=0') . '">';
			                  ?>
			                  <div class="carousel-caption">
			                    <p><?php the_title() ?></p>
			                  </div>
			                </div>
											<?php } ?>

			                <?php endwhile; ?>
			              </div>

			              <?php if ( $query->post_count > 1 ) : ?>
			              <a class="carousel-control left" href="#homeCarousel" data-slide="prev">&lsaquo;</a>
			              <a class="carousel-control right" href="#homeCarousel" data-slide="next">&rsaquo;</a>
			              <?php endif; ?>
			            
			            </div>
			            <?php endif; // end if slides > 0 ?>
			          <?php endif; // end if home ?>
			        </div><!-- ./span12 (sub) -->

						</div><!-- /.row-fluid -->
			        
			      <div class="row-fluid">
			      	<div class="span12">
			      		<?php get_template_part( 'index', 'featured' ); ?>
			        </div>
			      </div>

        	</div><!-- /.span9 -->
       	</div><!-- /.row-fluid -->
<?php get_footer(); ?>
