        
        <!-- end content -->
        <?php if ( is_active_sidebar( 'bottom' ) ) : ?>
        <hr>
        <div class="row-fluid">
          <?php

              $i              = 0;
              $widgets        = wp_get_sidebars_widgets( 'bottom' );
              $widgets_bottom = $widgets['bottom'];
              $count_widgets  = count($widgets_bottom);
              $span           = 12 / $count_widgets;

              register_sidebar(array(
                  'id'            => 'bottom'
                , 'before_widget' => '<div id="%1$s" class="widget %2$s span'.$span.'">'
                , 'after_widget'  => '</div>'
                , 'before_title'  => '<h4 class="h4 lead widget-title">'
                , 'after_title'   => '</h4>'
              ));

              dynamic_sidebar( 'bottom' );
          ?>
        </div>
        <?php endif; ?>

      </div><!-- /.span12 -->
    </div><!-- /.row -->
  </div><!-- /.container -->

      <!-- footer -->
      <div id="footer">
        <div class="container footer-inner">
          <div class="row-fluid">
            <div class="span3">
              <?php pleroma_secondary_nav_2(); ?>
            </div>
            <div class="span3">
              <?php pleroma_secondary_nav_3(); ?>
            </div>
            <div class="span6">
              <div class="map pull-right">
                <a href="http://www.filos.unam.mx/visitantes/" title="<?php _e('Visita la Facultad', 'pleromabootstrap'); ?>">
                </a>
              </div>
              <h4><?php _e('Visita la Facultad', 'pleromabootstrap'); ?></h4>
              <p>
                Circuito Interior.
                Ciudad Universitaria, s/n. C.P. 04510. México, DF.
              </p>
              <p><a href="http://www.filos.unam.mx/asv/"><?php _e('Edificio "Adolfo Sánchez Vázquez"', 'pleromabootstrap'); ?></a></p>
            </div>
          </div>
          <hr class="hr-inverse">
          © <?php echo date('Y') ?> <?php _e('Facultad de Filosofía y Letras', 'pleromabootstrap'); ?>, UNAM.
          <?php social_media(); ?>
        </div>
      </div>
      <!-- end footer -->

      <?php if (function_exists('pll_the_languages')): ?>
      <?php $translations = pll_the_languages(array('raw'=>1)); ?>
      <div class="selectlang">
        <ul>
          <?php foreach($translations as $lang) : ?>
            <li><a href="<?php print $lang['url']; ?>"><?php print $lang['name']; ?></a></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <?php endif; ?>
  
  <?php wp_footer();?>

</body>
</html>
