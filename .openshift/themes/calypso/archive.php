<?php ?>
<?php get_header(); ?>
<?php include("lang/lang.php"); ?>

<!-- start content -->
<div class="bread"><?php echo the_breadcrumb();?></div>
<section id="content" class="content">
    <!-- start listing -->
    <div class="popular-item">
        <h2 class="archive">
          <span>
          <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
          <?php /* If this is a category archive */ if (is_category()) { ?>
          Archive for the &#8216;
          <?php single_cat_title(); ?>
          &#8217; Category
          <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
          Posts Tagged &#8216;
          <?php single_tag_title(); ?>
          &#8217;
          <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
          Archive for
          <?php the_time('F jS, Y'); ?>
          <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
          Archive for
          <?php the_time('F, Y'); ?>
          <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
          Archive for
          <?php the_time('Y'); ?>
          <?php /* If this is an author archive */ } elseif (is_author()) { ?>
          Author Archive
          <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
            Blog Archives
            <?php } ?>
            </span>
        </h2>
      <ul class="clearfix">
        <?php wp_reset_query(); ?>
        <?php if ( have_posts() ) : ?>
        <?php $i = 1;?>
        <?php while (have_posts()) : the_post();?>
        <?php $j = $i%4;?>
    <li class="boxgrid captionfull" id="archive">
      <div class="specials"></div>
      <center>
        <?php include("includes/thumb.php"); ?>
      </center>
        <div class="cover boxcaption">
          <h5><a href="<?php the_permalink(); ?>">
            <?php the_trim_title('', '', true, '35'); ?>
            </a></h5>
          <img class="shuffle" src="" alt=""/> <span class="old-price">
          <div class=clear></div>
          <a href="javascript:void(0);" onclick="window.open ('<?php include("includes/link.php"); ?>','_blank')" rel="nofollow" class="buy">
            <span><?php echo $lang[1];?></span></a> 
            <div class=clear></div>
          <?php include("includes/old-price.php"); ?>
          </span> <span class="price">
          <?php include("includes/price.php"); ?>
          </span> 
            <a href="<?php the_permalink(); ?>" rel="nofollow" class="detail"><span><?php echo $lang[3];?></span></a> 
          </div>
      <div class="clear"></div>
    </li>
        <?php $i++;?>
        <?php endwhile;?>
        <?php else : ?>
        <?php endif; ?>
      </ul>
      <div class="clear"></div>
  <br clear="all" />
  <?php pagenavi(); ?>
  <br clear="all" />
    </div>
    <!-- end listing --> 
    
  </section>
  <!-- end main content --> 
<!-- start sidebar -->
<?php get_sidebar(); ?>
<!-- end sidebar -->
<div class="clear"></div>
<?php get_footer(); ?>
