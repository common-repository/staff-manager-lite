<?php
defined( 'ABSPATH' ) or die();
require_once( WPRSMP_PLUGIN_DIR_PATH . '/admin/inc/helpers/wprsmp-lite-helper.php' );
$all_shifts = get_option( 'wprsmp_shifts_data' );
?>
<!-- partial -->
<div class="dark-theme main-panel">
  	<div class="content-wrapper">
	    <div class="page-header">
	      	<h3 class="page-title">
	        	<span class="page-title-icon bg-gradient-primary text-white mr-2">
				<i class="fas fa-business-time"></i>                
	        	</span>
	        	<?php esc_html_e( 'Shifts', 'staff-manger-lite' ); ?>
	      	</h3>
	      	<nav aria-label="breadcrumb">
	        	<ul class="breadcrumb">
		          	<li class="breadcrumb-item active" aria-current="page">
		            	<button class="btn btn-block btn-lg btn-gradient-primary custom-btn" data-toggle="modal" data-target="#AddShift">
						<i class="fas fa-plus"></i> <?php esc_html_e( 'Add Shift', 'staff-manger-lite' ); ?></button>
		          	</li>
	        	</ul>
	      	</nav>
	    </div>
	    <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              	<div class="card table_card">
                	<div class="card-body">
                		<div class="table-responsive">
		                  	<h4 class="card-title"><?php esc_html_e( 'Shifts', 'staff-manger-lite' ); ?></h4>
		                  	<table class="table table-striped shifts_table">
		                    	<thead>
			                      	<tr>
				                        <th><?php esc_html_e( 'No.', 'staff-manger-lite' ); ?></th>
			                        	<th><?php esc_html_e( 'Name', 'staff-manger-lite' ); ?></th>
			                        	<th><?php esc_html_e( 'Start time', 'staff-manger-lite' ); ?></th>
			                        	<th><?php esc_html_e( 'Ending time', 'staff-manger-lite' ); ?></th>
			                        	<th><?php esc_html_e( 'Late time', 'staff-manger-lite' ); ?></th>
			                        	<th><?php esc_html_e( 'Status', 'staff-manger-lite' ); ?></th>
			                        	<th><?php esc_html_e( 'Action', 'staff-manger-lite' ); ?></th>
			                     	</tr>
		                    	</thead>
		                    	<tbody id="shift_tbody">
				                    <?php 
				                    	if ( ! empty ( $all_shifts ) ) {
		                        		$sno = 1;
		                        		foreach ( $all_shifts as $key => $shift ) {
											if ( $sno < 3 ) {
		                        	?>
			                        <tr>
			                        	<td><?php if( ! empty ( $sno ) ) { echo esc_html( $sno ); } ?>.</td>
			                          	<td><?php if( ! empty ( $shift['name'] ) ) { echo esc_html( $shift['name'] ); } ?></td>
			                          	<td><?php if( ! empty ( $shift['start'] ) ) { echo esc_html( date( WPRSMPLiteHelperClass::get_time_format(), strtotime( $shift['start'] ) ) ); } ?></td>
			                          	<td><?php if( ! empty ( $shift['end'] ) ) { echo esc_html( date( WPRSMPLiteHelperClass::get_time_format(), strtotime( $shift['end'] ) ) ); } ?></td>
			                          	<td><?php if( ! empty ( $shift['late'] ) ) { echo esc_html( date( WPRSMPLiteHelperClass::get_time_format(), strtotime( $shift['late'] ) ) ); } ?></td>
			                          	<td><?php if( ! empty ( $shift['status'] ) ) { echo esc_html( $shift['status'] ); } ?></td>
			                          	<td class="designation-action-tools">
			                          		<ul class="designation-action-tools-ul">
			                          			<li class="designation-action-tools-li">
			                          				<a href="#" class="designation-action-tools-a shift-edit-a" data-shift="<?php echo esc_attr( $key ); ?>">
			                          					<i class="fas fa-pencil-alt"></i>
			                          				</a>
			                          			</li>
			                          			<li class="designation-action-tools-li">
			                          				<a href="#" class="designation-action-tools-a shift-delete-a" data-shift="<?php echo esc_attr( $key ); ?>">
			                          					<i class="far fa-window-close"></i>
			                          				</a>
			                          			</li>
			                          		</ul>
			                          	</td>
			                        </tr>
				                    <?php $sno++; } } } else { ?>
				                    <tr>
				                    	<td><?php esc_html_e( 'No Shift added yet.!', 'staff-manger-lite' ); ?></td>
				                    </tr>
				                    <?php } ?>
		                    	</tbody>
		                    	<tfoot>
			                      	<tr>
				                        <th><?php esc_html_e( 'No.', 'staff-manger-lite' ); ?></th>
			                        	<th><?php esc_html_e( 'Name', 'staff-manger-lite' ); ?></th>
			                        	<th><?php esc_html_e( 'Start time', 'staff-manger-lite' ); ?></th>
			                        	<th><?php esc_html_e( 'Ending time', 'staff-manger-lite' ); ?></th>
			                        	<th><?php esc_html_e( 'Late time', 'staff-manger-lite' ); ?></th>
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

        <!-- Add Description Modal -->
		<div class="modal fade" id="AddShift" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-notify modal-info">
		    <div class="modal-content">

		     	<div class="card">
	                <div class="card-body">
	                  <h4 class="card-title"><?php esc_html_e( 'Shift Details', 'staff-manger-lite' ); ?></h4>
	                  <form class="forms-sample" method="post" id="add_shift_form" autocomplete="off">
	                  	<div class="form-group">
	                      <label for="shift_name"><?php esc_html_e( 'Shift Name', 'staff-manger-lite' ); ?></label>
	                      <input type="text" class="form-control" id="shift_name" placeholder="<?php esc_html_e( 'Name', 'staff-manger-lite' ); ?>">
						</div>
	                    <div class="form-group bootstrap-timepicker timepicker">
                  			<label><?php esc_html_e( 'Starting Time', 'staff-manger-lite' ); ?></label>
							<input type="text" class="form-control custom-timepicker-input" placeholder="<?php esc_html_e( 'Format:- 10:00 AM', 'staff-manger-lite' ); ?>" id="shift_start" />
							
                  		</div>
                  		<div class="form-group bootstrap-timepicker timepicker">
                  			<label><?php esc_html_e( 'Ending Time', 'staff-manger-lite' ); ?></label>
							<input type="text" id="shift_end" name="shift_end" placeholder="<?php esc_html_e( 'Format:- 1:39 PM', 'staff-manger-lite' ); ?>" class="form-control custom-timepicker-input">
							
                  		</div>
                  		<div class="form-group bootstrap-timepicker timepicker">
                  			<label><?php esc_html_e( 'Late Time', 'staff-manger-lite' ); ?></label>
							<input type="text" id="shift_late" name="shift_late" placeholder="<?php esc_html_e( 'Format:- 10:15 AM', 'staff-manger-lite' ); ?>" class="form-control custom-timepicker-input">
							
                  		</div>
	                    <div class="form-group">
	                      	<label for="shift_status"><?php esc_html_e( 'Status', 'staff-manger-lite' ); ?></label>
	                      	<select name="shift_status" id="shift_status" class="form-control">
	                      		<option value="Active"><?php esc_html_e( 'Active', 'staff-manger-lite' ); ?></option>
	                      		<option value="Inactive"><?php esc_html_e( 'Inactive', 'staff-manger-lite' ); ?></option>
	                      	</select>
	                    </div>
	                    <input type="button" class="btn btn-gradient-primary mr-2" id="add_shift_btn" value="<?php esc_html_e( 'Submit', 'staff-manger-lite' ); ?>">
	                  </form>
	                </div>
	            </div>

		    </div>
		  </div>
		</div>

		<!-- Add Description Modal -->
		<div class="modal fade" id="EditShift" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-notify modal-info">
		    <div class="modal-content">
		     	<div class="card">
	                <div class="card-body">
	                  <h4 class="card-title"><?php esc_html_e( 'Shift Details', 'staff-manger-lite' ); ?></h4>
	                  <form class="forms-sample" method="post" id="edit_shift_form" autocomplete="off">
	                  	<div class="form-group">
	                      <label for="edit_shift_name"><?php esc_html_e( 'Shift Name', 'staff-manger-lite' ); ?></label>
	                      <input type="text" class="form-control" id="edit_shift_name" placeholder="<?php esc_html_e( 'Name', 'staff-manger-lite' ); ?>">
	                    </div>
	                    <div class="form-group bootstrap-timepicker timepicker">
                  			<label><?php esc_html_e( 'Starting Time', 'staff-manger-lite' ); ?></label>
							<input type="text" class="form-control custom-timepicker-input" placeholder="<?php esc_html_e( 'Format:- 10:00 AM', 'staff-manger-lite' ); ?>" id="edit_shift_start"/>
							
                  		</div>
                  		<div class="form-group bootstrap-timepicker timepicker">
                  			<label><?php esc_html_e( 'Ending Time', 'staff-manger-lite' ); ?></label>
							<input type="text" id="edit_shift_end" name="shift_end" placeholder="<?php esc_html_e( 'Format:- 1:39 PM', 'staff-manger-lite' ); ?>" class="form-control custom-timepicker-input">
							
                  		</div>
                  		<div class="form-group bootstrap-timepicker timepicker">
                  			<label><?php esc_html_e( 'Late Time', 'staff-manger-lite' ); ?></label>
							<input type="text" id="edit_shift_late" name="edit_shift_late" placeholder="<?php esc_html_e( 'Format:- 10:15 AM', 'staff-manger-lite' ); ?>" class="form-control custom-timepicker-input">
							
                  		</div>
	                    <div class="form-group">
	                      	<label for="edit_shift_status"><?php esc_html_e( 'Status', 'staff-manger-lite' ); ?></label>
	                      	<select name="edit_shift_status" id="edit_shift_status" class="form-control">
	                      		<option value="Active"><?php esc_html_e( 'Active', 'staff-manger-lite' ); ?></option>
	                      		<option value="Inactive"><?php esc_html_e( 'Inactive', 'staff-manger-lite' ); ?></option>
	                      	</select>
	                    </div>
	                    <input type="hidden" name="shift_key" id="shift_key">
	                    <input type="button" class="btn btn-gradient-primary mr-2" id="edit_shift_btn" value="<?php esc_html_e( 'Submit', 'staff-manger-lite' ); ?>">
	                  </form>
	                </div>
	            </div>

		    </div>
		  </div>
		</div>

	</div>
</div>