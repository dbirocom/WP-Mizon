<aside id="sidebar"><div style="clear: both"></div>
<div class="box">
<form role="search" method="get" id="searchform" action="<?php echo home_url();?>" >
	<div style="text-align:center; background-color:#f9e886;"><br />
	<input type="text" size="20px" name="s" id="s" /><br />
	<input type="submit" id="searchsubmit" value="Search" /><br />
	</div>
</form>
</div>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar') ) : ?>	
<?php endif; ?>	
  <div class="box">
  <h4>Popular Search</h4>
  <ul>
  <?php
	echo do_shortcode('[spp_random_terms count=25]');
  ?>
  </ul>
  </div>
</aside>