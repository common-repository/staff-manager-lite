<?php
defined( 'ABSPATH' ) or die();
/**
 *  Ajax Action calls for notifications menu
 */
class LiteNotificationsAjaxAction {
	
	public static function save_options() {
        check_ajax_referer( 'notification_ajax_nonce', 'nounce' );

		if ( ! empty ( $_POST['from_name'] ) && ! empty ( $_POST['from_address'] ) ) {
            $name     = sanitize_text_field( $_POST['from_name'] );
			$address  = sanitize_text_field( $_POST['from_address'] );
            $logo     = sanitize_text_field( $_POST['logo_image'] );
            $footer   = sanitize_text_field( $_POST['footer_txt'] );
            $settings = get_option( 'wprsmp_email_options_data' );
            
            $data = array(
				'name'    => $name,
				'address' => $address,
				'logo'    => $logo,
				'footer'  => $status
            );
            
            if ( update_option( 'wprsmp_email_options_data', $data ) ) {
                $status  = 'success';
				$message = __( 'Saved successfully!', 'staff-manger-lite' );
            } else {
                $status  = 'error';
				$message = __( 'Data not saved!', 'staff-manger-lite' );
            }

        } else {

			if ( empty ( $_POST['from_name'] ) ) {
				$message = __( 'Please enter name.!', 'staff-manger-lite' );
			} elseif ( empty ( $_POST['from_address'] ) ) {
				$message = __( 'Please enter sender email.!', 'staff-manger-lite' );
			} else {
				$message = __( 'Something went wrong.!', 'staff-manger-lite' );
			}

			$status  = 'error';
		}

		$return = array(
			'status'  => $status,
			'message' => $message
		);

		wp_send_json( $return );
		wp_die();
	}
	
	public static function show_email_template_data() {
		check_ajax_referer( 'notification_ajax_nonce', 'nounce' );
		if ( ! empty ( $_POST['value'] ) ) {
			$value      = sanitize_text_field( $_POST['value'] );
			$email_data = get_option( 'wprsmp_email_'.$value );
			$status     = 'success';
			$content    = $email_data;
            
		} else {

			if ( empty ( $_POST['value'] ) ) {
				$message = __( 'Data Attribute not found.!', 'staff-manger-lite' );
			} else {
				$message = __( 'Something went wrong.!', 'staff-manger-lite' );
			}

			$status  = 'error';
			$content = '';
		}

		$return = array(
			'status'  => $status,
			'message' => $message,
			'content' => $content,
		);

		wp_send_json( $return );
		wp_die();
	}

	public static function save_email_template_data() {
        check_ajax_referer( 'notification_ajax_nonce', 'nounce' );

		if ( ! empty ( $_POST['name'] ) ) {
            $subject   = sanitize_text_field( $_POST['subject'] );
			$heading   = sanitize_text_field( $_POST['heading'] );
			$name      = sanitize_text_field( $_POST['name'] );
			$tags      = sanitize_text_field( $_POST['tags'] );
            $body      = $_POST['body'];
            $email_data = get_option( 'wprsmp_email_'.$name );
            
            $data = array(
				'subject' => $subject,
				'heading' => $heading,
				'body'    => $body,
				'tags'    => $tags
            );
            
            if ( update_option( 'wprsmp_email_'.$name, $data ) ) {
                $status  = 'success';
				$message = __( 'Saved successfully!', 'staff-manger-lite' );
            } else {
                $status  = 'error';
				$message = __( 'Data not saved!', 'staff-manger-lite' );
            }

        } else {

			if ( empty ( $_POST['name'] ) ) {
				$message = __( 'Email template id not found.!', 'staff-manger-lite' );
			} else {
				$message = __( 'Something went wrong.!', 'staff-manger-lite' );
			}

			$status  = 'error';
		}

		$return = array(
			'status'  => $status,
			'message' => $message
		);

		wp_send_json( $return );
		wp_die();
	}
}