<?php defined( 'ABSPATH' ) or die(); 
require_once( WPRSMP_PLUGIN_DIR_PATH . '/admin/inc/helpers/wprsmp-lite-helper.php' );

/**
 * Shift ajax action class
 */
class LiteShiftAjaxActions {

	/* Add Shift Action Call */
	public static function add_shift() {
		check_ajax_referer( 'backend_ajax_nonce', 'nounce' );

		if ( ! empty ( $_POST['name'] ) && ! empty ( $_POST['start'] ) && ! empty ( $_POST['end'] ) && ! empty ( $_POST['late'] ) && ! empty ( $_POST['status'] ) ) {
			$name   = sanitize_text_field( $_POST['name'] );
			$start  = wp_kses_post( $_POST['start'] );
			$end    = sanitize_text_field( $_POST['end'] );
			$late   = sanitize_text_field( $_POST['late'] );
			$status = sanitize_text_field( $_POST['status'] );
			$shifts = get_option( 'wprsmp_shifts_data' );
			$data   = array(
				'name'    => $name,
				'start'   => $start,
				'end'     => $end,
				'late'    => $late,
				'status'  => $status,
			);

			$staff_no = 0;

			if ( empty ( $shifts ) ) {
				$shifts = array();
			} else {
                $shift_arr_size = sizeof( $shifts );
                if ( $shift_arr_size > 1 ) {
                    $status  = 'error';
                    $message = __( 'You can add only 2 shifts in free version.!', 'staff-manger-lite' );
                    $content = '';
                    $return = array(
                        'status'  => $status,
                        'message' => $message,
                        'content' => $content
					);
					wp_send_json( $return );
                }
            }
			array_push( $shifts, $data );

			if ( update_option( 'wprsmp_shifts_data', $shifts ) ) {

				$all_shifts = get_option( 'wprsmp_shifts_data' );

				if ( ! empty ( $all_shifts ) ) {
            		$sno = 1;
            		foreach ( $all_shifts as $key => $shift ) {
            	
		                $html .= '<tr>
				                	<td>'.esc_html( $sno ).'</td>
				                  	<td>'.esc_html( $shift['name'] ).'</td>
				                  	<td>'.esc_html( date( WPRSMPLiteHelperClass::get_time_format(), strtotime( $shift['start'] ) ) ).'</td>
				                  	<td>'.esc_html( date( WPRSMPLiteHelperClass::get_time_format(), strtotime( $shift['end'] ) ) ).'</td>
				                  	<td>'.esc_html( date( WPRSMPLiteHelperClass::get_time_format(), strtotime( $shift['late'] ) ) ).'</td>
				                  	<td>'.esc_html( $shift['status'] ).'</td>
				                  	<td class="designation-action-tools">
		                          		<ul class="designation-action-tools-ul">
		                          			<li class="designation-action-tools-li">
		                          				<a href="#" class="designation-action-tools-a shift-edit-a" data-shift="'.esc_attr( $key ).'">
		                          					<i class="fas fa-pencil-alt"></i>
		                          				</a>
		                          			</li>
		                          			<li class="designation-action-tools-li">
		                          				<a href="#" class="designation-action-tools-a shift-delete-a" data-shift="'.esc_attr( $key ).'">
		                          					<i class="far fa-window-close"></i>
		                          				</a>
		                          			</li>
		                          		</ul>
		                          	</td>
				                </tr>';
		                $sno++; 
		            } 
		        }
				$status  = 'success';
				$message = __( 'Shift added successfully!', 'staff-manger-lite' );
				$content = wp_kses_post( $html );
			} else {
				$status  = 'error';
				$message = __( 'Shift not added!', 'staff-manger-lite' );
				$content = '';
			}

		} else {
			if ( empty ( $_POST['name'] ) ) {
				$message = __( 'Please enter name.!', 'staff-manger-lite' );		
			} elseif ( empty ( $_POST['start'] ) ) {
				$message = __( 'Please select start time.!', 'staff-manger-lite' );
			} elseif ( empty ( $_POST['end'] ) ) {
				$message = __( 'Please select end time.!', 'staff-manger-lite' );
			} elseif ( empty ( $_POST['late'] ) ) {
				$message = __( 'Please select late time.!', 'staff-manger-lite' );
			} elseif ( empty ( $_POST['status'] ) ) {
				$message = __( 'Please select status.!', 'staff-manger-lite' );
			}

			$status  = 'error';
			$content = '';
		}
		$return = array(
			'status'  => $status,
			'message' => $message,
			'content' => $content
		);

		wp_send_json( $return );
		wp_die();
	}

