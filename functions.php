<?php

// I had read somewhere:
// "I would say RTFM, but you would say, write the fucking manual"
// but actually this isn't a big deal
// so move your lazy ass!

require_once('library/pleroma.php');
require_once('library/admin.php');
require_once('library/sidebars.php');
require_once('library/navs.php');
require_once('library/widgets.php');
require_once('library/dev.php');

require_once('library/boletin.php'); // this line is embarrassing and no standard


update_option('thumbnail_size_w', 125);
update_option('thumbnail_size_h', 125);
update_option('thumbnail_crop', 1);

add_image_size( 'small', 10000, 161 );

update_option('medium_size_w', 700);
update_option('medium_size_h', 322);
update_option('medium_crop', 1);

update_option('large_size_w', 870);
update_option('large_size_h', 403);
update_option('large_crop', 1);
