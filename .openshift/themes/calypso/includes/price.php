<?php
if (ot_get_option('plugin')=="reviewazon")	{
	echo get_post_meta($post->ID, "ReviewAZON_LowestNewPrice", $single = true);
}
elseif (ot_get_option('plugin')=="wpzonbuilder")	{
	echo get_post_meta($post->ID, "amzn_LowestNewPrice", $single = true);
}
elseif (ot_get_option('plugin')=="asg")	{
	echo get_post_meta($post->ID, "azonwpprice", $single = true);
}
elseif (ot_get_option('plugin')=="zongrabbing")	{
	echo get_post_meta($post->ID, "price", $single = true);
}
else	{
	echo get_post_meta($post->ID, "price", $single = true);
}
?>