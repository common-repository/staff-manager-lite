<?php
defined('ABSPATH') or die();
require_once( WPRSMP_PLUGIN_DIR_PATH . '/admin/inc/helpers/wprsmp-lite-helper.php' );
$all_staffs       = get_option('wprsmp_staffs_data');
$all_shifts       = get_option('wprsmp_shifts_data');
$all_designations = get_option('wprsmp_designations_data');
?>
<!-- partial -->
<div class="dark-theme main-panel">
	<div class="content-wrapper">
		<div class="page-header">
			<h3 class="page-title">
				<span class="page-title-icon bg-gradient-primary text-white mr-2">
					<i class="fab fa-studiovinari"></i>
				</span>
				<?php esc_html_e('Staffs', 'staff-manger-lite' ); ?>
			</h3>
			<nav aria-label="breadcrumb">
				<ul class="breadcrumb">
					<li class="breadcrumb-item active" aria-current="page">
						<button class="btn btn-block btn-lg btn-gradient-primary custom-btn" data-toggle="modal" data-target="#AddStaff">
							<i class="fas fa-plus"></i> <?php esc_html_e('Add Staff', 'staff-manger-lite' ); ?></button>
					</li>
				</ul>
			</nav>
		</div>
		<div class="row">
			<div class="col-lg-12 grid-margin stretch-card">
				<div class="card table_card">
					<div class="card-body">
						<div class="table-responsive">
							<h4 class="card-title"><?php esc_html_e('Staffs', 'staff-manger-lite' ); ?></h4>
							<table class="table table-striped staffs_table">
								<thead>
									<tr>
										<th><?php esc_html_e( 'No.', 'staff-manger-lite' ); ?></th>
										<th><?php esc_html_e( 'Name', 'staff-manger-lite' ); ?></th>
										<th><?php esc_html_e( 'Email', 'staff-manger-lite' ); ?></th>
										<th><?php esc_html_e( 'Shift', 'staff-manger-lite' ); ?></th>
										<th><?php esc_html_e( 'Designation', 'staff-manger-lite' ); ?></th>
										<th><?php esc_html_e( 'Leaves', 'staff-manger-lite' ); ?></th>
										<th><?php esc_html_e( 'Salary', 'staff-manger-lite' ); ?></th>
										<th><?php esc_html_e( 'Status', 'staff-manger-lite' ); ?></th>
										<th><?php esc_html_e( 'Action', 'staff-manger-lite' ); ?></th>
									</tr>
								</thead>
								<tbody id="staff_tbody">
									<?php
									if ( ! empty( $all_staffs ) ) {
										$sno = 1;
										foreach ( $all_staffs as $key => $staff ) {

											$leave_name  = unserialize( $staff['leave_name'] );
											$leave_value = unserialize( $staff['leave_value'] );
											$leave_no    = sizeof( $leave_name );
									?>
											<tr>
												<td><?php echo esc_html( $sno ); ?>.</td>
												<td><?php echo esc_html( $staff['fullname'] ); ?></td>
												<td><?php echo esc_html( $staff['email'] ); ?></td>
												<td><?php echo esc_html( $staff['shift_name'] . '( ' . date( WPRSMPLiteHelperClass::get_time_format(), strtotime( $staff['shift_start'] ) ) . ' to ' . date( WPRSMPLiteHelperClass::get_time_format(), strtotime( $staff['shift_end'] ) ) . ' )' ); ?></td>
												<td><?php echo esc_html( $staff['desig_name'] ); ?></td>
												<td>
													<?php
														for ( $i = 0; $i < $leave_no; $i++ ) {
															echo '<span>' . $leave_name[$i] . ' ( ' . $leave_value[$i] . ')</br></br></span>';
														}
													?>
												</td>
												<td><?php echo esc_html( $staff['salary'] ); ?></td>
												<td><?php echo esc_html( $staff['status'] ); ?></td>
												<td class="designation-action-tools">
													<ul class="designation-action-tools-ul">
														<li class="designation-action-tools-li">
															<a href="#" title="Edit" class="designation-action-tools-a staff-edit-a" data-staff="<?php echo esc_attr($key); ?>">
																<i class="fas fa-pencil-alt"></i>
															</a>
														</li>
														<li class="designation-action-tools-li">
															<a href="#" title="Delete" class="designation-action-tools-a staff-delete-a" data-staff="<?php echo esc_attr($key); ?>">
																<i class="far fa-window-close"></i>
															</a>
														</li>
													</ul>
												</td>
											</tr>
											<?php $sno++;
										}
									} else { ?>
										<tr>
											<td><?php esc_html_e( 'No Staff added yet.!', 'staff-manger-lite' ); ?></td>
										</tr>
									<?php } ?>
								</tbody>
								<tfoot>
									<tr>
										<th><?php esc_html_e( 'No.', 'staff-manger-lite' ); ?></th>
										<th><?php esc_html_e( 'Name', 'staff-manger-lite' ); ?></th>
										<th><?php esc_html_e( 'Email', 'staff-manger-lite' ); ?></th>
										<th><?php esc_html_e( 'Shift', 'staff-manger-lite' ); ?></th>
										<th><?php esc_html_e( 'Designation', 'staff-manger-lite' ); ?></th>
										<th><?php esc_html_e( 'Leaves', 'staff-manger-lite' ); ?></th>
										<th><?php esc_html_e( 'Salary', 'staff-manger-lite' ); ?></th>
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
		<div class="modal fade" id="AddStaff" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-notify modal-lg modal-info">
				<div class="modal-content">
					<div class="card">
						<div class="card-body">
							<h4 class="card-title"><?php esc_html_e( 'Staff Details', 'staff-manger-lite' ); ?></h4>
							<form class="forms-sample" method="post" id="add_staff_form" autocomplete="off">
								<div class="form-group">
									<label for="staff_name"><?php esc_html_e( 'Select User', 'staff-manger-lite' ); ?></label>
									<select class="form-control" name="select_user_id" id="select_user_id">
										<option value=""><?php esc_html_e( '--------Select user---------', 'staff-manger-lite' ); ?></option>
										<?php global $wpdb;
										$user_table = $wpdb->base_prefix . "users";
										$users_data = $wpdb->get_results( "SELECT * FROM $user_table" );

										if ( ! empty( $users_data ) )  {
											foreach ( $users_data as $key => $users ) {
												?>
												<option value="<?php echo esc_attr( $users->ID ); ?>"><?php echo esc_html( $users->display_name ); ?>
												</option>
											<?php }
									} ?>
									</select>
								</div>
								<div class="form-group">
									<label><?php esc_html_e( 'Username', 'staff-manger-lite' ); ?></label>
									<input type="text" id="user_name" name="user_name" placeholder="<?php esc_html_e( 'User Name', 'staff-manger-lite' ); ?>" class="form-control" readonly>
								</div>
								<div class="form-group">
									<label><?php esc_html_e( 'First Name', 'staff-manger-lite' ); ?></label>
									<input type="text" id="first_name" name="first_name" placeholder="<?php esc_html_e( 'First Name', 'staff-manger-lite' ); ?>" class="form-control" readonly>
								</div>
								<div class="form-group">
									<label><?php esc_html_e( 'Last Name', 'staff-manger-lite' ); ?></label>
									<input type="text" id="last_name" name="last_name" placeholder="<?php esc_html_e( 'Last Name', 'staff-manger-lite' ); ?>" class="form-control" readonly>
								</div>
								<div class="form-group">
									<label><?php esc_html_e( 'Email', 'staff-manger-lite' ); ?></label>
									<input type="text" id="staff_email" name="staff_email" placeholder="<?php esc_html_e( 'Email', 'staff-manger-lite' ); ?>" class="form-control" readonly>
								</div>
								<div class="form-group">
									<label><?php esc_html_e( 'Select Shift', 'staff-manger-lite' ); ?></label>
									<select class="form-control" name="user_shift" id="user_shift">
										<option value=""><?php esc_html_e( '----------------Select user shift----------------', 'staff-manger-lite' ); ?></option>
										<?php
										if ( ! empty( $all_shifts ) ) {
											foreach ( $all_shifts as $shift_key => $shifts ) {
												?>
												<option value="<?php echo esc_attr( $shift_key ); ?>"><?php esc_html_e( $shifts['name'], 'staff-manger-lite' ); ?> <?php echo esc_html( "( " . $shifts['start'] . " to " . $shifts['end'] . " )" ); ?></option>
											<?php }
									} ?>

									</select>
								</div>
								<div class="form-group">
									<label><?php esc_html_e( 'Select Designation', 'staff-manger-lite' ); ?></label>
									<select class="form-control" name="user_designation" id="user_designation">
										<option value=""><?php esc_html_e( '---------Select User Designation---------', 'staff-manger-lite' ); ?></option>
										<?php
										if ( ! empty( $all_designations ) ) {
											foreach ( $all_designations as $designation_key => $designations ) {
												?>
												<option value="<?php echo esc_attr( $designation_key ); ?>"><?php esc_html_e( $designations['name'], 'staff-manger-lite' ); ?></option>
											<?php }
									} ?>
									</select>
								</div>
								<div class="form-group">
									<label><?php esc_html_e( 'Salary', 'staff-manger-lite' ); ?></label>
									<input type="text" id="staff_salary" name="staff_salary" placeholder="<?php esc_html_e( '$1000', 'staff-manger-lite' ); ?>" class="form-control ">
								</div>
								<div class="form-group dynamic_input_js">
									<label for="location_name"><?php esc_html_e( 'Leaves', 'staff-manger-lite') ; ?></label>
									<br>
									<input type="text" id="leave_name_-1" class="form-control leave_name" name="leave_name[]" placeholder="<?php esc_html_e( 'Name', 'staff-manger-lite' ); ?>">
									<input type="text" id="leave_value_-1" class="form-control leave_value" name="leave_value[]" placeholder="<?php esc_html_e( 'Value', 'staff-manger-lite' ); ?>">
									<div id="dynamic_leave_fields" class="dynamic_input_js"></div>
									<br>
									<button class="btn btn-success btn-sm add_leave_fields"><?php esc_html_e( 'Add More', 'staff-manger-lite' ); ?></button>
									<button class="btn btn-danger btn-sm remove_leave_fields"><?php esc_html_e( 'Remove', 'staff-manger-lite' ); ?></button>
								</div>
								<div class="form-group">
									<label for="staff_status"><?php esc_html_e( 'Status', 'staff-manger-lite' ); ?></label>
									<select name="staff_status" id="staff_status" class="form-control">
										<option value="Active"><?php esc_html_e( 'Active', 'staff-manger-lite' ); ?></option>
										<option value="Inactive"><?php esc_html_e( 'Inactive', 'staff-manger-lite' ); ?></option>
									</select>
								</div>
								<input type="button" class="btn btn-gradient-primary mr-2" id="add_staff_btn" value="<?php esc_html_e( 'Submit', 'staff-manger-lite' ); ?>">
							</form>
						</div>
					</div>

				</div>
			</div>
		</div>

		<!-- Add Description Modal -->
		<div class="modal fade" id="EditStaff" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-notify modal-lg modal-info">
				<div class="modal-content">
					<div class="card">
						<div class="card-body">
							<h4 class="card-title"><?php esc_html_e( 'Staff Details', 'staff-manger-lite' ); ?></h4>
							<form class="forms-sample" method="post" id="edit_staff_form" autocomplete="off">
								<div class="form-group">
									<label for="staff_name"><?php esc_html_e( 'Select User', 'staff-manger-lite' ); ?></label>
									<select class="form-control" name="select_user_id" id="select_user_id">
										<option value=""><?php esc_html_e( '--------Select user---------', 'staff-manger-lite' ); ?></option>
										<?php global $wpdb;
										$user_table = $wpdb->base_prefix . "users";
										$users_data = $wpdb->get_results( "SELECT * FROM $user_table" );

										if ( ! empty( $users_data ) ) {
											foreach ( $users_data as $key => $users ) {
												?>
												<option value="<?php echo esc_attr( $users->ID ); ?>"><?php echo esc_html( $users->display_name ); ?></option>
											<?php }
									} ?>
									</select>
								</div>
								<div class="form-group">
									<label><?php esc_html_e( 'Username', 'staff-manger-lite' ); ?></label>
									<input type="text" id="user_name" name="user_name" placeholder="<?php esc_html_e( 'User Name', 'staff-manger-lite' ); ?>" class="form-control" readonly>
								</div>
								<div class="form-group">
									<label><?php esc_html_e( 'First Name', 'staff-manger-lite' ); ?></label>
									<input type="text" id="first_name" name="first_name" placeholder="<?php esc_html_e( 'First Name', 'staff-manger-lite' ); ?>" class="form-control" readonly>
								</div>
								<div class="form-group">
									<label><?php esc_html_e( 'Last Name', 'staff-manger-lite' ); ?></label>
									<input type="text" id="last_name" name="last_name" placeholder="<?php esc_html_e( 'Last Name', 'staff-manger-lite' ); ?>" class="form-control" readonly>
								</div>
								<div class="form-group">
									<label><?php esc_html_e( 'Email', 'staff-manger-lite' ); ?></label>
									<input type="text" id="staff_email" name="staff_email" placeholder="<?php esc_html_e( 'Email', 'staff-manger-lite' ); ?>" class="form-control" readonly>
								</div>
								<div class="form-group">
									<label><?php esc_html_e( 'Select Shift', 'staff-manger-lite' ); ?></label>
									<select class="form-control" name="user_shift" id="user_shift">
										<option value=""><?php esc_html_e( '----------------Select user shift----------------', 'staff-manger-lite' ); ?></option>
										<?php
										if ( ! empty( $all_shifts ) ) {
											foreach ( $all_shifts as $shift_key => $shifts ) {
												?>
												<option value="<?php echo esc_attr( $shift_key ); ?>"><?php esc_html_e( $shifts['name'], 'staff-manger-lite'); ?> <?php echo esc_html( "( " . $shifts['start'] . " to " . $shifts['end'] . " )" ); ?></option>
											<?php }
									} ?>

									</select>
								</div>
								<div class="form-group">
									<label><?php esc_html_e( 'Select Designation', 'staff-manger-lite' ); ?></label>
									<select class="form-control" name="user_designation" id="user_designation">
										<option value=""><?php esc_html_e( '---------Select User Designation---------', 'staff-manger-lite' ); ?></option>
										<?php
										if ( ! empty( $all_designations ) ) {
											foreach ( $all_designations as $designation_key => $designations ) {
												?>
												<option value="<?php echo esc_attr( $designation_key ); ?>"><?php esc_html_e( $designations['name'], 'staff-manger-lite' ); ?></option>
											<?php }
									} ?>
									</select>
								</div>
								<div class="form-group">
									<label><?php esc_html_e( 'Salary', 'staff-manger-lite' ); ?></label>
									<input type="text" id="staff_salary" name="staff_salary" placeholder="<?php esc_html_e( '$1000', 'staff-manger-lite' ); ?>" class="form-control ">
								</div>
								<div class="form-group dynamic_input_js">
									<label for="location_name"><?php esc_html_e( 'Leaves', 'staff-manger-lite' ); ?></label>
									<br>
									<input type="text" id="edit_leave_name_-1" class="form-control edit_leave_name" name="edit_leave_name[]" placeholder="<?php esc_html_e( 'Name', 'staff-manger-lite' ); ?>">
									<input type="text" id="edit_leave_value_-1" class="form-control edit_leave_value" name="edit_leave_value[]" placeholder="<?php esc_html_e( 'Value', 'staff-manger-lite' ); ?>">
									<div id="edit_dynamic_leave_fields" class="dynamic_input_js"></div>
									<br>
									<button class="btn btn-success btn-sm edit_add_leave_fields"><?php esc_html_e( 'Add More', 'staff-manger-lite' ); ?></button>
									<button class="btn btn-danger btn-sm edit_remove_leave_fields"><?php esc_html_e( 'Remove', 'staff-manger-lite' ); ?></button>
								</div>
								<div class="form-group">
									<label for="staff_status"><?php esc_html_e( 'Status', 'staff-manger-lite' ); ?></label>
									<select name="staff_status" id="staff_status" class="form-control">
										<option value="Active"><?php esc_html_e( 'Active', 'staff-manger-lite' ); ?></option>
										<option value="Inactive"><?php esc_html_e( 'Inactive', 'staff-manger-lite' ); ?></option>
									</select>
								</div>
								<input type="hidden" name="staff_key" id="staff_key">
								<input type="button" class="btn btn-gradient-primary mr-2" id="edit_staff_btn" value="<?php esc_html_e( 'Submit', 'staff-manger-lite' ); ?>">
							</form>
						</div>
					</div>

				</div>
			</div>
		</div>

	</div>
</div>