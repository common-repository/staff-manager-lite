<?php
defined( 'ABSPATH' ) or die();

require_once( WPRSMP_PLUGIN_DIR_PATH . '/admin/inc/helpers/wprsmp-lite-helper.php' );

class WL_WPRSM_LITE_INIT {

	/* Add settings link on plugin page */
	public static function wprsmp_lite_links( $links ) {
		$wl_agm_pro_link = '<a href="https://codecanyon.net/item/wp-staff-management-pro/26377458" target="_blank" style="font-weight:700; color:#e35400">' . esc_html__( 'Go Pro', 'staff-manger-lite' ) . '</a>';
    	$wl_agm_settings_link = '<a href="admin.php?page=staff-manger-lite-settings">'. esc_html__( 'Settings', 'staff-manger-lite' ) .'</a>';
		array_unshift( $links,$wl_agm_pro_link, $wl_agm_settings_link );

		return $links;
	}

	/* Add custom admin widget */
	public static function wprsmp_custom_dashboard_widgets() {
		global $wp_meta_boxes;
		 
		wp_add_dashboard_widget( 'wprsmp_admin_widget', 'Staff Manager Plugin High lights', array( 'WL_WPRSM_LITE_INIT', 'wprsmp_custom_dashboard_widget' ) );
	}

