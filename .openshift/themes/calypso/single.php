<?php
	if ( function_exists( 'ot_get_option') ) {
		$carousel = ot_get_option( 'carousel');  
		$carouselamount = ot_get_option( 'carouselamount'); 
		$singleadvert = ot_get_option('singleadvert');
		if($singleadvert==""){
			$singleadvert = '<a href="#"><img src="' . get_template_directory_uri() . '/img/single-ads.png" alt="Default Single Ads" style="display: block; visibility: visible; "/></a>';
		}
	}
?>
<?php get_header(); ?>
<?php include("lang/lang.php"); ?>

<!-- start content -->

<div class="bread"><?php echo the_breadcrumb();?></div>
<section id="content" class="content">
<!-- start single item -->
<div class="single-item">
<?php wp_reset_query();?>
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
<div class="product-meta-data">
  <h1>
    <?php the_title(); ?>
  </h1>
  <div class="product-meta-social">
    <?php include("includes/social.php"); ?>
  </div>
</div>
<!-- start product image -->
 <div class="product-img">
  <div class="product-img-big">
    <div class="sale-icon"></div>
    <?php  include("includes/single-thumb.php"); ?>
  </div> 

</div> 

<!-- start product meta -->

 <div class="product-meta"> 
 <div class="product-meta-data">
   <div class="product-desc">
      <?php  include("includes/data.php"); ?>
      <p><span class="data"><?php echo $lang[17];?></span>&nbsp;&nbsp;:&nbsp;&nbsp;<span class="old-price"> <?php echo $oldprice; ?> </span></p>
      <p><span class="data"><?php echo $lang[18];?></span>&nbsp;&nbsp;:&nbsp;&nbsp;<span class="price"> <?php echo $price; ?> </span></p>
      <?php
preg_match_all('!\d+!', $price, $harga);
$harga_skrg = implode(' ', $harga[0]);

preg_match_all('!\d+!', $oldprice, $harga);
$harga_lama = implode(' ', $harga[0]);

$save		= $harga_lama - $harga_skrg;

if($harga_lama != 0){
    $savepct  = ($save/$harga_lama)*100;
} else {
    $savepct  = 0;
}

$percentage = number_format($savepct, 2, '.', '');

if (ot_get_option('language')=="english(us)" || ot_get_option('language')=="english(uk)") {
  $lambang = substr($price,0,1);
}
else  {
  $lambang = substr($price,0,3);
}

?>
      <p><span class="data"><?php echo $lang[19];?></span>&nbsp;&nbsp;:&nbsp;&nbsp;<span class="save"><?php echo $lambang."".$save; ?> (<?php echo $percentage; ?>&nbsp;%)</span> </p>
      <p><span class="data"><?php echo $lang[13];?></span>&nbsp;&nbsp;:&nbsp;&nbsp;
        <?php the_category(', ') ?>
      </p>
      <p><span class="data"><?php echo $lang[21];?></span>&nbsp;&nbsp;:&nbsp;&nbsp;<span class="stock"><?php echo $lang[25];?></span> </p>
      <p><span class="data"><?php echo $lang[28];?></span>&nbsp;&nbsp;:&nbsp;&nbsp;<img class="shuffle" src="" alt=""/></p>
    </div> 
    <div class="product-meta-action clearfix"> <a href="javascript:void(0);" onclick="window.open ('<?php include("includes/link.php"); ?>','_blank')" rel="nofollow" class="cart"><img src="<?php bloginfo('template_url'); ?>/img/cart2.png" align="left" align="middle" /><?php echo $lang[1];?></a> </div>
    <!-- <div class="price-disc"><?php  echo $lang[35];?></div>  -->
      <?php include("includes/data.php"); ?>
      <div class="product_meta"> </div>
    </div>
  </div>
</div> 
<div class="clear"></div>
<div class="product-meta-excerpt">
  <?php if (ot_get_option('plugin')=="wpzonbuilder")  { ?>
  <?php } else { ?>
  <?php if (ot_get_option('plugin')=="reviewazon")  { ?>
  <?php } else { ?>
  <h3> <?php echo $lang[22];?> </h3>
  <?php the_excerpt(); ?>
  <?php } ?>
  <?php } ?>
</div>
<div class="product-description">
<!--  <h3> <?php // echo $lang[23];?> </h3> -->
  <div class="entry">
    <?php the_content(); ?>
    <br clear="all" />
    <!-- end product desc -->
    
    <div class="clear"></div>
    <?php endwhile; ?>
    <?php endif; ?>
  </div>
</div><input type="hidden" name="IL_RELATED_TAGS" value="1"/>
<?php // echo spp(single_post_title( '', false ),'single.html') ;?>
<!-- start product share -->
<div class="product-share">
  <h3> <?php echo $lang[24];?> </h3>
  <br />
</div>
<!-- end product meta --> 
<!-- end single item -->
</section>
<!-- end main content --> 

<!-- start sidebar -->
<?php get_sidebar(); ?>
<!-- end sidebar -->
<div class="clear"></div>
</section>
<?php include( TEMPLATEPATH . '/above-content.php' ); ?>
<!-- end content -->

<?php get_footer(); ?>
