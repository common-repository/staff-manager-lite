<?php
defined( 'ABSPATH' ) or die();
$all_notices = get_option( 'wprsmp_notices_data' );
require_once( WPRSMP_PLUGIN_DIR_PATH . '/admin/inc/helpers/wprsmp-lite-helper.php' );
?>
<!-- partial -->
<div class="dark-theme main-panel">
  	<div class="content-wrapper">
	    <div class="page-header">
	      	<h3 class="page-title">
	        	<span class="page-title-icon bg-gradient-primary text-white mr-2">
	          	<i class="fab fa-evernote"></i>                 
	        	</span>
	        	<?php esc_html_e( 'Notices', 'staff-manger-lite' ); ?>
	      	</h3>
	    </div>
	    <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              	<div class="card table_card">
                	<div class="card-body">
                		<div class="table-responsive">
		                  	<h4 class="card-title"><?php esc_html_e( 'Notice', 'staff-manger-lite' ); ?></h4>
		                  	<table class="table table-striped events_table">
		                    	<thead>
			                      	<tr>
				                        <th><?php esc_html_e( 'No.', 'staff-manger-lite' ); ?></th>
			                        	<th><?php esc_html_e( 'Title', 'staff-manger-lite' ); ?></th>
			                        	<th><?php esc_html_e( 'Description', 'staff-manger-lite' ); ?></th>
			                        	<th><?php esc_html_e( 'Date', 'staff-manger-lite' ); ?></th>
			                     	</tr>
		                    	</thead>
		                    	<tbody id="notice_tbody">
				                    <?php 
				                    	if ( ! empty ( $all_notices ) ) {

                                        $sno         = 1;        
                                        $first       = new \DateTime( date( "Y" )."-01-01" );
                                        $first       = $first->format( "Y-m-d" );
                                        $plusOneYear = date( "Y" )+1;
                                        $last        = new \DateTime( $plusOneYear."-12-31" );          
                                        $last        = $last->format( "Y-m-d" );          
                                        $all_dates   = WPRSMPLiteHelperClass::wprsmp_get_date_range( $first, $last );

		                        		foreach ( $all_notices as $key => $notice ) {
                                            if ( in_array( $notice['date'], $all_dates ) && $notice['status'] == 'Active' ) {
                                    ?>
			                        <tr>
			                        	<td><?php echo esc_html( $sno ); ?>.</td>
			                          	<td><?php echo esc_html( $notice['name'] ); ?></td>
			                          	<td><?php echo esc_html( $notice['desc'] ); ?></td>
			                          	<td><?php echo esc_html( date( WPRSMPLiteHelperClass::get_date_format(), strtotime( $notice['date'] ) ) ); ?></td>
			                        </tr>
				                    <?php $sno++;
                                            } } } else { 
                                    ?>
				                    <tr>
				                    	<td><?php esc_html_e( 'No notices added yet.!', 'staff-manger-lite' ); ?></td>
				                    </tr>
				                    <?php } ?>
		                    	</tbody>
		                    	<tfoot>
			                      	<tr>
				                        <th><?php esc_html_e( 'No.', 'staff-manger-lite' ); ?></th>
			                        	<th><?php esc_html_e( 'Title', 'staff-manger-lite' ); ?></th>
			                        	<th><?php esc_html_e( 'Description', 'staff-manger-lite' ); ?></th>
			                        	<th><?php esc_html_e( 'Date', 'staff-manger-lite' ); ?></th>
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