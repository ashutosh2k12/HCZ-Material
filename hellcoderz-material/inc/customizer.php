<?php
/**
 * Material Theme Customizer
 *
 * @package Casper
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function material_customize_register( $wp_customize ) {
	/**
	 * Adds textarea support to the theme customizer
	 */
	class Casper_textarea_control extends WP_Customize_Control {
	    public $type = 'textarea';

	    public function render_content() {
	        ?>
	            <label>
	                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	                <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
	            </label>
	        <?php
	    }
	}
	/**
	 * Adds primary menu support to theme customizer
	 */
	 class Menu_Dropdown_Custom_control extends WP_Customize_Control {

	 	public $type = 'select';

	 	public $menu_id;

	 	public function __construct( $manager, $id, $args = array(), $menu_id = '') {
	 		parent::__construct($manager, $id, $args);
	 		$this->menu_id = $menu_id;
	 	}

        public function render_content() {
        ?>
            <label>
              <span class="customize-menu-dropdown"><?php echo esc_html( $this->label ); ?></span>
              <?php
                  	
              ?>
              <?php /*
              <select name="<?php echo $this->id; ?>" id="<?php echo $this->id; ?>">
                <?php
                  echo '<option value="">---Select Menu---</option>';
                  if($menus){
                    foreach ( $menus as $menu ) {
                      echo '<option value="'.$menu->term_id.'"'.selected($this->value, $menu->term_id).'>'.$menu->name.'</option>';
                    }
                  }
                ?>
              </select>
              */ ?>
            </label>
        <?php
        }
    } 
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'refresh';

	/* ==========================================================================
    Author Info
    ========================================================================== */
	$wp_customize->add_section( 'material_author_section' , array(
		'title'		  => __( 'Yourself', 'hellcoderz-material' ),
		'priority' 	  => 10,
		'description' => 'Mention here something about yourself') );

	$wp_customize->add_setting( 'material_name', array('transport'   => 'postMessage','sanitize_callback' => 'material_sanitize_text'));
	$wp_customize->add_control('material_name', array('section' => 'material_author_section', 'label' => 'Full Name', 'type' => 'text'));
	$wp_customize->add_setting( 'material_designation', array('transport'   => 'postMessage','sanitize_callback' => 'material_sanitize_text'));
	$wp_customize->add_control('material_designation', array('section' => 'material_author_section', 'label' => 'Designation', 'type' => 'text'));

	/* ==========================================================================
    Logo Controls
    ========================================================================== */
	$wp_customize->add_section( 'material_logo_section' , array(
	    'title'       => __( 'Logo', 'hellcoderz-material' ),
	    'priority'    => 20,
	    'description' => 'Upload a logo to display before your name') );

	$wp_customize->add_setting( 'material_logo'  , array(
	    'transport'   => 'refresh',
	    'sanitize_callback' => 'material_sanitize_uri'
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'material_logo', array(
	    'label'    => __( 'Logo', 'hellcoderz-material' ),
	    'section'  => 'material_logo_section',
	    'settings' => 'material_logo',
	) ) );

	/* ==========================================================================
    Menu Icon Controls
    ========================================================================== */
	$wp_customize->add_section( 'material_menu_section' , array(
	    'title'       => __( 'Menu Icons', 'hellcoderz-material' ),
	    'priority'    => 50,
	    'description' => 'Enter font awesome code of icon against each menu to add respective icon. For example <code>fa-home</code> for home menu.') );

	$wp_customize->add_setting( 'material_menu_icon'  , array(
	    'transport'   => 'refresh',
	    'sanitize_callback' => 'material_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'material_menu_icon', array(
	    	'priority'	=> 6,
	        'section'   => 'material_menu_section',
	        'label'     => __( 'Add icons to primary menu', 'hellcoderz-material' ),
	        'type'      => 'checkbox'
	) );

	$menuitems = apply_filters('get_nav_menu_items','primary');

	foreach ($menuitems as $id => $item) {

		$wp_customize->add_setting( 'menu_item_'. $id, array('transport'=>'refresh','sanitize_callback' => 'material_sanitize_text') );
		$wp_customize->add_control('menu_item_'. $id, array('section' => 'material_menu_section', 'label' => $item, 'type' => 'text'));
	
	}
	

	/* ==========================================================================
    Contact Form Options
    ========================================================================== */
    $wp_customize->add_section( 'material_contact_section' , array(
	    'title'       => __( 'Contact Options', 'hellcoderz-material' ),
	    'priority'    => 30,
	    'description' => 'Multiple Phone numbers and emails can be separated by |.For ex: 9876543210|8765432109'
	) );

	$wp_customize->add_setting( 'material_contact_mob' , array( 'transport'   => 'postMessage', 'sanitize_callback' => 'material_sanitize_text' ));
	$wp_customize->add_control(
	    new Casper_textarea_control(
	        $wp_customize,
	        'material_contact_mob',
	        array(
	            'label' => 'Contact Numbers',
	            'section' => 'material_contact_section',
	            'settings' => 'material_contact_mob'
	        )
	    )
	);

	$wp_customize->add_setting( 'material_contact_address' , array( 'transport'   => 'postMessage', 'sanitize_callback' => 'material_sanitize_text' ));
	$wp_customize->add_control(
	    new Casper_textarea_control(
	        $wp_customize,
	        'material_contact_address',
	        array(
	            'label' => 'Home Address',
	            'section' => 'material_contact_section',
	            'settings' => 'material_contact_address'
	        )
	    )
	);

	$wp_customize->add_setting( 'material_contact_mails' , array( 'transport'   => 'postMessage', 'sanitize_callback' => 'material_sanitize_text' ));
	$wp_customize->add_control(
	    new Casper_textarea_control(
	        $wp_customize,
	        'material_contact_mails',
	        array(
	            'label' => 'Email Addresses',
	            'section' => 'material_contact_section',
	            'settings' => 'material_contact_mails'
	        )
	    )
	);
 
	/* ==========================================================================
    Color Controls
    ========================================================================== */
	$wp_customize->add_section( 'material_color_section' , array(
	    'title'       => __( 'Colors', 'hellcoderz-material' ),
	    'priority'    => 30
	) );

	// Header BG color
	$wp_customize->add_setting( 'material_header_bg_color' , array(
	    'default'     => '#009587',
	    'transport'   => 'postMessage',
	    'sanitize_callback' => 'material_sanitize_color'
	) );
	$wp_customize->add_control(
	    new WP_Customize_Color_Control(
	        $wp_customize,
	        'material_header_bg_color',
	        array(
	            'label'      => __( 'Header Background Color', 'hellcoderz-material' ),
	            'section'    => 'colors',
	            'settings'   => 'material_header_bg_color'
	        )
	    )
	);

	// Header BG color
	$wp_customize->add_setting( 'material_body_bg_color' , array(
	    'default'     => '#eee',
	    'transport'   => 'postMessage',
	    'sanitize_callback' => 'material_sanitize_color'
	) );
	$wp_customize->add_control(
	    new WP_Customize_Color_Control(
	        $wp_customize,
	        'material_bg_color',
	        array(
	            'label'      => __( 'Body Background Color', 'hellcoderz-material' ),
	            'section'    => 'colors',
	            'settings'   => 'material_body_bg_color'
	        )
	    )
	);

	/* ==========================================================================
    Theme Custom Options
    ========================================================================== */
	$wp_customize->add_section( 'material_options_section' , array(
	    'title'       => __( 'Theme Options', 'hellcoderz-material' ),
	    'priority'    => 30
	) );
	

	// Circle logo
	$wp_customize->add_setting('material_logo_circle',
	    array( 'default' =>  false, 'transport' => 'postMessage', 'sanitize_callback' => 'material_sanitize_checkbox' )
	);
	$wp_customize->add_control('material_logo_circle',
	    array('priority' => 3, 'section' => 'material_options_section', 'label'=> 'Make logo circular', 'type'=> 'checkbox' )
	);

	// Frame logo
	$wp_customize->add_setting('material_logo_frame',
	    array( 'default' =>  false, 'transport' => 'postMessage', 'sanitize_callback' => 'material_sanitize_checkbox' )
	);
	$wp_customize->add_control('material_logo_frame',
	    array( 'priority' => 4, 'section' => 'material_options_section', 'label' => 'Frame logo image','type' => 'checkbox')
	);

	// Automatically limit post summary
	$wp_customize->add_setting('material_auto_excerpt',
	    array( 'default' => false, 'transport' => 'refresh','sanitize_callback' => 'material_sanitize_checkbox' )
	);
	$wp_customize->add_control('material_auto_excerpt',
	    array( 'priority' => 6, 'section' => 'material_options_section', 'label' => 'Auto-limit summary length', 'type' => 'checkbox')
	);

	// Custom read more link
	$wp_customize->add_setting( 'material_read_more_link' , array( 'sanitize_callback' => 'material_sanitize_text' ));

	$wp_customize->add_control(
	    new Casper_textarea_control(
	        $wp_customize,
	        'material_read_more_link',
	        array(
	            'label' => '\'Read More\' link',
	            'section' => 'material_options_section',
	            'settings' => 'material_read_more_link'
	        )
	    )
	);


	/* ==========================================================================
    Social Icons
    ========================================================================== */
    $wp_customize->add_section( 'material_social', array(
	    'title'        => 'Social URLs',
	    'priority'     => 40
	    )
	);
	
	$wp_customize->add_setting('material_social_behance', array('transport' => 'refresh', 'sanitize_callback' => 'material_sanitize_uri'));
	$wp_customize->add_control('material_social_behance', array('section' => 'material_social', 'label' => 'Behance', 'type' => 'text'));
	$wp_customize->add_setting('material_social_bitbucket', array('transport' => 'refresh', 'sanitize_callback' => 'material_sanitize_uri'));
	$wp_customize->add_control('material_social_bitbucket', array('section' => 'material_social', 'label' => 'Bitbucket', 'type' => 'text'));
	$wp_customize->add_setting('material_social_codepen', array('transport' => 'refresh', 'sanitize_callback' => 'material_sanitize_uri'));
	$wp_customize->add_control('material_social_codepen', array('section' => 'material_social', 'label' => 'CodePen', 'type' => 'text'));
	$wp_customize->add_setting('material_social_deviantart', array('transport' => 'refresh', 'sanitize_callback' => 'material_sanitize_uri'));
	$wp_customize->add_control('material_social_deviantart', array('section' => 'material_social', 'label' => 'Deviant Art', 'type' => 'text'));	
	$wp_customize->add_setting('material_social_dribbble', array('transport' => 'refresh', 'sanitize_callback' => 'material_sanitize_uri'));
	$wp_customize->add_control('material_social_dribbble', array('section' => 'material_social', 'label' => 'Dribbble', 'type' => 'text'));
	$wp_customize->add_setting('material_social_facebook', array('transport' => 'refresh', 'default' => '#fb', 'sanitize_callback' => 'material_sanitize_uri'));
	$wp_customize->add_control('material_social_facebook', array('section' => 'material_social', 'label' => 'Facebook', 'type' => 'text'));
	$wp_customize->add_setting('material_social_flickr', array('transport' => 'refresh', 'sanitize_callback' => 'material_sanitize_uri'));
	$wp_customize->add_control('material_social_flickr', array('section' => 'material_social', 'label' => 'Flickr', 'type' => 'text'));
	$wp_customize->add_setting('material_social_github', array('transport' => 'refresh', 'default' => '#github', 'sanitize_callback' => 'material_sanitize_uri'));
	$wp_customize->add_control('material_social_github', array('section' => 'material_social', 'label' => 'GitHub', 'type' => 'text'));
	$wp_customize->add_setting('material_social_google', array('transport' => 'refresh', 'sanitize_callback' => 'material_sanitize_uri'));
	$wp_customize->add_control('material_social_google', array('section' => 'material_social', 'label' => 'Google+', 'type' => 'text'));
	$wp_customize->add_setting('material_social_instagram', array('transport' => 'refresh', 'sanitize_callback' => 'material_sanitize_uri'));
	$wp_customize->add_control('material_social_instagram', array('section' => 'material_social', 'label' => 'Instagram', 'type' => 'text'));
	$wp_customize->add_setting('material_social_lastfm', array('transport' => 'refresh', 'sanitize_callback' => 'material_sanitize_uri'));
	$wp_customize->add_control('material_social_lastfm', array('section' => 'material_social', 'label' => 'LastFM', 'type' => 'text'));
	$wp_customize->add_setting('material_social_linkedin', array('transport' => 'refresh', 'sanitize_callback' => 'material_sanitize_uri'));
	$wp_customize->add_control('material_social_linkedin', array('section' => 'material_social', 'label' => 'LinkedIn', 'type' => 'text'));
	$wp_customize->add_setting('material_social_mail', array('transport' => 'refresh', 'sanitize_callback' => 'material_sanitize_email'));
	$wp_customize->add_control('material_social_mail', array('section' => 'material_social', 'label' => 'Email', 'type' => 'text'));
	$wp_customize->add_setting('material_social_rss', array('transport' => 'refresh', 'sanitize_callback' => 'material_sanitize_uri'));
	$wp_customize->add_control('material_social_rss', array('section' => 'material_social', 'label' => 'RSS', 'type' => 'text'));
	$wp_customize->add_setting('material_social_soundcloud', array('transport' => 'refresh', 'sanitize_callback' => 'material_sanitize_uri'));
	$wp_customize->add_control('material_social_soundcloud', array('section' => 'material_social', 'label' => 'SoundCloud', 'type' => 'text'));
	$wp_customize->add_setting('material_social_stack_overflow', array('transport' => 'refresh', 'default' => '#so', 'sanitize_callback' => 'material_sanitize_uri'));
	$wp_customize->add_control('material_social_stack_overflow', array('section' => 'material_social', 'label' => 'Stack Overflow', 'type' => 'text'));
	$wp_customize->add_setting('material_social_spotify', array('transport' => 'refresh', 'sanitize_callback' => 'material_sanitize_uri'));
	$wp_customize->add_control('material_social_spotify', array('section' => 'material_social', 'label' => 'Spotify', 'type' => 'text'));
	$wp_customize->add_setting('material_social_tumblr', array('transport' => 'refresh', 'sanitize_callback' => 'material_sanitize_uri'));
	$wp_customize->add_control('material_social_tumblr', array('section' => 'material_social', 'label' => 'Tumblr', 'type' => 'text'));
	$wp_customize->add_setting('material_social_twitter', array('transport' => 'refresh', 'sanitize_callback' => 'material_sanitize_uri'));
	$wp_customize->add_control('material_social_twitter', array('section' => 'material_social', 'label' => 'Twitter', 'type' => 'text'));
	$wp_customize->add_setting('material_social_website', array('transport' => 'refresh', 'sanitize_callback' => 'material_sanitize_uri'));
	$wp_customize->add_control('material_social_website', array('section' => 'material_social', 'label' => 'Website', 'type' => 'text'));
	$wp_customize->add_setting('material_social_youtube', array('transport' => 'refresh', 'sanitize_callback' => 'material_sanitize_uri'));
	$wp_customize->add_control('material_social_youtube', array('section' => 'material_social', 'label' => 'Youtube', 'type' => 'text'));
	$wp_customize->add_setting('material_social_skype', array('transport' => 'refresh', 'default' => '#skype', 'sanitize_callback' => 'material_sanitize_uri'));
	$wp_customize->add_control('material_social_skype', array('section' => 'material_social', 'label' => 'Skype', 'type' => 'text'));
}
add_action( 'customize_register', 'material_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function material_customize_preview_js() {
	wp_enqueue_script( 'material_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'jquery', 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'material_customize_preview_js' );

/**
 * Sanitize color
 */
function material_sanitize_color($content){
	$content = str_replace('#', '', $content);
	if (ctype_xdigit($content)) {
	    return '#' . $content;
	}
	return '';
}

/**
 * Sanitize checkbox
 */
function material_sanitize_checkbox($content){
	if('selected' === $content || 'checked' === $content || 'true' === $content || true === $content){
		return $content;
	}
	return '';
}

/**
 * Sanitize URIs
 */
function material_sanitize_uri($uri){
	if('' === $uri){
		return '';
	}
	return esc_url_raw($uri);
}

/**
 * Sanitize Text
 */
function material_sanitize_text($str){
	if('' === $str){
		return '';
	}
	return sanitize_text_field( $str);
}

/**
 * Sanitize email/uri
 */
function material_sanitize_email($uri){
	if('' === $uri){
		return '';
	}
	if (substr( $uri, 0, 4 ) != 'http' && strpos($uri, '@') === false) {
		$uri = 'mailto:' . $uri;
	}
	return sanitize_email($uri);
}

/**
 * Sanitize meta
 */
function material_sanitize_meta($content){
	$allowed = array('meta' => array());
	if('' === $content){
		return '';
	}
	return wp_kses($content, $allowed);
}

/**
 * Sanitize footer
 */
function material_sanitize_footer($content){
	if('' === $content){
		return '';
	}
	if ( current_user_can('unfiltered_html') )
		return wp_kses($content, wp_kses_allowed_html('post'));
	else
		return stripslashes( wp_filter_post_kses( addslashes($content) ) );
}
