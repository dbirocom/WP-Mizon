<?php ?>
<?php get_header(); ?>
<?php include("lang/lang.php"); ?>

<!-- start content -->
<div class="bread"><?php echo the_breadcrumb();?></div>
<section id="content" class="content">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<!-- start listing -->
<div class="post-content">
<div class="heading-bg">
  <h2 class="page">
  	<span>
    <?php the_title(); ?>
    </span>
  </h2>
  <div class="post-content">
    <?php the_content(); ?>
  </div>
</div>
<!-- end listing -->
<?php endwhile; ?>
<?php endif; ?>
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
