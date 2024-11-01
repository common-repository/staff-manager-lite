<?php
defined( 'ABSPATH' ) or die();
require_once( WPRSMP_PLUGIN_DIR_PATH . '/admin/inc/helpers/wprsmp-lite-helper.php' );

/**
 *  Add Admin Menu Panel 
 */
class WPRSMP_AdminMenu {
	public static function create_menu() {

		$dashboard = add_menu_page( esc_html__( 'Staff manager Lite', 'staff-manger-lite' ), esc_html__( 'Staff manager Lite', 'staff-manger-lite' ), 'manage_options', 'staff-manger-lite', array(
			'WPRSMP_AdminMenu',
			'dashboard'
		), 'dashicons-groups', 25 );
		add_action( 'admin_print_styles-' . $dashboard, array( 'WPRSMP_AdminMenu', 'dashboard_assets' ) );

		/* Dashboard submenu */
		$dashboard_submenu = add_submenu_page( 'staff-manger-lite', esc_html__( 'Staff manager Lite', 'staff-manger-lite' ), esc_html__( 'Dashboard', 'staff-manger-lite' ), 'manage_options', 'staff-manger-lite', array(
			'WPRSMP_AdminMenu',
			'dashboard'
		) );
		add_action( 'admin_print_styles-' . $dashboard_submenu, array( 'WPRSMP_AdminMenu', 'dashboard_assets' ) );

		/* Designation submenu */
		$designation_submenu = add_submenu_page( 'staff-manger-lite', esc_html__( 'Designation', 'staff-manger-lite' ), esc_html__( 'Designation', 'staff-manger-lite' ), 'manage_options', 'staff-manger-lite-designation', array(
			'WPRSMP_AdminMenu',
			'designation'
		) );
		add_action( 'admin_print_styles-' . $designation_submenu, array( 'WPRSMP_AdminMenu', 'dashboard_assets' ) );

		/* Leave Requests submenu */
		$requests_submenu = add_submenu_page( 'staff-manger-lite', esc_html__( 'Leave Requests', 'staff-manger-lite' ), esc_html__( 'Leave Requests', 'staff-manger-lite' ), 'manage_options', 'staff-manger-lite-requests', array(
			'WPRSMP_AdminMenu',
			'requests'
		) );
		add_action( 'admin_print_styles-' . $requests_submenu, array( 'WPRSMP_AdminMenu', 'dashboard_assets' ) );

		/* Shift submenu */
		$shift_submenu = add_submenu_page( 'staff-manger-lite', esc_html__( 'Shifts', 'staff-manger-lite' ), esc_html__( 'Shifts', 'staff-manger-lite' ), 'manage_options', 'staff-manger-lite-shift', array(
			'WPRSMP_AdminMenu',
			'shift'
		) );
		add_action( 'admin_print_styles-' . $shift_submenu, array( 'WPRSMP_AdminMenu', 'event_assets' ) );

		/* Staff submenu */
		$staff_submenu = add_submenu_page( 'staff-manger-lite', esc_html__( 'Staff', 'staff-manger-lite' ), esc_html__( 'Staff', 'staff-manger-lite' ), 'manage_options', 'staff-manger-lite-staff', array(
			'WPRSMP_AdminMenu',
			'staff'
		) );
		add_action( 'admin_print_styles-' . $staff_submenu, array( 'WPRSMP_AdminMenu', 'dashboard_assets' ) );

		/* Reports submenu */
		$reports_submenu = add_submenu_page( 'staff-manger-lite', esc_html__( 'Reports', 'staff-manger-lite' ), esc_html__( 'Reports', 'staff-manger-lite' ), 'manage_options', 'staff-manger-lite-reports', array(
			'WPRSMP_AdminMenu',
			'reports'
		) );
		add_action( 'admin_print_styles-' . $reports_submenu, array( 'WPRSMP_AdminMenu', 'report_assets' ) );

		/* Events submenu */
		$event_submenu = add_submenu_page( 'staff-manger-lite', esc_html__( 'Events', 'staff-manger-lite' ), esc_html__( 'Events', 'staff-manger-lite' ), 'manage_options', 'staff-manger-lite-events', array(
			'WPRSMP_AdminMenu',
			'events'
		) );
		add_action( 'admin_print_styles-' . $event_submenu, array( 'WPRSMP_AdminMenu', 'event_assets' ) );

		/* Notices submenu */
		$notices_submenu = add_submenu_page( 'staff-manger-lite', esc_html__( 'Notices', 'staff-manger-lite' ), esc_html__( 'Notices', 'staff-manger-lite' ), 'manage_options', 'staff-manger-lite-notices', array(
			'WPRSMP_AdminMenu',
			'notices'
		) );
		add_action( 'admin_print_styles-' . $notices_submenu, array( 'WPRSMP_AdminMenu', 'dashboard_assets' ) );

		/* Holidays submenu */
		$holiday_submenu = add_submenu_page( 'staff-manger-lite', esc_html__( 'Holidays', 'staff-manger-lite' ), esc_html__( 'Holidays', 'staff-manger-lite' ), 'manage_options', 'staff-manger-lite-holidays', array(
			'WPRSMP_AdminMenu',
			'holidays'
		) );
		add_action( 'admin_print_styles-' . $holiday_submenu, array( 'WPRSMP_AdminMenu', 'holiday_assets' ) );

		/* Projects submenu */
		$holiday_submenu = add_submenu_page( 'staff-manger-lite', esc_html__( 'Projects', 'staff-manger-lite' ), esc_html__( 'Projects', 'staff-manger-lite' ), 'manage_options', 'staff-manger-lite-projects', array(
			'WPRSMP_AdminMenu',
			'projects'
		) );
		add_action( 'admin_print_styles-' . $holiday_submenu, array( 'WPRSMP_AdminMenu', 'project_assets' ) );

		/* Notifications submenu */
		$notification_submenu = add_submenu_page( 'staff-manger-lite', esc_html__( 'Notifications', 'staff-manger-lite' ), esc_html__( 'Notifications', 'staff-manger-lite' ), 'manage_options', 'staff-manger-lite-notifications', array(
			'WPRSMP_AdminMenu',
			'notifications'
		) );
		add_action( 'admin_print_styles-' . $notification_submenu, array( 'WPRSMP_AdminMenu', 'notification_assets' ) );

		/* Settings submenu */
		$settings_submenu = add_submenu_page( 'staff-manger-lite', esc_html__( 'Settings', 'staff-manger-lite' ), esc_html__( 'Settings', 'staff-manger-lite' ), 'manage_options', 'staff-manger-lite-settings', array(
			'WPRSMP_AdminMenu',
			'settings'
		) );
		add_action( 'admin_print_styles-' . $settings_submenu, array( 'WPRSMP_AdminMenu', 'event_assets' ) );

		/* Go Pro submenu */
		$help = esc_html__( 'Help & Support', 'staff-manger-lite' ).' '.wp_kses_post( '<i class="fas fa-question-circle"></i>' );
		$settings_submenu = add_submenu_page( 'staff-manger-lite', $help, $help, 'manage_options', 'staff-manger-lite-help', array(
			'WPRSMP_AdminMenu',
			'help_support'
		) );
		add_action( 'admin_print_styles-' . $settings_submenu, array( 'WPRSMP_AdminMenu', 'dashboard_assets' ) );

		/* Go Pro submenu */
		$go_pro = esc_html__( 'Update to Pro', 'staff-manger-lite' ).' '.wp_kses_post( '<i class="fas fa-star"></i>' );
		$settings_submenu = add_submenu_page( 'staff-manger-lite', $go_pro, $go_pro, 'manage_options', 'staff-manger-lite-go_rpo', array(
			'WPRSMP_AdminMenu',
			'go_rpo'
		) );
		add_action( 'admin_print_styles-' . $settings_submenu, array( 'WPRSMP_AdminMenu', 'dashboard_assets' ) );

		/***----------------------------------------------------------Menus for subscriber----------------------------------------------------------***/
		/* Dashboard submenu */
		$save_settings  = get_option( 'wprsmp_settings_data' );
		if ( ! empty( $save_settings['user_roles'] ) ) {
			$user_roles = unserialize( $save_settings['user_roles'] );
		} else {
			$user_roles = array('subscriber');
		}

		$role = WPRSMPLiteHelperClass::wprsmp_get_current_user_roles();

		if ( is_array( $user_roles ) ) {
			if ( in_array( $role, $user_roles ) &&  WPRSMPLiteHelperClass::check_user_availability() == true ) {

				/** Dashboard**/
				$sub_dash_submenu = add_submenu_page( 'staff-manger-lite', esc_html__( 'Dashboard', 'staff-manger-lite' ), esc_html__( 'Dashboard', 'staff-manger-lite' ), $role, 'staff-manager-lite-dashboard', array(
					'WPRSMP_AdminMenu',
					'staff_dashboard'
				) );
				add_action( 'admin_print_styles-' . $sub_dash_submenu, array( 'WPRSMP_AdminMenu', 'staff_dashboard_assets' ) );

				/* Reports submenu */
				$staff_report_submenu = add_submenu_page( 'staff-manger-lite', esc_html__( 'Reports', 'staff-manger-lite' ), esc_html__( 'Reports', 'staff-manger-lite' ), $role, 'staff-manager-lite-reports', array(
					'WPRSMP_AdminMenu',
					'staff_reports'
				) );
				add_action( 'admin_print_styles-' . $staff_report_submenu, array( 'WPRSMP_AdminMenu', 'report_assets' ) );

				/* Leave Requests submenu */
				$staff_requests_submenu = add_submenu_page( 'staff-manger-lite', esc_html__( 'Leaves', 'staff-manger-lite' ), esc_html__( 'Leaves', 'staff-manger-lite' ), $role, 'staff-manager-lite-requests', array(
					'WPRSMP_AdminMenu',
					'staff_requests'
				) );
				add_action( 'admin_print_styles-' . $staff_requests_submenu, array( 'WPRSMP_AdminMenu', 'staff_requests_assets' ) );

				if ( ! empty ( $save_settings['show_holiday'] ) && $save_settings['show_holiday'] == 'Yes' ) {
					/* Holidays submenu */
					$staff_holidays_submenu = add_submenu_page( 'staff-manger-lite', esc_html__( 'Holidays', 'staff-manger-lite' ), esc_html__( 'Holidays', 'staff-manger-lite' ), $role, 'staff-manager-lite-holidays', array(
						'WPRSMP_AdminMenu',
						'staff_holidays'
					) );
					add_action( 'admin_print_styles-' . $staff_holidays_submenu, array( 'WPRSMP_AdminMenu', 'holiday_assets' ) );
				}

				if ( ! empty ( $save_settings['show_notice'] ) && $save_settings['show_notice'] == 'Yes' ) {
					/* Notice submenu */
					$staff_notice_submenu = add_submenu_page( 'staff-manger-lite', esc_html__( 'Notice', 'staff-manger-lite' ), esc_html__( 'Notice', 'staff-manger-lite' ), $role, 'staff-manager-lite-notice', array(
						'WPRSMP_AdminMenu',
						'staff_notice'
					) );
					add_action( 'admin_print_styles-' . $staff_notice_submenu, array( 'WPRSMP_AdminMenu', 'dashboard_assets' ) );
				}

				if ( ! empty ( $save_settings['show_projects'] ) && $save_settings['show_projects'] == 'Yes' ) {
					/* Projects submenu */
					$staff_project_submenu = add_submenu_page( 'staff-manger-lite', esc_html__( 'Projects', 'staff-manger-lite' ), esc_html__( 'Projects', 'staff-manger-lite' ), $role, 'staff-manager-lite-project', array(
						'WPRSMP_AdminMenu',
						'staff_project'
					) );
					add_action( 'admin_print_styles-' . $staff_project_submenu, array( 'WPRSMP_AdminMenu', 'project_assets' ) );
				}
			}
		}
	}

