<?php 

  if( !is_multisite() ||  1 == get_current_blog_id() )
  {
    
    // www.filos.unam.mx
    get_template_part( 'index', 'parent' );
    
  } else 
  {

    // *.filos.unam.mx
    get_template_part( 'index', 'child' );
  
  }

?>
