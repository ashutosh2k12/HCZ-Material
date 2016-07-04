<?php
/**
 * Material functions and definitions
 *
 * @package Material
 */

//Hellcoderz Portfolio post type
define( 'HCZ_PF_POST_TYPE', 'hczpf');

//Theme's constants
define( 'THEME_DIR', get_template_directory() );
define( 'THEME_URI', get_template_directory_uri() );

//External Libraries and plugins
define( 'LIBS_DIR', THEME_DIR . '/inc' );
define( 'PLUGINS_DIR', THEME_URI . '/plugins' );

if ( ! function_exists( 'hcz_paging_nav' ) ) :
function hcz_paging_nav(){
	global $wp_query, $wp_rewrite;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

	// Set up paginated links.
	$links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $wp_query->max_num_pages,
		'current'  => $paged,
		'mid_size' => 1,
		'type'	   => 'array',
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_text' => __( '&larr; Previous', 'hellcoderz-material' ),
		'next_text' => __( 'Next &rarr;', 'hellcoderz-material' ),
	) );

	if ( $links ) :
		echo '<ul class="pagination">';
		foreach ($links as $link) :

			$current_class  = (strpos( $link, 'current' ) > 0) ? 'class="active"' : '';
	?>
	<li <?php echo $current_class; ?>><?php echo $link; ?></li>
	<?php
		endforeach;
		echo '</ul>';
	endif;
}
endif;

if ( ! function_exists( 'hcz_post_thumbnail' ) ) :
function hcz_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) :
	?>

	<div class="post-thumbnail">
		<?php the_post_thumbnail(); ?>
	</div>

	<?php else : ?>

	<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
		<?php
			the_post_thumbnail( 'post-thumbnail', array( 'alt' => get_the_title() ) );
		?>
	</a>

	<?php endif;
}
endif;

if ( ! function_exists( 'hcz_post_nav' ) ) :
function hcz_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}

	?>
		<ul class="pager">
			<?php
			if ( is_attachment() ) :
				previous_post_link( '<li class="previous">%link</li>', __( '&larr; %title', 'hellcoderz-material' ) );
			else :
				previous_post_link( '<li class="previous">%link</li>', __( '&larr; %title', 'hellcoderz-material' ) );
				next_post_link( '<li class="next">%link</li>', __( '%title &rarr;', 'hellcoderz-material' ) );
			endif;
			?>
		</ul>
	<?php
}
endif;

 
if ( ! function_exists( 'material_init' ) ) :
function material_init() {

	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );

	if ( ! isset( $content_width ) )
		$content_width = 600;

	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'hellcoderz-material' ),
	) );

	function new_excerpt_more( $more ) {
		return ' <a class="read-more" href="'. get_permalink( get_the_ID() ) . '">' . __( '<span class="meta-nav">read more</span>', 'hellcoderz-material' ) . '</a>';
	}

	add_filter( 'excerpt_more', 'new_excerpt_more' );

}
endif;
add_action( 'after_setup_theme', 'material_init' );

//Will fire once on theme activation
if ( ! function_exists( 'material_setup' ) ) :
function material_setup() {

	material_set_demodata();
}
endif;
add_action( 'after_switch_theme', 'material_setup' );

if ( ! function_exists( '_wp_render_title_tag' ) ) :
    function theme_slug_render_title() {
?>
<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php
    }
    add_action( 'wp_head', 'theme_slug_render_title' );
endif;

//Insert necessary styles and scripts in page header
function material_head(){
?>
	<style type="text/css">
	<?php if( false != get_theme_mod( 'material_logo_circle' ) ) { ?>
			.blog-logo img {
				-webkit-border-radius: 50%;
			    -moz-border-radius: 50%;
			    border-radius: 50%;
			}
        <?php } ?>
        <?php if( false != get_theme_mod( 'material_logo_frame' ) ) { ?>
			.blog-logo img {
			    border: 3px solid #ccc;
			    -webkit-box-shadow: 0 1px 1px rgba(0,0,0,0.3);
			    -moz-box-shadow: 0 1px 1px rgba(0,0,0,0.3);
			    box-shadow: 0 1px 1px rgba(0,0,0,0.3);
			}
        <?php } ?>
        <?php if( get_theme_mod( 'material_bg_color' ) ) { ?>
        body {
		    background-color: <?php echo get_theme_mod( 'material_bg_color' ); ?>;
		}
		<?php } ?>
        <?php if( get_theme_mod( 'material_header_bg_color' ) ) { ?>
		.header-panel.shadow-z-2{
			background-color: <?php echo get_theme_mod( 'material_header_bg_color' ); ?>;
		}
		.icon{ color: <?php echo get_theme_mod( 'material_header_bg_color' ); ?>; }
		<?php } ?>
    </style>
<?php
}
add_action( 'wp_head',  'material_head' );

