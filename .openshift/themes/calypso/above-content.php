<?php 
if ( function_exists( 'ot_get_option') ) {
  $bannerbottom = ot_get_option( 'bannerbottom');
  if($topads==""){
      $bannerbottom = '<a href="#"><img src="' . get_template_directory_uri() . '/img/bannerbottom.png" alt="Default Ads" /></a>';
    }
}
?>
<div class="above-content">
  <div class="category">
    <div class="title">
      <h3><?php echo $lang[13];?></h3>
    </div>
    <div class="category-content">
      <ul>
        <?php wp_list_categories('title_li=0&hierarchical=0'); ?>
      </ul>
    </div>
  </div>
  <div class="random-post">
    <div class="title">
      <h3><?php echo $lang[5];?></h3>
    </div>
    <div class="random-post-content">
      <ul>
        <?php query_posts('showposts=6&orderby=rand'); ?>
        <?php if ( have_posts() ) : ?>
        <?php $m = 1;?>
        <?php while (have_posts()) : the_post();?>
        <?php $n = $m%4;?>
        <li>
          <div class="random-thumb">
            <?php include("includes/thumbnail.php"); ?>
          </div>
          <div class="random-title"> <a href="<?php the_permalink(); ?>" class="title">
            <?php the_trim_title('', '', true, '30'); ?>
            </a> </div>
          <div class="description">
            <p>
              <?php
if (ot_get_option('plugin')=="reviewazon")  {
  echo substr (get_post_meta($post->ID,"ReviewAZON_Description", true), 0, 60);
}
elseif (ot_get_option('plugin')=="wpzonbuilder")  {
  echo substr(get_post_meta($post->ID,"amzn_ProductDescription", true), 0, 60);
}
elseif (ot_get_option('plugin')=="asg") {
  $excerpt = get_the_excerpt();
  echo string_limit_words($excerpt,15);
}
else  {
  $excerpt = get_the_excerpt();
  echo string_limit_words($excerpt,15);
}
?>
            </p>
          </div>
          <div class="detail"><a href="<?php the_permalink(); ?>" rel="nofollow" class="detail"><span><?php echo $lang[3];?>&nbsp;»&nbsp;</span></a></div>
        </li>
        <?php $m++;?>
        <?php endwhile;?>
        <?php else : ?>
        <?php endif; ?>
        <div class="clear"></div>
      </ul>
    </div>
    <div class="clear"></div>
  </div>
  <div class="disclaimer">
    <div class="disc-logo">
      <img src="<?php bloginfo('template_url'); ?>/img/amazon.png" alt=""/>
    </div>
    <div class="disc-text">
    <p><?php echo $lang[14];?></p>
    </div>
    <div class="clear"></div>
  </div>
</div>
