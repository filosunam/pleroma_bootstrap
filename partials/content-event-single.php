<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  
  <!-- article -->
  <article id="post-<?php the_ID(); ?>">

    <header>
      <h1 class="h3"><?php the_title(); ?></h1>
      <table class="table table-bordered table-striped">
        <tbody>
          <?php if( eo_is_all_day() ) { ?>
          <tr>
            <td><i class="glyphicon glyphicon-time"></i> Comienza</td>
            <td><?php echo eo_get_the_start('l j \d\e F, Y'); ?> (todo el día)</td>
          </tr>
          <?php } else { ?>
          <tr>
            <td><i class="glyphicon glyphicon-time"></i> Comienza</td>
            <td><?php echo eo_get_the_start('l j \d\e F, Y h:i:s A'); ?></td>
          </tr>
          <tr>
            <td><i class="glyphicon glyphicon-time"></i> Finaliza</td>
            <td><?php echo eo_get_the_end('l j \d\e F, Y h:i:s A'); ?></td>
          </tr>
          <?php } ?>
          <?php if ( eo_get_venue_name() ) { ?>
          <tr>
            <td><i class="glyphicon glyphicon-globe"></i> Lugar</td>
            <td>
              <?php

                $fields = get_post_custom();
                
                if ( isset( $fields['lugar'] ) ) {
                  echo $fields['lugar'][0] . '. ';
                }
                
                echo eo_get_venue_name();

              ?>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </header> <!-- end article header -->

    <section class="post-content">
      <?php

        // Displays the content
        the_content();
          
      ?>
    </section> <!-- end article section -->
    <footer>
      <p>
        <?php

          // Do sociable
          if ( function_exists( 'do_sociable' ) ) {
            do_sociable();
          }

          // Add to Google Calendar
          echo '<a class="btn btn-success" href="'. esc_url( eo_get_add_to_google_link() ).'" title="Añadir a Google Calendar"> Añadir a Google Calendar </a> ';

          // Show full calendar if is main site
          if ( is_main_site() ) {
            echo '<a class="btn btn-info" href="/calendario-de-eventos" title="Ver más eventos"> Ver más eventos </a>';
          }

        ?>
      </p>
      <?php

        // Get venue map
        if ( eo_get_venue_map() ) {
          echo do_shortcode('[eo_venue_map]');
        }

      ?>
    </footer>
  </article><!-- /article -->

<?php endwhile; endif; ?>
