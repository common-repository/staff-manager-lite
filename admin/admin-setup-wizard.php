<?php
/**
 * Setup Wizard Class
 *
 * Takes new users through some basic steps to setup their store.
 *
 * @package  Employee & HR Management
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * wprsmp_liteesc_html__Admin_Setup_Wizard class.
 */
class WPRSMLite_AdminSetupWizard {

    /**
	 * Current step
	 *
	 * @var string
	 */
    private $step = '';

	/**
	 * Steps for the setup wizard
	 *
	 * @var array
	 */
    private $steps = array();

    /**
	 * Department status
	 *
	 * @var string
	 */
	private $dept_status = 0;

    /**
	 * Hook in tabs.
	 */
	public function esc_html__construct() {
        add_action( 'admin_menu', array( $this, 'admin_menus' ) );
        add_action( 'admin_init', array( $this, 'setup_wizard' ) );

		add_action( 'wprsmp_liteesc_html__setup_setup_footer', array( $this, 'add_footer_scripts' ) );
    }

    public function dashboard_assets() {
		self::enqueue_scripts();
	}
    /**
	 * Add admin menus/screens.
	 */
	public function admin_menus() {
		add_dashboard_page( '', '', 'manage_options', 'wprsmp-lite-setup-wizard', '' );
	}

	/**
	 * Add footer scripts to OBW via woocommerce_setup_footer
	 */
	public function add_footer_scripts() {
		wp_print_scripts();
    }

