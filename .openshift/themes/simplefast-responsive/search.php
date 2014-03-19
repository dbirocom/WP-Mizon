<?php if($_GET['s']!=''){
$ganti = array('+',' ');
$urlredirect = str_replace($ganti, '-' ,$_GET['s']). '.html';
header("HTTP/1.1 301 Moved Permanently");
header( "Location: $urlredirect" );
}?>
<?php get_header(); ?>
<div style="clear: both"></div>
<div id="container">
<div id="contents">
<h1><?php echo get_search_query(); ?></h1><br />
<?php echo spp(get_search_query(), 'search.html', '');?>

<?php get_template_part( 'loop' ); ?>	
<div style="clear: both"></div>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>