<?php
defined( 'ABSPATH' ) or die();

class WPRSMLiteLanguage {
	public static function load_translation() {
		load_plugin_textdomain( 'staff-manger-lite', false, basename( WPRSMP_PLUGIN_DIR_PATH ) . '/lang' );
	}
}