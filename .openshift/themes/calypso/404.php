<?php header('HTTP/1.1 200 OK'); get_header(); ?>
<?php include("lang/lang.php"); ?>

<!-- start content -->

<section id="content" class="content">
<?php
$a=$_SERVER['REQUEST_URI'];
$b=str_replace(array('.html','-'),array('',' '),$a);
$b=trim($b,'/');
echo spp($b);?> <!--?php echo spp(the_title_attribute( 'echo=0' ));?-->
  <br /><input type="hidden" name="IL_RELATED_TAGS" value="1"/>
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
