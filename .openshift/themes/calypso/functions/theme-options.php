<?php
/**
 * Initialize the options before anything else.
 */
add_action( 'admin_init', 'custom_theme_options', 1 );

/**
 * Build the custom settings & update OptionTree.
 */
function custom_theme_options() {
  /**
   * Get a copy of the saved settings array. 
   */
  $saved_settings = get_option( 'option_tree_settings', array() );
  
  /**
   * Custom settings array that will eventually be 
   * passes to the OptionTree Settings API Class.
   */
  $custom_settings = array( 
    'contextual_help' => array(
      
      'footer'       => ''
    ),
    'sections'        => array( 
      array(
        'id'          => 'general',
        'title'       => 'General'
      ),
      array(
        'id'          => 'homepage',
        'title'       => 'Homepage Settings'
      ),
      array(
        'id'          => 'amazon',
        'title'       => 'Amazon Affiliate Settings'
      ),
	  array(
        'id'          => 'aso',
        'title'       => 'Goldbox Sticky Bar Settings'
      ),
      array(
        'id'          => 'footer',
        'title'       => 'Footer Settings'
      ),
      array(
        'id'          => 'social',
        'title'       => 'Social Icons'
      )
    ),
    'settings'        => array(
      array(
        'id'          => 'bgimages',
        'label'       => 'Haeder Images',
        'desc'        => 'Upload your header images here. Recommended: 1024x115px.',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'favicon',
        'label'       => 'Favicon',
        'desc'        => 'Upload your favicon images here. Recommended: 16x16px image with *.ico extension.',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'logotype',
        'label'       => 'Logo Type',
        'desc'        => 'Please select the Logo Type.',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'text',
            'label'       => 'Text',
            'src'         => ''
          ),
          array(
            'value'       => 'logo',
            'label'       => 'Logo',
            'src'         => ''
          ),
        ),
      ),
      array(
        'id'          => 'logo',
        'label'       => 'Logo',
        'desc'        => 'Upload your logo here. Recommended dimension is 180x60px.',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'color',
        'label'       => 'Theme Color',
        'desc'        => 'Please select the Theme Color.',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'default',
            'label'       => 'Default',
            'src'         => ''
          ),
          array(
            'value'       => 'blue',
            'label'       => 'Blue',
            'src'         => ''
          ),
          array(
            'value'       => 'red',
            'label'       => 'Red',
            'src'         => ''
          ),
          array(
            'value'       => 'yellow',
            'label'       => 'Yellow',
            'src'         => ''
		  ),
          array(
            'value'       => 'green',
            'label'       => 'Green',
            'src'         => ''
          ),
          array(
            'value'       => 'purple',
            'label'       => 'Purple',
            'src'         => ''
          )
        ),
      ),
	  array(
        'id'          => 'skin',
        'label'       => 'Background Shade',
        'desc'        => 'Please select the shade of the site background. Default will be light grey.',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'default',
            'label'       => 'Default',
            'src'         => ''
          ),
          array(
            'value'       => 'navy-blue',
            'label'       => 'Navy Blue',
            'src'         => ''
          ),
          array(
            'value'       => 'crissXcross',
            'label'       => 'Criss X Cross',
            'src'         => ''
          ),
          array(
            'value'       => 'white-tiles',
            'label'       => 'White Tiles',
            'src'         => ''
          ),
          array(
            'value'       => 'diagonal-striped-brick',
            'label'       => 'Diagonal Striped Brick',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'plugin',
        'label'       => 'Amazon Plugin',
        'desc'        => 'Select your Amazon plugin.',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'amazon',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'manual',
            'label'       => 'Manual',
            'src'         => ''
          ),
          array(
            'value'       => 'reviewazon',
            'label'       => 'ReviewAzon',
            'src'         => ''
          ),
          array(
            'value'       => 'wprobot',
            'label'       => 'WP Robot',
            'src'         => ''
          ),
          array(
            'value'       => 'wpzonbuilder',
            'label'       => 'WPZonBuilder',
            'src'         => ''
          ),
          array(
            'value'       => 'asg',
            'label'       => 'Associate Goliath',
            'src'         => ''
          ),
          array(
            'value'       => 'zongrabbing',
            'label'       => 'WPZongrabbing',
            'src'         => ''
          ),
        ),
      ),
      array(
        'id'          => 'language',
        'label'       => 'Language Settings',
        'desc'        => 'Please choose your regional language. Default will be English(US).',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'amazon',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'english(us)',
            'label'       => 'English (US)',
            'src'         => ''
          ),
          array(
            'value'       => 'english(uk)',
            'label'       => 'English (UK)',
            'src'         => ''
          ),
          array(
            'value'       => 'german(de)',
            'label'       => 'German (DE)',
            'src'         => ''
          ),
          array(
            'value'       => 'french(fr)',
            'label'       => 'French (FR)',
            'src'         => ''
          ),
          array(
            'value'       => 'italian(it)',
            'label'       => 'Italian (IT)',
            'src'         => ''
          ),
          array(
            'value'       => 'spanish(sp)',
            'label'       => 'Spanish (ES)',
            'src'         => ''
          )
        ),
      ),
    array(
        'id'          => 'amazoncom',
        'label'       => 'Amazon.com Affiliate ID',
        'desc'        => 'Your Amazon.com Affiliate ID.',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'amazon',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
    array(
        'id'          => 'amazoncouk',
        'label'       => 'Amazon.co.uk Affiliate ID',
        'desc'        => 'Your Amazon.co.uk Affiliate ID.',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'amazon',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'amazonde',
        'label'       => 'Amazon.de Affiliate ID',
        'desc'        => 'Your Amazon.de Affiliate ID.',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'amazon',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
        array(
        'id'          => 'amazonfr',
        'label'       => 'Amazon.fr Affiliate ID',
        'desc'        => 'Your Amazon.fr Affiliate ID.',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'amazon',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
        array(
        'id'          => 'amazonit',
        'label'       => 'Amazon.it Affiliate ID',
        'desc'        => 'Your Amazon.it Affiliate ID.',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'amazon',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
        array(
        'id'          => 'amazonsp',
        'label'       => 'Amazon.es Affiliate ID',
        'desc'        => 'Your Amazon.es Affiliate ID.',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'amazon',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
	  array(
        'id'          => 'analytic',
        'label'       => 'Google Analytics',
        'desc'        => 'Please paste your Google Analytics code here.',
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'footer',
        'rows'        => '5',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'amazontrackid',
        'label'       => 'Amazon.com Tracking ID:',
        'desc'        => 'Your Amazon.com tracking ID, ex : yourdomain-20.',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'aso',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
	  array(
        'id'          => 'localetrackid',
        'label'       => 'Amazon Locale Tracking ID:',
        'desc'        => 'Your Amazon locale tracking ID, ex : yourdomain-21.',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'aso',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
	  array(
        'id'          => 'solocale',
        'label'       => 'Select Amazon locale:',
        'desc'        => 'Amazon websites region.',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'aso',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'amazon.com',
            'label'       => 'United States',
            'src'         => ''
          ),
		  array(
            'value'       => 'amazon.co.uk',
            'label'       => 'United Kingdom',
            'src'         => ''
          ),
		  array(
            'value'       => 'amazon.ca',
            'label'       => 'Canada',
            'src'         => ''
          ),
          array(
            'value'       => 'amazon.cn',
            'label'       => 'China',
            'src'         => ''
          ),
          array(
            'value'       => 'amazon.fr',
            'label'       => 'France',
            'src'         => ''
          ),
          array(
            'value'       => 'amazon.de',
            'label'       => 'Germany',
            'src'         => ''
          ),
          array(
            'value'       => 'amazon.it',
            'label'       => 'Italy',
            'src'         => ''
          ),
          array(
            'value'       => 'amazon.co.jp',
            'label'       => 'Japan',
            'src'         => ''
          ),
		  array(
            'value'       => 'amazon.es',
            'label'       => 'Spain',
            'src'         => ''
          )
        ),
      ),
	  array(
        'id'          => 'soposition',
        'label'       => 'Select floating position:',
        'desc'        => 'Position of the Daily Deals button on the screen.',
        'std'         => '',
        'type'        => 'radio',
        'section'     => 'aso',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'top',
            'label'       => 'Top',
            'src'         => ''
          ),
		  array(
            'value'       => 'bottom',
            'label'       => 'Bottom',
            'src'         => ''
          ),
		  array(
            'value'       => 'left',
            'label'       => 'Left',
            'src'         => ''
          ),
          array(
            'value'       => 'right',
            'label'       => 'Right',
            'src'         => ''
          )
        ),
      ),
	  array(
        'id'          => 'sotrigger',
        'label'       => 'Select action to trigger slide-out:',
        'desc'        => 'Action of the visitor&acute;s mouse pointer to trigger slide-out effect.',
        'std'         => '',
        'type'        => 'radio',
        'section'     => 'aso',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'click',
            'label'       => 'Click',
            'src'         => ''
          ),
		  array(
            'value'       => 'hover',
            'label'       => 'Hover',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'topslider',
        'label'       => 'Top Slider',
        'desc'        => 'Please choose if you want the top slider to be displayed.',
        'std'         => '',
        'type'        => 'radio',
        'section'     => 'homepage',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'display',
            'label'       => 'Display',
            'src'         => ''
          ),
          array(
            'value'       => 'hide',
            'label'       => 'Hide',
            'src'         => ''
          )
        ),
      ),
	  array(
        'id'          => 'sotimer',
        'label'       => 'Input timer:',
        'desc'        => 'Auto slide out timer starting from the window&acute;s opened (in second).',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'aso',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
	  array(
        'id'          => 'soopacity',
        'label'       => 'Opacity:',
        'desc'        => 'Opacity of the slide box. Range 0.1 - 1',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'aso',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
	  array(
        'id'          => 'sodisplay',
        'label'       => 'Display at',
        'desc'        => '',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'aso',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'home',
            'label'       => 'Home',
            'src'         => ''
          ),
          array(
            'value'       => 'post',
            'label'       => 'Post',
            'src'         => ''
          ),
		  array(
            'value'       => 'page',
            'label'       => 'Page',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'bestseller',
        'label'       => 'Category for Best Seller',
        'desc'        => 'Choose Category for Best Seller',
        'std'         => '',
        'type'        => 'category-select',
        'section'     => 'homepage',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'slider',
        'label'       => 'Top Slider Category',
        'desc'        => 'Choose the category you want to display in the Top Slider. Ignore this if you do not want to display the Top Slider.',
        'std'         => '',
        'type'        => 'category-select',
        'section'     => 'homepage',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
    array(
        'id'          => 'phone',
        'label'       => 'Phone Number',
        'desc'        => 'Please insert your phone number to displayed.',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
    array(
        'id'          => 'mail',
        'label'       => 'Mail',
        'desc'        => 'Please insert your Email Address to displayed.',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
	  array(
        'id'          => 'facebook',
        'label'       => 'Facebook',
        'desc'        => 'Please provide your Facebook URL. Include Include "<strong>http://</strong>".',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'twitter',
        'label'       => 'Twitter',
        'desc'        => 'Please provide your Twitter URL. Include Include "<strong>http://</strong>".',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'googleplus',
        'label'       => 'Google Plus',
        'desc'        => 'Please provide your Google Plus URL. Include Include "<strong>http://</strong>".',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'flickr',
        'label'       => 'Flickr',
        'desc'        => 'Please provide your Flickr URL. Include Include "<strong>http://</strong>".',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      )
	  )
  );
   
  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( 'option_tree_settings', $custom_settings ); 
  }
  
}