<?php
defined( 'ABSPATH' ) or die();
$all_designations = get_option( 'wprsmp_designations_data' );
?>
<!-- partial -->
<div class="dark-theme main-panel">
  	<div class="content-wrapper">
	    <div class="page-header">
	      	<h3 class="page-title">
	        	<span class="page-title-icon bg-gradient-primary text-white mr-2">
					<i class="fas fa-qrcode"></i>                 
	        	</span>
	        	<?php esc_html_e( 'Designations', 'staff-manger-lite' ); ?>
	      	</h3>
	      	<nav aria-label="breadcrumb">
	      		<ul class="breadcrumb">
		          	<li class="breadcrumb-item active" aria-current="page">
		            	<button class="btn btn-block btn-lg btn-gradient-primary custom-btn" data-toggle="modal" data-target="#AddDesignation">
							<i class="fas fa-plus"></i>
		            		<?php esc_html_e( 'Add Designation', 'staff-manger-lite' ); ?>
		            	</button>
		          	</li>
		        </ul>
	      	</nav>
	    </div>
	    <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              	<div class="card table_card">
                	<div class="card-body">
                		<div class="table-responsive">
		                  	<h4 class="card-title"><?php esc_html_e( 'Designations', 'staff-manger-lite' ); ?></h4>
		                  	<table class="table table-striped designations_table">
		                    	<thead>
			                      	<tr>
				                        <th><?php esc_html_e( 'No.', 'staff-manger-lite' ); ?></th>
				                        <th><?php esc_html_e( 'Name', 'staff-manger-lite' ); ?></th>
				                        <th><?php esc_html_e( 'Color', 'staff-manger-lite' ); ?></th>
				                        <th><?php esc_html_e( 'Status', 'staff-manger-lite' ); ?></th>
				                        <th><?php esc_html_e( 'Action', 'staff-manger-lite' ); ?></th>
			                     	</tr>
		                    	</thead>
		                    	<tbody id="designation_tbody">
				                    <?php if ( ! empty ( $all_designations ) ) {
		                        		$sno = 1;
		                        		foreach ( $all_designations as $key => $designation ) {
		                        	?>
			                        <tr>
			                        	<td><?php echo esc_html( $sno ); ?>.</td>
			                          	<td><?php echo esc_html( $designation['name'] ); ?></td>
			                          	<td>
			                          		<label class="badge" style="background-color:<?php echo esc_attr( $designation['color'] ); ?>;">
			                          			<?php echo esc_attr( $designation['color'] ); ?>
			                          		</label>
			                          	</td>
			                          	<td><?php echo esc_html( $designation['status'] ); ?></td>
			                          	<td class="designation-action-tools">
			                          		<ul class="designation-action-tools-ul">
			                          			<li class="designation-action-tools-li">
			                          				<a href="#" class="designation-action-tools-a designation-edit-a" data-designation="<?php echo esc_attr( $key ); ?>">
			                          					<i class="fas fa-pencil-alt"></i>
			                          				</a>
			                          			</li>
			                          			<li class="designation-action-tools-li">
			                          				<a href="#" class="designation-action-tools-a designation-delete-a" data-designation="<?php echo esc_attr( $key ); ?>">
			                          					<i class="far fa-window-close"></i>
			                          				</a>
			                          			</li>
			                          		</ul>
			                          	</td>
			                        </tr>
				                    <?php $sno++; } } else { ?>
				                    <tr>
				                    	<td><?php esc_html_e( 'No Designations added yet.!', 'staff-manger-lite' ); ?></td>
				                    </tr>
				                    <?php } ?>
		                    	</tbody>
		                    	<tfoot>
			                      	<tr>
				                        <th><?php esc_html_e( 'No.', 'staff-manger-lite' ); ?></th>
				                        <th><?php esc_html_e( 'Name', 'staff-manger-lite' ); ?></th>
				                        <th><?php esc_html_e( 'Color', 'staff-manger-lite' ); ?></th>
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
		<div class="modal fade" id="AddDesignation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-notify modal-info">
		    <div class="modal-content">
		     	<div class="card">
	                <div class="card-body">
	                  <h4 class="card-title"><?php esc_html_e( 'Designation Details', 'staff-manger-lite' ); ?></h4>
	                  <form class="forms-sample" method="post" id="add_designation_form">
	                    <div class="form-group">
	                      <label for="designation_name"><?php esc_html_e( 'Designation Name', 'staff-manger-lite' ); ?></label>
	                      <input type="text" class="form-control" id="designation_name" placeholder="<?php esc_html_e( 'Designation Type', 'staff-manger-lite' ); ?>">
	                    </div>
	                    <div class="form-group">
	                      <label for="designation_color"><?php esc_html_e( 'Designation Color', 'staff-manger-lite' ); ?></label>
	                      <input type="text" class="form-control color-field" id="designation_color" placeholder="#ffffff">
	                    </div>
	                    <div class="form-group">
	                      	<label for="designation_status"><?php esc_html_e( 'Status', 'staff-manger-lite' ); ?></label>
	                      	<select name="staff_department" id="designation_status" class="form-control">
	                      		<option value="Active"><?php esc_html_e( 'Active', 'staff-manger-lite' ); ?></option>
	                      		<option value="Inactive"><?php esc_html_e( 'Inactive', 'staff-manger-lite' ); ?></option>
	                      	</select>
	                    </div>
	                    <input type="button" class="btn btn-gradient-primary mr-2" id="add_designation_btn" value="<?php esc_html_e( 'Submit', 'staff-manger-lite' ); ?>">
	                  </form>
	                </div>
	            </div>
		    </div>
		  </div>
		</div>

		<!-- Edit Description Modal -->
		<div class="modal fade" id="EditDesignation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-notify modal-info">
		    <div class="modal-content">
		     	<div class="card">
	                <div class="card-body">
	                  <h4 class="card-title"><?php esc_html_e( 'Designation Details', 'staff-manger-lite' ); ?></h4>
	                  <form class="forms-sample" method="post" id="edit_designation_form">
	                    <div class="form-group">
	                      <label for="edit_designation_name"><?php esc_html_e( 'Designation Name', 'staff-manger-lite' ); ?></label>
	                      <input type="text" class="form-control" id="edit_designation_name" placeholder="<?php esc_html_e( 'Designation Type', 'staff-manger-lite' ); ?>">
	                    </div>
	                    <div class="form-group">
	                      <label for="edit_designation_color"><?php esc_html_e( 'Designation Color', 'staff-manger-lite' ); ?></label>
	                      <input type="text" class="form-control color-field" id="edit_designation_color" placeholder="#ffffff">
	                    </div>
	                    <div class="form-group">
	                      	<label for="edit_designation_status"><?php esc_html_e( 'Status', 'staff-manger-lite' ); ?></label>
	                      	<select name="edit_designation_status" id="edit_designation_status" class="form-control">
	                      		<option value="Active"><?php esc_html_e( 'Active', 'staff-manger-lite' ); ?></option>
	                      		<option value="Inactive"><?php esc_html_e( 'Inactive', 'staff-manger-lite' ); ?></option>
	                      	</select>
	                    </div>
	                    <input type="hidden" name="designation_key" id="designation_key">
	                    <input type="button" class="btn btn-gradient-primary mr-2" id="edit_designation_btn" value="<?php esc_html_e( 'Submit', 'staff-manger-lite' ); ?>">
	                  </form>
	                </div>
	            </div>
		    </div>
		  </div>
		</div>

	</div>
</div>