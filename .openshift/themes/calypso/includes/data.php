<?php
if (ot_get_option('plugin')=="reviewazon")	{
	$price		= get_post_meta($post->ID, "ReviewAZON_LowestNewPrice", true);
	$oldprice	= get_post_meta($post->ID, "ReviewAZON_ListPrice", true);
	$asin		= get_post_meta($post->ID, "ReviewAZON_ASIN", true);
}
elseif (ot_get_option('plugin')=="wpzonbuilder")	{
	$price		= get_post_meta($post->ID, "amzn_LowestNewPrice", true);
	$oldprice	= get_post_meta($post->ID, "amzn_ListPrice", true);
	$asin		= get_post_meta($post->ID, "amzn_ASIN", true);
}

elseif (ot_get_option('plugin')=="asg")	{
	$price		= get_post_meta($post->ID, "amazon-price", true);
	$oldprice	= get_post_meta($post->ID, "amazon-price", true);
	$asin		= get_post_meta($post->ID, "ReviewAZON_ASIN", true);
}
elseif (ot_get_option('plugin')=="zongrabbing")	{
	$price		= get_post_meta($post->ID, "price", true);
	$oldprice	= get_post_meta($post->ID, "listprice", true);
	$asin		= "";

}

else {
	$price		= get_post_meta($post->ID, "price", true);
	$oldprice	= get_post_meta($post->ID, "list_price", true);
	$asin		= "";

}

?>