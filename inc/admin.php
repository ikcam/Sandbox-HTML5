<?php
class sandbox_admin {
	function settings_register(){
		register_setting( 'sandbox', 'google_analytics' );
		register_setting( 'sandbox', 'facebook_appid', array('sandbox_admin', 'facebook_appid_verify') );
		add_settings_section('sandbox_main', 'Main Settings', 'settings_main_desc', 'sandbox');
	}

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

	function settings_main_desc(){
		echo '<p>First area.</p>';
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
			<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
						<label><?php _e( 'Google Analiytics ID', 'Sandbox' ) ?></label>
					</th>
					<td>
						<input class="regular-text" type="text" name="google_analytics" value="<?php echo get_option('google_analytics'); ?>" />
						<span class="description"><?php _e('Example:', 'Sandbox') ?> UA-12345678-9</span>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label><?php _e( 'Facebook App ID', 'Sandbox' ) ?></label>
					</th>
					<td>
						<input class="regular-text" type="text" name="facebook_appid" value="<?php echo get_option('facebook_appid'); ?>" />
						<span class="description"><?php _e('Example:', 'Sandbox') ?> 123456789012345</span>
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