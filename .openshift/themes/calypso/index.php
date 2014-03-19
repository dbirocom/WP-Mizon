<?php ?>
<?php
	if ( function_exists( 'ot_get_option') ) {
		$slider = ot_get_option( 'slider'); 
		$carousel = ot_get_option( 'carousel'); 
		$carouselamount = ot_get_option( 'carouselamount'); 
		$slideramount = ot_get_option( 'slideramount'); 
	}
?>
<?php get_header(); ?>
<?php include("lang/lang.php"); ?>

<!-- start content -->

<div class="top"></div>
<section id="content">

<!-- start main content -->
<section id="main">
<?php if ( have_posts() ) : ?>
<?php while (have_posts()) : the_post();?>
<?php endwhile;?>
<?php endif;?>
<?php if (ot_get_option('topslider')=="display") { ?>
<!-- start home slider -->
<div class="frontslide">
  <div id="home-slider">
    <div class="amazon-seacrh">
      <div class="rain">
        <div class="border start">
          <?php include("lang/lang.php"); ?>
          <div class="amzsearch">
            <h3>
            <?php echo $lang[32];?></div>
          <div class="searchlogo"></div>
          <?php include("amazon-search.php"); ?>
          <div class="amazon-discount"></div>
        </div>
      </div>
    </div>
    <div class="ribbon"></div>
    <div id="slider">
      <ul class="slides">
        <?php
						$slider = ot_get_option('slider');
						if($slider != '' && $slider != '0') {
						global $post;
						$slide = get_posts("numberposts=5&category=$slider");

						foreach($slide as $post) {
						?>
        <li>
          <div class="slide-img">
            <?php include("includes/slider-thumb.php"); ?>
          </div>
          <h3><a href="<?php the_permalink(); ?>">
            <?php the_trim_title('', '', true, '30'); ?>
            </a></h3>
          <div class="slide-desc"> <span class="rating"><img class="shuffle" src="" alt="rating"/></span><br />
          <!-- <p>
              <?php /*
if (ot_get_option('plugin')=="reviewazon")	{
	echo substr (get_post_meta($post->ID,"ReviewAZON_Description", true), 0, 80);
}
elseif (ot_get_option('plugin')=="wpzonbuilder")	{
	echo substr(get_post_meta($post->ID,"amzn_ProductDescription", true), 0, 80);
}
elseif (ot_get_option('plugin')=="asg")	{
echo get_excerpt();
}
elseif (ot_get_option('plugin')=="zongrabbing") {
echo get_excerpt();
}
else	{
 echo get_excerpt();
} */
?> 
            </p> -->
            <span class="old-price">
            <?php include("includes/old-price.php"); ?>
            </span> <span class="price">
            <?php include("includes/price.php"); ?>
            </span> <a href="javascript:void(0);" onclick="window.open ('<?php include("includes/link.php"); ?>','_blank')" rel="nofollow" class="cart"><span><?php echo $lang[1];?></span></a></div>
        </li>
        <?php } ?>
        <?php } ?>
      </ul>
      <div class="clear"></div>
    </div>
  </div>
  <div class="slideshadow"></div>
</div>
<!-- end home slider -->
<?php } else { ?>
<?php } ?>
<div class="clear"></div>
<?php if (ot_get_option('carouselslider')=="displayc") { ?>
<br />
<?php } else { ?>
<?php } ?>

<!-- start popular product -->
<div id="tabContainer">
<div class="tabs">
  <ul>
    <li id="tabHeader_1"><?php echo $lang[29];?></li>
    <li id="tabHeader_2"><?php echo $lang[30];?></li>
    <li id="tabHeader_3"><?php echo $lang[31];?></li>
  </ul>
