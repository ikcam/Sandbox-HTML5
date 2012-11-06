<?php
// Theme activation
if ( is_admin() && isset($_GET['activated'] ) && $pagenow == 'themes.php' ) :
	global $settings;
	if( $settings == FALSE ) :
		$settings = array(
				'site_logo'            => '',
				'site_logo_height'     => 100,
				'site_layout'          => 1,
				'footer_layout'        => 1,
				'site_jquery'          => 1,
				'site_jqueryui'        => 1,
				'site_gmaps'           => 0,
				'site_og'              => 0,
				'site_gplus'           => 0,
				'site_fbappid'         => '',
				'site_ga'              => '',
				'excerpt_length'       => 80,
				'excerpt_thumb'        => 0,
				'excerpt_thumb_crop'   => 0,
				'excerpt_thumb_align'  => 1,
				'excerpt_thumb_width'  => 150,
				'excerpt_thumb_height' => 150,
				'excerpt_more'         => 1,
				'comments_pages'       => 0,
				'trackbacks_pages'     => 0,
				'comments_posts'       => 1,
				'trackbacks_posts'     => 1,
				'contact_phone'        => '',
				'contact_facebook'     => '',
				'contact_twitter'      => '',
				'contact_youtube'      => '',
				'contact_yell'         => '',
			);
		add_option( 'sb_settings', $settings);
	endif;
endif;

// Using a class to avoid conflicts with other fuctions
class sandbox_admin {

	function settings_register(){
		register_setting( 'sandbox', 'sb_settings', array( 'sandbox_admin' , 'settings_callback' ) );
	} // Function settings_registers

	function settings_scripts(){
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-button' );
		wp_enqueue_script( 'jquery-ui-slider' );
		wp_enqueue_script( 'media-upload' );
		wp_enqueue_script( 'thickbox' );
		if( isset($_GET['page']) && $_GET['page'] == 'sandbox' )
			wp_enqueue_script( 'sandbox-jquery', get_template_directory_uri().'/inc/javascript/admin.jquery.js', array('jquery') );
		wp_register_style( 'sandbox-css', get_template_directory_uri().'/inc/stylesheet/admin.css' );
		wp_enqueue_style( 'sandbox-css' );
		wp_enqueue_style( 'thickbox' );
	}

	function settings_callback($input){
		// $input['site_layout'];
		// $input['site_ga'];
		// $input['site_fbappid'];
		// $input['site_logo'];
		// $input['site_logo_height'];
		// $input['footer_layout'];
		// $input['excerpt_thumb_align'];
		// $input['contact_phone'];
		// $input['contact_facebook'];
		// $input['contact_twitter'];
		// $input['contact_youtube'];
		// $input['contact_yell'];
		$input['site_og']              = isset( $input['site_og'] )                == true ? 1 : 0;
		$input['site_gplus']           = isset( $input['site_gplus'] )             == true ? 1 : 0;
		$input['site_jquery']          = isset( $input['site_jquery'] )            == true ? 1 : 0;
		$input['site_jqueryui']        = isset( $input['site_jqueryui'] )          == true ? 1 : 0;
		$input['site_gmaps']           = isset( $input['site_gmaps'] )             == true ? 1 : 0;
		$input['comments_posts']       = isset( $input['comments_posts'] )         == true ? 1 : 0;
		$input['comments_pages']       = isset( $input['comments_pages'] )         == true ? 1 : 0;
		$input['trackbacks_posts']     = isset( $input['trackbacks_posts'] )       == true ? 1 : 0;
		$input['trackbacks_pages']     = isset( $input['trackbacks_pages'] )       == true ? 1 : 0;
		$input['excerpt_thumb']        = isset( $input['excerpt_thumb'] )          == true ? 1 : 0;
		$input['excerpt_thumb_crop']   = isset( $input['excerpt_thumb_crop'] )     == true ? 1 : 0;
		$input['excerpt_more']         = isset( $input['excerpt_more'] )           == true ? 1 : 0;
		if ( empty($input['excerpt_lenght']) )       $input['excerpt_lenght']       = 80;
		if ( empty($input['excerpt_thumb_width']) )  $input['excerpt_thumb_width']  = 150;
		if ( empty($input['excerpt_thumb_height']) ) $input['excerpt_thumb_height'] = 150;

		return $input;
	} // Function settings_callback

