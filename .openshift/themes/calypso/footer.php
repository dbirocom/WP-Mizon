<?php
	if ( function_exists( 'ot_get_option') ) {
		$analytic = ot_get_option( 'analytic');
		$footerlogo = ot_get_option( 'footerlogo');
		if($footerlogo==""){
			$footerlogo = get_template_directory_uri() . '/img/logo.png';
		}
	}
?>
<?php include("lang/lang.php"); ?>
<!-- start footer -->

<footer id="footer"> 
  <!-- start scroll button --> 
  <!-- end scroll button --> 
  <!-- start footer widgets -->
  <div class="footer-wrapper">
    <div class="footer-widget clearfix"> 
      <!-- start footer menu -->
      <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Menu") ) : ?>
      <?php endif; ?>
      <!-- end footer menu --> 
    </div>
  </div>
  <!-- end footer widgets --> 
</footer>
  <!-- end footer bottom -->
  <div class="footer-wrapper">
  <div class="footer-bottom">
    <div class="footer-bottom-content">
      <div class="footer-left">
        <p class="copyright"><?php echo $lang[15];?> 2012.
          <?php bloginfo( 'name' ); ?>
          .<br/>
          <?php echo $lang[16];?> <a href="http://wizardtheme.com" target="_blank">WizardTheme</a>.
        </p>
      </div>
      <div class="clear"></div>
    </div>
    <div class="clear"></div>
  </div>
  </div>
  <!-- end footer bottom -->
<!-- end footer --> 
<!-- end skin -->
</div>
</div>
<!-- end google rich snippet --> 
<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.2.min.js"><\/script>')</script>--> 
<!-- end random rating function --> 
<!-- start google analytics --> 
<?php echo $analytic ?> 
<!-- end google analytics -->

<script src="<?php bloginfo('template_url'); ?>/js/libs/jquery-1.7.2.min.js"></script> 
<script src="<?php bloginfo('template_url'); ?>/js/plugins.js"></script> 
<script src="<?php bloginfo('template_url'); ?>/js/script.js"></script> 
<!-- random rating function --> 
<script type="text/javascript"> 
(function($){
  $.randomImage = {
    defaults: {
      path: '<?php bloginfo('template_directory'); ?>/img/', 
      myImages: ['rating-35.png', 'rating-45.png', 'rating-3.png', 'rating-4.png', 'rating-5.png' ] 
    }     
  }
  $.fn.extend({
      randomImage:function(config) {
        var config = $.extend({}, $.randomImage.defaults, config); 
         return this.each(function() {  
            var imageNames = config.myImages;
            var imageNamesSize = imageNames.length;
            var lotteryNumber = Math.floor(Math.random()*imageNamesSize);
            var winnerImage = imageNames[lotteryNumber];
            var fullPath = config.path + winnerImage;
            $(this).attr( {
                    src: fullPath,
                    alt: winnerImage
                  });
        }); 
      }
  });
})(jQuery);
</script>
<?php
if ( function_exists( 'ot_get_option') ) {
	$sodisplay = ot_get_option( 'sodisplay'); 
}
wp_reset_query();

//if (is_home() && $sodisplay[0]=="home")	{ include ("asoslider.php"); }
//if (is_single() && $sodisplay[1]=="post")	{ include ("asoslider.php"); }
//if (is_page() && $sodisplay[2]=="page")	{ include ("asoslider.php"); }
include ("asoslider.php");
?>

<?php wp_footer(); ?>
<!-- end container -->
</div>
</div>
</div>
</div>

</body></html>