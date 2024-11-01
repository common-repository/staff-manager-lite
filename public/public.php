<?php
defined( 'ABSPATH' ) or die();

require_once( 'wprsmp_lite_language.php' );
require_once( 'wprsmp_lite_shortcode.php' );
require_once( 'inc/controllers/wprsmp_lite_login_actions.php' );

/* Load text domain */
add_action( 'plugins_loaded', array( 'WPRSMLiteLanguage', 'load_translation' ) );

/* Enqueue Assets for shortcodes */
add_action( 'wp_enqueue_scripts', array( 'LiteWPRSMShortcode', 'shortcode_enqueue_assets' ) );

/* Login Form Shortcode files */
add_shortcode( 'WPRSMP_LOGIN_FORM', array( 'LiteWPRSMShortcode', 'login_portal' ) );

/**----------------------------------------------------------------Staff login actions for frontend shortcode----------------------------------------------------------------**/

/* Staff's clock actions */
add_action( 'wp_ajax_nopriv_wprsmp_front_clock_action', array( 'LiteFrontDashBoardAction', 'clock_actions' ) );
add_action( 'wp_ajax_wprsmp_front_clock_action', array( 'LiteFrontDashBoardAction', 'clock_actions' ) );

/* Late reson submit actions */
add_action( 'wp_ajax_nopriv_wprsmp_front_late_reson_action', array( 'LiteFrontDashBoardAction', 'late_reson_submit' ) );
add_action( 'wp_ajax_wprsmp_front_late_reson_action', array( 'LiteFrontDashBoardAction', 'late_reson_submit' ) );

/* Daily report submit actions */
add_action( 'wp_ajax_nopriv_wprsmp_front_daily_report_action', array( 'LiteFrontDashBoardAction', 'staff_daily_report' ) );
add_action( 'wp_ajax_wprsmp_front_daily_report_action', array( 'LiteFrontDashBoardAction', 'staff_daily_report' ) );

?>