<?php
defined( 'ABSPATH' ) or die();
require_once( WPRSMP_PLUGIN_DIR_PATH . '/admin/inc/helpers/wprsmp-lite-helper.php' );
$all_holidays = get_option( 'wprsmp_holidays_data' );
?>
<!-- partial -->
<div class="dark-theme main-panel">
  	<div class="content-wrapper">
	    <div class="page-header">
	      	<h3 class="page-title">
	        	<span class="page-title-icon bg-gradient-primary text-white mr-2">
	          	<i class="fas fa-golf-ball"></i>                 
	        	</span>
	        	<?php esc_html_e( 'Holidays', 'staff-manger-lite' ); ?>
	      	</h3>
	    </div>
	    <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              	<div class="card table_card">
                	<div class="card-body">
                		<div class="table-responsive">
		                  	<h4 class="card-title"><?php esc_html_e( 'Holiday', 'staff-manger-lite' ); ?></h4>
		                  	<table class="table table-striped events_table">
		                    	<thead>
			                      	<tr>
				                        <th><?php esc_html_e( 'No.', 'staff-manger-lite' ); ?></th>
			                        	<th><?php esc_html_e( 'Name', 'staff-manger-lite' ); ?></th>
			                        	<th><?php esc_html_e( 'Date(s)', 'staff-manger-lite' ); ?></th>
			                        	<th><?php esc_html_e( 'Days', 'staff-manger-lite' ); ?></th>
			                        	<th><?php esc_html_e( 'Status', 'staff-manger-lite' ); ?></th>
			                     	</tr>
		                    	</thead>
		                    	<tbody id="holiday_tbody">
				                    <?php 
				                    	if ( ! empty ( $all_holidays ) ) {

                                        $sno         = 1;        
                                        $first       = new \DateTime( date( "Y" )."-01-01" );
                                        $first       = $first->format( "Y-m-d" );
                                        $plusOneYear = date( "Y" )+1;
                                        $last        = new \DateTime( $plusOneYear."-12-31" );          
                                        $last        = $last->format( "Y-m-d" );          
                                        $all_dates   = WPRSMPLiteHelperClass::wprsmp_get_date_range( $first, $last );

		                        		foreach ( $all_holidays as $key => $holiday ) {
                                            if ( in_array( $holiday['to'], $all_dates ) && $holiday['status'] == 'Active' ) {
                                    ?>
			                        <tr>
			                        	<td><?php echo esc_html( $sno ); ?>.</td>
			                          	<td><?php echo esc_html( $holiday['name'] ); ?></td>
			                          	<td><?php echo( "From ".date( WPRSMPLiteHelperClass::get_date_format(), strtotime( $holiday['start'] ) )." to ".date( WPRSMPLiteHelperClass::get_date_format(), strtotime( $holiday['to'] ) ) ); ?></td>
			                          	<td><?php echo esc_html( $holiday['days'] ); ?></td>
			                          	<td><?php echo esc_html( $holiday['status'] ); ?></td>
			                        </tr>
				                    <?php $sno++;
                                            } } } else {
                                    ?>
				                    <tr>
				                    	<td><?php esc_html_e( 'No Holidays added yet.!', 'staff-manger-lite' ); ?></td>
				                    </tr>
				                    <?php } ?>
		                    	</tbody>
		                    	<tfoot>
			                      	<tr>
				                        <th><?php esc_html_e( 'No.', 'staff-manger-lite' ); ?></th>
			                        	<th><?php esc_html_e( 'Name', 'staff-manger-lite' ); ?></th>
			                        	<th><?php esc_html_e( 'Date(s)', 'staff-manger-lite' ); ?></th>
			                        	<th><?php esc_html_e( 'Days', 'staff-manger-lite' ); ?></th>
			                        	<th><?php esc_html_e( 'Status', 'staff-manger-lite' ); ?></th>
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