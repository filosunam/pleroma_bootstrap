<?php
  
  // Sidebar Page 2
  if ( is_active_sidebar( 'sidebar-page-2' ) ) {
    echo '<div class="sidebar">';
      dynamic_sidebar( 'sidebar-page-2' );
    echo '</div>';
  }