    /**
	 * Register/enqueue scripts and styles for the Setup Wizard.
	 *
	 * Hooked onto 'admin_enqueue_scripts'.
	 */
	public function enqueue_scripts() {
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_style( 'bootstrap', WPRSMP_PLUGIN_URL . 'public/css/bootstrap.min.css' );
		wp_enqueue_style( 'bootstrap-timepicker', WPRSMP_PLUGIN_URL . 'assets/css/bootstrap-timepicker.css' );
		wp_enqueue_style( 'font-awesome', WPRSMP_PLUGIN_URL . 'assets/css/font-awesome.min.css' );
		wp_enqueue_style( 'wprsmp-lite-setup-css', WPRSMP_PLUGIN_URL . '/admin/css/admin-setup-wizard.css');

        /* Add the color picker css file */
        wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'wp-color-picker' );
        wp_enqueue_script( 'moment' );
		wp_enqueue_script( 'popper-js', WPRSMP_PLUGIN_URL . 'assets/js/popper.min.js', array( 'jquery' ), true, true );
        wp_enqueue_script( 'bootstrap-js', WPRSMP_PLUGIN_URL . 'assets/js/bootstrap.min.js', array( 'jquery' ), true, true );
		wp_enqueue_script( 'bootstrap-timepicker-js', WPRSMP_PLUGIN_URL . 'assets/js/bootstrap-timepicker.js', array( 'jquery' ), true, true );
        wp_enqueue_script( 'wprsmp-lite-setup-js', WPRSMP_PLUGIN_URL . '/admin/js/admin-setup.js', array( 'jquery' ), true, true );
    }

     /**
	 * Show the setup wizard.
	 */
	public function setup_wizard() {
		self::enqueue_scripts();
		if ( empty( $_GET['page'] ) || 'wprsmp-lite-setup-wizard' !== $_GET['page'] ) {

			return;
		}
		$default_steps = array(
			'shifts' => array(
				'name'    => esc_html__( 'Create Shift', 'staff-manger-lite' ),
				'view'    => array( $this, 'wprsmp_lite_setup_shift_setup' ),
				'handler' => array( $this, 'wprsmp_lite_setup_shift_setup_save' ),
            ),
			'designation'     => array(
				'name'    => esc_html__( 'Create Designation', 'staff-manger-lite' ),
				'view'    => array( $this, 'wprsmp_lite_setup_desig' ),
				'handler' => '',
			),
			'settings'    => array(
				'name'    => esc_html__( 'Configure Settings', 'staff-manger-lite' ),
				'view'    => array( $this, 'wprsmp_lite_setup_settings' ),
				'handler' => array( $this, 'wprsmp_lite_setup_settings_save' ),
			),
			'next_steps'  => array(
				'name'    => esc_html__( 'Ready!', 'staff-manger-lite' ),
				'view'    => array( $this, 'wprsmp_lite_setup_ready' ),
				'handler' => '',
			),
		);

		$this->steps = apply_filters( 'wprsmp_lite_setup_wizard_steps', $default_steps );
		$this->step  = isset( $_GET['step'] ) ? sanitize_key( $_GET['step'] ) : current( array_keys( $this->steps ) );

		// @codingStandardsIgnoreStart
		if ( ! empty( $_POST['save_step'] ) && isset( $this->steps[ $this->step ]['handler'] ) ) {
			call_user_func( $this->steps[ $this->step ]['handler'], $this );
		}
		// @codingStandardsIgnoreEnd

		ob_start();
		$this->setup_wizard_header();
		$this->setup_wizard_steps();
		$this->setup_wizard_content();
		$this->setup_wizard_footer();
		exit;
    }

    /** Next step function **/
	public function get_next_step_link( $step = '' ) {
		if ( ! $step ) {
			$step = $this->step;
		}

		$keys = array_keys( $this->steps );
		if ( end( $keys ) === $step ) {
			return admin_url();
		}

		$step_index = array_search( $step, $keys, true );
		if ( false === $step_index ) {
			return '';
		}

		return add_query_arg( 'step', $keys[ $step_index + 1 ], remove_query_arg( 'activate_error' ) );
	}

    /**
	 * Setup Wizard Header.
	 */
	public function setup_wizard_header() {
		set_current_screen();
		?>
		<!DOCTYPE html>
		<html <?php language_attributes(); ?>>
		<head>
			<meta name="viewport" content="width=device-width" />
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<title><?php esc_html_e( 'Employee & HR Management &rsaquo; Setup Wizard', 'staff-manger-lite' ); ?></title>
			<?php do_action( 'admin_enqueue_scripts' ); ?>
			<?php wp_print_scripts( 'wprsmp-lite-setup-wizard' ); ?>
			<?php do_action( 'admin_print_styles' ); ?>
			<?php do_action( 'admin_head' ); ?>
		</head>
		<body class="wprsmp-lite-setup-wizard wp-core-ui wl_custom wl_wprsmp">
            <div class="main-panel">
  	            <div class="content-wrapper container" style="position: relative">
                    <div class="logo">
                        <h2 class="text-white"><?php esc_html_e( 'Staff Manager Lite', 'staff-manger-lite' ); ?></h2>
                    </div>
		<?php
    }

    /**
	 * Output the steps.
	 */
	public function setup_wizard_steps() {
		$output_steps = $this->steps;
		?>
		<ol class="wprsmp-lite-setup-steps">
			<?php
			foreach ( $output_steps as $step_key => $step ) {
				$is_completed = array_search( $this->step, array_keys( $this->steps ), true ) > array_search( $step_key, array_keys( $this->steps ), true );

				if ( $step_key === $this->step ) {
					?>
					<li class="active"><?php echo esc_html( $step['name'] ); ?></li>
					<?php
				} elseif ( $is_completed ) {
					?>
					<li class="done">
						<a href="<?php echo esc_url( add_query_arg( 'step', $step_key, remove_query_arg( 'activate_error' ) ) ); ?>"><?php echo esc_html( $step['name'] ); ?></a>
					</li>
					<?php
				} else {
					?>
					<li><?php echo esc_html( $step['name'] ); ?></li>
					<?php
				}
			}
			?>
		</ol>
		<?php
    }

    /**
	 * Setup Wizard Footer.
	 */
	public function setup_wizard_footer() {
		?>
			<a class="wprsmp-lite-setup-footer-links" href="<?php echo esc_url( admin_url() ); ?>"><?php esc_html_e( 'Not right now', 'staff-manger-lite' ); ?></a>
            <?php do_action( 'wprsmp_liteesc_html__setup_setup_footer' ); ?>
                    </div>
                </div>
			</body>
		</html>
		<?php
	}

	/**
	 * Output the content for the current step.
	 */
	public function setup_wizard_content() {
		echo '<div class="wprsmp-lite-setup-content">';
		if ( ! empty( $this->steps[ $this->step ]['view'] ) ) {
			call_user_func( $this->steps[ $this->step ]['view'], $this );
		}
		echo '</div>';
    }

    /** Shift step **/
	public function wprsmp_lite_setup_shift_setup() {
		?>
		<form method="post" class="shifts-step" aria-hidden="true" autocomplete="off">
			<p class="store-setup"><?php esc_html_e( 'The following wizard will help you to create multiple shift for your employees.', 'staff-manger-lite' ); ?></p>
			<hr>
			<div class="form-body">
                <div class="form-group row">
                    <label for="shift_name"><?php esc_html_e( 'Shift Name', 'staff-manger-lite' ); ?></label>
                    <input type="text" class="form-control" name="shift_name" id="shift_name" placeholder="<?php esc_html_e( 'Name', 'staff-manger-lite' ); ?>">
                </div>
                <div class="form-group row" >
                    <label><?php esc_html_e( 'Starting Time', 'staff-manger-lite' ); ?></label>
                    <input type="text" class="form-control datetimepicker-input" placeholder="<?php esc_html_e( 'Format:- 10:00 AM', 'staff-manger-lite' ); ?>" id="start_time" name="start_time" data-toggle="datetimepicker" data-target="#start_time"/>
                </div>
                <div class="form-group row" >
                    <label><?php esc_html_e( 'Ending Time', 'staff-manger-lite' ); ?></label>
                    <input type="text" id="end_time" name="end_time" placeholder="<?php esc_html_e( 'Format:- 1:39 PM', 'staff-manger-lite' ); ?>" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target="#end_time">
                </div>
                <div class="form-group row" >
                    <label><?php esc_html_e( 'Late Time', 'staff-manger-lite' ); ?></label>
                    <input type="text" id="late_time" name="late_time" placeholder="<?php esc_html_e( 'Format:- 10:15 AM', 'staff-manger-lite' ); ?>" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target="#late_time">
                </div>
			</div>
			<hr>
			<p class="wprsmp-lite-setup-actions step">
				<button type="submit" class="button-primary button button-large button-next" value="<?php esc_attr_e( "Next", 'staff-manger-lite' ); ?>" name="save_step"><?php esc_html_e( "Next", 'staff-manger-lite' ); ?></button>
			</p>
			<?php wp_nonce_field( 'wprsmp-lite-setup-wizard' ); ?>
		</form>
		<?php
    }

    public static function wprsmp_lite_setup_shift_setup_save() {
        check_admin_referer( 'wprsmp-lite-setup-wizard' );

        $name   = isset( $_POST['shift_name'] ) ? sanitize_text_field( $_POST['shift_name'] ) : '';
        $start  = isset( $_POST['start_time'] ) ? sanitize_text_field( $_POST['start_time'] ) : '';
        $end    = isset( $_POST['end_time'] ) ? sanitize_text_field( $_POST['end_time'] ) : '';
        $late   = isset( $_POST['late_time'] ) ? sanitize_text_field( $_POST['late_time'] ) : '';
        $shifts = get_option( 'wprsmp_shifts_data' );
        $data   = array(
            'name'   => $name,
            'start'  => $start,
            'end'    => $end,
            'late'   => $late,
            'status' => 'Active',
        );

        if ( empty ( $shifts ) ) {
            $shifts = array();
        }
        array_push( $shifts, $data );

        update_option( 'wprsmp_shifts_data', $shifts );
        wp_safe_redirect( esc_url_raw( $this->get_next_step_link() ) );
        exit;

    }

	/** Designation step **/
	public function wprsmp_lite_setup_desig() {

        if ( isset( $_POST['save_desig_step'] ) ) {
            $name   = isset( $_POST['designation_name'] ) ? sanitize_text_field( $_POST['designation_name'] ) : '';
            $color  = isset( $_POST['designation_color'] ) ? sanitize_text_field( $_POST['designation_color'] ) : '';
            $design = get_option( 'wprsmp_designations_data' );
            $data   = array(
                'deparment' => $depart,
                'name'      => $name,
                'color'     => $color,
                'status'    => 'Active',
            );

            if ( empty ( $design ) ) {
                $design = array();
            }
            array_push( $design, $data );

            if ( update_option( 'wprsmp_designations_data', $design ) ) {
				$this->dept_status++;
			}
        }
		?>
		<form method="post" class="designation-step" autocomplete="off">
			<p class="store-setup"><?php esc_html_e( 'The following wizard will help you to create multiple Designations for you employees.', 'staff-manger-lite' ); ?></p>
			<hr>
			<div class="form-group row">
				<label for="designation_name"><?php esc_html_e( 'Designation Name', 'staff-manger-lite' ); ?></label>
				<input type="text" class="form-control" name="designation_name" id="designation_name" placeholder="<?php esc_html_e( 'Designation Type', 'staff-manger-lite' ); ?>">
			</div>
			<hr>
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group row">
						<label for="designation_color" class="col-sm-12 col-form-label"><?php esc_html_e( 'Designation Color', 'staff-manger-lite' ); ?></label>
						<div class="col-sm-11">
							<input type="text" class="form-control color-field" name="designation_color" id="designation_color" placeholder="#ffffff">
						</div>
					</div>
				</div>
			</div>
			<hr>
			<p class="wprsmp-lite-setup-actions step">
                <?php if ( $this->dept_status != 0 ) { ?>
                    <button type="submit" class="btn btn-gradient-primary"  name="save_desig_step"><?php esc_html_e( "Add more !", 'staff-manger-lite' ); ?></button>
                    <a href="<?php echo $this->get_next_step_link(); ?>" class="btn button-primary"  name=""><?php esc_html_e( "Next", 'staff-manger-lite' ); ?></a>
                <?php } else { ?>
                    <button type="submit" class="btn btn-gradient-primary"  name="save_desig_step"><?php esc_html_e( "Create !", 'staff-manger-lite' ); ?></button>
                <?php } ?>
			</p>
			<?php wp_nonce_field( 'wprsmp-lite-setup-wizard' ); ?>
		</form>
		<?php
    }

	/** Designation step **/
	public function wprsmp_lite_setup_settings() {
		require_once( WPRSMP_PLUGIN_DIR_PATH . '/admin/inc/helpers/wprsmp-lite-helper.php' );
		$timezone_list    = WPRSMPLiteHelperClass::timezone_list();
        $save_settings    = get_option( 'wprsmp_settings_data' );
        $TimeZone         = isset( $save_settings['timezone'] ) ? sanitize_text_field( $save_settings['timezone'] ) : 'Asia/Kolkata';
        $date_format      = isset( $save_settings['date_format'] ) ? sanitize_text_field( $save_settings['date_format'] ) : 'F j Y';
        $time_format      = isset( $save_settings['time_format'] ) ? sanitize_text_field( $save_settings['time_format'] ) : 'g:i A';
        $monday_status    = isset( $save_settings['monday_status'] ) ? sanitize_text_field( $save_settings['monday_status'] ) : 'Working';
		$tuesday_status   = isset( $save_settings['tuesday_status'] ) ? sanitize_text_field( $save_settings['tuesday_status'] ) : 'Working';
		$wednesday_status = isset( $save_settings['wednesday_status'] ) ? sanitize_text_field( $save_settings['wednesday_status'] ) : 'Working';
		$thursday_status  = isset( $save_settings['thursday_status'] ) ? sanitize_text_field( $save_settings['thursday_status'] ) : 'Working';
		$friday_status    = isset( $save_settings['friday_status'] ) ? sanitize_text_field( $save_settings['friday_status'] ) : 'Working';
		$saturday_status  = isset( $save_settings['saturday_status'] ) ? sanitize_text_field( $save_settings['saturday_status'] ) : 'Working';
		$sunday_status    = isset( $save_settings['sunday_status'] ) ? sanitize_text_field( $save_settings['sunday_status'] ) : 'Off';
        $halfday_start    = isset( $save_settings['halfday_start'] ) ? sanitize_text_field( $save_settings['halfday_start'] ) : '';
        $halfday_end      = isset( $save_settings['halfday_end'] ) ? sanitize_text_field( $save_settings['halfday_end'] ) : '';
        $lunch_start      = isset( $save_settings['lunch_start'] ) ? sanitize_text_field( $save_settings['lunch_start'] ) : '';
        $lunch_end        = isset( $save_settings['lunch_end'] ) ? sanitize_text_field( $save_settings['lunch_end'] ) : '';
        $cur_symbol       = isset( $save_settings['cur_symbol'] ) ? sanitize_text_field( $save_settings['cur_symbol'] ) : '₹';
        $cur_position     = isset( $save_settings['cur_position'] ) ? sanitize_text_field( $save_settings['cur_position'] ) : 'Right';
        $salary_method    = isset( $save_settings['salary_method'] ) ? sanitize_text_field( $save_settings['salary_method'] ) : 'Monthly';
        $lunchtime        = isset( $save_settings['lunchtime'] ) ? sanitize_text_field( $save_settings['lunchtime'] ) : 'Include';
        $shoot_mail       = isset( $save_settings['shoot_mail'] ) ? sanitize_text_field( $save_settings['shoot_mail'] ) : 'Yes';
        $show_holiday     = isset( $save_settings['show_holiday'] ) ? sanitize_text_field( $save_settings['show_holiday'] ) : 'Yes';
        $show_report      = isset( $save_settings['show_report'] ) ? sanitize_text_field( $save_settings['show_report'] ) : 'Yes';
        $show_notice      = isset( $save_settings['show_notice'] ) ? sanitize_text_field( $save_settings['show_notice'] ) : 'Yes';
        $late_reson       = isset( $save_settings['late_reson'] ) ? sanitize_text_field( $save_settings['late_reson'] ) : 'Yes';
        $salary_status    = isset( $save_settings['salary_status'] ) ? sanitize_text_field( $save_settings['salary_status'] ) : 'Yes';
        $show_projects    = isset( $save_settings['show_projects'] ) ? sanitize_text_field( $save_settings['show_projects'] ) : 'Yes';
        $user_roles       = isset( $save_settings['user_roles'] ) ? sanitize_text_field( $save_settings['user_roles'] ) : '';
        $mail_logo        = isset( $save_settings['mail_logo'] ) ? sanitize_text_field( $save_settings['mail_logo'] ) : '';
        $office_in_sub    = isset( $save_settings['office_in_sub'] ) ? sanitize_text_field( $save_settings['office_in_sub'] ) : esc_html__( 'Login Alert From Employee & HR Management', 'staff-manger-lite' );
        $office_out_sub   = isset( $save_settings['office_out_sub'] ) ? sanitize_text_field( $save_settings['office_out_sub'] ) : esc_html__( 'Logout Alert From Employee & HR Management', 'staff-manger-lite' );
        $mail_heading     = isset( $save_settings['mail_heading'] ) ? sanitize_text_field( $save_settings['mail_heading'] ) : esc_html__( 'Staff Login/Logout Details', 'staff-manger-lite' );

		?>
		<form method="post" class="settings-step" autocomplete="off">
			<p class="store-setup"><?php esc_html_e( 'General settings', 'staff-manger-lite' ); ?></p>
			<hr>
			<div class="form-group row">
				<label class="col-sm-3 col-form-label"><?php esc_html_e('TimeZone', 'staff-manger-lite'); ?></label>
				<div class="col-sm-11">
					<select class="form-control" id="timezone" name="timezone">
						<option value=""><?php esc_html_e('----------------------------------------------------------Select timezone----------------------------------------------------------', 'staff-manger-lite'); ?></option>
					<?php foreach ( $timezone_list as $timezone ) { ?>
						<option value="<?php echo esc_attr( $timezone ); ?>" <?php selected( $TimeZone, $timezone ); ?>><?php echo esc_html( $timezone ); ?></option>
					<?php } ?>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-5 col-md-12">
					<div class="form-group row">
						<label class="col-sm-12 col-form-label"><?php esc_html_e('Date Format', 'staff-manger-lite'); ?></label>
						<div class="col-sm-11">
							<select class="form-control" id="date_format" name="date_format">
								<option value="F j Y" <?php selected( $date_format, 'F j Y' ); ?>><?php echo esc_html( date( 'F j Y' ) . ' ( F j Y ) '); ?></option>
								<option value="Y-m-d" <?php selected( $date_format, 'Y-m-d' ); ?>><?php echo esc_html( date( 'Y-m-d' ) . ' ( YYYY-MM-DD )'); ?></option>
								<option value="m/d/Y" <?php selected( $date_format, 'm/d/Y' ); ?>><?php echo esc_html( date( 'm/d/Y' ) . ' ( MM/DD/YYYY )'); ?></option>
								<option value="d-m-Y" <?php selected( $date_format, 'd-m-Y' ); ?>><?php echo esc_html( date( 'd-m-Y' ) . ' ( DD-MM-YYYY )'); ?></option>
								<option value="m-d-Y" <?php selected( $date_format, 'm-d-Y' ); ?>><?php echo esc_html( date( 'm-d-Y' ) . ' ( MM-DD-YYYY )'); ?></option>
								<option value="jS F Y" <?php selected( $date_format, 'jS F Y' ); ?>><?php echo esc_html( date( 'jS F Y' ) . ' ( d M YYYY )'); ?></option>
							</select>
						</div>
					</div>
				</div>
				<div class="col-lg-5 col-md-12">
					<div class="form-group row">
						<label class="col-sm-12 col-form-label"><?php esc_html_e('Time Format', 'staff-manger-lite'); ?></label>
						<div class="col-sm-11">
							<select class="form-control" id="time_format" name="time_format">
								<option value="g:i a" <?php selected( $time_format, 'g:i a' ); ?>><?php echo esc_html( date( 'g:i a' ) . ' (  g:i a  )' ); ?></option>
								<option value="g:i A" <?php selected( $time_format, 'g:i A' ); ?>><?php echo esc_html( date( 'g:i A' ) . ' (  g:i A  )' ); ?></option>
								<option value="H:i" <?php selected( $time_format, 'H:i' ); ?>><?php echo esc_html( date( 'H:i' ) . ' (  H:i  )' ); ?></option>
								<option value="H:i:s" <?php selected( $time_format, 'H:i:s' ); ?>><?php echo esc_html( date( 'H:i:s' ) . ' (  H:i:s  )' ); ?></option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<hr>
			<h4 class="card-title week_days"><?php esc_html_e( 'Week days status', 'staff-manger-lite'); ?></h4>
              <div class="row">
                <div class="col-lg-3 col-md-12">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?php esc_html_e( 'Monday', 'staff-manger-lite'); ?></label>
                    <div class="col-sm-8">
                      <select class="form-control" id="monday_status" name="monday_status">
                        <option value="Working" <?php selected( $monday_status, 'Working' ); ?>><?php esc_html_e( 'Working', 'staff-manger-lite' ); ?></option>
                        <option value="Half Day" <?php selected( $monday_status, 'Half Day' ); ?>><?php esc_html_e( 'Half Day', 'staff-manger-lite' ); ?></option>
                        <option value="Off" <?php selected( $monday_status, 'Off' ); ?>><?php esc_html_e( 'Off', 'staff-manger-lite' ); ?></option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-12">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?php esc_html_e( 'Tuesday', 'staff-manger-lite'); ?></label>
                    <div class="col-sm-8">
                      <select class="form-control" id="tuesday_status" name="tuesday_status">
                        <option value="Working" <?php selected( $tuesday_status, 'Working' ); ?>><?php esc_html_e( 'Working', 'staff-manger-lite' ); ?></option>
                        <option value="Half Day" <?php selected( $tuesday_status, 'Half Day' ); ?>><?php esc_html_e( 'Half Day', 'staff-manger-lite' ); ?></option>
                        <option value="Off" <?php selected( $tuesday_status, 'Off' ); ?>><?php esc_html_e( 'Off', 'staff-manger-lite' ); ?></option>
                      </select>
                    </div>
                  </div>
                </div>
				<div class="col-lg-3 col-md-12">
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label"><?php esc_html_e( 'Wednesday', 'staff-manger-lite'); ?></label>
                    <div class="col-sm-8">
                      <select class="form-control" id="wednesday_status" name="wednesday_status">
                        <option value="Working" <?php selected( $wednesday_status, 'Working' ); ?>><?php esc_html_e( 'Working', 'staff-manger-lite' ); ?></option>
                        <option value="Half Day" <?php selected( $wednesday_status, 'Half Day' ); ?>><?php esc_html_e( 'Half Day', 'staff-manger-lite' ); ?></option>
                        <option value="Off" <?php selected( $wednesday_status, 'Off' ); ?>><?php esc_html_e( 'Off', 'staff-manger-lite' ); ?></option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
			    <div class="col-lg-3 col-md-12">
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label"><?php esc_html_e( 'Thursday', 'staff-manger-lite'); ?></label>
                    <div class="col-sm-8">
                      <select class="form-control" id="thursday_status" name="thursday_status">
                        <option value="Working" <?php selected( $thursday_status, 'Working' ); ?>><?php esc_html_e( 'Working', 'staff-manger-lite' ); ?></option>
                        <option value="Half Day" <?php selected( $thursday_status, 'Half Day' ); ?>><?php esc_html_e( 'Half Day', 'staff-manger-lite' ); ?></option>
                        <option value="Off" <?php selected( $thursday_status, 'Off' ); ?>><?php esc_html_e( 'Off', 'staff-manger-lite' ); ?></option>
                      </select>
                    </div>
                  </div>
                </div>
			    <div class="col-lg-3 col-md-12">
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label"><?php esc_html_e( 'Friday', 'staff-manger-lite'); ?></label>
                    <div class="col-sm-8">
                      <select class="form-control" id="friday_status" name="friday_status">
                        <option value="Working" <?php selected( $friday_status, 'Working' ); ?>><?php esc_html_e( 'Working', 'staff-manger-lite' ); ?></option>
                        <option value="Half Day" <?php selected( $friday_status, 'Half Day' ); ?>><?php esc_html_e( 'Half Day', 'staff-manger-lite' ); ?></option>
                        <option value="Off" <?php selected( $friday_status, 'Off' ); ?>><?php esc_html_e( 'Off', 'staff-manger-lite' ); ?></option>
                      </select>
                    </div>
                  </div>
                </div>
			   	<div class="col-lg-3 col-md-12">
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label"><?php esc_html_e( 'Saturday', 'staff-manger-lite'); ?></label>
                    <div class="col-sm-8">
                      <select class="form-control" id="saturday_status" name="saturday_status">
                        <option value="Working" <?php selected( $saturday_status, 'Working' ); ?>><?php esc_html_e( 'Working', 'staff-manger-lite' ); ?></option>
                        <option value="Half Day" <?php selected( $saturday_status, 'Half Day' ); ?>><?php esc_html_e( 'Half Day', 'staff-manger-lite' ); ?></option>
                        <option value="Off" <?php selected( $saturday_status, 'Off' ); ?>><?php esc_html_e( 'Off', 'staff-manger-lite' ); ?></option>
                      </select>
                    </div>
                  </div>
                </div>
            </div>
			<div class="row">
				<div class="col-lg-3 col-md-12">
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label"><?php esc_html_e( 'Sunday', 'staff-manger-lite'); ?></label>
                    <div class="col-sm-8">
                      <select class="form-control" id="sunday_status" name="sunday_status">
                        <option value="Working" <?php selected( $sunday_status, 'Working' ); ?>><?php esc_html_e( 'Working', 'staff-manger-lite' ); ?></option>
                        <option value="Half Day" <?php selected( $sunday_status, 'Half Day' ); ?>><?php esc_html_e( 'Half Day', 'staff-manger-lite' ); ?></option>
                        <option value="Off" <?php selected( $sunday_status, 'Off' ); ?>><?php esc_html_e( 'Off', 'staff-manger-lite' ); ?></option>
                      </select>
                    </div>
                  </div>
                </div>
			</div>
			<hr>
			<h4 class="card-title week_days"><?php esc_html_e( 'Half Day Timing', 'staff-manger-lite'); ?></h4>
			<div class="row">
				<div class="col-lg-5 col-md-12">
					<div class="form-group row">
						<label class="col-sm-12 col-form-label"><?php esc_html_e( 'Halfday Start Time', 'staff-manger-lite' ); ?></label>
						<div class="col-sm-9">
							<input type="text" name="halfday_start" id="halfday_start" class="form-control" placeholder="<?php esc_html_e( 'Format:- 10:00 AM', 'staff-manger-lite' ); ?>" data-toggle="datetimepicker" data-target="#halfday_start" value="<?php echo esc_attr( $halfday_start ); ?>">
						</div>
					</div>
				</div>
				<div class="col-lg-5 col-md-12">
					<div class="form-group row">
						<label class="col-sm-12 col-form-label"><?php esc_html_e('Halfday End Time', 'staff-manger-lite'); ?></label>
						<div class="col-sm-9">
							<input type="text" name="halfday_end" id="halfday_end" class="form-control" placeholder="<?php esc_html_e('Format:- 03:00 PM', 'staff-manger-lite'); ?>" data-toggle="datetimepicker" data-target="#halfday_end" value="<?php echo esc_attr($halfday_end); ?>">
						</div>
					</div>
				</div>
			</div>
			<hr>
			<h4 class="card-title week_days"><?php esc_html_e( 'Lunch Timing', 'staff-manger-lite'); ?></h4>
			<div class="row">
				<div class="col-lg-5 col-md-12">
					<div class="form-group row">
						<label class="col-sm-12 col-form-label"><?php esc_html_e('Lunch Start Time', 'staff-manger-lite'); ?></label>
						<div class="col-sm-9">
							<input type="text" name="lunch_start" id="lunch_start" class="form-control" placeholder="<?php esc_html_e('Format:- 02:00 PM', 'staff-manger-lite'); ?>" data-toggle="datetimepicker" data-target="#lunch_start" value="<?php echo esc_attr($lunch_start); ?>">
						</div>
					</div>
				</div>
				<div class="col-lg-5 col-md-12">
					<div class="form-group row">
						<label class="col-sm-12 col-form-label"><?php esc_html_e('Lunch End Time', 'staff-manger-lite'); ?></label>
						<div class="col-sm-9">
							<input type="text" name="lunch_end" id="lunch_end" class="form-control" placeholder="<?php esc_html_e('Format:- 02:30 PM', 'staff-manger-lite'); ?>" data-toggle="datetimepicker" data-target="#lunch_end" value="<?php echo esc_attr($lunch_end); ?>">
						</div>
					</div>
				</div>
			</div>
			<hr>
			<h4 class="card-title week_days"><?php esc_html_e( 'Currency Detials', 'staff-manger-lite'); ?></h4>
			<div class="row">
			    <div class="col-lg-5 col-md-12">
					<div class="form-group row">
						<label class="col-sm-12 col-form-label"><?php esc_html_e( 'Currency Symbol', 'staff-manger-lite' ); ?></label>
						<div class="col-sm-9">
							<input type="text" class="form-control" placeholder="$" id="currency_symbol" name="currency_symbol" value="<?php echo esc_attr( $cur_symbol ); ?>">
						</div>
					</div>
				</div>
				<div class="col-lg-5 col-md-12">
					<div class="form-group row">
						<label class="col-sm-12 col-form-label"><?php esc_html_e( 'Currency Position', 'staff-manger-lite' ); ?></label>
						<div class="col-sm-11">
							<select class="form-control" id="currency_position" name="currency_position">
							<option value="Right" <?php selected( $cur_position, 'Right' ); ?>><?php esc_html_e( 'Right', 'staff-manger-lite' ); ?></option>
							<option value="Left" <?php selected( $cur_position, 'Left' ); ?>><?php esc_html_e( 'Left', 'staff-manger-lite' ); ?></option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<hr>
			<h4 class="card-title week_days"><?php esc_html_e( 'Salary Calculation', 'staff-manger-lite'); ?></h4>
			<div class="row">
			    <div class="col-lg-12 col-md-12">
					<div class="form-group row">
						<label class="col-sm-12 col-form-label"><?php esc_html_e( 'Salary paid by', 'staff-manger-lite' ); ?></label>
						<div class="col-sm-3">
							<div class="form-check form-check-success">
							<label class="form-check-label">
								<input type="radio" class="form-check-input" name="salary_method" value="Monthly" checked="" <?php checked( $salary_method, 'Monthly' ); ?>>
								<?php esc_html_e( 'Monthly', 'staff-manger-lite' ); ?>
								<i class="input-helper"></i></label>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="form-check form-check-success">
							<label class="form-check-label">
								<input type="radio" class="form-check-input" name="salary_method" value="Hourly" <?php checked( $salary_method, 'Hourly' ); ?>>
								<?php esc_html_e( 'Hourly', 'staff-manger-lite' ); ?>
								<i class="input-helper"></i></label>
							</div>
						</div>
					</div>
				</div>
			</div>
			<hr>
			<div class="row">
			    <div class="col-lg-12 col-md-12">
					<div class="form-group row">
						<label class="col-sm-12 col-form-label"><?php esc_html_e('Include/Exclude Lunch time from Working Hours', 'staff-manger-lite'); ?></label>
						<div class="col-sm-3">
							<div class="form-check form-check-success">
							<label class="form-check-label">
								<input type="radio" class="form-check-input" name="lunch_time_status" value="Include" checked="" <?php checked($lunchtime, 'Include'); ?>>
								<?php esc_html_e('Include', 'staff-manger-lite'); ?>
								<i class="input-helper"></i></label>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="form-check form-check-danger">
							<label class="form-check-label">
								<input type="radio" class="form-check-input" name="lunch_time_status" value="Exclude" <?php checked($lunchtime, 'Exclude'); ?>>
								<?php esc_html_e('Exclude', 'staff-manger-lite'); ?>
								<i class="input-helper"></i></label>
							</div>
						</div>
					</div>
				</div>
			</div>
			<hr>
			<h4 class="card-title week_days"><?php esc_html_e( 'Select Roles for employee', 'staff-manger-lite'); ?></h4>
			<div class="form-group row">
				<label class="col-sm-3 col-form-label"><?php esc_html_e('Select roles for staff\'s.', 'staff-manger-lite'); ?></label>
				<?php if ( ! empty( $save_settings['user_roles'] ) ) {
					$user_roles = unserialize( $save_settings['user_roles'] );
				} else {
					$user_roles = array();
				}
				?>
				<div class="col-sm-3">
					<div class="form-check form-check-success">
					<label class="form-check-label">
						<input type="checkbox" class="form-check-input" <?php if ( is_array( $user_roles ) ) { if ( in_array( 'subscriber', $user_roles ) ) { echo 'checked'; } } ?> name="user_roles[]" value="subscriber">
						<?php esc_html_e( 'Subscriber', 'staff-manger-lite' ); ?>
						<i class="input-helper"></i></label>
					</div>
					<div class="form-check form-check-success">
					<label class="form-check-label">
						<input type="checkbox" class="form-check-input" name="user_roles[]" value="contributor" <?php if ( is_array( $user_roles ) ) { if ( in_array( 'contributor', $user_roles ) ) { echo 'checked'; } } ?>>
						<?php esc_html_e( 'Contributor', 'staff-manger-lite' ); ?>
						<i class="input-helper"></i></label>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-check form-check-success">
					<label class="form-check-label">
						<input type="checkbox" class="form-check-input" name="user_roles[]" value="author" <?php if ( is_array( $user_roles ) ) { if ( in_array( 'author', $user_roles ) ) { echo 'checked'; } } ?>>
						<?php esc_html_e( 'Author', 'staff-manger-lite' ); ?>
						<i class="input-helper"></i></label>
					</div>
					<div class="form-check form-check-success">
					<label class="form-check-label">
						<input type="checkbox" class="form-check-input" name="user_roles[]" value="editor" <?php if ( is_array( $user_roles ) ) { if ( in_array( 'editor', $user_roles ) ) { echo 'checked'; } } ?>>
						<?php esc_html_e( 'Editor', 'staff-manger-lite' ); ?>
						<i class="input-helper"></i></label>
					</div>
				</div>
				<p class="info-text-hr">
					<span class="option-info-text">
						<i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
						<?php esc_html_e( 'Staff\'s login dashboard shows only for selected user roles.', 'staff-manger-lite' ); ?>
					</span>
				</p>
			</div>
			<hr>
			<p class="wprsmp-lite-setup-actions step">
				<button type="submit" class="button-primary button button-large button-next" value="<?php esc_attr_e( "Next", 'staff-manger-lite' ); ?>" name="save_step"><?php esc_html_e( "Next", 'staff-manger-lite' ); ?></button>
			</p>
			<?php wp_nonce_field( 'wprsmp-lite-setup-wizard' ); ?>
		</form>
		<?php
	}

	/** setings save step **/
	public function wprsmp_lite_setup_settings_save() {
		check_admin_referer( 'wprsmp-lite-setup-wizard' );

		$timezone         = isset( $_POST['timezone'] ) ? sanitize_text_field( $_POST['timezone'] ) : 'Asia/Kolkata';
		$date_format      = isset( $_POST['date_format'] ) ? sanitize_text_field( $_POST['date_format'] ) : 'F j Y';
		$time_format      = isset( $_POST['time_format'] ) ? sanitize_text_field( $_POST['time_format'] ) : 'g:i A';
		$monday_status    = isset( $_POST['monday_status'] ) ? sanitize_text_field( $_POST['monday_status'] ) : 'Working';
		$tuesday_status   = isset( $_POST['tuesday_status'] ) ? sanitize_text_field( $_POST['tuesday_status'] ) : 'Working';
		$wednesday_status = isset( $_POST['wednesday_status'] ) ? sanitize_text_field( $_POST['wednesday_status'] ) : 'Working';
		$thursday_status  = isset( $_POST['thursday_status'] ) ? sanitize_text_field( $_POST['thursday_status'] ) : 'Working';
		$friday_status    = isset( $_POST['friday_status'] ) ? sanitize_text_field( $_POST['friday_status'] ) : 'Working';
		$saturday_status  = isset( $_POST['saturday_status'] ) ? sanitize_text_field( $_POST['saturday_status'] ) : 'Working';
		$sunday_status    = isset( $_POST['sunday_status'] ) ? sanitize_text_field( $_POST['sunday_status'] ) : 'Off';
		$halfday_start    = isset( $_POST['halfday_start'] ) ? sanitize_text_field( $_POST['halfday_start'] ) : '';
		$halfday_end      = isset( $_POST['halfday_end'] ) ? sanitize_text_field( $_POST['halfday_end'] ) : '';
		$lunch_start      = isset( $_POST['lunch_start'] ) ? sanitize_text_field( $_POST['lunch_start'] ) : '';
		$lunch_end        = isset( $_POST['lunch_end'] ) ? sanitize_text_field( $_POST['lunch_end'] ) : '';
		$cur_symbol       = isset( $_POST['currency_symbol'] ) ? sanitize_text_field( $_POST['currency_symbol'] ) : '₹';
		$cur_position     = isset( $_POST['currency_position'] ) ? sanitize_text_field( $_POST['currency_position'] ) : 'Right';
		$salary_method    = isset( $_POST['salary_method'] ) ? sanitize_text_field( $_POST['salary_method'] ) : 'Monthly';
		$lunchtime        = isset( $_POST['lunch_time_status'] ) ? sanitize_text_field( $_POST['lunch_time_status'] ) : 'Include';
		$shoot_mail       = isset( $_POST['shoot_mail'] ) ? sanitize_text_field( $_POST['shoot_mail'] ) : 'Yes';
		$show_holiday     = isset( $_POST['show_holiday'] ) ? sanitize_text_field( $_POST['show_holiday'] ) : 'Yes';
		$show_report      = isset( $_POST['report_submission'] ) ? sanitize_text_field( $_POST['report_submission'] ) : 'Yes';
		$show_notice      = isset( $_POST['show_notice'] ) ? sanitize_text_field( $_POST['show_notice'] ) : 'Yes';
		$late_reson       = isset( $_POST['late_reson'] ) ? sanitize_text_field( $_POST['late_reson'] ) : 'Yes';
		$salary_status    = isset( $_POST['salary_status'] ) ? sanitize_text_field( $_POST['salary_status'] ) : 'Yes';
		$show_projects    = isset( $_POST['show_projects'] ) ? sanitize_text_field( $_POST['show_projects'] ) : 'Yes';
		$mail_logo        = isset( $_POST['mail_logo'] ) ? sanitize_text_field( $_POST['mail_logo'] ) : '';
		$office_in_sub    = isset( $_POST['office_in_sub'] ) ? sanitize_text_field( $_POST['office_in_sub'] ) : esc_html__( 'Login Alert From Employee & HR Management', 'staff-manger-lite' );
		$office_out_sub   = isset( $_POST['office_out_sub'] ) ? sanitize_text_field( $_POST['office_out_sub'] ) : esc_html__( 'Logout Alert From Employee & HR Management', 'staff-manger-lite' );
		$mail_heading     = isset( $_POST['mail_heading'] ) ? sanitize_text_field( $_POST['mail_heading'] ) : esc_html__( 'Staff Login/Logout Details', 'staff-manger-lite' );

		$user_roles = ( isset( $_POST['user_roles'] ) && is_array( $_POST['user_roles'] ) ) ? $_POST['user_roles'] : array('subscriber');
		$user_roles = array_map( 'sanitize_text_field', $user_roles );

		$wprsmp_settings_data = array(
			'timezone'         => $timezone,
            'date_format'      => $date_format,
            'time_format'      => $time_format,
            'monday_status'    => $monday_status,
			'tuesday_status'   => $tuesday_status,
			'wednesday_status' => $wednesday_status,
			'thursday_status'  => $thursday_status,
			'friday_status'    => $friday_status,
			'saturday_status'  => $saturday_status,
			'sunday_status'    => $sunday_status,
            'halfday_start'    => $halfday_start,
            'halfday_end'      => $halfday_end,
            'lunch_start'      => $lunch_start,
            'lunch_end'        => $lunch_end,
            'cur_symbol'       => $cur_symbol,
            'cur_position'     => $cur_position,
            'salary_method'    => $salary_method,
            'lunchtime'        => $lunchtime,
            'shoot_mail'       => $shoot_mail,
            'show_holiday'     => $show_holiday,
            'show_report'      => $show_report,
            'show_notice'      => $show_notice,
            'late_reson'       => $late_reson,
            'salary_status'    => $salary_status,
            'show_projects'    => $show_projects,
            'mail_logo'        => $mail_logo,
            'office_in_sub'    => $office_in_sub,
            'office_out_sub'   => $office_out_sub,
            'mail_heading'     => $mail_heading,
            'user_roles'       => serialize( $user_roles ),
		);

		update_option( 'wprsmp_settings_data', $wprsmp_settings_data );
		wp_safe_redirect( esc_url_raw( $this->get_next_step_link() ) );
		exit;
	}

    /** Final step **/
	public function wprsmp_lite_setup_ready() {
		?>
		<div class="final-setup text-center">
			<h3 class="main-heading text-center">You're ready to start!</h3>
			<h4 class="sub-heading text-center">All configurations are done..!! Now you just need to add your staff into system</h4>
			<a href="<?php echo admin_url( '/admin.php?page=staff-manger-lite-staff/' ); ?>" class="btn btn-success final-step_btn"> Add staff</a>
		</div>
		<?php
	}
}

new WPRSMLite_AdminSetupWizard();
