<?php
/*
Plugin Name: Staff Manager Lite
Plugin URI:
Description: World's most advanced Staff Management Plugin. You can manage Projects, Departments, Employees Attendance, Salary, Real Time Working Hours, Monthly Report Generation, Leaves, Notices, Holidays.
Author: rajthemes
Author URI: 
Version: 1.0.2
Text Domain: staff-manger-lite
Domain Path: /lang/
*/

defined( 'ABSPATH' ) or die();

if ( ! defined( 'WPRSMP_PLUGIN_URL' ) ) {
	define( 'WPRSMP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}

if ( ! defined( 'WPRSMP_PLUGIN_DIR_PATH' ) ) {
	define( 'WPRSMP_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );
}

if ( ! defined( 'WPRSMP_PLUGIN_BASENAME' ) ) {
	define( 'WPRSMP_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
}

if ( ! defined( 'WPRSMP_PLUGIN_FILE' ) ) {
	define( 'WPRSMP_PLUGIN_FILE', __FILE__ );
}

final class StaffManagertLite {
	private static $instance = null;

	private function __construct() {
		$this->initialize_hooks();
		$this->setup_init();
	}

	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	private function initialize_hooks() {
		if ( is_admin() ) {
			require_once( 'admin/admin.php' );
			require_once( 'admin/admin-setup-wizard.php' );
		}
		require_once( 'public/public.php' );
	}

	private function setup_init() {
		require_once( 'admin/inc/wprsmp_lite_default_options.php' );
		register_activation_hook( __FILE__, array( 'LiteSetDeafaultOptions', 'wprsmp_lite_activation_actions' ) );
		register_activation_hook( __FILE__, array( 'LiteSetDeafaultOptions', 'wprsmp_lite_activation_default_emails' ) );
		add_action( 'wprsmp_lite_extension_activation', array( 'LiteSetDeafaultOptions', 'default_settings' ) );
		add_action( 'init', array( 'LiteSetDeafaultOptions', 'wprsmp_lite_allow_subscriber_uploads' ) );
		add_action( 'pre_get_posts', array( 'LiteSetDeafaultOptions', 'wprsmp_lite_users_own_attachments' ) );
		add_action( 'wprsmp_lite_default_emails_activation', array( 'LiteSetDeafaultOptions', 'wprsmp_lite_setup_default_emails' ) );
		register_activation_hook(__FILE__, array( 'LiteSetDeafaultOptions', 'wprsmp_setup_wizard_activation_hook') );
		//add_action( 'admin_init', array( 'LiteSetDeafaultOptions', 'wprsmp_setup_wizard_redirect' ) );
	}
}

StaffManagertLite::get_instance();

function wprsmp_lite_staff_login_redirect( $url, $request, $user ) {
	$staffs = get_option( 'wprsmp_staffs_data' );

	if ( $user && is_object( $user ) && is_a( $user, 'WP_User' ) ) {

		if( $user->has_cap( 'administrator') ) {

			$url = admin_url();

		} else {

			if ( ! empty ( $staffs ) ) {
				foreach ( $staffs as $key => $staff ) {
					if ( $satff['ID'] == get_current_user_id() ) {
						$url = admin_url('/admin.php?page=staff-manager-lite-dashboard/');
					} else {
						$url = admin_url();
					}
				}
			} else {
				$url = admin_url();
			}
		}
	}
	return $url;
}
add_filter( 'login_redirect', 'wprsmp_lite_staff_login_redirect', 10, 3 );