	/* Dashboard menu/submenu callback */
	public static function dashboard() {
		require_once( 'inc/wprsmp-lite_dashboard.php' );
	}

	/* Designation menu/submenu callback */
	public static function designation() {
		require_once( 'inc/administrator/wprsmp-lite_designation.php' );
	}

	/* Requests menu/submenu callback */
	public static function requests() {
		require_once( 'inc/administrator/wprsmp-lite_requests.php' );
	}

	/* Shift menu/submenu callback */
	public static function shift() {
		require_once( 'inc/administrator/wprsmp-lite_shift.php' );
	}

	/* Staff menu/submenu callback */
	public static function staff() {
		require_once( 'inc/administrator/wprsmp-lite_staff.php' );
	}

	/* Reports menu/submenu callback */
	public static function reports() {
		require_once('inc/administrator/wprsmp-lite_reports.php');
	}

	/* Events menu/submenu callback */
	public static function events() {
		require_once( 'inc/administrator/wprsmp-lite_event.php' );
	}

	/* Notices menu/submenu callback */
	public static function notices() {
		require_once( 'inc/administrator/wprsmp-lite_notice.php' );
	}

	/* Holidays menu/submenu callback */
	public static function holidays() {
		require_once( 'inc/administrator/wprsmp-lite_holiday.php' );
	}

