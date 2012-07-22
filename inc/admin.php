<?php
// Using a class to avoid conflicts with other fuctions
class sandbox_admin {

	// Register all the settings
	function settings_register(){
		register_setting( 'sandbox', 'sb_google_analytics' );
		register_setting( 'sandbox', 'sb_facebook_appid', array('sandbox_admin', 'facebook_appid_verify') );
		register_setting( 'sandbox', 'sb_google_plus' );
		register_setting( 'sandbox', 'sb_facebook_og' );
		register_setting( 'sandbox', 'sb_website_logo', array( 'sandbox_admin', 'website_logo_verify' ) );
		register_setting( 'sandbox', 'sb_image_width', array( 'sandbox_admin', 'verify_number' ) );
		register_setting( 'sandbox', 'sb_image_height', array( 'sandbox_admin', 'verify_number' ) );
		register_setting( 'sandbox', 'sb_timthumb' );
		register_setting( 'sandbox', 'sb_footer_sidebars', array( 'sandbox_admin', 'footer_sidebars_verify' ) );
		register_setting( 'sandbox', 'sb_jquery' );
		register_setting( 'sandbox', 'sb_jqueryui', array('sandbox_admin', 'jquery_verify') );
		register_setting( 'sandbox', 'sb_comments', array('sandbox_admin', 'comments_verify'));
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
			$logo = esc_attr($logo);
			return $logo;
		}
	}

	// Verify positive value
	function verify_number($input){
		$number = $input;
		if($number < 10 || $number > 1400){
			return 10;
		} else {
			$number = esc_attr($number);
			return $number;
		}
	}

	// Callback for sb_footer_sidebars setting
	function footer_sidebars_verify($input){
		$count = $input;
		if($count<0 || $count>4){
			return 0;
		} else {
			$count = esc_attr($count);
			return $count;
		}
	}

	// Callback for jqueryui setting
	function jquery_verify($input){
		if($input==true){
			update_option( 'sb_jquery', true );
			return true;
		}

	}

	// Callback for comments setting
	function comments_verify($input){

		if( $input['com_posts'] == true )
			$input['com_posts'] = 1;
		else
			$input['com_posts'] = 0;

		if( $input['tra_posts'] == true )
			$input['tra_posts'] = 1;
		else
			$input['tra_posts'] = 0;

		if( $input['com_pages'] == true )
			$input['com_pages'] = 1;
		else
			$input['com_pages'] = 0;

		if( $input['tra_pages'] == true )
			$input['tra_pages'] = 1;
		else
			$input['tra_pages'] = 0;

		return $input;
	}

	// This is the settings page on WordPress Admin Page
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
			<h3><?php _e( 'Main Settings', 'Sandbox' ) ?></h3>
			<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
						<label for="sb_jquery"><?php _e('jQuery inside', 'sandbox') ?> &lt;head&gt;</label>
					</th>
					<td>
						<input type="checkbox" name="sb_jquery" <?php if( get_option('sb_jquery')==true ) { echo 'checked';	 } ?> />
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="sb_jqueryui"><?php _e('jQueryUI inside', 'sandbox') ?> &lt;head&gt;</label>
					</th>
					<td>
						<input type="checkbox" name="sb_jqueryui" <?php if( get_option('sb_jqueryui')==true ) { echo 'checked';	 } ?> />
						<span class="description"><?php _e('Only jQueryUI Core', 'Sandbox') ?></span>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="sb_footer_sidebars"><?php _e('Footer Sidebars', 'sandbox') ?></label>
					</th>
					<td>
						<select name="sb_footer_sidebars">
							<option value="0" <?php if( get_option('sb_footer_sidebars') == 0 ) { echo 'selected'; } ?> >0</option>
							<option value="1" <?php if( get_option('sb_footer_sidebars') == 1 ) { echo 'selected'; } ?> >1</option>
							<option value="2" <?php if( get_option('sb_footer_sidebars') == 2 ) { echo 'selected'; } ?> >2</option>
							<option value="3" <?php if( get_option('sb_footer_sidebars') == 3 ) { echo 'selected'; } ?> >3</option>
							<option value="4" <?php if( get_option('sb_footer_sidebars') == 4 ) { echo 'selected'; } ?> >4</option>
						</select>
					</td>
				</tr>
				<tr valign="top">
					<?php $sb_comments = get_option('sb_comments'); ?>
					<th scope="row">
						<label><?php _e('Enable Comments', 'sandbox') ?></label>
					</th>
					<td>
						<input type="checkbox" name="sb_comments[com_posts]" <?php if($sb_comments['com_posts']==1){ echo 'checked'; } ?> /> <?php _e('on posts?', 'sandbox') ?> <input type="checkbox" name="sb_comments[com_pages]" <?php if($sb_comments['com_pages']==1){ echo 'checked'; } ?> /> <?php _e('on pages?', 'sandbox') ?>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label><?php _e('Enable Trackbacks', 'sandbox') ?></label>
					</th>
					<td>
						<input type="checkbox" name="sb_comments[tra_posts]" <?php if($sb_comments['tra_posts']==1){ echo 'checked'; } ?> /> <?php _e('on posts?', 'sandbox') ?> <input type="checkbox" name="sb_comments[tra_pages]" <?php if($sb_comments['tra_pages']==1){ echo 'checked'; } ?> /> <?php _e('on pages?', 'sandbox') ?>
					</td>
				</tr>
			</tbody>
			</table>
			<h3><?php _e('Google Settings', 'sandbox') ?></h3>
			<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
						<label><?php _e( 'GooglePlus inside &lt;head&gt;', 'Sandbox' ) ?></label>
					</th>
					<td>
						<input type="checkbox" name="sb_google_plus" <?php if( get_option('sb_google_plus')==true ) { echo 'checked';	 } ?> />
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label><?php _e( 'Google Analiytics ID', 'sandbox' ) ?></label>
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

// Adds the menu element at WordPress admin panel
function sandbox_admin_menu(){
	add_menu_page( 'Sandbox', 'Sandbox', 'administrator', 'sandbox', array('sandbox_admin', 'settings_page'), '', 61 );
	add_action('admin_init', array('sandbox_admin', 'settings_register'));
}
add_action('admin_menu', 'sandbox_admin_menu');

?>