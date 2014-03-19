<?php 

add_filter( 'ot_show_pages', '__return_false' ); 
add_filter( 'ot_theme_mode', '__return_true' ); 
include_once( 'option-tree/ot-loader.php' );

// Initialize theme options
include_once( 'functions/theme-options.php' );

//Post thumbnail support
if ( function_exists( 'add_theme_support' ) ) {  
    add_theme_support( 'post-thumbnails' );  
}

// Custom admin footer
function remove_footer_admin () {
echo 'Fueled by <a href="http://www.wordpress.org" target="_blank">WordPress</a> | Designed and developed by WizardTheme.</p>';
}
add_filter('admin_footer_text', 'remove_footer_admin');

// Hide login error
add_filter('login_errors', create_function('$a', "return null;"));

// Remove version info from head and feeds
function complete_version_removal() {
	return '';
}
add_filter('the_generator', 'complete_version_removal');

// Register area for custom menu
function register_my_menus() {
  register_nav_menus(
    array(
      'primary' => __( 'Header Navigation')
    )
  );
}
add_action( 'init', 'register_my_menus' );

// Trim title
function the_trim_title($before = '', $after = '', $echo = true, $length = false) {
	$title = get_the_title();
    if ( $length && is_numeric($length) ) {
	$title = substr( $title, 0, $length );
	}
	if ( strlen($title)> 0 ) {
	$title = apply_filters('the_trim_title', $before . $title . $after, $before, $after);
	if ( $echo )
	echo $title;
	else
	return $title;
	}
}

// Register widgets
if ( function_exists('register_sidebar') )
register_sidebar(array(
'name' => 'Sidebar',
'before_widget' => '<div class="sidebar-widget">',
'after_widget' => '</div>',
'before_title' => '<h3>',
'after_title' => '</h3>',
));
if ( function_exists('register_sidebar') )
register_sidebar(array(
'name' => 'Footer Menu',
'before_widget' => '<div class="footer-menu">',
'after_widget' => '</div>',
'before_title' => '<h3>',
'after_title' => '</h3>',
));

// Custom Excerpt Length
function excerpt($limit) {
      $excerpt = explode(' ', get_the_excerpt(), $limit);
      if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).' ';
      } else {
        $excerpt = implode(" ",$excerpt);
      } 
      $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
      return $excerpt;
    }

    function content($limit) {
      $content = explode(' ', get_the_content(), $limit);
      if (count($content)>=$limit) {
        array_pop($content);
        $content = implode(" ",$content).'';
      } else {
        $content = implode(" ",$content);
      } 
      $content = preg_replace('/\[.+\]/','', $content);
      $content = apply_filters('the_content', $content); 
      $content = str_replace(']]>', ']]&gt;', $content);
      return $content;
    }

function get_excerpt(){
$excerpt = get_the_content();
$excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
$excerpt = strip_shortcodes($excerpt);
$excerpt = strip_tags($excerpt);
$excerpt = substr($excerpt, 0, 80);
$excerpt = substr($excerpt, 0, strripos($excerpt, " "));
$excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
$excerpt = $excerpt.'... <a href="'.$permalink.'"></a>';
return $excerpt;
}

function string_limit_words($string, $word_limit)
{
  $words = explode(' ', $string, ($word_limit + 1));
  if(count($words) > $word_limit)
  array_pop($words);
  return implode(' ', $words);
}

// Build breadcrumbs
function the_breadcrumb() {
	if (!is_home()) {
		echo '<div class="homes"><a href="';
		echo get_option('home');
		echo '" class="home">';
		echo "Home";
		echo "</a></div>";
		if (is_category() || is_single()) {
			single_cat_title();
			if (is_single()) {
			echo '<div class="categories">';
			the_category(' ');
			echo "</div>";
			echo '<div class="categories-title">';
			the_title();
			echo "</div>";
			}
		} elseif (is_page()) {
			echo ' &nbsp; ';
			echo " &nbsp; ";
			echo the_title();
		}
		  elseif (is_tag()) {
			echo 'Posts tagged with "'; 
			single_tag_title();
			echo '"'; }
		elseif (is_day()) {echo "Archive for "; the_time(' F jS, Y');}
		elseif (is_month()) {echo "Archive for "; the_time(' F, Y');}
		elseif (is_year()) {echo "Archive for "; the_time(' Y');}
		elseif (is_author()) {echo "Author Archive";}
		elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "Blog Archives";}
		elseif (is_search()) {echo the_search_query();}
	}
	if (is_home()) {
		echo '<a href="';
		echo get_option('home');
		echo ' &nbsp; ';
		echo "Home";
		echo "</a>";
		echo " &nbsp; ";
		bloginfo('name');
	}
}

function pagenavi() {
  global $wp_query, $wp_rewrite;
  $pages = '';
  $max = $wp_query->max_num_pages;
  if (!$current = get_query_var('paged')) $current = 1;
  $a['base'] = str_replace(999999999, '%#%', get_pagenum_link(999999999));
  $a['total'] = $max;
  $a['current'] = $current;
 
  $total = 1; 
  $a['mid_size'] = 7;
  $a['end_size'] = 1;
  $a['prev_text'] = __('&laquo; Prev', 'specta'); 
  $a['next_text'] = __('Next &raquo;', 'specta'); 
 
  if ($max > 1) echo '<div class="navigation">';
  if ($total == 1 && $max > 1) $pages = __('<span class="pages">Page ' . $current . ' of ' . $max . '</span>'."\r\n", 'inova');
  echo $pages . paginate_links($a);
  if ($max > 1) echo '</div>';
}

// Twitter Follower Numbers
function twitter_followers($twitter_user) {
	 $url="http://twitter.com/users/show.xml?screen_name=". $twitter_user;
	 $ch = curl_init();
	 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	 curl_setopt($ch, CURLOPT_URL, $url);
	 $data = curl_exec($ch);
	 curl_close($ch);
	 $xml = new SimpleXMLElement($data);
	 $tw_fol_count = $xml->followers_count;
	 if ($tw_fol_count == false) { echo '512'; }
	 else { echo number_format($tw_fol_count); }
}

// Get Feedburner RSS Subscriber Count
function diww_fb_count ($fb_user) {
	$fburl="https://feedburner.google.com/api/awareness/1.0/GetFeedData?uri=". $fb_user;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_URL, $fburl);
	$stored = curl_exec($ch);
	curl_close($ch);
	$grid = new SimpleXMLElement($stored);
	$rsscount = $grid->feed->entry['circulation']+0;
	return number_format($rsscount);
}
function diww_fb_count_run($feed) {
	$fb_subs = diww_fb_count ($feed);
	$fb_option = "diww_fb_sub_value";
	$fb_subscount = get_option($fb_option);
	if (is_null($fb_subs)) { return $fb_subscount; }
	else {update_option($fb_option, $fb_subs); return $fb_subs;}
}
function diww_fb_sub_value($feed) {
	echo diww_fb_count_run($feed);
}

?>