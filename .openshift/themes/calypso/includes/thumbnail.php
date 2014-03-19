<?php
if (ot_get_option('plugin')=="reviewazon")	{
	if (get_post_meta($post->ID, "ReviewAZON_LargeImage", $single = true)!="")	{
	?>

<a href="javascript:void(0);" onclick="window.open ('<?php include("link.php"); ?>','_blank')" rel="nofollow" class="product-img"> <img src="<?php echo get_post_meta($post->ID, "ReviewAZON_LargeImage", $single = true); ?>" alt="<?php the_title();?>" /> </a>
<?php } else { ?>
<a href="#" class="product-img"> <img src="<?php bloginfo('template_url'); ?>/img/noimagebig.png" alt="No Images" /> </a>
<?php } ?>
<?php
}
elseif (ot_get_option('plugin')=="wpzonbuilder")	{
	if (get_post_meta($post->ID, "amzn_LargeImageURL", $single = true)!="")	{
	?>
<a href="javascript:void(0);" onclick="window.open ('<?php include("link.php"); ?>','_blank')" rel="nofollow" class="product-img"> <img src="<?php echo get_post_meta($post->ID, "amzn_LargeImageURL", $single = true); ?>" alt="<?php the_title();?>" /> </a>
<?php } else { ?>
<a href="#" class="product-img"> <img src="<?php bloginfo('template_url'); ?>/img/noimagebig.png" alt="No Images" /> </a>
<?php } ?>
<?php
}
elseif (ot_get_option('plugin')=="asg")	{
	if (get_post_meta($post->ID, "amazon-image-url", $single = true)!="")	{
	?>
<a href="javascript:void(0);" onclick="window.open ('<?php include("link.php"); ?>','_blank')" rel="nofollow" class="product-img"> <img src="<?php echo get_post_meta($post->ID, "amazon-image-url", $single = true); ?>" alt="<?php the_title();?>" /> </a>
<?php } else { ?>
<a href="#" class="product-img"> <img src="<?php bloginfo('template_url'); ?>/img/noimagebig.png" alt="No Images" /> </a>
<?php } ?>
<?php
}
elseif (ot_get_option('plugin')=="zongrabbing")	{
	$PostContent = $post->post_content;
	$ImgSearch = '|<img.*?src=[\'"](.*?)[\'"].*?>|i';
	preg_match_all( $ImgSearch, $PostContent, $PostImg );
	$ImgNumber = count($PostImg[0]);
	if ($ImgNumber > 0)	{
	?>
<a href="javascript:void(0);" onclick="window.open ('<?php include("link.php"); ?>','_blank')" rel="nofollow" class="product-img"> <img src="<?php echo $PostImg[1][0]; ?>" alt="<?php the_title();?>" /> </a>
<?php } else { ?>
<a href="#" class="product-img"> <img src="<?php bloginfo('template_url'); ?>/img/noimage.png" alt="No Images" /> </a>
<?php } ?>
<?php
}
else {
	$PostContent = $post->post_content;
	$ImgSearch = '|<img.*?src=[\'"](.*?)[\'"].*?>|i';
	preg_match_all( $ImgSearch, $PostContent, $PostImg );
	$ImgNumber = count($PostImg[0]);
	if ($ImgNumber > 0)	{
	?>
<!--<a href="javascript:void(0);" onclick="window.open ('<?php // include("link.php"); ?>','_blank')" rel="nofollow" class="product-img"> --><img src="<?php echo $PostImg[1][0]; ?>" alt="<?php the_title();?>" title="Buy Now"/> <!-- </a> -->
<?php } else { ?>
<a href="#" class="product-img"> <img src="<?php bloginfo('template_url'); ?>/img/noimage.png" alt="No Images" /> </a>
<?php } ?>
<?php
}
?>
