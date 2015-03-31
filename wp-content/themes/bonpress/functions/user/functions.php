<?php

/* You can add custom functions below, in the empty area
=========================================================== */

register_sidebar( array(
	'name' => 'Sidebar',
	'id' => 'sidebar',
	'before_widget' => '<div class="widget %1$s" id="%2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3>',
	'after_title' => '</h3>',
) );


/*  Don't add any code below here or the sky will fall down
=========================================================== */

?>