	public static function wprsmp_custom_dashboard_widget() {

		$staffs      = get_option( 'wprsmp_staffs_data' );
		$all_staffs  = get_option( 'wprsmp_staffs_data' );
		$attendences = get_option( 'wprsmp_staff_attendence_data' );
		$count       = 0;
		$count1      = 0;

		if ( ! empty ( $staffs ) ) {
			foreach ( $staffs as $staff_key => $staff ) {
				if ( $staff['status'] == 'Active' ) {
					$count++;
				}
			}
		}

		if ( ! empty ( $all_staffs ) ) {
			foreach ( $all_staffs as $key => $staff ) {
				$user_id     = $staff['ID'];
				if ( ! empty( $attendences ) ) {
					foreach ( $attendences as $key => $attendence ) {
						if ( $attendence['date'] == date( 'Y-m-d' ) && $attendence['staff_id'] == $user_id && ! empty( $attendence['office_in'] ) ) {
							$count1++;
						}
					}
				}
			}
		}

		$projects = get_option( 'wprsmp_projects_data' );
		$p_count  = 0;

		if ( ! empty ( $projects ) ) {
			foreach ( $projects as $project_key => $project ) {
				if ( $project['status'] == 'Active' ) {
					$p_count++;
				}
			}
		}

		$locations = get_option( 'wprsmp_requests_data' );
		$l_count   = 0;

		if ( ! empty ( $locations ) ) {
			foreach ( $locations as $location_key => $location ) {
				if ( $location['status'] == 'Pending' ) {
					$l_count++;
				}
			}
		}

		$shifts  = get_option( 'wprsmp_shifts_data' );
		$s_count = 0;

		if ( ! empty ( $shifts ) ) {
			foreach ( $shifts as $shift_key => $shift ) {
				if ( $shift['status'] == 'Active' ) {
					$s_count++;
				}
			}
		}

		$all_events  = get_option( 'wprsmp_events_data' );
		$all_dates   = WPRSMPLiteHelperClass::wprsmp_get_current_date_range();
		$n_count     = 0;

		foreach ( $all_dates as $key => $date ) {
			if ( ! empty ( $all_events  ) ) {
				foreach ( $all_events as $event_key => $event ) {
					if ( $event['date'] == $date ) {

						$current_date = strtotime( date( 'Y-m-d' ) );
						$duedate_task = strtotime( $event['date'] );

						if ( $duedate_task > $current_date ) { 
							$n_count++;
						}
					}
				}
			}
		}

		$all_holidays = get_option( 'wprsmp_holidays_data' );
		$all_dates    = WPRSMPLiteHelperClass::wprsmp_get_current_date_range();
		$h_count      = 0;

		foreach ( $all_dates as $key => $date ) {
			if ( ! empty ( $all_holidays  ) ) {
				foreach ( $all_holidays as $holiday_key => $holiday ) {
					if ( $holiday['start'] == $date ) {
						$current_date = strtotime( date( 'Y-m-d' ) );
						$duedate_task = strtotime( $holiday['to'] );

						if ( $duedate_task > $current_date ) {
							$h_count++;
						}
					}
				}
			}
		}

		?>
			<div class="main wprsmp-lite-widget">
				<ul>
					<?php 
						$role = WPRSMPLiteHelperClass::wprsmp_get_current_user_roles();
						if ( $role == 'administrator' ) {
					?>
					<li class="leaves-count">
						<a href="admin.php?page=staff-manger-lite-requests">
							<span class="icon"><i class="fas fa-notes-medical"></i></span>
							<span class="title"><?php esc_html_e( 'Pending Leaves', 'staff-manger-lite' ); ?></span> 
							<span class="count"><?php echo esc_html( $l_count ); ?></span>
						</a>
					</li>
					<li class="shifts-count">
						<a href="admin.php?page=staff-manger-lite-shift">
							<span class="icon"><i class="fas fa-business-time"></i></span>
							<span class="title"><?php esc_html_e( 'Shifts', 'staff-manger-lite' ); ?></span> 
							<span class="count"><?php echo esc_html( $s_count ); ?></span>
						</a>
					</li>		
					<li class="staffs-count">
						<a href="admin.php?page=staff-manger-lite-staff">
							<span class="icon"><i class="fab fa-studiovinari"></i></span>
							<span class="title"><?php esc_html_e( 'Active Staffs', 'staff-manger-lite' ); ?></span> 
							<span class="count"><?php echo esc_html( $count1 ); ?></span>
						</a>
					</li>
					<li class="projects-count">
						<a href="admin.php?page=staff-manger-lite-projects">
							<span class="icon"><i class="fas fa-tasks"></i></span>
							<span class="title"><?php esc_html_e( 'Projects', 'staff-manger-lite' ); ?></span> 
							<span class="count"><?php echo esc_html( $p_count ); ?></span>
						</a>
					</li>
					<li class="events-count">
						<a href="admin.php?page=staff-manger-lite-events">
							<span class="icon"><i class="fas fa-calendar-day"></i></span>
							<span class="title"><?php esc_html_e( 'Up Coming Events', 'staff-manger-lite' ); ?></span> 
							<span class="count"><?php echo esc_html( $n_count ); ?></span>
						</a>
					</li>
					<li class="holidays-count">
						<a href="admin.php?page=staff-manger-lite-holidays">
							<span class="icon"><i class="fas fa-golf-ball"></i></span>
							<span class="title"><?php esc_html_e( 'Up Coming Holidays', 'staff-manger-lite' ); ?></span> 
							<span class="count"><?php echo esc_html( $h_count ); ?></span>
						</a>
					</li>
					<?php } else { ?>
						<li class="events-count">
							<a href="#">
								<span class="icon"><i class="fas fa-calendar-day"></i></span>
								<span class="title"><?php esc_html_e( 'Up Coming Events', 'staff-manger-lite' ); ?></span> 
								<span class="count"><?php echo esc_html( $n_count ); ?></span>
							</a>
						</li>
						<li class="holidays-count">
							<span class="icon"><i class="fas fa-golf-ball"></i></span>
							<a href="admin.php?page=employee-and-hr-management-staff-holidays">
								<span class="title"><?php esc_html_e( 'Up Coming Holidays', 'staff-manger-lite' ); ?></span> 
								<span class="count"><?php echo esc_html( $h_count ); ?></span>
							</a>
						</li>
					<?php } ?>
				</ul>
			</div>
		<?php
	}

	public static function wprsmp_admin_widget_assets() {
		wp_enqueue_style( 'font-awesome', WPRSMP_PLUGIN_URL . 'assets/css/font-awesome.min.css' );
		wp_enqueue_style( 'wprsmp_admin_widget', WPRSMP_PLUGIN_URL.'admin/css/wprsmp-admin-widget-css.css' );
	}
}