	/* Delete Shift Action Call */
	public static function delete_shift() {
		check_ajax_referer( 'backend_ajax_nonce', 'nounce' );

		if ( isset ( $_POST['shift_key'] ) ) {
			$shift_key = sanitize_text_field( $_POST['shift_key'] );
			$shifts    = get_option( 'wprsmp_shifts_data' );

			unset( $shifts[$shift_key] );

			if ( update_option( 'wprsmp_shifts_data', $shifts ) ) {

				$all_shifts = get_option( 'wprsmp_shifts_data' );

				$staff_no = 0;

				if ( ! empty ( $all_shifts ) ) {
            		$sno = 1;
            		foreach ( $all_shifts as $key => $shift ) {
            	
		                $html .= '<tr>
				                	<td>'.esc_html( $sno ).'</td>
				                  	<td>'.esc_html( $shift['name'] ).'</td>
				                  	<td>'.esc_html( date( WPRSMPLiteHelperClass::get_time_format(), strtotime( $shift['start'] ) ) ).'</td>
				                  	<td>'.esc_html( date( WPRSMPLiteHelperClass::get_time_format(), strtotime( $shift['end'] ) ) ).'</td>
				                  	<td>'.esc_html( date( WPRSMPLiteHelperClass::get_time_format(), strtotime( $shift['late'] ) ) ).'</td>
				                  	<td>'.esc_html( $shift['status'] ).'</td>
				                  	<td class="designation-action-tools">
		                          		<ul class="designation-action-tools-ul">
		                          			<li class="designation-action-tools-li">
		                          				<a href="#" class="designation-action-tools-a shift-edit-a" data-shift="'.esc_attr( $key ).'">
		                          					<i class="fas fa-pencil-alt"></i>
		                          				</a>
		                          			</li>
		                          			<li class="designation-action-tools-li">
		                          				<a href="#" class="designation-action-tools-a shift-delete-a" data-shift="'.esc_attr( $key ).'">
		                          					<i class="far fa-window-close"></i>
		                          				</a>
		                          			</li>
		                          		</ul>
		                          	</td>
				                </tr>';
		                $sno++; 
		            } 
		        }
				$status  = 'success';
				$message = __( 'Shift deleted successfully!', 'staff-manger-lite' );
				$content = wp_kses_post( $html );
			} else {
				$status  = 'error';
				$message = __( 'Shift not deleted!', 'staff-manger-lite' );
				$content = '';
			}

		} else {
			$status  = 'error';
			$message = __( 'Something went wrong.!', 'staff-manger-lite' );
			$content = '';
		}
		$return = array(
			'status'  => $status,
			'message' => $message,
			'content' => $content
		);

		wp_send_json( $return );
		wp_die();
	}

	/* Edit Shift Action Call */
	public static function edit_shift() {
		check_ajax_referer( 'backend_ajax_nonce', 'nounce' );

		if ( isset ( $_POST['shift_key'] ) ) {
			$shift_key   = sanitize_text_field( $_POST['shift_key'] );
			$shifts      = get_option( 'wprsmp_shifts_data' );

			$data = array(
				'name'   => $shifts[$shift_key]['name'],
				'start'  => $shifts[$shift_key]['start'],
				'end'    => $shifts[$shift_key]['end'],
				'late'   => $shifts[$shift_key]['late'],
				'status' => $shifts[$shift_key]['status'],
			);
			wp_send_json( $data );

		} else {
			wp_send_json( __( 'Something went wrong.!', 'staff-manger-lite' ) );
		}
		wp_die();
	}