	/* Projects menu/submenu callback */
	public static function projects() {
		require_once( 'inc/administrator/wprsmp-lite_project.php' );
	}

	/* Notifications menu/submenu callback */
	public static function notifications() {
		require_once( 'inc/administrator/wprsmp-lite_notification.php' );
	}

	/* Settings menu/submenu callback */
	public static function settings() {
		require_once( 'inc/wprsmp-lite_settings.php' );
	}

	/* Help & Support */
	public static function help_support() {
		require_once( 'wprsmp-lite_help.php' );
	}

	public static function go_rpo(){
		require_once( 'wprsmp-lite_banner.php' );
	}

	/* Staff's dashboard */
	public static function staff_dashboard() {
		require_once( 'inc/subscriber/wprsmp_lite_staff_dash.php' );
	}

	/* Staff's reports */
	public static function staff_reports() {
		require_once( 'inc/subscriber/wprsmp_lite_staff_report.php' );
	}

	/* Staff's requests */
	public static function staff_requests() {
		require_once( 'inc/subscriber/wprsmp_lite_staff_requests.php' );
	}

	/* Staff's Holidays */
	public static function staff_holidays() {
		require_once( 'inc/subscriber/wprsmp_lite_staff_holidays.php' );
	}

	/* Staff's Notice */
	public static function staff_notice() {
		require_once( 'inc/subscriber/wprsmp_lite_staff_notices.php' );
	}