//Prepare some demodata for customizer. This prevents headaches and anxiety for noobs
function material_set_demodata() {

	//Demo Personal data
	set_theme_mod('material_logo', THEME_URI .'/img/profile.jpg');
	set_theme_mod('material_name', 'Mr Awesome');
	set_theme_mod('material_designation', 'Freelancer');

	//Demo Social data
	set_theme_mod('material_social_facebook','#'); 
	set_theme_mod('material_social_github','#'); 
	set_theme_mod('material_social_stack_overflow','#'); 
	set_theme_mod('material_social_skype','#');

	//Demo Contact data
	set_theme_mod('material_contact_mob','+91-9876543210|+011-6543210');
	set_theme_mod('material_contact_address','BLK-XX, Location A, CA');
	set_theme_mod('material_contact_mails','me@example.com|ceo@example.com');

	//Demo logo data
	set_theme_mod('material_logo_circle',true);
	set_theme_mod('material_logo_frame',true);
}

if ( ! function_exists( 'material_scripts' ) ) :
/**
 * Enqueue scripts and styles.
 */
function material_scripts() {

	wp_enqueue_style('material-google-fonts', '//fonts.googleapis.com/css?family=Roboto:300,400,500,700');
	wp_enqueue_style( 'font-awesome', THEME_URI . '/css/font-awesome.min.css' );
	wp_enqueue_style( 'bootstrap', THEME_URI . '/css/bootstrap.min.css' );
	wp_enqueue_style( 'material-bootstrap', THEME_URI . '/css/bootstrap-material-design.min.css' );
	wp_enqueue_style( 'material-ripple', THEME_URI . '/css/ripples.min.css' );
	wp_enqueue_style( 'animate', THEME_URI . '/css/main.css' );
	wp_enqueue_style( 'material-style', get_stylesheet_uri() );

	wp_enqueue_script( 'material-bootstrap', THEME_URI . '/js/bootstrap.min.js', array('jquery'), '1.0.0', true );
//	wp_enqueue_script( 'material-ripple', THEME_URI . '/js/ripples.min.js', array('jquery'), '1.0.0', true ); //Maybe in next version
	wp_enqueue_script( 'material-material', THEME_URI . '/js/material.min.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'material-index', THEME_URI . '/js/main.js', array('jquery'), '1.0.0', true );

	//Include HCZ portfolio scripts by default
	global $post;
	if( isset($post->post_type) && $post->post_type == HCZ_PF_POST_TYPE ){

		if( class_exists( 'HCZPF_Api' ) ) {
			new HCZPF_Api();
		}

	}
}

endif;

add_action( 'wp_enqueue_scripts', 'material_scripts' );


if ( ! function_exists( 'material_admin_scripts' ) ) :
/**
 * Enqueue admin side scripts and styles.
 */
function material_admin_scripts() {

	wp_enqueue_style( 'material-mce-style', THEME_URI . '/css/hcz-tinymce.css' );

}
endif;

add_action( 'admin_enqueue_scripts', 'material_admin_scripts' );

if ( ! function_exists( 'get_material_theme_mods' ) ) :
/**
 * Get theme mods.
 */
function get_material_theme_mods( $mod = '' ) {

	if($mod && !empty($mod))
		return get_theme_mod( $mod );

	
	$mod['logo'] = get_theme_mod('material_logo'); 

	$mod['name'] = get_theme_mod('material_name'); 
	$mod['designation'] = get_theme_mod('material_designation');

	$mod['social']['facebook'] = get_theme_mod('material_social_facebook'); 
	$mod['social']['github'] = get_theme_mod('material_social_github'); 
	$mod['social']['stackoverflow'] = get_theme_mod('material_social_stack_overflow'); 
	$mod['social']['skype'] = get_theme_mod('material_social_skype'); 

	return $mod;

}
endif;
add_filter( 'material_theme_mods', 'get_material_theme_mods', 10, 1 );

/**
 * Get Primary Nav menu
 */
function material_get_nav_menu($location_id='primary') {

	$items = array();
	$locations = get_registered_nav_menus();
	$menus = wp_get_nav_menus();
	$menu_locations = get_nav_menu_locations();

	if (isset($menu_locations[ $location_id ])) {
		foreach ($menus as $menu) {
			if ($menu->term_id == $menu_locations[ $location_id ]) {
				$menu_items = wp_get_nav_menu_items($menu);
				foreach ($menu_items as $menu) {

					$items[ $menu->ID ] = $menu->title;
				}

				break;
			}
		}
	} 
	return $items;
}

add_filter('get_nav_menu_items','material_get_nav_menu',10,1);

/**
 * Get Custom comment number template to show at bottom
 */
function material_get_comments_number(){
	$comments_count = get_comments_number();

	if( comments_open() ) {

		if( $comments_count == 0 ) $comments = __('No comments', 'hellcoderz-material' );
		elseif( $comments_count > 1 ) $comments = $comments_count . __(' comments', 'hellcoderz-material' );
		else $comments = __('1 comment', 'hellcoderz-material' );

		return '<a href="'. get_comments_link() .'">'. $comments . '</a>';
	} else {
		return __('Comments are off', 'hellcoderz-material' );
	}
}

add_filter('get_comment_number','material_get_comments_number',20,0);

/**
 * Include necessary libraries to get rolling
 */
require LIBS_DIR . '/customizer.php';
require LIBS_DIR . '/shortcode.php';
require LIBS_DIR . '/tinymce.php';
require LIBS_DIR . '/helpers.php';
require LIBS_DIR . '/class-tgm-plugin-activation.php';

/**
 * Activate necessary plugins for this theme
 */
function material_register_plugins() {
	
	$plugins = array(

		array(
			'name'               => 'Wp Resume', 
			'slug'               => 'wp-resume',
			'source'             => PLUGINS_DIR . '/wp-resume.zip',
			'required'           => true,
			'version'            => '', 
			'force_activation'   => false,
			'force_deactivation' => false,
			'external_url'       => '',
			'is_callable'        => '',
		),

		array(
			'name'               => 'HCZ Portfolio', 
			'slug'               => 'hczpf',
			'source'             => PLUGINS_DIR . '/hcz-portfolio.zip',
			'required'           => true,
			'version'            => '', 
			'force_activation'   => false,
			'force_deactivation' => false,
			'external_url'       => '',
			'is_callable'        => '',
		),

		array(
			'name'               => 'HCZ Testimonials', 
			'slug'               => 'hcz-testimonials',
			'source'             => PLUGINS_DIR . '/hcz-testimonials.zip',
			'required'           => false,
			'version'            => '', 
			'force_activation'   => false,
			'force_deactivation' => false,
			'external_url'       => '',
			'is_callable'        => '',
		),

		array(
			'name'               => 'Contact Form 7', 
			'slug'               => 'contact-form-7'
		)

	);

	$config = array(
		'id'           => 'hcz',                 
		'default_path' => '',                     
		'menu'         => 'tgmpa-install-plugins', 
		'parent_slug'  => 'themes.php',            
		'capability'   => 'edit_theme_options',    
		'has_notices'  => true,                    
		'dismissable'  => true,                    
		'dismiss_msg'  => '',                      
		'is_automatic' => false,                   
		'message'      => '',                      
		);

	tgmpa( $plugins, $config );
}

add_action( 'tgmpa_register', 'material_register_plugins' );

/* ----------------------------------------------------------------------------------- *
 *	Custom Menu Walker
 *	For adding font-awesome icons to primary menu
 * ----------------------------------------------------------------------------------- */
class Walker_Material_Menu extends Walker_Nav_Menu {

	function display_element ($element, &$children_elements, $max_depth, $depth = 0, $args, &$output)
    {
        $element->hasChildren = isset($children_elements[$element->ID]) && !empty($children_elements[$element->ID]);
        return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }

    public function start_lvl( &$output, $depth = 0, $args = array() ) {
      $output .= "\n<ul class=\"sub-menu child\">\n";
   }

    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
    	$icon = '<i class="fa fa-navicon"></i>';
    	
    	if( false != get_theme_mod( 'menu_item_'. $item->ID ) && false !== get_theme_mod( 'material_menu_icon' ) && get_theme_mod( 'material_menu_icon' ) == 1 ){
    		$icon = '<i class="fa ' . get_theme_mod( 'menu_item_'. $item->ID ) .'"></i>';
    	}

    	$pagepost_id = get_option( 'page_for_posts' );

    	$current_id = is_home( $pagepost_id ) ? $pagepost_id : get_the_ID();

        $output .= sprintf( '<li class="col-lg-12 col-md-12 %7$s col-xs-12 %2$s %5$s %6$s"><a href="%1$s">%3$s %4$s</a>%8$s',
            $item->url,
            ( $item->object_id == $current_id ) ? 'current-menu-item' : '',
            $icon,
            $item->title,
            $item->object_id,
            ( $item->hasChildren ) ? 'dropdown-submenu parent' : '',
            ($depth == 0) ? 'col-sm-4' : 'col-sm-12',
            ( $item->hasChildren ) ?'<button class="dropdown-toggle" aria-expanded="true"><i class="fa"></i></button>':''
        );
    }

}

if ( ! function_exists( 'material_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function material_posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		//$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
	}

	$category_list = get_the_category_list( __( ', ', 'hellcoderz-material' ) );

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	printf( __( '<footer>On <span class="posted-on">%1$s</span><span class="byline"> by %2$s</span>, %4$s. <span class="comments">%3$s</span></footer>', 'hellcoderz-material' ),
		sprintf( '<a href="%1$s" rel="bookmark">%2$s</a>',
			esc_url( get_permalink() ),
			$time_string
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		),
		sprintf( '%s', apply_filters('get_comment_number',null) ),
		sprintf( __( ' in ', 'hellcoderz-material' ).'%1$s', $category_list )
	);
}
endif;