<?php
if (ot_get_option('plugin')=="reviewazon")	{
	echo get_post_meta($post->ID, "ReviewAZON_DetailedPageUrl", $single = true);
}
elseif (ot_get_option('plugin')=="wpzonbuilder")	{
	echo get_post_meta($post->ID, "amzn_DetailPageURL", $single = true);
}
elseif (ot_get_option('plugin')=="asg")	{
	echo get_post_meta($post->ID, "amazon-product-url", $single = true);
}
elseif (ot_get_option('plugin')=="zongrabbing")	{
	echo get_post_meta($post->ID, "detail", $single = true);
}
else	{
	echo get_post_meta($post->ID, "link", $single = true);
}
?>