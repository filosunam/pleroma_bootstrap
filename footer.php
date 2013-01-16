        </div>
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
      <div id="footer" class="container-fluid">
        <div class="span12 footer-inner">
          <div class="row-fluid">
            <div class="span3">
              <?php pleroma_secondary_nav_2(); ?>
            </div>
            <div class="span3">
              <?php pleroma_secondary_nav_3(); ?>
            </div>
            <div class="span6">
              <div class="map pull-right">
                <a href="http://www.filos.unam.mx/visitantes/" title="<?php echo __('Visita la Facultad', 'pleromabootstrap'); ?>">
                </a>
              </div>
              <h4><?php echo __('Visita la Facultad', 'pleromabootstrap'); ?></h4>
              <p>
                Circuito Interior.
                Ciudad Universitaria, s/n. C.P. 04510. México, DF.
              </p>
              <p><a href="http://www.filos.unam.mx/asv/"><?php echo __('Edificio', 'pleromabootstrap'); ?> “Adolfo Sánchez Vázquez”</a></p>
            </div>
          </div>
          <hr class="hr-inverse">
          © <?php echo date('Y') ?> <?php echo __('Facultad de Filosofía y Letras', 'pleromabootstrap'); ?>, UNAM.
        </div>
      </div>
      <!-- end footer -->
  
  <?php wp_footer();?>

</body>
</html>