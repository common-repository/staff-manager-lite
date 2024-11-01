<?php
defined( 'ABSPATH' ) or die();
require_once( WPRSMP_PLUGIN_DIR_PATH . '/admin/inc/helpers/wprsmp-lite-helper.php' );

/**
 *  Action calls for Shotcode
 */
class LiteWPRSMShortcode {

	/* Login Portal */
	public static function login_portal( $attr ) {
		ob_start();
		require_once( 'inc/controllers/wprsmp_lite_login_portal.php' );
		return ob_get_clean();
	}

	public static function shortcode_enqueue_assets() {

		/* Enqueue styles */
		wp_enqueue_style( 'bootstrap', WPRSMP_PLUGIN_URL . 'public/css/bootstrap.min.css' );
		wp_enqueue_style( 'toastr', WPRSMP_PLUGIN_URL . 'assets/css/toastr.min.css' );
        wp_enqueue_style( 'wprsmp-lite-front-end', WPRSMP_PLUGIN_URL . 'public/css/front_end_css.css' );
        
		/* Enqueue scripts */
        wp_enqueue_script( 'jquery' );
        wp_enqueue_script( 'popper-js', WPRSMP_PLUGIN_URL . 'assets/js/popper.min.js', array( 'jquery' ), true, true );
		wp_enqueue_script( 'bootstrap-js', WPRSMP_PLUGIN_URL . 'assets/js/bootstrap.min.js', array( 'jquery' ), true, true );
		wp_enqueue_script( 'toastr-js', WPRSMP_PLUGIN_URL . 'assets/js/toastr.min.js', array( 'jquery' ), true, true );
        
        /* Staff dash board ajax js */
		wp_enqueue_script( 'wprsmp-lite-login-ajax-js', WPRSMP_PLUGIN_URL . 'public/js/wprsmp-lite-login-ajax.js', array( 'jquery' ), true, true );
		wp_localize_script( 'wprsmp-lite-login-ajax-js', 'ajax_login', array(
			'ajax_url'    => admin_url( 'admin-ajax.php' ),
			'login_nonce' => wp_create_nonce( 'login_ajax_nonce' ),
			'wprsmp_timezone' => WPRSMPLiteHelperClass::get_setting_timezone(),
		));
        
	}

}