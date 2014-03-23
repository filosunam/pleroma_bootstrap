<?php if ( is_active_sidebar( 'bottom' ) ) : ?>
<!-- .wrapper -->
<div class="wrapper wrapper-primary">
  <!-- .container -->
  <div class="container">
    <!-- .row -->
    <div class="row">
      <?php

        // Displays sidebar
        dynamic_sidebar( 'bottom' );

      ?>
    </div><!-- /.row -->
  </div><!-- /.container -->
</div><!-- /.wrapper -->
<?php endif; ?>

<!-- #footer.wrapper -->
<div id="footer" class="wrapper wrapper-footer"> 
  <!-- .container -->
  <div class="container">
    <!-- .row -->
    <div class="row">
      <div class="col-xs-6 col-md-3">
        <?php

          // Secondary Nav Menu 2
          pleroma_secondary_nav_2();

        ?>
      </div>
      <div class="col-xs-6 col-md-3">
        <?php

          // Secondary Nav Menu 3
          pleroma_secondary_nav_3();

        ?>
      </div>
        
      <div class="col-xs-12 col-md-6">
        <div class="widget">
          <hr class="visible-xs visible-sm">
          <h4><?php _e( 'Visita la Facultad', 'pleromabootstrap' ); ?></h4>
          <p>
            Circuito Interior.
            Ciudad Universitaria, s/n. C.P. 04510. México, DF.
          </p>
          <a href="http://www.filos.unam.mx/asv/"><?php _e( 'Edificio "Adolfo Sánchez Vázquez"', 'pleromabootstrap' ); ?></a>
        </div>

        <!-- .icons -->
        <div class="icons">
          <?php

            // Get social links
            $socials = array(
              'facebook'  => get_option( 'pleroma_facebook' ),
              'twitter'   => get_option( 'pleroma_twitter' ),
              'youtube'   => get_option( 'pleroma_youtube' ),
              'vimeo'     => get_option( 'pleroma_vimeo' )
            );

            // Remove empty values
            $socials = array_filter( $socials );

            // Displays each social link
            foreach ( $socials as $social => $value ) {
              
              // Build handle
              switch ( $social ) {
                case 'twitter':
                  $value = "http://twitter.com/$value";
                  break;

                case 'youtube':
                  $value = "http://youtube.com/$value";
                  break;

                case 'vimeo':
                  $value = "http://vimeo.com/$value";
                  break;
              }

              // Displays social link
              if ( $value ) {
                echo '<a href="' . $value . '" class="' . $social . '"></a> ';
              }

            }


          ?>
          <a href="<?php echo bloginfo( 'rss2_url' ); ?>" class="rss"></a>
        </div><!-- /.icons -->
      </div>
    </div><!-- /.row -->
    
    <hr>

    <?php echo date( 'Y' ) ?> © <?php _e( 'Facultad de Filosofía y Letras', 'pleromabootstrap' ); ?>, UNAM.
  </div><!-- /.container -->


</div><!-- /#footer.wrapper -->

<?php

  // Use polylang plugin
  if ( function_exists( 'pll_the_languages' ) ) :

    // Get languages
    $languages = pll_the_languages( array( 'raw' => 1 ) );

?>
<div class="wrapper wrapper-inverse languages-controls">
  <div class="container">
    <ul>
      <?php
      
        // Display each language
        foreach ( $languages as $language ) :
          echo '<li><a href="' . $language['url'] . ' ">' . $language['name'] . '</a></li> ';
        endforeach;

      ?>
    </ul>
  </div>
</div>
<?php endif; ?>

<?php wp_reset_query(); ?>
<?php if ( get_option('pleroma_instagram_feed') && is_home() && is_main_site() ) : ?>
<script type="text/javascript">
  jQuery(document).ready(function ($) {

    var feed = new Instafeed({
      clientId: '3f12224ae6094ea095c8aafa675867e4',
      get: 'location',
      locationId: 1167187,
      limit: 35,
      template: '<a href="{{link}}" data-toggle="tooltip" data-placement="top" title="{{caption}}"><img src="{{image}}" alt=""></a>',
      after: function () {
        $('#instafeed [data-toggle="tooltip"]').tooltip();
      }
    });

    feed.run();

  });
</script>
<div id="comunidad" class="visible-md visible-lg">
  <a href="http://fotos.filos.unam.mx" class="instafeed-title">Imágenes de nuestra comunidad</a>
  <div id="instafeed"></div>
</div>
<?php endif; ?>
  
<?php wp_footer();?>

  </body>
</html>
