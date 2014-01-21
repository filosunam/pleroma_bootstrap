<?php
  
  // Sidebar Page 1
  if ( is_active_sidebar( 'sidebar-page-1' ) ) {
    echo '<div class="sidebar">';
      dynamic_sidebar( 'sidebar-page-1' );
    echo '</div>';
  }