	// This is the settings page on WordPress Admin Page
	function settings_page(){
		global $settings;
?>
	<div class="wrap">
		<div id="icon-themes" class="icon32"><br></div><h2><?php _e('Theme Settings', 'sandbox') ?></h2>
		<form method="post" action="options.php">
<?php settings_fields('sandbox'); ?>

			<h3><?php _e( 'Main Settings', 'sandbox' ) ?></h3>
			<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><label><?php _e('Current logo', 'sandbox') ?></label></th>
					<td>
<?php if( $settings['site_logo'] == '' ) : ?>
						<img id="current_logo" src="<?php echo get_template_directory_uri() ?>/inc/images/logo_none.png" />
<?php else: ?>
						<img id="current_logo" src="<?php echo $settings['site_logo'] ?>" height="<?php echo $settings['site_logo_height'] ?>" />
<?php endif; ?>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php _e('Upload logo', 'sandbox') ?></th>
					<td>
						<input id="site_logo" type="text" size="36" name="sb_settings[site_logo]" value="<?php echo $settings['site_logo'] ?>" />
						<input id="upload_image_button" type="button" value="<?php _e('Upload Image', 'sandbox') ?>" />
						<br /><?php _e('Enter an URL or upload an image for the banner.', 'sandbox') ?>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><?php _e('Logo height', 'sandbox') ?></th>
					<td>
						<script>
						jQuery(document).ready(function($){
							$( "#slider-site-logo-height" ).slider({
									value: <?php echo $settings['site_logo_height'] ?>,
									min: 1,
									max: 300,
									slide: function( event, ui ) {
										$( "#site-logo-height" ).val( ui.value );
										$( "#current_logo" ).attr( 'height', ui.value );
								}
							});
							$( "#site-logo-height" ).change(function(){
								$( "#slider-site-logo-height" ).slider( "value", this.value );
							})
						});
						</script>
						<div id="slider-site-logo-height"></div>
						<input type="text" name="sb_settings[site_logo_height]" value="<?php echo $settings['site_logo_height'] ?>" id="site-logo-height" />px
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label><?php _e('Site layout', 'sandbox') ?></label></th>
					<td>
						<div id="site-layout">
							<input type="radio" id="site1" name="sb_settings[site_layout]" value="1" <?php if( $settings['site_layout'] == 1 ) {echo 'checked';} ?> /><label for="site1"><img src="<?php echo get_template_directory_uri() ?>/inc/images/layout_1.png" /></label>
							<input type="radio" id="site2" name="sb_settings[site_layout]" value="2" <?php if( $settings['site_layout'] == 2 ) {echo 'checked';} ?> /><label for="site2"><img src="<?php echo get_template_directory_uri() ?>/inc/images/layout_2.png" /></label>
							<input type="radio" id="site3" name="sb_settings[site_layout]" value="3" <?php if( $settings['site_layout'] == 3 ) {echo 'checked';} ?> /><label for="site3"><img src="<?php echo get_template_directory_uri() ?>/inc/images/layout_3.png" /></label>
							<input type="radio" id="site4" name="sb_settings[site_layout]" value="4" <?php if( $settings['site_layout'] == 4 ) {echo 'checked';} ?> /><label for="site4"><img src="<?php echo get_template_directory_uri() ?>/inc/images/layout_4.png" /></label>
							<input type="radio" id="site5" name="sb_settings[site_layout]" value="5" <?php if( $settings['site_layout'] == 5 ) {echo 'checked';} ?> /><label for="site5"><img src="<?php echo get_template_directory_uri() ?>/inc/images/layout_5.png" /></label>
							<input type="radio" id="site6" name="sb_settings[site_layout]" value="6" <?php if( $settings['site_layout'] == 6 ) {echo 'checked';} ?> /><label for="site6"><img src="<?php echo get_template_directory_uri() ?>/inc/images/layout_6.png" /></label>
						</div>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label><?php _e('Footer layout', 'sandbox') ?></label></th>
					<td>
						<div id="footer-layout">
							<input type="radio" id="footer1" name="sb_settings[footer_layout]" value="1" <?php if( $settings['footer_layout'] == 1 ) {echo 'checked';} ?> /><label for="footer1"><img src="<?php echo get_template_directory_uri() ?>/inc/images/footer_1.png" /></label>
							<input type="radio" id="footer2" name="sb_settings[footer_layout]" value="2" <?php if( $settings['footer_layout'] == 2 ) {echo 'checked';} ?> /><label for="footer2"><img src="<?php echo get_template_directory_uri() ?>/inc/images/footer_2.png" /></label>
							<input type="radio" id="footer3" name="sb_settings[footer_layout]" value="3" <?php if( $settings['footer_layout'] == 3 ) {echo 'checked';} ?> /><label for="footer3"><img src="<?php echo get_template_directory_uri() ?>/inc/images/footer_3.png" /></label>
							<input type="radio" id="footer4" name="sb_settings[footer_layout]" value="4" <?php if( $settings['footer_layout'] == 4 ) {echo 'checked';} ?> /><label for="footer4"><img src="<?php echo get_template_directory_uri() ?>/inc/images/footer_4.png" /></label>
							<input type="radio" id="footer5" name="sb_settings[footer_layout]" value="5" <?php if( $settings['footer_layout'] == 5 ) {echo 'checked';} ?> /><label for="footer5"><img src="<?php echo get_template_directory_uri() ?>/inc/images/footer_5.png" /></label>
							<input type="radio" id="footer6" name="sb_settings[footer_layout]" value="6" <?php if( $settings['footer_layout'] == 6 ) {echo 'checked';} ?> /><label for="footer6"><img src="<?php echo get_template_directory_uri() ?>/inc/images/footer_6.png" /></label>
						</div>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label><?php _e('jQuery settings', 'sandbox') ?></label></th>
					<td>
						<input type="checkbox" name="sb_settings[site_jquery]" <?php if( $settings['site_jquery'] == 1 ) {echo 'checked';} ?> /> jQuery<br />
						<input type="checkbox" name="sb_settings[site_jqueryui]" <?php if( $settings['site_jqueryui'] == 1 ) {echo 'checked';} ?> /> jQueryUI <span class="description"><?php _e('Only jQueryUI Core', 'sandbox') ?></span><br />
						<input type="checkbox" name="sb_settings[site_gmaps]" <?php if( $settings['site_gmaps'] == 1 ) {echo 'checked';} ?> /> gMaps
						 <span class="description"><?php _e('Shortcode for gMaps', 'sandbox') ?></span>
					</td>
				</tr>
			</tbody>
			</table>

			<h3><?php _e('Social Settings', 'sandbox') ?></h3>
			<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><label>Facebook OpenGraph</label></th>
					<td>
						<input type="checkbox" name="sb_settings[site_og]" <?php if( $settings['site_og'] == 1 ) {echo 'checked';} ?> />
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label>Google Plus Tags</label></th>
					<td>
						<input type="checkbox" name="sb_settings[site_gplus]" <?php if( $settings['site_gplus'] == 1 ) {echo 'checked';} ?> />
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label>Facebook AppID</label></th>
					<td>
						<input type="text" name="sb_settings[site_fbappid]" value="<?php echo $settings['site_fbappid']; ?>" />
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label>Google Analitycs</label></th>
					<td>
						<input type="text" name="sb_settings[site_ga]" value="<?php echo $settings['site_ga']; ?>" />
					</td>
				</tr>
			</tbody>
			</table>

			<h3><?php _e('Excerpt Settings', 'sandbox') ?></h3>
			<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><label><?php _e('Excerpt length', 'sandbox') ?></label></th>
					<td>
						<input type="number" min="20" name="sb_settings[excerpt_length]" value="<?php echo $settings['excerpt_length'] ?>" />
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label><?php _e('Thumbnail', 'sandbox') ?></label></th>
					<td>
						<input type="checkbox" name="sb_settings[excerpt_thumb]" <?php if( $settings['excerpt_thumb'] == 1 ) {echo 'checked';} ?> />
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label><?php _e('Crop Thumbnail', 'sandbox') ?></label></th>
					<td>
						<input type="checkbox" name="sb_settings[excerpt_thumb_crop]" <?php if( $settings['excerpt_thumb_crop'] == 1 ) {echo 'checked';} ?> />
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label><?php _e('Thumbnail Align', 'sandbox') ?></label></th>
					<td>
						<select name="sb_settings[excerpt_thumb_align]">
							<option value="1" <?php if( $settings['excerpt_thumb_align'] == 1 ) {echo 'selected'; } ?>><?php _e('Align left', 'sandbox') ?></option>
							<option value="2" <?php if( $settings['excerpt_thumb_align'] == 2 ) {echo 'selected'; } ?>><?php _e('Align right', 'sandbox') ?></option>
							<option value="3" <?php if( $settings['excerpt_thumb_align'] == 3 ) {echo 'selected'; } ?>><?php _e('Align center', 'sandbox') ?></option>
							<option value="4" <?php if( $settings['excerpt_thumb_align'] == 4 ) {echo 'selected'; } ?>><?php _e('No align', 'sandbox') ?></option>
						</select>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label><?php _e('Thumbnail Size', 'sandbox') ?></label></th>
					<td>
						<input type="number" min="20" name="sb_settings[excerpt_thumb_width]" value="<?php echo $settings['excerpt_thumb_width'] ?>" /><span class="description"><?php _e('Width', 'sandbox') ?> - <?php _e('Use 999 for unlimited width', 'sandbox') ?></span><br />
						<input type="number" min="20" name="sb_settings[excerpt_thumb_height]" value="<?php echo $settings['excerpt_thumb_height'] ?>" /><span class="description"><?php _e('Height', 'sandbox') ?> - <?php _e('Use 999 for unlimited height', 'sandbox') ?></span>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label><?php _e('Add "Read More" button', 'sandbox') ?></label></th>
					<td>
						<input type="checkbox" name="sb_settings[excerpt_more]" <?php if( $settings['excerpt_more'] == 1 ) {echo 'checked';} ?> />
					</td>
				</tr>
			</tbody>
			</table>

			<h3><?php _e('Comments and Trackbacks', 'sandbox') ?></h3>
			<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><label><?php _e('On Pages?', 'sandbox') ?></label></th>
					<td>
						<input type="checkbox" name="sb_settings[comments_pages]" <?php if( $settings['comments_pages'] == 1 ) {echo 'checked';} ?> />
						<?php _e('Comments', 'sandbox') ?><br />
						<input type="checkbox" name="sb_settings[trackbacks_pages]" <?php if( $settings['trackbacks_pages'] == 1 ) {echo 'checked';} ?> />
						<?php _e('Trackbacks', 'sandbox') ?><br />
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label><?php _e('On Posts?', 'sandbox') ?></label></th>
					<td>
						<input type="checkbox" name="sb_settings[comments_posts]" <?php if( $settings['comments_posts'] == 1 ) {echo 'checked';} ?> />
						<?php _e('Comments', 'sandbox') ?><br />
						<input type="checkbox" name="sb_settings[trackbacks_posts]" <?php if( $settings['trackbacks_posts'] == 1 ) {echo 'checked';} ?> />
						<?php _e('Trackbacks', 'sandbox') ?><br />
					</td>
				</tr>
			</tbody>
			</table>

			<h3><?php _e('Contact Information', 'sandbox') ?></h3>
			<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><label><?php _e('Phone', 'sandbox') ?></label></th>
					<td>
						<input type="text" name="sb_settings[contact_phone]" <?php if( !empty($settings['contact_phone']) ){ echo 'value="'.$settings['contact_phone'].'"'; } ?> />
						<span class="description">Shortcode: [contact type="phone"]</span>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label><?php _e('Facebook URL', 'sandbox') ?></label></th>
					<td>
						<input type="text" name="sb_settings[contact_facebook]" <?php if( !empty($settings['contact_facebook']) ){ echo 'value="'.$settings['contact_facebook'].'"'; } ?> />
						<span class="description">Shortcode: [contact type="facebook"]</span>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label><?php _e('Twitter URL', 'sandbox') ?></label></th>
					<td>
						<input type="text" name="sb_settings[contact_twitter]" <?php if( !empty($settings['contact_twitter']) ){ echo 'value="'.$settings['contact_twitter'].'"'; } ?> />
						<span class="description">Shortcode: [contact type="twitter"]</span>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label><?php _e('YouTube URL', 'sandbox') ?></label></th>
					<td>
						<input type="text" name="sb_settings[contact_youtube]" <?php if( !empty($settings['contact_youtube']) ){ echo 'value="'.$settings['contact_youtube'].'"'; } ?> />
						<span class="description">Shortcode: [contact type="youtube"]</span>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label><?php _e('Yell URL', 'sandbox') ?></label></th>
					<td>
						<input type="text" name="sb_settings[contact_yell]" <?php if( !empty($settings['contact_yell']) ){ echo 'value="'.$settings['contact_yell'].'"'; } ?> />
						<span class="description">Shortcode: [contact type="yell"]</span>
					</td>
				</tr>
			</tbody>
			</table>
			<p class="submit">
				<input type="submit" value="<?php _e('Save Changes', 'sandbox') ?>" class="button-primary" />
			</p>
		</form>
	</div>
<?php
	} // Function settings_page
} // Class sandbox_admin

// Adds the menu element at WordPress admin panel
function sandbox_admin_menu(){
	add_theme_page( __('Theme Settings', 'sandbox'), __('Theme Settings', 'sandbox'), 'administrator', 'sandbox', array('sandbox_admin', 'settings_page') );
	add_action( 'admin_enqueue_scripts', array('sandbox_admin', 'settings_scripts') );
	add_action('admin_init', array('sandbox_admin', 'settings_register'));
}
add_action('admin_menu', 'sandbox_admin_menu');
?>