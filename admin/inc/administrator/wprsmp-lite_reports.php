<?php
defined('ABSPATH') or die();
require_once( WPRSMP_PLUGIN_DIR_PATH . '/admin/inc/helpers/wprsmp-lite-helper.php' );
$staffs = WPRSMPLiteHelperClass::wprsmp_get_staffs_list();
$months = WPRSMPLiteHelperClass::wprsmp_month_filter();
?>
<!-- partial -->
<div class="dark-theme main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                    <i class="fas fa-network-wired"></i>
                </span>
                <?php esc_html_e('Reports', 'staff-manger-lite' ); ?>
            </h3>
            <nav aria-label="breadcrumb" class="report">
                <form method="post" id="report_form" action="">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item" aria-current="page">
                            <select class="form-control" id="report_staff_id" name="report_staff_id">
                                <option value=""><?php esc_html_e('Select Staff member', 'staff-manger-lite' ); ?></option>
                                <?php foreach ( $staffs as $key => $staff ) { ?>
                                    <option value="<?php echo esc_attr( $staff['ID'] ); ?>"><?php echo esc_html( $staff['fullname'] ); ?></option>
                                <?php } ?>
                            </select>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            <select class="form-control" id="report_month" name="report_month">
                                <optgroup label="Select Any Filter ( individual Months )">
                                    <?php foreach ( $months as $key => $month ) { ?>
                                        <option value="<?php echo esc_attr( $key + 1 ); ?>"><?php esc_html_e( $month, 'staff-manger-lite' ); ?></option>
                                    <?php } ?>
                                </optgroup>
				                <optgroup label="Select Any Filter ( Combine Months )">
                                    <option value="14"><?php esc_html_e( 'Previous Three Month', 'staff-manger-lite' );?></option>
                                    <option value="15"><?php esc_html_e( 'Previous Six Month', 'staff-manger-lite' );?></option>
                                    <option value="16"><?php esc_html_e( 'Previous Nine Month', 'staff-manger-lite' );?></option>
                                    <option value="17"><?php esc_html_e( 'Previous One Year', 'staff-manger-lite' );?></option>
                                </optgroup>
                            </select>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            <select class="form-control" id="report_type" name="report_type">
                                <option value="all"><?php esc_html_e( 'All Days', 'staff-manger-lite' ); ?></option>
                                <option value="attend"><?php esc_html_e( 'Only Attend days', 'staff-manger-lite' ); ?></option>
                                <option value="absent"><?php esc_html_e( 'Only Absent Days', 'staff-manger-lite' ); ?></option>
                            </select>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <button type="button" class="btn btn-block btn-lg btn-gradient-primary custom-btn" id="report_form_btn">
                                <i class="fas fa-network-wired"></i> <?php esc_html_e('Generate Report', 'staff-manger-lite'); ?>
                            </button>
                        </li>
                    </ul>
                </form>
            </nav>
        </div>
        <div class="row report_row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card table_card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="table_expand_row">
                                <button class="btn btn-sm btn-gradient-success custom-btn" id="btn-show-all-children" type="button">
                                    <?php esc_html_e( 'Expand All', 'staff-manger-lite' ); ?>
                                </button>
                                <button class="btn btn-sm btn-gradient-danger custom-btn" id="btn-hide-all-children" type="button">
                                    <?php esc_html_e( 'Collapse All', 'staff-manger-lite' ); ?>
                                </button>
                            </div>
                            <table id="report_table" class="table table-striped report_table" cellspacing="0" style="width:100%">
                                <thead>
                                    <tr>
                                        <th><?php esc_html_e( 'Date', 'staff-manger-lite' ); ?></th>
                                        <th><?php esc_html_e( 'Name', 'staff-manger-lite' ); ?></th>
                                        <th><?php esc_html_e( 'Day', 'staff-manger-lite' ); ?></th>
                                        <th><?php esc_html_e( 'Office In', 'staff-manger-lite' ); ?></th>
                                        <th><?php esc_html_e( 'Office Out', 'staff-manger-lite' ); ?></th>
                                        <th><?php esc_html_e( 'Working Hours', 'staff-manger-lite' ); ?></th>
                                        <th><?php esc_html_e( 'IP', 'staff-manger-lite' ); ?></th>
                                        <th class="none"><?php esc_html_e( 'Other Details', 'staff-manger-lite' ); ?></th>
                                    </tr>
                                </thead>
                                <tbody class="report_tbody">
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><?php esc_html_e( 'No data', 'staff-manger-lite' ); ?></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th><?php esc_html_e( 'Date', 'staff-manger-lite' ); ?></th>
                                        <th><?php esc_html_e( 'Name', 'staff-manger-lite' ); ?></th>
                                        <th><?php esc_html_e( 'Day', 'staff-manger-lite' ); ?></th>
                                        <th><?php esc_html_e( 'Office In', 'staff-manger-lite' ); ?></th>
                                        <th><?php esc_html_e( 'Office Out', 'staff-manger-lite' ); ?></th>
                                        <th><?php esc_html_e( 'Working Hours', 'staff-manger-lite' ); ?></th>
                                        <th><?php esc_html_e( 'IP', 'staff-manger-lite' ); ?></th>
                                        <th class="none"><?php esc_html_e( 'Other Details', 'staff-manger-lite' ); ?></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="row" id="download_report_csv">
            <div class="col-lg-6 grid-margin stretch-card" id="report_salary_result"></div>
            <div class="col-lg-6 grid-margin stretch-card" id="csv_form_div">
            </div>
        </div>

        <!-- Edit Report Modal -->
		<div class="modal fade" id="EditReports" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-notify modal-lg modal-info">
		    <div class="modal-content">
		     	<div class="card">
	                <div class="card-body">
	                  <h4 class="card-title"><?php esc_html_e( 'Report Details', 'staff-manger-lite' ); ?></h4>
	                  <form class="forms-sample" method="post" id="edit_report_form">
	                  	<div class="form-group">
	                      <label for="edit_name"><?php esc_html_e( 'Staff Name', 'staff-manger-lite' ); ?></label>
	                      <input type="text" class="form-control" id="edit_name" placeholder="<?php esc_html_e( 'Name', 'staff-manger-lite' ); ?>" readonly>
	                    </div>
	                    <div class="form-group">
                          <label for="edit_date"><?php esc_html_e( 'Date', 'staff-manger-lite' ); ?></label>
                          <input type="text" class="form-control" id="edit_date" placeholder="<?php esc_html_e( 'Name', 'staff-manger-lite' ); ?>" readonly>
                        </div>
                        <div class="form-group">
                  			<label><?php esc_html_e( 'Office IN', 'staff-manger-lite' ); ?></label>
				        	<input type="text" class="form-control datetimepicker-input" placeholder="<?php esc_html_e( 'Format:- 10:00 AM', 'staff-manger-lite' ); ?>" id="edit_office_in" data-toggle="datetimepicker" data-target="#edit_office_in"/>
                        </div>
                        <div class="form-group">
                  			<label><?php esc_html_e( 'Office OUT', 'staff-manger-lite' ); ?></label>
				        	<input type="text" class="form-control datetimepicker-input" placeholder="<?php esc_html_e( 'Format:- 10:00 AM', 'staff-manger-lite' ); ?>" id="edit_office_out" data-toggle="datetimepicker" data-target="#edit_office_out"/>
                        </div>
                        <div class="form-group">
                  			<label><?php esc_html_e( 'Lunch IN', 'staff-manger-lite' ); ?></label>
				        	<input type="text" class="form-control datetimepicker-input" placeholder="<?php esc_html_e( 'Format:- 10:00 AM', 'staff-manger-lite' ); ?>" id="edit_lunch_in" data-toggle="datetimepicker" data-target="#edit_lunch_in"/>
                        </div>
                        <div class="form-group">
                  			<label><?php esc_html_e( 'Lunch OUT', 'staff-manger-lite' ); ?></label>
				        	<input type="text" class="form-control datetimepicker-input" placeholder="<?php esc_html_e( 'Format:- 10:00 AM', 'staff-manger-lite' ); ?>" id="edit_lunch_out" data-toggle="datetimepicker" data-target="#edit_lunch_out"/>
                  		</div>
                        <div class="form-group">
	                      	<label for="edit_report_punctual"><?php esc_html_e( 'Punctuality', 'staff-manger-lite' ); ?></label>
	                      	<select name="edit_report_punctual" id="edit_report_punctual" class="form-control">
	                      		<option value="Late"><?php esc_html_e( 'Late', 'staff-manger-lite' ); ?></option>
	                      		<option value="On Time"><?php esc_html_e( 'On Time', 'staff-manger-lite' ); ?></option>
	                      	</select>
                        </div>
                        <div class="form-group">
                  			<label><?php esc_html_e( 'Working Hours', 'staff-manger-lite' ); ?></label>
				        	<input type="text" class="form-control"  id="edit_working_hours" />
                  		</div>
                        <div class="form-group">
                          <label for="edit_late"><?php esc_html_e( 'Late Reason', 'staff-manger-lite' ); ?></label>
	                      <textarea class="form-control" rows="4" id="edit_late" name="edit_late" placeholder="<?php esc_html_e( 'Description....', 'staff-manger-lite' ); ?>"></textarea>
                        </div>
                        <div class="form-group">
                          <label for="edit_work"><?php esc_html_e( 'Daily Work Report', 'staff-manger-lite' ); ?></label>
	                      <textarea class="form-control" rows="4" id="edit_work" name="edit_work" placeholder="<?php esc_html_e( 'Description....', 'staff-manger-lite' ); ?>"></textarea>
                        </div>
                        <input type="hidden" name="report_key" id="report_key" value="">
                        <input type="hidden" name="edit_staff_id" id="edit_staff_id" value="">
                        <input type="button" class="btn btn-gradient-primary mr-2" id="edit_report_btn" value="<?php esc_html_e( 'Submit', 'staff-manger-lite' ); ?>">
	                  </form>
	                </div>
	            </div>
		    </div>
		  </div>
        </div>
        
    </div>
</div>