	/* Staff's Notice */
	public static function staff_project() {
		require_once( 'inc/subscriber/wprsmp_lite_staff_projects.php' );
	}

	/* Dashboard menu/submenu assets */
	public static function dashboard_assets() {
		self::enqueue_libraries();
		self::enqueue_datatable_assets();
		self::enqueue_custom_assets();
	}

	/* Event menu/submenu assets */
	public static function event_assets() {
		self::enqueue_libraries();
		self::enqueue_datatable_assets();
		self::enqueue_datetimepicker();
		self::enqueue_custom_assets();
	}

	/* Holiday menu/submenu assets */
	public static function holiday_assets() {
		self::enqueue_libraries();
		self::enqueue_datatable_assets();
		self::enqueue_daterangepicker();
		self::enqueue_holiday_assets();
		self::enqueue_custom_assets();
	}

	/* Staff's dashboard assets */
	public static function staff_dashboard_assets() {
		self::enqueue_libraries();
		self::enqueue_datatable_assets();
		self::enqueue_custom_assets();
		self::staffs_dashboard();
	}

	/* Staff's Requests assets */
	public static function staff_requests_assets() {
		self::enqueue_libraries();
		self::enqueue_datatable_assets();
		self::enqueue_daterangepicker();
		self::enqueue_custom_assets();
	}

	/* Staff's dashboard assets */
	public static function report_assets() {
		self::enqueue_libraries();
		self::enqueue_datatable_assets();
		self::enqueue_datetimepicker();
		self::enqueue_custom_assets();
		self::reports_dashboard();
	}

	/* Projects menu/submenu assets */
	public static function project_assets() {
		self::enqueue_libraries();
		self::enqueue_datatable_assets();
		self::enqueue_datetimepicker();
		self::enqueue_custom_assets();
		self::enqueue_project_assets();
	}

	/* Notifications menu/submenu assets */
	public static function notification_assets() {
		self::enqueue_libraries();
		self::enqueue_datatable_assets();
		self::enqueue_custom_assets();
		self::enqueue_notification_assets();
	}

	public static function enqueue_datatable_assets() {
		wp_enqueue_style( 'jquery-dataTables', WPRSMP_PLUGIN_URL . '/assets/css/jquery.dataTables.min.css' );
		wp_enqueue_style( 'dataTables-bootstrap4', WPRSMP_PLUGIN_URL . '/assets/css/dataTables.bootstrap4.min.css' );
		wp_enqueue_script( 'jquery-datatable-js', WPRSMP_PLUGIN_URL . '/assets/js/jquery.dataTables.min.js', array( 'jquery' ), true, true );
		wp_enqueue_script( 'datatable-bootstrap4-js', WPRSMP_PLUGIN_URL . '/assets/js/dataTables.bootstrap4.min.js', array( 'jquery' ), true, true );
	}

