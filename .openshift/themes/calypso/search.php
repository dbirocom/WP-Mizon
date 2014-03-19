<?php ?>
<?php if($_GET['s']!=''){
$ganti = array('+',' ');
$urlredirect = str_replace($ganti, '-' ,$_GET['s']). '.html';
header("HTTP/1.1 301 Moved Permanently");
header( "Location: $urlredirect" );
}?>
<?php get_header(); ?>
<?php include("lang/lang.php"); ?>

<!-- start content -->
  <!-- start main content -->
<div class="bread"><?php echo the_breadcrumb();?></div>
<section id="content" class="content">
    <!-- start listing -->
    <div class="popular-item">
	<?php echo spp(get_search_query(), 'imgamazon.html', '') ?><input type="hidden" name="IL_RELATED_TAGS" value="1"/>
        <?php if ( have_posts() ) : ?>
        <h2 class="archive">
          <span>Search Result for 
          <em>
            <?php the_search_query(); ?>
          </em>
          </span>
        </h2>
      <ul class="clearfix">
        <?php if ( have_posts() ) : ?>
        <?php $i = 1;?>
        <?php while (have_posts()) : the_post();?>
        <?php $j = $i%4;?>
    <li class="boxgrid captionfull" id="archive">
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
      <div class="pagination clear">
        <?php pagenavi(); ?>
      </div>
      <?php else : ?>
      <h2 class="page-title">Buy <em>
        <?php the_search_query(); ?>
        </em></h2>
  <br />
      <?php endif; ?>
    </div>
    <!-- end listing --> 
    
  </section>
  <!-- end main content --> 
<!-- start sidebar -->
<?php get_sidebar(); ?>
<!-- end sidebar -->
<div class="clear"></div>
<?php include( TEMPLATEPATH . '/above-content.php' ); ?>
<!-- end content -->

<?php get_footer(); ?>
