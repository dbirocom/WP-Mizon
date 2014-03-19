<aside class="thumb">
<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php
if(has_post_thumbnail()) {
	the_post_thumbnail();
} else { ?>
<img src="<?php echo home_url() ; ?>/wp-content/themes/simplefast-responsive/images/loading.gif" alt="<?php the_title(); ?>" width="150" height="100"/>
<?php }
?></a>
</aside>