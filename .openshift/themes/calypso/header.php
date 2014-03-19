<?php ?>
<?php
	if ( function_exists( 'ot_get_option') ) {
		$bgimages = ot_get_option( 'bgimages'); 
		$favicon = ot_get_option( 'favicon'); 
		$logo = ot_get_option( 'logo'); 
		$skin = ot_get_option( 'skin'); 
		$color = ot_get_option( 'color');
		$phone = ot_get_option( 'phone');
		$mail = ot_get_option( 'mail');
		$twitter = ot_get_option( 'twitter');
		$facebook = ot_get_option( 'facebook'); 
		$googleplus = ot_get_option( 'googleplus'); 
		$flickr = ot_get_option( 'flickr'); 
		if($color=="blue"){
			$color= 'blue';
		}
		if($color=="green"){
			$color= 'green';
		}
		if($color=="yellow"){
			$color= 'yellow';
		}
		if($color=="red"){
			$color = 'red';
		}
		if($color=="purple"){
			$color = 'purple';
		}
		if($color=="default"){
			$color = 'default';
		}
		if($bgimages==""){
			$bgimages = get_template_directory_uri() . '/img/header.jpg';
		}
		if($logo==""){
			$logo = get_template_directory_uri() . '/img/logo.png';
		}
		if($skin==""){
			$skin = 'grey';
		}
	}
?>
<!doctype html>

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>
<?php
		global $page, $paged;
		wp_title( '|', true, 'right' );
		bloginfo( 'name' );
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			echo " | $site_description";
		if ( $paged >= 2 || $page >= 2 )
			echo ' | ' . sprintf( __( 'Page %s', 'calypso' ), max( $paged, $page ) );
		?>
</title>
<link rel="shortcut icon" type="image/x-icon" href="<?php echo esc_url( home_url( '/' ) ); ?>wp-content/themes/calypso/favicon.ico" >
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>">
<meta name="description" content="<?php bloginfo('description'); ?>">
<meta name="author" content="WizardTheme.com">
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>">
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/<?php echo $color ?>.css">
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/flexslider.css">
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/media.css">
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/font/style.css">
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/cloud-zoom.css">
<script type='text/javascript' src='<?php bloginfo('template_url'); ?>/js/tabs.js'></script>
<script src="<?php bloginfo('template_directory'); ?>/js/libs/modernizr-2.5.3-respond-1.1.0.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/libs/jquery-1.7.2.min.js"></script>
<script type="text/javascript">
		$(document).ready( function(){
			// Hide all Modal Boxes
			$('div.modal-box').show();
			// Display appropriate box on click - adjust this as required for your website
			$('span.modal-link').click(function() {
				var modalBox = $(this).attr('rel');
				$('div'+modalBox).fadeIn('slow');
			});
			// Multiple ways to close a Modal Box
			$('span.modal-close').click(function() {
				$(this).parents('div.modal-box').fadeOut('slow');
			});
		});
	</script>
<script type='text/javascript' src='<?php bloginfo('template_url'); ?>/js/libs/jquery-1.7.2.min.js'></script>
<script type="text/javascript">
var infolinks_pid = 1135079;
var infolinks_wsid = 10;
</script>
<script type="text/javascript" src="http://resources.infolinks.com/js/infolinks_main.js"></script>
<script>
jQuery(document).ready(function($){

	/* prepend menu icon */
	$('.header-nav, .menu-nav-menu-container, .selectopt').prepend('<div id="menu-icon">Navigation</div>');
	
	/* toggle nav */
	$("#menu-icon").on("click", function(){
		$("#menu-main-menu, ul#menu-main-menu, #menu-nav-menu, selectmenu").slideToggle();
		$(this).toggleClass("active");
	});

});
</script>
<script type='text/javascript' src='<?php bloginfo('template_url'); ?>/js/libs/jquery-1.7.2.min.js'></script>
<script type="text/javascript">
$(document).ready(function(){  
    //To switch directions up/down and left/right just place a "-" in front of the top/left attribute 
    //Full Caption Sliding (Hidden to Visible)  
    $('.boxgrid.captionfull').ready(function(){  
        $(".cover", this).stop().animate({bottom:'260px'},{queue:false,duration:300});
    });  
    $('.boxgrid.captionfull').hover(function(){  
        $(".cover", this).stop().animate({bottom:'0px'},{queue:false,duration:300});
    }, function() {  
        $(".cover", this).stop().animate({bottom:'260px'},{queue:false,duration:300});  
    });  
    //Caption Sliding (Partially Hidden to Visible)  
});
</script>
<b:if cond='data:blog.url == data:blog.homepageUrl'>
  <link href='<?php echo $googleplus ?>' rel='publisher'/>
