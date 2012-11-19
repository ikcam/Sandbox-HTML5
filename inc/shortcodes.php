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

	global $settings;

	if( $settings['site_gmaps'] == 0 )
		return __('You need to enable gMaps on your Sandbox settings.', 'sandbox');
	else
		return '
			<script type="text/javascript">
				jQuery(document).ready(function(){
					map = new GMaps({
						div: "#'.$id.'",
						lat: '.$lat.',
						lng: '.$lng.',
						height: "'.$height.'px"
					});'.do_shortcode($content).'});
			</script>
			<div id="'.$id.'" class="gmaps"></div>
		';
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

	return '
		map.drawRoute({
			origin: ['.$origin.'],
			destination: ['.$destination.'],
			travelMode: "'.$travelMode.'",
			strokeColor: "#'.$strokeColor.'",
			strokeOpacity: '.$strokeOpacity.',
			strokeWeight: '.$strokeWeight.'
		});
	';
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

	$output = '
		map.addMarker({
			lat: '.$lat.',
			lng: '.$lng.',
			title: "'.$title.'"';
	if( $content!=NULL ){
		$content = str_replace( "\n", ' ', $content );
		$content = str_replace( "\r", ' ', $content );
		$output.= ',infoWindow: { content: "'.$content.'" }';
	}
	$output .= '});';

	return $output;
}
add_shortcode('gmarker', 'shortcode_gmarker');

// [contact]
function shortcode_contact($atts){
	global $settings;
	$type = 'contact_'.$atts['type'];

	if( in_array('link', $atts) )
		return '<a href="'.$settings[$type].'">'.$settings[$type].'</a>';
	else
		return $settings[$type];
}
add_shortcode( 'contact', 'shortcode_contact' );

// [box]
function shortcode_box($atts, $content=null){
	extract( shortcode_atts( array(
			'title' => false,
			'padding' => 'normal',
			'bg' => false
		) , $atts )
	);

	if( $content == null )
		return null;

	$class = array('box');
	$class[] = $title      == false   ? 'no-header'     : 'with-header';
	$class[] = $bg         == false   ? null            : 'with-bg';
	$class[] = $padding    == 'small' ? 'padding-small' : null;
	$class = implode( ' ', $class );

	$output = '<div class="'.$class.'">';
	if( $title != false )
		$output .= '<div class="box-header">'.$title.'</div>';
	$output .= '<div class="box-content">'.do_shortcode($content).'</div>';
	$output .= '</div>';

	return $output;
}
add_shortcode( 'box', 'shortcode_box' );

function shortcode_tabgroup( $atts, $content ){
	$GLOBALS['tab_count'] = 0;
	do_shortcode( $content );

	if( is_array( $GLOBALS['tabs'] ) ){
		$i=0;
		foreach( $GLOBALS['tabs'] as $tab ){
			$tabs[]  = '<li><a href="#tabs-'.$i.'">'.$tab['title'].'</a></li>';
			$panes[] = '<div id="tabs-'.$i.'">'.do_shortcode($tab['content']).'</div>';
			$i++;
		}
		$return = '<div id="tabs">'."\n".'<ul>'.implode( "\n", $tabs ).'</ul>'."\n".implode( "\n", $panes )."\n".'</div>';
	}

	return $return;
}
add_shortcode( 'tabgroup', 'shortcode_tabgroup' );

function shortcode_tab( $atts, $content ){
	extract(shortcode_atts(array(
		'title' => 'Tab %d'
	), $atts));

	$x = $GLOBALS['tab_count'];
	$GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'content' =>  $content );

	$GLOBALS['tab_count']++;
}
add_shortcode( 'tab', 'shortcode_tab' );

function shortcode_togglergroup( $atts, $content ){
	$output  = '<div id="accordion">';
	$output .= do_shortcode( $content );
	$output .= '</div>';
	
	return $output;
}
add_shortcode( 'togglergroup', 'shortcode_togglergroup' );

function shortcode_toggler( $atts, $content ){
	extract(shortcode_atts(array(
		'title' => 'No title',
		'active' => 'false'
	) , $atts));

	$output  = '<h3>'.$title.'</h3>';
	$output .= "\n";
	$output .= '<div>';
	$output .= do_shortcode( $content );
	$output .= '</div>';

	return $output;
}
add_shortcode( 'toggler', 'shortcode_toggler' );
?>