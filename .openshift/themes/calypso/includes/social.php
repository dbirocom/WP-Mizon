<ul>
  <li class="facebook-btn"> 
    <script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) {return;}
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
    <div class="fb-like" data-send="false" data-width="250" data-show-faces="false"></div>
    <!-- end facebook --> 
  </li>
  <li class="twitter-btn"> <a href="https://twitter.com/share" class="twitter-share-button">Tweet</a> 
    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script> 
    <!-- end twitter --> 
  </li>
  <li class="googleplus-btn">
    <g:plusone></g:plusone>
    <script type="text/javascript">
		  (function() {
			var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
			po.src = 'https://apis.google.com/js/plusone.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
		  })();
		</script> 
    <!-- end google plus --> 
  </li>
  <li class="pinterest-btn"> <a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo get_post_meta($post->ID, "amzn_LargeImageURL", true); ?>" class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a> 
    <!-- end pinterest --> 
  </li>
</ul>
