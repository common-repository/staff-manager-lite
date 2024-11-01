<?php
defined( 'ABSPATH' ) or die();
require_once( WPRSMP_PLUGIN_DIR_PATH . '/admin/inc/helpers/wprsmp-lite-helper.php' );
require_once( WPRSMP_PLUGIN_DIR_PATH . '/admin/WPRSMP_MENU.php' );
$all_staffs    = get_option( 'wprsmp_staffs_data' );
$save_settings = get_option( 'wprsmp_settings_data' );

WPRSMP_AdminMenu::enqueue_chart_assets();
?>
<!-- partial -->
<div class="dark-theme main-panel main-dashboard">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
          <i class="fas fa-home"></i>                 
        </span>
        <?php esc_html_e( 'Dashboard', 'staff-manger-lite' ); ?>
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
    <div class="row">
      <div class="col-md-3 stretch-card grid-margin">
        <div class="card bg-gradient-blue card-img-holder text-white">
          <div class="card-body">
            <img src="<?php echo WPRSMP_PLUGIN_URL; ?>assets/images/circle.svg" class="card-img-absolute" alt="circle-image" />
            <div class="row">
              <div class="col-md-9">
                <h4 class="font-weight-normal mb-3"><?php echo esc_html( WPRSMPLiteHelperClass::staff_greeting_status() ); ?></h4>
                <h2 class="mb-5"><?php echo esc_html( WPRSMPLiteHelperClass::get_current_user_data( get_current_user_id(), 'fullname') ); ?></h2>
              </div>
              <div class="col-md-1 gravtar_wprsmp">
                <?php echo wp_kses_post( get_avatar( WPRSMPLiteHelperClass::get_current_user_data( get_current_user_id(), 'user_email'), 70) ); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3 stretch-card grid-margin">
        <div class="card bg-gradient-danger card-img-holder text-white">
          <div class="card-body">
            <img src="<?php echo WPRSMP_PLUGIN_URL; ?>assets/images/circle.svg" class="card-img-absolute" alt="circle-image"/>                  
            <h4 class="font-weight-normal mb-3"><?php esc_html_e( 'Pending Leaves', 'staff-manger-lite' ); ?>
              <i class="mdi mdi-airballoon mdi-24px float-right"></i>
            </h4>
            <?php echo wp_kses_post( WPRSMPLiteHelperClass::get_pending_requests() ); ?>
          </div>
        </div>
      </div>
      <div class="col-md-3 stretch-card grid-margin">
        <div class="card bg-gradient-new-success card-img-holder text-white">
          <div class="card-body">
            <img src="<?php echo WPRSMP_PLUGIN_URL; ?>assets/images/circle.svg" class="card-img-absolute" alt="circle-image"/>                                    
            <h4 class="font-weight-normal mb-3"><?php esc_html_e( 'Shifts', 'staff-manger-lite' ); ?>
              <i class="mdi mdi-mouse-variant mdi-24px float-right"></i>
            </h4>
            <?php echo wp_kses_post( WPRSMPLiteHelperClass::get_total_shifts() ); ?>
          </div>
        </div>
      </div>
      <div class="col-md-3 stretch-card grid-margin">
        <div class="card bg-gradient-new-primary card-img-holder text-white">
          <div class="card-body">
            <img src="<?php echo WPRSMP_PLUGIN_URL; ?>assets/images/circle.svg" class="card-img-absolute" alt="circle-image"/>                                    
            <h4 class="font-weight-normal mb-3"><?php esc_html_e( 'Staffs', 'staff-manger-lite' ); ?>
              <i class="mdi mdi-human-greeting mdi-24px float-right"></i>
            </h4>
            <?php echo wp_kses_post( WPRSMPLiteHelperClass::get_total_satffs() ); ?>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-12 stretch-card grid-margin chart-card task_status">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title"><?php esc_html_e( 'Task Status', 'staff-manger-lite' ); ?></h4>
            <canvas id="Task_status" width="400" height="400"></canvas>
            <h5 class="text-center"><?php esc_html_e( 'Records', 'staff-manger-lite' ); ?></h5>
            <?php $task_status = WPRSMPLiteHelperClass::all_task_status(); ?>
            <ul class="list-style-none mb-0">
                <li>
                    <i class="fas fa-circle text-primary font-10 mr-2"></i>
                    <span class="text-muted"><?php esc_html_e( 'No Progress Task', 'staff-manger-lite' ); ?></span>
                    <span class="text-dark float-right font-weight-medium"><?php echo $task_status[0]; ?></span>
                </li>
                <li class="mt-3">
                    <i class="fas fa-circle text-danger font-10 mr-2"></i>
                    <span class="text-muted"><?php esc_html_e( 'In Progress Task', 'staff-manger-lite' ); ?></span>
                    <span class="text-dark float-right font-weight-medium"><?php echo $task_status[1]; ?></span>
                </li>
                <li class="mt-3">
                    <i class="fas fa-circle text-cyan font-10 mr-2"></i>
                    <span class="text-muted"><?php esc_html_e( 'Completed Task', 'staff-manger-lite' ); ?></span>
                    <span class="text-dark float-right font-weight-medium"><?php echo $task_status[2]; ?></span>
                </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-lg-8 col-md-12 stretch-card grid-margin chart-card all-main-task-list">
        <div class="card">
          <div class="card-body">
            <div class="au-card-title" style="background-image:url('<?php echo WPRSMP_PLUGIN_URL; ?>assets/images/bg-title-01.jpg');">
              <div class="bg-overlay bg-overlay--blue"></div>
              <h4 class="card-title"><?php esc_html_e( 'All Tasks', 'staff-manger-lite' ); ?></h4>
            </div>
            <div class="main-all-tasks">
              <div class="au-task-list js-scrollbar3">
                <?php echo WPRSMPLiteHelperClass::get_all_tasks(); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  
    <div class="row dashboard_status_table">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title"><?php esc_html_e( 'Staff\'s Live Status', 'staff-manger-lite' ); ?></h4>
            <div class="table-responsive">
              <table class="table table-striped dash_table" id="admin_dash_table" cellspacing="0" style="width:100%">
                <thead>
                  <tr>
                    <th><?php esc_html_e( 'No.', 'staff-manger-lite' ); ?></th>
                    <th><?php esc_html_e( 'Name', 'staff-manger-lite' ); ?></th>
                    <th><?php esc_html_e( 'Office In', 'staff-manger-lite' ); ?></th>
                    <th><?php esc_html_e( 'Office Out', 'staff-manger-lite' ); ?></th>
                    <th><?php esc_html_e( 'Lunch In', 'staff-manger-lite' ); ?></th>
                    <th><?php esc_html_e( 'Lunch Out', 'staff-manger-lite' ); ?></th>
                    <th><?php esc_html_e( 'Working Hour\'s', 'staff-manger-lite' ); ?></th>
                    <th><?php esc_html_e( 'Puntuality', 'staff-manger-lite' ); ?></th>
                    <th><?php esc_html_e( 'IP Address', 'staff-manger-lite' ); ?></th>
                    <th class="none"><?php esc_html_e( 'Location', 'staff-manger-lite' ); ?></th>
                    <th><?php esc_html_e( 'Status', 'staff-manger-lite' ); ?></th>
                    <th><?php esc_html_e( 'Action', 'staff-manger-lite' ); ?></th>
                  </tr>
                </thead>
                <tbody id="staff_tbody">
                  <?php 
                    if ( ! empty ( $all_staffs ) ) {
                      $sno = 1;
                      foreach ( $all_staffs as $key => $staff ) {
                  ?>
                    <tr>
                      <td><?php echo esc_html( $sno ); ?>.</td>
                        <td><?php echo esc_html( $staff['fullname'] ); ?></td>
                        <?php if ( ! empty ( WPRSMPLiteHelperClass::wprsmp_staff_today_status( $staff['ID'] ) ) ) {
                          echo wp_kses_post( WPRSMPLiteHelperClass::wprsmp_staff_today_status( $staff['ID'] ) ); 
                        } else { ?>
                          <td>---</td>
                          <td>---</td>
                          <td>---</td>
                          <td>---</td>
                          <td>---</td>
                          <td>---</td>
                          <td>---</td>
                          <td class="none">---</td>
                          <td>---</td>
                        <?php } ?>
                        <td class="designation-action-tools">
                          <ul class="designation-action-tools-ul">
                            <?php if ( empty ( WPRSMPLiteHelperClass::wprsmp_staff_today_status( $staff['ID'] ) ) ) { ?>
                            <li class="designation-action-tools-li">
                              <a href="#" class="designation-action-tools-a admin-staff-edit-a" title="Login" data-value="office-in" data-staff="<?php echo esc_attr( $staff['ID'] ); ?>" data-timezone="<?php echo esc_attr( WPRSMPLiteHelperClass::get_setting_timezone() ); ?>" id="dashboard_login">
                                <i class="mdi mdi-login"></i> <?php esc_html_e( 'Login', 'employee-&-hr-management' ); ?>
                              </a>
                            </li>
                            <?php } else { ?>
                            <li class="designation-action-tools-li">
                              <a href="#" class="designation-action-tools-a admin-staff-delete-a" title="Logout" data-value="office-out" data-staff="<?php echo esc_attr( $staff['ID'] ); ?>" data-timezone="<?php echo esc_attr( WPRSMPLiteHelperClass::get_setting_timezone() ); ?>" id="dashboard_logout">
                                <i class="mdi mdi-logout"></i><?php esc_html_e( 'Logout', 'employee-&-hr-management' ); ?>
                              </a>
                            </li>
                            <?php } ?>
                          </ul>
                        </td>
                    </tr>
                  <?php $sno++; } } else { ?>
                    <tr>
                      <td><?php esc_html_e( 'No Staff added yet.!', 'employee-&-hr-management' ); ?></td>
                    </tr>
                  <?php } ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th><?php esc_html_e( 'No.', 'staff-manger-lite' ); ?></th>
                    <th><?php esc_html_e( 'Name', 'staff-manger-lite' ); ?></th>
                    <th><?php esc_html_e( 'Office In', 'staff-manger-lite' ); ?></th>
                    <th><?php esc_html_e( 'Office Out', 'staff-manger-lite' ); ?></th>
                    <th><?php esc_html_e( 'Lunch In', 'staff-manger-lite' ); ?></th>
                    <th><?php esc_html_e( 'Lunch Out', 'staff-manger-lite' ); ?></th>
                    <th><?php esc_html_e( 'Working Hour\'s', 'staff-manger-lite' ); ?></th>
                    <th><?php esc_html_e( 'Puntuality', 'staff-manger-lite' ); ?></th>
                    <th><?php esc_html_e( 'IP Address', 'staff-manger-lite' ); ?></th>
                    <th class="none"><?php esc_html_e( 'Location', 'staff-manger-lite' ); ?></th>
                    <th><?php esc_html_e( 'Status', 'staff-manger-lite' ); ?></th>
                    <th><?php esc_html_e( 'Action', 'staff-manger-lite' ); ?></th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="dark-theme detail-panel extra-data-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-lg-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="au-card-title" style="background-image:url('<?php echo WPRSMP_PLUGIN_URL; ?>assets/images/bg-title-01.jpg');">
              <div class="bg-overlay bg-overlay--blue"></div>
              <h4 class="card-title"><?php esc_html_e( 'Notice\'s', 'staff-manger-lite' ); ?></h4>
            </div>
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th><?php esc_html_e( 'Title', 'staff-manger-lite' ); ?></th>
                    <th><?php esc_html_e( 'Description', 'staff-manger-lite' ); ?></th>
                  </tr>
                </thead>
                <tbody>
                  <?php echo wp_kses_post( WPRSMPLiteHelperClass::wprsmp_display_notices() ); ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="au-card-title" style="background-image:url('<?php echo WPRSMP_PLUGIN_URL; ?>assets/images/bg-title-01.jpg');">
              <div class="bg-overlay bg-overlay--blue"></div>
              <h4 class="card-title"><?php esc_html_e( 'Upcoming Event\'s', 'staff-manger-lite' ); ?></h4>
            </div>
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th><?php esc_html_e( 'Title', 'staff-manger-lite' ); ?></th>
                    <th><?php esc_html_e( 'Date', 'staff-manger-lite' ); ?></th>
                  </tr>
                </thead>
                <tbody>
                  <?php echo wp_kses_post( WPRSMPLiteHelperClass::wprsmp_display_events() ); ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="au-card-title" style="background-image:url('<?php echo WPRSMP_PLUGIN_URL; ?>assets/images/bg-title-01.jpg');">
              <div class="bg-overlay bg-overlay--blue"></div>
              <h4 class="card-title"><?php esc_html_e( 'Upcoming Holiday\'s', 'staff-manger-lite' ); ?></h4>
            </div>
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th><?php esc_html_e( 'Name', 'staff-manger-lite' ); ?></th>
                    <th><?php esc_html_e( 'Date', 'staff-manger-lite' ); ?></th>
                    <th><?php esc_html_e( 'Days', 'staff-manger-lite' ); ?></th>
                  </tr>
                </thead>
                <tbody>
                  <?php echo wp_kses_post( WPRSMPLiteHelperClass::wprsmp_display_holidays() ); ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>