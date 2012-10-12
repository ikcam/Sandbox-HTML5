<?php
// [one_half]
function shortcode_one_half($atts, $content=NULL){
	if( is_array( $atts ) ) {
		if ( in_array( 'last', $atts ) )
			return '<div class="one_half last">'.do_shortcode($content).'</div><div class="clearfix"></div>';	
	}
	else
		return '<div class="one_half">'.do_shortcode($content).'</div>';
}
add_shortcode('one_half', 'shortcode_one_half');

// [one_third]
function shortcode_one_third($atts, $content=NULL){
	if( is_array( $atts ) ) {
		if ( in_array( 'last', $atts ) )
			return '<div class="one_third last">'.do_shortcode($content).'</div><div class="clearfix"></div>';
	}
	else
		return '<div class="one_third">'.do_shortcode($content).'</div>';
}
add_shortcode('one_third', 'shortcode_one_third');

// [two_third]
function shortcode_two_third($atts, $content=NULL){
	if( is_array( $atts ) ) {
		if ( in_array( 'last', $atts ) )
			return '<div class="two_third last">'.do_shortcode($content).'</div><div class="clearfix></div>';
	}
	else
		return '<div class="two_third">'.do_shortcode($content).'</div>';
}
add_shortcode('two_third', 'shortcode_two_third');

// [one_fourth]
function shortcode_one_fourth($atts, $content=NULL){
	if( is_array( $atts ) ) {
		if ( in_array( 'last', $atts ) )
		return '<div class="one_fourth last">'.do_shortcode($content).'</div><div class="clearfix"></div>';
	}
	else
		return '<div class="one_fourth">'.do_shortcode($content).'</div>';
}
add_shortcode('one_fourth', 'shortcode_one_fourth');

// [three_fourth]
function shortcode_three_fourth($atts, $content=NULL){
	if( is_array( $atts ) ) {
		if ( in_array( 'last', $atts ) )
			return '<div class="three_fourth last">'.do_shortcode($content).'</div><div class="clearfix"></div>';
	}
	else
		return '<div class="three_fourth">'.do_shortcode($content).'</div>';
}
add_shortcode('three_fourth', 'shortcode_three_fourth');

// [one_fifth]
function shortcode_one_fifth($atts, $content=NULL){
	if( is_array( $atts ) ) {
		if ( in_array( 'last', $atts ) )
			return '<div class="one_fifth last">'.do_shortcode($content).'</div><div class="clearfix"></div>';
	}
	else
		return '<div class="one_fifth">'.do_shortcode($content).'</div>';
}
add_shortcode('one_fifth', 'shortcode_one_fifth');

// [one_sixth]
function shortcode_one_sixth($atts, $content=NULL){
	if( is_array( $atts ) ) {
		if ( in_array( 'last', $atts ) )
			return '<div class="one_sixth la	st">'.do_shortcode($content).'</div><div class="clearfix"></div>';
	}
	else
		return '<div class="one_sixth">'.do_shortcode($content).'</div>';
}
add_shortcode('one_sixth', 'shortcode_one_sixth');

// [is_user]
function shortcode_is_user($atts, $content=NULL){
	$user_id = get_current_user_id();

	if($user_id == 0)
		return ;
	else
		return do_shortcode($content);
}
add_shortcode('is_user', 'shortcode_is_user');

// [is_admin]
function shortcode_is_admin($atts, $content=NULL){
	$user_id = get_current_user_id();
	$user = get_userdata($user_id);
	$user_level = $user->user_level;

	if($user_lever == 10)
		return ;
	else 
		return do_shortcode($content);
}
add_shortcode('is_admin', 'shortcode_is_admin');

// [gmaps]
function shortcode_gmaps($atts, $content=NULL){
			extract( shortcode_atts( array(
			'class' => 'gMaps',
			'id' => 'gMaps',
			'lat' => -12.043333,
			'lng' => -77.028333,
			'height' => 330
		), $atts ) 
	);

	$settings = get_option('sb_settings');

	if( $settings['site_gmaps'] == 0 )
		return __('You need to enable gMaps on your Sandbox settings.', 'sandbox');
	else
		return '<script type="text/javascript">jQuery(document).ready(function(){ map = new GMaps({ div: "#'.$id.'", lat: '.$lat.', lng: '.$lng.', height: "'.$height.'px" });'.do_shortcode($content).'});</script><div id="'.$id.'"></div>';
}
add_shortcode('gmaps', 'shortcode_gmaps');

// [groute]
function shortcode_groute($atts){
	extract( shortcode_atts( array(
			'origin'        => '-12.044012922866312, -77.02470665341184',
			'destination'   => '-12.090814532191756, -77.02271108990476',
			'travelMode'    => 'walking',
			'strokeColor'   => '131540',
			'strokeOpacity' => 0.6,
			'strokeWeight'  => 6
		), $atts ) 
	);

	return 'map.drawRoute({ origin: ['.$origin.'], destination: ['.$destination.'], travelMode: "'.$travelMode.'", strokeColor: "#'.$strokeColor.'", strokeOpacity: '.$strokeOpacity.', strokeWeight: '.$strokeWeight.'  });';
}
add_shortcode('groute', 'shortcode_groute');

// [gmarker]
function shortcode_gmarker($atts, $content=NULL){
	extract( shortcode_atts( array(
			'lat'   => -12.043333,
			'lng'   => -77.028333,
			'title' => 'Marker'
		), $atts ) 
	);

	$output = 'map.addMarker({ lat: '.$lat.', lng: '.$lng.', title: "'.$title.'"';
	if( $content!=NULL )
		$output.= ',infoWindow: { content: "'.$content.'" }';
	$output .= '});';

	return $output;
}
add_shortcode('gmarker', 'shortcode_gmarker');

// [contact]
function shortcode_contact($atts){
	$settings = get_option('sb_settings');
	$type = 'contact_'.$atts['type'];

	if( in_array('link', $atts) )
		return '<a href="'.$settings[$type].'">'.$settings[$type].'</a>';
	else
		return $settings[$type];
}
add_shortcode( 'contact', 'shortcode_contact' );

?>