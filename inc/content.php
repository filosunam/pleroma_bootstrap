<?php

  // Change excerpt lenght with filter hook 'excerpt_length'
  add_filter( 'excerpt_length', 'pleroma_excerpt_length', 999 );

  // Reduce excerpt length to 35 words
  function pleroma_excerpt_length( $length ) {
    return 35;
  }
