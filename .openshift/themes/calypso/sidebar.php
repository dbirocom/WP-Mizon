<?php ?>
<?php
	if ( function_exists( 'ot_get_option') ) {
		$sideads = ot_get_option( 'sideadvert'); 
		$rsscount = ot_get_option( 'rsscount'); 
		$fbcount = ot_get_option( 'fbcount'); 
		$twittercount = ot_get_option( 'twittercount'); 
		if($sideads==""){
			$sideads = '<a href="#"><img src="' . get_template_directory_uri() . '/img/sidebar-ads.jpg" alt="Default Sidebar Ads" style="display: block; visibility: visible; "/></a>';
		}
	}
?>
<?php include("lang/lang.php"); ?>
<section id="sidebar">   

<div class="price-disc"><?php echo $lang[35];?></div><br />
<?php 
if(is_search()){ ?>
<div class="sidebar-widget">
<h3>Related Search</h3>
<?php
echo spp(get_search_query(), 'sidebar.html');
?>
</div>
<?php
}
?>
  <div id="product-recommend">
    <h3><?php echo $lang[31];?></h3>
    <ul>
      <?php query_posts('showposts=4&orderby=rand'); ?>
      <?php if ( have_posts() ) : ?>
      <?php $m = 1;?>
      <?php while (have_posts()) : the_post();?>
      <?php $n = $m%4;?>
      <li>
        <div class="">
        <div class="product-images"><?php include("includes/thumbnail.php"); ?></div>
        <div class="product-detailed"><div class="rating"><img class="shuffle" src="" alt=""/></div>
        <div class="judul"><a href="<?php the_permalink(); ?>" class="title">
        <?php the_trim_title('', '', true, '25'); ?>
        </a></div>
        <div class="details">
<p>
              <?php
if (ot_get_option('plugin')=="reviewazon")  {
  echo substr (get_post_meta($post->ID,"ReviewAZON_Description", true), 0, 40);
}
elseif (ot_get_option('plugin')=="wpzonbuilder")  {
  echo substr(get_post_meta($post->ID,"amzn_ProductDescription", true), 0, 40);
}
elseif (ot_get_option('plugin')=="asg") {
  $excerpt = get_the_excerpt();
  echo string_limit_words($excerpt,6);
}
else  {
  $excerpt = get_the_excerpt();
  echo string_limit_words($excerpt,6);
}
?>
            </p>
        </div></div></li>
      <?php $m++;?>
      <?php endwhile;?>
      <?php else : ?>
      <?php endif; ?>
      <div class="clear"></div>
    </ul>
  </div>
  <!-- start sidebar widgets -->
  <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Sidebar") ) : ?>
  <?php endif; ?>
  <?php
  $as=$_SERVER['REQUEST_URI'];
  preg_match('/\\/(.*?)\\//',$as,$match);
  $bs = $match[1];
  if ( $bs == 'tag' ) { ?>
  <div class="sidebar-widget">
  <h3>Popular Search</h3>
  <div class="textwidget"><ul>
  <?php
	echo do_shortcode('[spp_random_terms count=10]');
  ?>
  </ul></div>
  </div>
  <?php } ?>
  <!-- end sidebar widgets -->
 
</section>