</div>
<div class="clear"></div>
<div class="tabscontent">
<div class="tabpage" id="tabpage_1">
  <div class="popular-item">
    <ul class="clearfix">
      <?php wp_reset_query(); ?>
      <?php if ( have_posts() ) : ?>
      <?php $i = 1;?>
      <?php while (have_posts()) : the_post();?>
      <?php $j = $i%4;?>
      <li class="boxgrid captionfull">
        <div class="special"></div>
        <center>
          <?php include("includes/thumb.php"); ?>
        </center>
        <div class="cover boxcaption">
          <h5><a href="<?php the_permalink(); ?>">
            <?php the_trim_title('', '', true, '35'); ?>
            </a></h5>
          <img class="shuffle" src="" alt="rating"/> <span class="old-price">
          <div class=clear></div>
          <a href="javascript:void(0);" onclick="window.open ('<?php include("includes/link.php"); ?>','_blank')" rel="nofollow" class="buy"> <span><?php echo $lang[1];?></span></a>
          <div class=clear></div>
          <?php include("includes/old-price.php"); ?>
          </span> <span class="price">
          <?php include("includes/price.php"); ?>
          </span> <a href="<?php the_permalink(); ?>" rel="nofollow" class="detail"><span><?php echo $lang[3];?></span></a> </div>
        <div class="clear"></div>
      </li>
      <?php $i++;?>
      <?php endwhile;?>
      <?php else : ?>
      <?php endif; ?>
    </ul>
    <div class="clear"></div>
  </div>
  <br clear="all" />
  <?php pagenavi(); ?>
  <br clear="all" />
</div>
<div class="tabpage" id="tabpage_2">
  <div class="popular-item">
    <ul class="clearfix">
      <?php 
			$bestseller = ot_get_option('bestseller');
			if($bestseller != '' && $bestseller != '0') {
			global $post;
			$best = get_posts("numberposts=8&category=$bestseller");

			foreach($best as $post) {
			?>
      <li class="boxgrid captionfull">
        <div class="special"></div>
        <center>
          <?php include("includes/thumb.php"); ?>
        </center>
        <div class="cover boxcaption">
          <h5><a href="<?php the_permalink(); ?>">
            <?php the_trim_title('', '', true, '35'); ?>
            </a></h5>
          <img class="shuffle" src="" alt="rating"/> <span class="old-price">
          <div class=clear></div>
          <a href="javascript:void(0);" onclick="window.open ('<?php include("includes/link.php"); ?>','_blank')" rel="nofollow" class="buy"> <span><?php echo $lang[1];?></span></a>
          <div class=clear></div>
          <?php include("includes/old-price.php"); ?>
          </span> <span class="price">
          <?php include("includes/price.php"); ?>
          </span> <a href="<?php the_permalink(); ?>" rel="nofollow" class="detail"><span><?php echo $lang[3];?></span></a> </div>
        <div class="clear"></div>
      </li>
      <?php } ?>
      <?php } ?>
    </ul>
    <div class="clear"></div>
  </div>
  <br clear="all" />
</div>
<div class="tabpage" id="tabpage_3">
<div class="popular-item">
  <ul class="clearfix">
    <?php query_posts('showposts=16&orderby=rand'); ?>
    <?php if ( have_posts() ) : ?>
    <?php $i = 1;?>
    <?php while (have_posts()) : the_post();?>
    <?php $j = $i%4;?>
    <li class="boxgrid captionfull">
      <div class="special"></div>
      <center>
        <?php include("includes/thumb.php"); ?>
      </center>
      <div class="cover boxcaption">
        <h5><a href="<?php the_permalink(); ?>">
          <?php the_trim_title('', '', true, '35'); ?>
          </a></h5>
        <img class="shuffle" src="" alt="rating"/> <span class="old-price">
        <div class=clear></div>
        <a href="javascript:void(0);" onclick="window.open ('<?php include("includes/link.php"); ?>','_blank')" rel="nofollow" class="buy"> <span><?php echo $lang[1];?></span></a>
        <div class=clear></div>
        <?php include("includes/old-price.php"); ?>
        </span> <span class="price">
        <?php include("includes/price.php"); ?>
        </span> <a href="<?php the_permalink(); ?>" rel="nofollow" class="detail"><span><?php echo $lang[3];?></span></a> </div>
      <div class="clear"></div>
    </li>
    <?php $i++;?>
    <?php endwhile;?>
    <?php else : ?>
    <?php endif; ?>
  </ul>
  <div class="clear"></div>
</div>
<br clear="all" />
<!-- end popular product -->
</section>
<!-- end main content -->

<div class="clear"></div>
</section>
<?php include( TEMPLATEPATH . '/above-content.php' ); ?>
<!-- end content -->

<?php get_footer(); ?>
