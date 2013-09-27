<?php

  if ( $_SERVER["SERVER_ADDR"] == '127.0.0.1' ) {

    // livereload for faster web development
    function register_livereload() {
      wp_register_script( 'livereload', 'http://localhost:35729/livereload.js' );
      wp_enqueue_script('livereload');
    }

    add_action('init', 'register_livereload');

  }

?>