	/* Enqueue third party libraties */
	public static function enqueue_libraries() {

		/* Enqueue styles */
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_style( 'wprsmp-lite-dashboard', WPRSMP_PLUGIN_URL . 'assets/css/dashboard-style.css' );
		wp_enqueue_style( 'toastr', WPRSMP_PLUGIN_URL . 'assets/css/toastr.min.css' );
		wp_enqueue_style( 'jquery-confirm', WPRSMP_PLUGIN_URL . 'admin/css/jquery-confirm.min.css' );
		wp_enqueue_style( 'bootstrap-multiselect', WPRSMP_PLUGIN_URL . 'assets/css/bootstrap-multiselect.css' );
		wp_enqueue_style( 'wprsmp-lite-banner', WPRSMP_PLUGIN_URL . 'admin/css/wprsmp-lite-banner.css' );

		/* Enqueue Scripts */
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'moment' );
		wp_enqueue_media();
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_script( 'jquery-form' );
		wp_enqueue_script( 'popper-js', WPRSMP_PLUGIN_URL . 'assets/js/popper.min.js', array( 'jquery' ), true, true );
		wp_enqueue_script( 'bootstrap-js', WPRSMP_PLUGIN_URL . 'assets/js/bootstrap.min.js', array( 'jquery' ), true, true );
		wp_enqueue_script( 'toastr-js', WPRSMP_PLUGIN_URL . 'assets/js/toastr.min.js', array( 'jquery' ), true, true );
		wp_enqueue_script( 'jquery-confirm-js', WPRSMP_PLUGIN_URL . 'admin/js/jquery-confirm.min.js', array( 'jquery' ), true, true );
		wp_enqueue_script( 'bootstrap-multiselect-js', WPRSMP_PLUGIN_URL . 'assets/js/bootstrap-multiselect.js', array( 'jquery' ), true, true );
	}

	public static function enqueue_chart_assets() {
		wp_enqueue_script( 'chart', WPRSMP_PLUGIN_URL . 'assets/js/Chart.min.js', array( 'jquery' ), true, true );
	}

	public static function staffs_dashboard() {

		/* Staff dash board ajax js */
		wp_enqueue_script( 'wprsmp-lite-staff-ajax-js', WPRSMP_PLUGIN_URL . 'admin/js/wprsmp-lite-staff-ajax.js', array( 'jquery' ), true, true );
		wp_localize_script( 'wprsmp-lite-staff-ajax-js', 'ajax_staff', array(
			'ajax_url'      => admin_url( 'admin-ajax.php' ),
			'staff_nonce'   => wp_create_nonce( 'staff_ajax_nonce' ),
			'wprsmp_timezone' => WPRSMPLiteHelperClass::get_setting_timezone(),
		) );
	}

	public static function reports_dashboard() {

		/* Staff dash board ajax js */
		wp_enqueue_script( 'wprsmp-lite-report-ajax-js', WPRSMP_PLUGIN_URL . 'admin/js/wprsmp-lite-report-ajax.js', array( 'jquery' ), true, true );
		wp_localize_script( 'wprsmp-lite-report-ajax-js', 'ajax_report', array(
			'ajax_url'      => admin_url( 'admin-ajax.php' ),
			'report_nonce'  => wp_create_nonce( 'report_ajax_nonce' ),
		));
	}

	/** Libraries for DateRangePicker **/
	public static function enqueue_daterangepicker() {
		wp_enqueue_style( 'daterangepicker', WPRSMP_PLUGIN_URL . 'assets/css/daterangepicker.css' );
		wp_enqueue_script( 'daterangepicker-js', WPRSMP_PLUGIN_URL . 'assets/js/daterangepicker.min.js', array( 'jquery' ), true, true );
		wp_enqueue_script( 'wprsmp-lite-holiday-js', WPRSMP_PLUGIN_URL . 'admin/js/wprsmp-lite-holiday.js', array( 'jquery' ), true, true );
	}

	public static function enqueue_datetimepicker() {
		wp_enqueue_style( 'datetimepicker', WPRSMP_PLUGIN_URL . 'assets/css/tempusdominus-bootstrap-4.min.css' );
		wp_enqueue_style( 'font-awesome', WPRSMP_PLUGIN_URL . 'assets/css/font-awesome.min.css' );
		wp_enqueue_script( 'datetimepicker-js', WPRSMP_PLUGIN_URL . 'assets/js/tempusdominus-bootstrap-4.min.js', array( 'jquery' ), true, true );
		wp_enqueue_style( 'bootstrap-timepicker', WPRSMP_PLUGIN_URL . 'assets/css/bootstrap-timepicker.css' );
		wp_enqueue_script( 'bootstrap-timepicker-js', WPRSMP_PLUGIN_URL . 'assets/js/bootstrap-timepicker.js', array( 'jquery' ), true, true );
		wp_enqueue_script( 'wprsmp-lite-event-js', WPRSMP_PLUGIN_URL . 'admin/js/wprsmp-lite-event.js', array( 'jquery' ), true, true );
	}

	public static function enqueue_project_assets() {
		wp_enqueue_media();

		/** For CKEDITOR **/
		wp_enqueue_script( 'ckeditor-js', 'https://cdn.ckeditor.com/4.11.3/standard/ckeditor.js', array('jquery') );
		
		/** For Multi tags field **/
		wp_enqueue_style( 'bootstrap-tokenfield', WPRSMP_PLUGIN_URL . '/assets/css/bootstrap-tokenfield.min.css' );
		wp_enqueue_script( 'bootstrap-tokenfiled-js', WPRSMP_PLUGIN_URL . '/assets/js/bootstrap-tokenfield.min.js', array( 'jquery' ), true, true );
		
		/* Project ajax js */
		wp_enqueue_script( 'wprsmp-project-ajax-js', WPRSMP_PLUGIN_URL . 'admin/js/wprsmp-lite-project-ajax.js', array( 'jquery' ), true, true );
		wp_localize_script( 'wprsmp-project-ajax-js', 'ajax_project', array(
			'ajax_url'       => admin_url( 'admin-ajax.php' ),
			'project_nonce'  => wp_create_nonce( 'project_ajax_nonce' ),
		));
	}

	public static function enqueue_holiday_assets() {
		/* Enqueue scripts */
		wp_enqueue_script( 'wprsmp-holiday-js', WPRSMP_PLUGIN_URL . 'admin/js/wprsmp-lite-holiday.js', array( 'jquery' ), true, true );
	}

	public static function enqueue_notification_assets() {
		/* Enqueue scripts */
		wp_enqueue_script( 'wprsmp-notification-js', WPRSMP_PLUGIN_URL . 'admin/js/wprsmp-lite-notification.js', array( 'jquery' ), true, true );
		wp_localize_script( 'wprsmp-notification-js', 'ajax_notification', array(
			'ajax_url'           => admin_url( 'admin-ajax.php' ),
			'notification_nonce' => wp_create_nonce( 'notification_ajax_nonce' ),
		) );
	}

	/* Enqueue custom assets */
	public static function enqueue_custom_assets() {

		/* Enqueue styles */
		wp_enqueue_style( 'wprsmp-lite-style', WPRSMP_PLUGIN_URL . 'admin/css/wprsmp-lite-backend-style.css' );
		wp_enqueue_style( 'font-awesome', WPRSMP_PLUGIN_URL . 'assets/css/font-awesome.min.css' );

		/* Enqueue scripts */
		wp_enqueue_script( 'wprsmp-lite-settings-js', WPRSMP_PLUGIN_URL . 'admin/js/wprsmp-lite-settings.js', array( 'jquery' ), true, true );
		wp_enqueue_script( 'wprsmp-lite-backend-js', WPRSMP_PLUGIN_URL . 'admin/js/wprsmp-lite-backend.js', array( 'jquery', 'wp-color-picker' ), true, true );
		wp_enqueue_script( 'wprsmp-lite-ajax-js', WPRSMP_PLUGIN_URL . 'admin/js/wprsmp-lite-ajax.js', array( 'jquery' ), true, true );
		//$attendence_data = WPRSMPLiteHelperClass::attendence_graph_details();
		wp_localize_script( 'wprsmp-lite-ajax-js', 'ajax_backend', array(
			'ajax_url'      => admin_url( 'admin-ajax.php' ),
			'backend_nonce' => wp_create_nonce( 'backend_ajax_nonce' ),
			'task_status'   => WPRSMPLiteHelperClass::all_task_status(),
			//'total_days'    => $attendence_data['total_days']
		) );

		$role = WPRSMPLiteHelperClass::wprsmp_get_current_user_roles();
		if ( is_admin() && $role == 'administrator' ) {
			/** Staff Login/Logout action from Admin Dashboard **/
			wp_enqueue_script( 'wprsmp-admin-ajax-js', WPRSMP_PLUGIN_URL . 'admin/js/wprsmp-lite-admin-dashboard.js', array( 'jquery' ), true, true );
			wp_localize_script( 'wprsmp-admin-ajax-js', 'ajax_admin', array(
				'ajax_url'      => admin_url( 'admin-ajax.php' ),
				'admin_nonce'   => wp_create_nonce( 'admin_ajax_nonce' ),
			) );
		}
	}
}