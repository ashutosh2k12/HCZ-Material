<?php
/* ----------------------------------------------------------------------------------- *
 *	WordPress uses TinyMCE 4 since 3.9
 *	For safety reasons no support for TinyMCE 3 ( WordPress 3.8 )
 * ----------------------------------------------------------------------------------- */
$hcz_wp_version = floatval( get_bloginfo( 'version' ) );

if( $hcz_wp_version >= 3.9 ){

	function hcz_mce_init() {
		global $page_handle;
		if ( ! current_user_can ( 'edit_posts' ) || ! current_user_can ( 'edit_pages' )) return false;
		
		if (get_user_option ( 'rich_editing' ) == 'true') {
			add_filter ( "mce_external_plugins", 'hcz_mce_plugin' );
			add_filter ( 'mce_buttons', 'hcz_mce_buttons' );
		}
	}
	add_action ( 'init', 'hcz_mce_init' );
	
	function hcz_mce_plugin( $array ){
		$array ['hczmc'] = THEME_URI . '/js/hcz-tinymce.js';
		return $array;
	}
	
	function hcz_mce_buttons( $buttons ){
		array_push ( $buttons, 'hczmc' );	
		return $buttons;
	}
	
}
?>