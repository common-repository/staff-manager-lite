<?php
defined( 'ABSPATH' ) or die();
require_once( WPRSMP_PLUGIN_DIR_PATH . '/admin/inc/helpers/wprsmp-lite-helper.php' );
$all_events = get_option( 'wprsmp_events_data' );
?>
<!-- partial -->
<div class="dark-theme main-panel">
  	<div class="content-wrapper">
	    <div class="page-header">
	      	<h3 class="page-title">
	        	<span class="page-title-icon bg-gradient-primary text-white mr-2">
	          	<i class="fas fa-calendar-day"></i>                
	        	</span>
	        	<?php esc_html_e( 'Events', 'staff-manger-lite' ); ?>
	      	</h3>
	      	<nav aria-label="breadcrumb">
	        	<ul class="breadcrumb">
		          	<li class="breadcrumb-item active" aria-current="page">
		            	<button class="btn btn-block btn-lg btn-gradient-primary custom-btn" data-toggle="modal" data-target="#AddEvents">
		            		<i class="fas fa-plus"></i> <?php esc_html_e( 'Add Events', 'staff-manger-lite' ); ?></button>
		          	</li>
	        	</ul>
	      	</nav>
	    </div>
	    <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              	<div class="card table_card">
                	<div class="card-body">
                		<div class="table-responsive">
		                  	<h4 class="card-title"><?php esc_html_e( 'Events', 'staff-manger-lite' ); ?></h4>
		                  	<table class="table table-striped events_table">
		                    	<thead>
			                      	<tr>
				                        <th><?php esc_html_e( 'No.', 'staff-manger-lite' ); ?></th>
			                        	<th><?php esc_html_e( 'Name', 'staff-manger-lite' ); ?></th>
			                        	<th><?php esc_html_e( 'Description', 'staff-manger-lite' ); ?></th>
			                        	<th><?php esc_html_e( 'Date', 'staff-manger-lite' ); ?></th>
			                        	<th><?php esc_html_e( 'Time', 'staff-manger-lite' ); ?></th>
			                        	<th><?php esc_html_e( 'Status', 'staff-manger-lite' ); ?></th>
			                        	<th><?php esc_html_e( 'Action', 'staff-manger-lite' ); ?></th>
			                     	</tr>
		                    	</thead>
		                    	<tbody id="event_tbody">
				                    <?php 
				                    	if ( ! empty ( $all_events ) ) {
		                        		$sno = 1;
		                        		foreach ( $all_events as $key => $event ) {
		                        	?>
			                        <tr>
			                        	<td><?php echo esc_html( $sno ); ?>.</td>
			                          	<td><?php echo esc_html( $event['name'] ); ?></td>
			                          	<td class="badge-desc">
			                          		<p><?php echo esc_html( $event['desc'] ); ?></p>
			                          	</td>
			                          	<td><?php echo esc_html( date( WPRSMPLiteHelperClass::get_date_format(), strtotime( $event['date'] ) ) ); ?></td>
			                          	<td><?php echo esc_html( $event['time'] ); ?></td>
			                          	<td><?php echo esc_html( $event['status'] ); ?></td>
			                          	<td class="designation-action-tools">
			                          		<ul class="designation-action-tools-ul">
			                          			<li class="designation-action-tools-li">
			                          				<a href="#" class="designation-action-tools-a event-edit-a" data-event="<?php echo esc_attr( $key ); ?>">
			                          					<i class="fas fa-pencil-alt"></i>
			                          				</a>
			                          			</li>
			                          			<li class="designation-action-tools-li">
			                          				<a href="#" class="designation-action-tools-a event-delete-a" data-event="<?php echo esc_attr( $key ); ?>">
			                          					<i class="far fa-window-close"></i>
			                          				</a>
			                          			</li>
			                          		</ul>
			                          	</td>
			                        </tr>
				                    <?php $sno++; } } else { ?>
				                    <tr>
				                    	<td><?php esc_html_e( 'No Events added yet.!', 'staff-manger-lite' ); ?></td>
				                    </tr>
				                    <?php } ?>
		                    	</tbody>
		                    	<tfoot>
			                      	<tr>
				                        <th><?php esc_html_e( 'No.', 'staff-manger-lite' ); ?></th>
			                        	<th><?php esc_html_e( 'Name', 'staff-manger-lite' ); ?></th>
			                        	<th><?php esc_html_e( 'Description', 'staff-manger-lite' ); ?></th>
			                        	<th><?php esc_html_e( 'Date', 'staff-manger-lite' ); ?></th>
			                        	<th><?php esc_html_e( 'Time', 'staff-manger-lite' ); ?></th>
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
		<div class="modal fade" id="AddEvents" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-notify modal-info">
		    <div class="modal-content">

		     	<div class="card">
	                <div class="card-body">
	                  <h4 class="card-title"><?php esc_html_e( 'Event Details', 'staff-manger-lite' ); ?></h4>
	                  <form class="forms-sample" method="post" id="add_event_form" autocomplete="off">
	                  	<div class="form-group">
	                      <label for="event_name"><?php esc_html_e( 'Event Name', 'staff-manger-lite' ); ?></label>
	                      <input type="text" class="form-control" id="event_name" placeholder="<?php esc_html_e( 'Name', 'staff-manger-lite' ); ?>">
	                    </div>
	                    <div class="form-group">
	                      <label for="event_desc"><?php esc_html_e( 'Event Description', 'staff-manger-lite' ); ?></label>
	                      <textarea class="form-control" rows="4" id="event_desc" name="event_desc" placeholder="<?php esc_html_e( 'Description....', 'staff-manger-lite' ); ?>"></textarea>
	                    </div>
	                    <div class="form-group">
	                      <label for="event_date"><?php esc_html_e( 'Event Date', 'staff-manger-lite' ); ?></label>
	                      <input type="text" class="form-control" id="event_date" placeholder="Format:- YYYY-MM-DD" data-toggle="datetimepicker" data-target="#event_date">
	                    </div>
	                    <div class="form-group">
	                      <label for="event_time"><?php esc_html_e( 'Event Time', 'employee-&-hr-management' ); ?></label>
	                      <input type="text" class="form-control" id="event_time" placeholder="10:00 AM" data-toggle="datetimepicker" data-target="#event_time">
	                    </div>
	                    <div class="form-group">
	                      	<label for="event_status"><?php esc_html_e( 'Status', 'staff-manger-lite' ); ?></label>
	                      	<select name="event_status" id="event_status" class="form-control">
	                      		<option value="Active"><?php esc_html_e( 'Active', 'staff-manger-lite' ); ?></option>
	                      		<option value="Inactive"><?php esc_html_e( 'Inactive', 'staff-manger-lite' ); ?></option>
	                      	</select>
	                    </div>
	                    <input type="button" class="btn btn-gradient-primary mr-2" id="add_event_btn" value="<?php esc_html_e( 'Submit', 'staff-manger-lite' ); ?>">
	                  </form>
	                </div>
	            </div>

		    </div>
		  </div>
		</div>

		<!-- Add Description Modal -->
		<div class="modal fade" id="EditEvent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-notify modal-info">
		    <div class="modal-content">
		     	<div class="card">
	                <div class="card-body">
	                  <h4 class="card-title"><?php esc_html_e( 'Event Details', 'staff-manger-lite' ); ?></h4>
	                  <form class="forms-sample" method="post" id="edit_event_form" autocomplete="off">
	                  	<div class="form-group">
	                      <label for="edit_event_name"><?php esc_html_e( 'Event Name', 'staff-manger-lite' ); ?></label>
	                      <input type="text" class="form-control" id="edit_event_name" placeholder="<?php esc_html_e( 'Name', 'staff-manger-lite' ); ?>">
	                    </div>
	                    <div class="form-group">
	                      <label for="edit_event_desc"><?php esc_html_e( 'Event Description', 'staff-manger-lite' ); ?></label>
	                      <textarea class="form-control" rows="4" id="edit_event_desc" name="edit_event_desc" placeholder="<?php esc_html_e( 'Description....', 'staff-manger-lite' ); ?>"></textarea>
	                    </div>
	                    <div class="form-group">
	                      <label for="edit_event_date"><?php esc_html_e( 'Event Date', 'staff-manger-lite' ); ?></label>
	                      <input type="text" class="form-control" id="edit_event_date" placeholder="Format:- YYYY-MM-DD" data-toggle="datetimepicker" data-target="#edit_event_date">
	                    </div>
	                    <div class="form-group">
	                      <label for="edit_event_time"><?php esc_html_e( 'Event Time', 'staff-manger-lite' ); ?></label>
	                      <input type="text" class="form-control" id="edit_event_time" placeholder="10:00 AM" data-toggle="datetimepicker" data-target="#edit_event_time">
	                    </div>
	                    <div class="form-group">
	                      	<label for="edit_event_status"><?php esc_html_e( 'Status', 'staff-manger-lite' ); ?></label>
	                      	<select name="edit_event_status" id="edit_event_status" class="form-control">
	                      		<option value="Active"><?php esc_html_e( 'Active', 'staff-manger-lite' ); ?></option>
	                      		<option value="Inactive"><?php esc_html_e( 'Inactive', 'staff-manger-lite' ); ?></option>
	                      	</select>
	                    </div>
	                    <input type="hidden" name="event_key" id="event_key">
	                    <input type="button" class="btn btn-gradient-primary mr-2" id="edit_event_btn" value="<?php esc_html_e( 'Submit', 'staff-manger-lite' ); ?>">
	                  </form>
	                </div>
	            </div>

		    </div>
		  </div>
		</div>

	</div>
</div>