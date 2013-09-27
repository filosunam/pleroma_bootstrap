<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  <article id="post-<?php the_ID(); ?>" role="article" itemscope itemtype="http://schema.org/BlogPosting">

    <header>
      <h1 class="h3 lead" itemprop="headline"><?php the_title(); ?></h1>
      
        <?php if(get_post_type() == 'event') : ?>
          <div class="well">
            <p>
              <?php

                if( eo_is_all_day() )
                {
                  echo "<span class=\"label label-success\"><i class=\"icon-time icon-white\"></i> Comienza</span> " . eo_get_the_start('l j \d\e F, Y');
                  echo " (<strong>todo el día</strong>)";
                } else
                {
                  echo "<span class=\"label label-success\"><i class=\"icon-time icon-white\"></i> Comienza</span> " . eo_get_the_start('l j \d\e F, Y h:i:s A');
                  echo "<br><span class=\"label label-important\"><i class=\"icon-search icon-white\"></i> Finaliza</span> " . eo_get_the_end('l j \d\e F, Y h:i:s A');
                }

                  echo "<br><span class=\"label\">Lugar</span> " . eo_get_venue_name(); 

              ?>
            </p>
          </div>
        <?php endif; ?>
      
    </header> <!-- end article header -->

    <section class="post-content" itemprop="articleBody">
      <?php the_content(); ?>
      <?php

        if( function_exists( 'do_sociable' ) ){ do_sociable(); }
        
        if(get_post_type() == 'event')
        {
          
          $url = eo_get_the_GoogleLink();
          
          echo '<p>';
          echo '  <a class="btn btn-success" href="'.esc_url($url).'" title="Añadir a Google Calendar"> Añadir a Google Calendar </a>';

          if( get_current_blog_id() === 1 ) {
            echo '<a class="btn btn-secondary" href="/calendario-de-eventos" title="Ver más eventos"> Ver más eventos </a>';
          }

          echo '</p>';
          echo "<p>" . do_shortcode('[eo_venue_map]') . "</p>";
        }
          
      ?>
    </section> <!-- end article section -->

    <footer class="article-footer" style="clear: both">
      <?php if(get_post_type() != 'event') : ?>
        <div class="well">
          <?php _e("Publicada", "pleromabootstrap"); ?>
          <time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate>  <?php the_time('F j, Y'); ?></time>
          <?php if ( get_the_category() ) : ?>
          <span class="amp">&</span> <?php _e("archivada en", "pleromabootstrap"); ?> <?php the_category(', '); ?>
          <?php endif; ?>
          <?php the_tags('<p class="tags">', ', ', '</p>'); ?>
        </div>
      <?php endif; ?>
    </footer> <!-- end article footer -->

    <?php //comments_template(); ?>

  </article> <!-- end article -->

<?php endwhile; ?>

<?php endif; ?>
