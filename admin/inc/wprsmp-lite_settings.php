<?php
defined('ABSPATH') or die();
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
$office_in_sub    = isset( $save_settings['office_in_sub'] ) ? sanitize_text_field( $save_settings['office_in_sub'] ) : __( 'Login Alert From Employee & HR Management', 'staff-manger-lite' );
$office_out_sub = isset( $save_settings['office_out_sub'] ) ? sanitize_text_field( $save_settings['office_out_sub'] ) : __( 'Logout Alert From Employee & HR Management', 'staff-manger-lite' );
$mail_heading   = isset( $save_settings['mail_heading'] ) ? sanitize_text_field( $save_settings['mail_heading'] ) : __( 'Staff Login/Logout Details', 'staff-manger-lite' );
?>
<!-- partial -->
<div class="dark-theme main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
          <i class="fas fa-sliders-h"></i>
        </span>
        <?php esc_html_e( 'Settings', 'staff-manger-lite' ); ?>
      </h3>
      <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">
            <span></span><?php esc_html_e( 'Overview', 'staff-manger-lite' ); ?>
            <i class="fas fa-exclamation-circle icon-sm text-primary align-middle"></i>
          </li>
        </ul>
      </nav>
    </div>
    <div class="row settings_panel">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">

            <!----- General settings ------>
            <h4 class="card-title bg-gradient-primary"><?php esc_html_e('General settings', 'staff-manger-lite'); ?></h4>
            <form class="form-sample" id="wprsmp-lite-settings-form" method="post" action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>">
              <?php $nonce = wp_create_nonce('wprsmp_lite_save_settings'); ?>
              <input type="hidden" name="wprsmp_lite_setting_options" value="<?php echo esc_attr( $nonce ); ?>">
              <input type="hidden" name="action" value="wprsmp-lite-settings">
              <div class="row">
                <div class="col-lg-4 col-md-12">
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label"><?php esc_html_e( 'TimeZone', 'staff-manger-lite' ); ?></label>
                    <div class="col-sm-8">
                      <select class="form-control" id="timezone" name="timezone">
                        <option value=""><?php esc_html_e('----------------------------------------------------------Select timezone----------------------------------------------------------', 'staff-manger-lite'); ?></option>
                        <?php foreach ( $timezone_list as $timezone ) { ?>
                          <option value="<?php echo esc_attr( $timezone ); ?>" <?php selected( $TimeZone, $timezone ); ?>><?php echo esc_html( $timezone ); ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-12">
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label"><?php esc_html_e('Date Format', 'staff-manger-lite'); ?></label>
                    <div class="col-sm-8">
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
                <div class="col-lg-4 col-md-12">
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label"><?php esc_html_e('Time Format', 'staff-manger-lite'); ?></label>
                    <div class="col-sm-8">
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
              <div class="row">
                <div class="col-lg-4 col-md-12">
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label"><?php esc_html_e( 'Halfday Start Time', 'staff-manger-lite' ); ?></label>
                    <div class="col-sm-8 bootstrap-timepicker timepicker">
                      <input type="text" name="halfday_start" id="halfday_start" class="form-control custom-timepicker-input" placeholder="<?php esc_html_e( 'Format:- 10:00 AM', 'staff-manger-lite' ); ?>" value="<?php echo esc_attr( $halfday_start ); ?>">
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-12">
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label"><?php esc_html_e('Lunch Start Time', 'staff-manger-lite'); ?></label>
                    <div class="col-sm-8 bootstrap-timepicker timepicker">
                      <input type="text" name="lunch_start" id="lunch_start" class="form-control custom-timepicker-input" placeholder="<?php esc_html_e('Format:- 02:00 PM', 'staff-manger-lite'); ?>" data-toggle="datetimepicker" data-target="#lunch_start" value="<?php echo esc_attr($lunch_start); ?>">
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-12">
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label"><?php esc_html_e( 'Currency Symbol', 'staff-manger-lite' ); ?></label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" placeholder="$" id="currency_symbol" name="currency_symbol" value="<?php echo esc_attr( $cur_symbol ); ?>">
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-4 col-md-12">
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label"><?php esc_html_e('Halfday End Time', 'staff-manger-lite'); ?></label>
                    <div class="col-sm-8 bootstrap-timepicker timepicker">
                      <input type="text" name="halfday_end" id="halfday_end" class="form-control custom-timepicker-input" placeholder="<?php esc_html_e('Format:- 03:00 PM', 'staff-manger-lite'); ?>" data-toggle="datetimepicker" data-target="#halfday_end" value="<?php echo esc_attr($halfday_end); ?>">
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-12">
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label"><?php esc_html_e('Lunch End Time', 'staff-manger-lite'); ?></label>
                    <div class="col-sm-8 bootstrap-timepicker timepicker">
                      <input type="text" name="lunch_end" id="lunch_end" class="form-control custom-timepicker-input" placeholder="<?php esc_html_e('Format:- 02:30 PM', 'staff-manger-lite'); ?>" data-toggle="datetimepicker" data-target="#lunch_end" value="<?php echo esc_attr($lunch_end); ?>">
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-12">
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label"><?php esc_html_e( 'Currency Position', 'staff-manger-lite' ); ?></label>
                    <div class="col-sm-8">
                      <select class="form-control" id="currency_position" name="currency_position">
                        <option value="Right" <?php selected( $cur_position, 'Right' ); ?>><?php esc_html_e( 'Right', 'staff-manger-lite' ); ?></option>
                        <option value="Left" <?php selected( $cur_position, 'Left' ); ?>><?php esc_html_e( 'Left', 'staff-manger-lite' ); ?></option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">   
                <div class="col-lg-6 col-md-12">
                  <div class="form-group row">
                    <label class="col-sm-6 col-form-label"><?php esc_html_e( 'Salary paid by', 'staff-manger-lite' ); ?></label>
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
                <div class="col-lg-6 col-md-12">
                  <div class="form-group row">
                    <label class="col-sm-6 col-form-label"><?php esc_html_e('Include/Exclude Lunch time from Working Hours', 'staff-manger-lite'); ?></label>
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
              <h4 class="card-title bg-gradient-primary"><?php esc_html_e( 'Week days status', 'staff-manger-lite'); ?></h4>
              <div class="row">   
                <div class="col-lg-4 col-md-12">
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label"><?php esc_html_e( 'Monday', 'staff-manger-lite'); ?></label>
                    <div class="col-sm-8">
                      <select class="form-control" id="monday_status" name="monday_status">
                        <option value="Working" <?php selected( $monday_status, 'Working' ); ?>><?php esc_html_e( 'Working', 'staff-manger-lite' ); ?></option>
                        <option value="Half Day" <?php selected( $monday_status, 'Half Day' ); ?>><?php esc_html_e( 'Half Day', 'staff-manger-lite' ); ?></option>
                        <option value="Off" <?php selected( $monday_status, 'Off' ); ?>><?php esc_html_e( 'Off', 'staff-manger-lite' ); ?></option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-12">
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label"><?php esc_html_e( 'Tuesday', 'staff-manger-lite'); ?></label>
                    <div class="col-sm-8">
                      <select class="form-control" id="tuesday_status" name="tuesday_status">
                        <option value="Working" <?php selected( $tuesday_status, 'Working' ); ?>><?php esc_html_e( 'Working', 'staff-manger-lite' ); ?></option>
                        <option value="Half Day" <?php selected( $tuesday_status, 'Half Day' ); ?>><?php esc_html_e( 'Half Day', 'staff-manger-lite' ); ?></option>
                        <option value="Off" <?php selected( $tuesday_status, 'Off' ); ?>><?php esc_html_e( 'Off', 'staff-manger-lite' ); ?></option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-12">
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
                <div class="col-lg-4 col-md-12">
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
                <div class="col-lg-4 col-md-12">
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
                <div class="col-lg-4 col-md-12">
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
                <div class="col-lg-4 col-md-12">
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
              <!----- Staff's settings ------>
              <h4 class="card-title bg-gradient-primary"><?php esc_html_e('Staff\'s settings', 'staff-manger-lite'); ?></h4>
              <div class="row">
                <div class="col-lg-4 col-md-12">
                  <div class="form-group row">
                    <label class="col-sm-6 col-form-label"><?php esc_html_e('Show Holidays', 'staff-manger-lite'); ?></label>
                    <div class="col-sm-3">
                      <div class="form-check form-check-success">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="show_holiday" value="Yes" checked="" <?php checked($show_holiday, 'Yes'); ?>>
                          <?php esc_html_e('Yes', 'staff-manger-lite'); ?>
                          <i class="input-helper"></i></label>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-check form-check-danger">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="show_holiday" value="No" <?php checked($show_holiday, 'No'); ?>>
                          <?php esc_html_e('No', 'staff-manger-lite'); ?>
                          <i class="input-helper"></i></label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-12">
                  <div class="form-group row">
                    <label class="col-sm-6 col-form-label"><?php esc_html_e('Enable Report Submission', 'staff-manger-lite'); ?></label>
                    <div class="col-sm-3">
                      <div class="form-check form-check-success">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="report_submission" value="Yes" checked="" <?php checked($show_report, 'Yes'); ?>>
                          <?php esc_html_e('Yes', 'staff-manger-lite'); ?>
                          <i class="input-helper"></i></label>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-check form-check-danger">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="report_submission" value="No" <?php checked($show_report, 'No'); ?>>
                          <?php esc_html_e('No', 'staff-manger-lite'); ?>
                          <i class="input-helper"></i></label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-12">
                  <div class="form-group row">
                    <label class="col-sm-6 col-form-label"><?php esc_html_e('Show Notice', 'staff-manger-lite'); ?></label>
                    <div class="col-sm-3">
                      <div class="form-check form-check-success">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="show_notice" value="Yes" checked="" <?php checked($show_notice, 'Yes'); ?>>
                          <?php esc_html_e('Yes', 'staff-manger-lite'); ?>
                          <i class="input-helper"></i></label>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-check form-check-danger">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="show_notice" value="No" <?php checked($show_notice, 'No'); ?>>
                          <?php esc_html_e('No', 'staff-manger-lite'); ?>
                          <i class="input-helper"></i></label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-4 col-md-12">
                  <div class="form-group row">
                    <label class="col-sm-6 col-form-label"><?php esc_html_e('Enable Late Reason Submission', 'staff-manger-lite'); ?></label>
                    <div class="col-sm-3">
                      <div class="form-check form-check-success">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="late_reson" value="Yes" checked="" <?php checked($late_reson, 'Yes'); ?>>
                          <?php esc_html_e('Yes', 'staff-manger-lite'); ?>
                          <i class="input-helper"></i></label>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-check form-check-danger">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="late_reson" value="No" <?php checked($late_reson, 'No'); ?>>
                          <?php esc_html_e('No', 'staff-manger-lite'); ?>
                          <i class="input-helper"></i></label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-12">
                  <div class="form-group row">
                    <label class="col-sm-6 col-form-label"><?php esc_html_e('Show Salary Status', 'staff-manger-lite'); ?></label>
                    <div class="col-sm-3">
                      <div class="form-check form-check-success">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="salary_status" value="Yes" checked="" <?php checked($salary_status, 'Yes'); ?>>
                          <?php esc_html_e('Yes', 'staff-manger-lite'); ?>
                          <i class="input-helper"></i></label>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-check form-check-danger">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="salary_status" value="No" <?php checked($salary_status, 'No'); ?>>
                          <?php esc_html_e('No', 'staff-manger-lite'); ?>
                          <i class="input-helper"></i></label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-12">
                  <div class="form-group row">
                    <label class="col-sm-6 col-form-label"><?php esc_html_e('Show Projects', 'staff-manger-lite'); ?></label>
                    <div class="col-sm-3">
                      <div class="form-check form-check-success">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="show_projects" value="Yes" checked="" <?php checked($show_projects, 'Yes'); ?>>
                          <?php esc_html_e('Yes', 'staff-manger-lite'); ?>
                          <i class="input-helper"></i></label>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-check form-check-danger">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="show_projects" value="No" <?php checked($show_projects, 'No'); ?>>
                          <?php esc_html_e('No', 'staff-manger-lite'); ?>
                          <i class="input-helper"></i></label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6 col-md-12">
                  <div class="form-group row">
                    <label class="col-sm-12 col-form-label"><?php esc_html_e('Select roles for staff\'s.', 'staff-manger-lite'); ?></label>
                    <?php 
                        if ( ! empty( $save_settings['user_roles'] ) ) {
                          $user_roles = unserialize( $save_settings['user_roles'] );
                        } else {
                          $user_roles = array('subscriber');
                        }
                        global $wp_roles;
                        $all_roles = $wp_roles->roles;
                        foreach ( $all_roles as $key => $value ) {
                          if ( $value["name"] != 'Administrator' ) {
                      ?>
                      <div class="col-sm-3">
                        <div class="form-check form-check-success">
                          <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" <?php if ( is_array( $user_roles ) ) { if ( in_array( strtolower( $value["name"] ), $user_roles ) ) { echo 'checked'; } } ?> name="user_roles[]" value="<?php echo esc_attr( strtolower( $value["name"] ) ); ?>">
                            <?php esc_html_e( $value["name"], 'staff-manger-lite' ); ?>
                            <i class="input-helper"></i></label>
                        </div>
                      </div>
                      <?php } } ?>
                    <br>
                    <span class="option-info-text">
                      <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                      <?php esc_html_e( 'Staff\'s login dashboard shows only for selected user roles.', 'staff-manger-lite' ); ?>
                    </span>
                  </div>
                </div>
              </div>

              <!----- Email settings ------>
              <h4 class="card-title bg-gradient-primary"><?php esc_html_e( 'Email Settings', 'staff-manger-lite' ); ?></h4>
              <div class="row">
                <div class="col-lg-6 col-md-12">
                  <div class="form-group row">
                    <label class="col-sm-6 col-form-label"><?php esc_html_e('Shoot Mail when user Login/Logout', 'staff-manger-lite'); ?></label>
                    <div class="col-sm-3">
                      <div class="form-check form-check-success">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="shoot_mail" value="Yes" checked="" <?php checked($shoot_mail, 'Yes'); ?>>
                          <?php esc_html_e('Yes', 'staff-manger-lite'); ?>
                          <i class="input-helper"></i></label>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-check form-check-danger">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="shoot_mail" value="No" <?php checked($shoot_mail, 'No'); ?>>
                          <?php esc_html_e('No', 'staff-manger-lite'); ?>
                          <i class="input-helper"></i></label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 col-md-12">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">
                      <?php esc_html_e( 'Your logo for mail', 'staff-manger-lite' ); ?>
                    </label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" name="mail_logo" id="mail_logo" value="<?php if ( ! empty ( $mail_logo ) ) { echo esc_attr( $mail_logo ); } ?>">
                    </div>
                    <div class="col-sm-3">
                      <button type="button" class="btn btn-gradient-success mr-2" id="upload_logo">
                        <?php esc_html_e( 'Upload', 'staff-manger-lite' ); ?>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6 col-md-12">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?php esc_html_e( 'Notification Mail Subject ( Office in )', 'staff-manger-lite' ); ?></label>
                    <div class="col-sm-9">
                      <textarea class="form-control" name="office_in_sub" id="office_in_sub"><?php if ( ! empty ( $office_in_sub ) ) { echo esc_html( $office_in_sub ); } ?></textarea>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 col-md-12">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?php esc_html_e( 'Notification Mail Subject ( Office out )', 'staff-manger-lite' ); ?></label>
                    <div class="col-sm-9">
                      <textarea class="form-control" name="office_out_sub" id="office_out_sub"><?php if ( ! empty ( $office_out_sub ) ) { echo esc_html( $office_out_sub ); } ?></textarea>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6 col-md-12">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?php esc_html_e( 'Heading for mail content', 'staff-manger-lite' ); ?></label>
                    <div class="col-sm-9">
                      <textarea class="form-control" name="mail_heading" id="mail_heading"><?php if ( ! empty ( $mail_heading ) ) { echo esc_html( $mail_heading ); } ?></textarea>
                    </div>
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-gradient-success mr-2" id="save-settings-btn">
                <?php esc_html_e( 'Save Changes', 'staff-manger-lite' ); ?>
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>