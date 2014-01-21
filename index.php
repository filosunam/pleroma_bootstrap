<?php 

  if ( ! is_multisite() || is_main_site() ) {
    
    // www.filos.unam.mx
    get_template_part( 'index', 'parent' );
    
  } else {

    // *.filos.unam.mx
    get_template_part( 'index', 'child' );
  
  }