	/* Update Shift Action Call */
	public static function update_shift() {
		check_ajax_referer( 'backend_ajax_nonce', 'nounce' );

		if ( ! empty ( $_POST['name'] ) && ! empty ( $_POST['start'] ) && ! empty ( $_POST['end'] ) && ! empty ( $_POST['late'] ) && ! empty ( $_POST['status'] ) ) {
			$shift_key = sanitize_text_field( $_POST['shift_key'] );
			$name      = sanitize_text_field( $_POST['name'] );
			$start     = wp_kses_post( $_POST['start'] );
			$end       = sanitize_text_field( $_POST['end'] );
			$late      = sanitize_text_field( $_POST['late'] );
			$status    = sanitize_text_field( $_POST['status'] );
			$shifts    = get_option( 'wprsmp_shifts_data' );

			$data = array(
				'name'   => $name,
				'start'  => $start,
				'end'    => $end,
				'late'   => $late,
				'status' => $status,
			);

			$staff_no = 0;

			$shifts[$shift_key] = $data;

			if ( update_option( 'wprsmp_shifts_data', $shifts ) ) {

				$all_shifts = get_option( 'wprsmp_shifts_data' );

				if ( ! empty ( $all_shifts ) ) {
            		$sno = 1;
            		foreach ( $all_shifts as $key => $shift ) {
            	
		                $html .= '<tr>
				                	<td>'.esc_html( $sno ).'</td>
				                  	<td>'.esc_html( $shift['name'] ).'</td>
				                  	<td>'.esc_html( date( WPRSMPLiteHelperClass::get_time_format(), strtotime( $shift['start'] ) ) ).'</td>
				                  	<td>'.esc_html( date( WPRSMPLiteHelperClass::get_time_format(), strtotime( $shift['end'] ) ) ).'</td>
				                  	<td>'.esc_html( date( WPRSMPLiteHelperClass::get_time_format(), strtotime( $shift['late'] ) ) ).'</td>
				                  	<td>'.esc_html( $shift['status'] ).'</td>
				                  	<td class="designation-action-tools">
		                          		<ul class="designation-action-tools-ul">
		                          			<li class="designation-action-tools-li">
		                          				<a href="#" class="designation-action-tools-a shift-edit-a" data-shift="'.esc_attr( $key ).'">
		                          					<i class="fas fa-pencil-alt"></i>
		                          				</a>
		                          			</li>
		                          			<li class="designation-action-tools-li">
		                          				<a href="#" class="designation-action-tools-a shift-delete-a" data-shift="'.esc_attr( $key ).'">
		                          					<i class="far fa-window-close"></i>
		                          				</a>
		                          			</li>
		                          		</ul>
		                          	</td>
				                </tr>';
		                $sno++; 
		            } 
		        }
				$status  = 'success';
				$message = __( 'Shift updated successfully!', 'staff-manger-lite' );
				$content = wp_kses_post( $html );
			} else {
				$status  = 'error';
				$message = __( 'Shift not updated!', 'staff-manger-lite' );
				$content = '';
			}

		} else {
			if ( empty ( $_POST['name'] ) ) {
				$message = __( 'Please enter name.!', 'staff-manger-lite' );		
			} elseif ( empty ( $_POST['start'] ) ) {
				$message = __( 'Please select start time.!', 'staff-manger-lite' );
			} elseif ( empty ( $_POST['end'] ) ) {
				$message = __( 'Please select end time.!', 'staff-manger-lite' );
			} elseif ( empty ( $_POST['late'] ) ) {
				$message = __( 'Please select late time.!', 'staff-manger-lite' );
			} elseif ( empty ( $_POST['status'] ) ) {
				$message = __( 'Please select status.!', 'staff-manger-lite' );
			}

			$status  = 'error';
			$content = '';
		}
		$return = array(
			'status'  => $status,
			'message' => $message,
			'content' => $content
		);

		wp_send_json( $return );
		wp_die();
	}
}

?>