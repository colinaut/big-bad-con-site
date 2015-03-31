<?php
if ( have_posts() ) :

	while ( have_posts() ) : the_post();
	?><span class="post_icon"><a href="<?php the_permalink(); ?>" class="fade" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></span>
<?php

	endwhile;

else :

	?><p class="title"><?php _e('There are no posts', 'wpzoom'); ?></p><?php

endif;

wp_reset_query();
?>