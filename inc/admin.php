<?php
class sandbox_admin {
	function settings_register(){
		register_setting( 'sandbox', 'sb_google_analytics' );
		register_setting( 'sandbox', 'sb_facebook_appid', array('sandbox_admin', 'facebook_appid_verify') );
		register_setting( 'sandbox', 'sb_google_plus' );
		register_setting( 'sandbox', 'sb_facebook_og' );
		register_setting( 'sandbox', 'sb_website_logo', array( 'sandbox_admin', 'website_logo_verify' ) );
		register_setting( 'sandbox', 'sb_image_width', array( 'sandbox_admin', 'verify_number' ) );
		register_setting( 'sandbox', 'sb_image_height', array( 'sandbox_admin', 'verify_number' ) );
		register_setting( 'sandbox', 'sb_timthumb' );
	}

	// Verify Facebook Application ID
	function facebook_appid_verify($input){
		$app_id = $input;
		
		$c = curl_init('http://graph.facebook.com/'.$app_id);
		curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
		$object = curl_exec($c);
		curl_close($c);
		
		$object = json_decode($object);

		if( isset($object->id) ) {
			return $app_id;
		}
	}

	// This kind of force you to add an image to the OpenGraph
	function website_logo_verify($input){
		$logo = $input;
		if ( empty($logo) ) {
			$logo = get_bloginfo('template_directory').'/images/logo.png';
			return $logo;
		} else {
			return $logo;
		}
	}

	// Verify positive value
	function verify_number($input){
		$number = $input;
		if($number < 10 || $number > 1400){
			return 10;
		} else {
			return $number;
		}
	}

	function settings_page(){
	?>
	<div class="wrap">
		<h2><?php _e('Sandbox Settings Page', 'Sandbox') ?></h2>
<?php 
	if( $_GET['settings-updated']==true ){
		$message = __('Settings saved.', 'Sandbox');
?>
			<div id="message" class="updated fade"><p><?php echo $message; ?></p></div>
<?php	}	?>
		<form method="post" action="options.php">
<?php	
	settings_fields('sandbox');
?>
			<h3><?php _e('Google Settings', 'Sandbox') ?></h3>
			<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
						<label><?php _e( 'Google+ inside &lt;head&gt;', 'Sandbox' ) ?></label>
					</th>
					<td>
						<input type="checkbox" name="sb_google_plus" <?php if( get_option('sb_google_plus')==true ) { echo 'checked';	 } ?> />
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label><?php _e( 'Google Analiytics ID', 'Sandbox' ) ?></label>
					</th>
					<td>
						<input class="regular-text" type="text" name="sb_google_analytics" value="<?php echo get_option('sb_google_analytics'); ?>" />
						<span class="description"><?php _e('Example:', 'Sandbox') ?> UA-12345678-9</span>
					</td>
				</tr>
			</tbody>
			</table>

			<h3><?php _e('Facebook OpenGraph Settings', 'Sandbox') ?></h3>
			<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
						<label><?php _e( 'OpenGraph inside &lt;head&gt;', 'Sandbox' ) ?></label>
					</th>
					<td>
						<input type="checkbox" name="sb_facebook_og" <?php if( get_option('sb_facebook_og')==true ) { echo 'checked';	 } ?> />
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label><?php _e( 'Facebook App ID', 'Sandbox' ) ?></label>
					</th>
					<td>
						<input class="regular-text" type="text" name="sb_facebook_appid" value="<?php echo get_option('sb_facebook_appid'); ?>" />
						<span class="description"><?php _e('Example:', 'Sandbox') ?> 123456789012345</span>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label><?php _e( 'Website Logo', 'Sandbox' ) ?></label>
					</th>
					<td>
						<input class="regular-text" type="text" name="sb_website_logo" value="<?php echo get_option('sb_website_logo'); ?>" />
						<span class="description"><?php _e('Only for OpenGraph purposes', 'Sandbox') ?></span>
					</td>
				</tr>
			</tbody>
			</table>

			<h3><?php _e('Shortcode Options', 'Sandbox') ?></h3>
			<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
						<label><?php _e( 'Activate TimThumb?', 'Sandbox' ) ?></label>
					</th>
					<td>
						<input type="checkbox" name="sb_timthumb" <?php if( get_option('sb_timthumb')==true ){ echo 'checked'; } ?> />
						<span class="description"><?php _e('Better image compression. Requires fopen()', 'Sandbox') ?></span>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label><?php _e( 'Default image width', 'Sandbox' ) ?></label>
					</th>
					<td>
						<input type="number" min="10" max="1400" name="sb_image_width" value="<?php echo get_option('sb_image_width'); ?>" />
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label><?php _e( 'Default image height', 'Sandbox' ) ?></label>
					</th>
					<td>
						<input type="number" min="10" max="1400" name="sb_image_height" value="<?php echo get_option('sb_image_height'); ?>" />
					</td>
				</tr>
			</tbody>
			</table>
			<p class="submit">
				<input type="submit" value="<?php _e('Save Changes') ?>" class="button-primary" />
			</p>
		</form>
	</div>
<?php
	}
}
function sandbox_admin_menu(){
	add_menu_page( 'Sandbox', 'Sandbox', 'administrator', 'sandbox', array('sandbox_admin', 'settings_page'), '', 61 );
	add_action('admin_init', array('sandbox_admin', 'settings_register'));
}
add_action('admin_menu', 'sandbox_admin_menu');

?>