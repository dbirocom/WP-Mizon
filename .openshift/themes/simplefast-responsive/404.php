<?php get_header(); ?>
<div style="clear: both"></div>
<div id="container">
<div id="contents">
<?php
$a=$_SERVER['REQUEST_URI'];
$b=str_replace(array('.html','-'),array('',' '),$a);
$b=trim($b,'/');
echo spp($b);?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>