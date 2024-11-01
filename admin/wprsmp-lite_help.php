<?php 
defined( 'ABSPATH' ) or die();
require_once( WPRSMP_PLUGIN_DIR_PATH . '/admin/inc/helpers/wprsmp-lite-helper.php' );
?>

<!-- partial -->
<div class="dark-theme main-panel main-dashboard help_banner_dash">
	<div class="content-wrapper">
	    <div class="page-header">
	      	<h3 class="page-title">
	        	<span class="page-title-icon bg-gradient-primary text-white mr-2">
	          		<i class="fas fa-home"></i>                 
	        	</span>
	        	<?php esc_html_e( 'Staff manager Lite ('.WPRSMPLiteHelperClass::get_plugin_version().')', 'staff-manger-lite' ); ?>
	      	</h3>
	  	</div>
	  	<div class="row dashboard_status_table">
	      	<div class="col-12 grid-margin">
	        	<div class="card">
	         	 	<div class="card-body">
	         	 		<h4 class="card-title help_banner"><?php esc_html_e( 'How To Configure', 'staff-manger-lite' ); ?></h4>
	            		<div class="row">
	            			<div class="col-12 inner-banner-sec img-sec">
	            				<p><?php esc_html_e( 'Step 1. Staff manager Lite->Settings->Select TimeZone first.', 'staff-manger-lite' ); ?></p>
	            				<p><?php esc_html_e( 'Step 2. Then configure remaning settings as your requirement and save it.', 'staff-manger-lite' ); ?></p>
	            				<p><?php esc_html_e( 'Step 3. Staff manager Lite->Designation, Create staff designations you need it while staff creation.', 'staff-manger-lite' ); ?></p>
	            				<p><?php esc_html_e( 'Step 4. Staff manager Lite->Shift, Create shifts for your working hours.', 'staff-manger-lite' ); ?></p>
	            				<p><?php esc_html_e( 'Step 5. Staff manager Lite->Staff, Create or Add existing staff to "HR Management lite" plugin.', 'staff-manger-lite' ); ?></p>
	            				<p><?php esc_html_e( 'Step 6. That\'s all.!', 'staff-manger-lite' ); ?></p>
	            				<p><?php esc_html_e( 'You can manage "Email Templates via Staff manager Lite->Notifications as you required so all get proper mail in proper format as you want.', 'staff-manger-lite' ); ?></p>
	            				<p><?php esc_html_e( 'Remaining you can manage Events, Notices, Projects, Tasks and Upcoming Holidays.', 'staff-manger-lite' ); ?></p>
	            			</div>
	            			<div class="col-12 inner-banner-sec img-sec">
	            				<h4 class="card-title help_banner"><?php esc_html_e( 'Shortcode', 'staff-manger-lite' ); ?></h4>
	            				<div class="shortcode_inner">
	            					<p><?php esc_html_e( 'You can use this ', 'staff-manger-lite' ); echo wp_kses_post( '<b>[WPRSMP_LOGIN_FORM]</b> '); esc_html_e( 'for frontend login portal, Employee has to login first to use this. so employee can Office in & Office out from frontend.', 'staff-manger-lite' ); ?></p>
	            				</div>
	            			</div>
	            		</div>
	            	</div>
	            </div>
	        </div>
	    </div>
	</div>
</div>