</b:if>
<script type='text/javascript' src='<?php bloginfo('template_url'); ?>/js/aso.slideout.js?ver=1.2'></script>
<script type='text/javascript' src='<?php bloginfo('template_url'); ?>/js/jquery.floatingbox.js?ver=1.2'></script>
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/afds.css">
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/mainbody.css">
<?php wp_head(); ?>
</head>
<body>
<div>
<div itemscope='' itemtype='http://data-vocabulary.org/Review-aggregate'>
<div id="skin" class="<?php echo $skin ?>">
<div class="clear"></div>
<div id="wrapper">
<header id="header">
<div class="top-header">
  <div class="top-header-left">
    <ul>
      <li class="phone"><?php echo $phone ?></li>
      <li class="mail"><a href="mailto:<?php echo $mail ?>" target="_blank"><?php echo $mail ?></a></li>
    </ul>
  </div>
  <div class="top-header-right">
    <ul>
      <li><a href="<?php echo $twitter ?>" class="twitter" target="_blank">Twitter</a></li>
      <li><a href="<?php echo $facebook ?>" class="facebook" target="_blank">Facebook</a></li>
      <li><a href="<?php echo $googleplus ?>" class="googleplus" target="_blank">GooglePlus</a></li>
      <li><a href="<?php echo $flickr ?>" class="flickr" target="_blank">Flickr</a></li>
    </ul>
  </div>
  <div class="clear"></div>
</div>
<div class="clear"></div>
<?php wp_nav_menu( array(
    'container' => 'nav',
    'container_class' => 'header-nav',
    'menu_class' => 'sf-menu', 
    'theme_location' => 'primary'
) )?>
<div class="clear"></div>
<div class="header-wrapper" id="bgimages" style="background:url(<?php echo $bgimages ?>); -webkit-background-size: cover; -moz-background-size: cover;	-o-background-size: cover; background-size: cover;">
<div class="header-left"></div>
<div id="logo">
  <?php if (ot_get_option('logotype')=="text")  { ?>
  <div class="logotext"> <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
    <?php             
    $completeName = get_bloginfo('name');
    $split = explode(" ",$completeName);
    echo '<span>'.$split[0].'</span> '.$split[1].' '.$split[2].' '.$split[3].' '.$split[4];
  	?>
    <h3 class="description">
      <?php bloginfo("description"); ?>
    </h3>
    </a>
    <?php } else { ?>
    <div class="logoimg">
      <?php if (ot_get_option('logotype')=="logo")  { ?>
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo $logo ?>" alt="<?php bloginfo( 'name' ); ?>"/></a>
      <?php } else { ?>
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo $logo ?>" alt="<?php bloginfo( 'name' ); ?>"/></a>
      <?php } ?>
      <?php } ?>
    </div>
  </div>
  <div class="search-form">
    <?php $asr=$_SERVER['REQUEST_URI'];
  preg_match('/\\/(.*?)\\//',$asr,$matchs);
  $bsr = $matchs[1];
  if ( $bsr == 'tag' ) { get_search_form(); } ?>
  </div>
  <div class="clear"></div>
</div>
</header>
