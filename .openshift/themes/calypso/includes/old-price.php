<?php
if (ot_get_option('plugin')=="reviewazon")	{
	echo get_post_meta($post->ID, "ReviewAZON_ListPrice", $single = true);
}
elseif (ot_get_option('plugin')=="wpzonbuilder")	{
	echo get_post_meta($post->ID, "amzn_ListPrice", $single = true);
}
elseif (ot_get_option('plugin')=="asg")	{
	echo get_post_meta($post->ID, "amazon-price", $single = true);
}
elseif (ot_get_option('plugin')=="zongrabbing")	{
	echo get_post_meta($post->ID, "listprice", $single = true);
}
else	{
	echo get_post_meta($post->ID, "list_price", $single = true);
}
?>