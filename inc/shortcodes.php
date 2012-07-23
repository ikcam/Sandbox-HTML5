<?php
// [one_half]
function shortcode_one_half($atts, $content=NULL){
	return '<div class="one_half">'.do_shortcode($content).'</div>';
}
add_shortcode('one_half', 'shortcode_one_half');

function shortcode_one_half_last($atts, $content=NULL){
	return '<div class="one_half last">'.do_shortcode($content).'</div><div class="clearfix"></div>';
}
add_shortcode('one_half_last', 'shortcode_one_half_last');

// [one_third]
function shortcode_one_third($atts, $content=NULL){
	return '<div class="one_third">'.do_shortcode($content).'</div>';
}
add_shortcode('one_third', 'shortcode_one_third');

function shortcode_one_third_last($atts, $content=NULL){
	return '<div class="one_third last">'.do_shortcode($content).'</div><div class="clearfix"></div>';
}
add_shortcode('one_third_last', 'shortcode_one_third_last');

// [one_fourth]
function shortcode_one_fourth($atts, $content=NULL){
	return '<div class="one_fourth">'.do_shortcode($content).'</div>';
}
add_shortcode('one_fourth', 'shortcode_one_fourth');

function shortcode_one_fourth_last($atts, $content=NULL){
	return '<div class="one_fourth last">'.do_shortcode($content).'</div><div class="clearfix"></div>';
}
add_shortcode('one_fourth_last', 'shortcode_one_fourth_last');

// [one_fifth]
function shortcode_one_fifth($atts, $content=NULL){
	return '<div class="one_fifth">'.do_shortcode($content).'</div>';
}
add_shortcode('one_fifth', 'shortcode_one_fifth');

function shortcode_one_fifth_last($atts, $content=NULL){
	return '<div class="one_fifth last">'.do_shortcode($content).'</div><div class="clearfix"></div>';
}
add_shortcode('one_fifth_last', 'shortcode_one_fifth_last');

// [one_sixth]
function shortcode_one_sixth($atts, $content=NULL){
	return '<div class="one_sixth">'.do_shortcode($content).'</div>';
}
add_shortcode('one_sixth', 'shortcode_one_sixth');

function shortcode_one_sixth_last($atts, $content=NULL){
	return '<div class="one_sixth last">'.do_shortcode($content).'</div><div class="clearfix"></div>';
}
add_shortcode('one_sixth_last', 'shortcode_one_sixth_last');

// [image]
function shortcode_image($atts, $content=NULL){
	extract( shortcode_atts( array(
			'url' => '',
			'title' => '',
			'align' => 'aligncenter',
			'width' => get_option('sb_image_width'),
			'height' => get_option('sb_image_height'),
		) , $atts)
	);

	$align = esc_attr($align);

	if( $title != '' ){
		$title = esc_attr($title);
	}

	if( $url != '' ){
		$url = esc_attr($url);
	}

	if( get_option('sb_timthumb') == TRUE ){
		$image = get_bloginfo('stylesheet_directory').'/inc/timthumb.php?src='.$content.'&w='.$width.'&h='.$height;
		if( $url != '' ){
			if( $title != '' ) {
				return '<a href="'.$url.'" rel="lightbox"><img src="'.$image.'" class="'.$align.'" width="'.$width.'" height="'.$height.'" title="'.$title.'" /></a>';				
			} else {
				return '<a href="'.$url.'" rel="lightbox"><img src="'.$image.'" class="'.$align.'" width="'.$width.'" height="'.$height.'" /></a>';
			}
		} else {
			if( $title != '' ) {
				return '<img src="'.$image.'" class="'.$align.'" width="'.$width.'" height="'.$height.'" title="'.$title.'" />';
			} else {
				return '<img src="'.$image.'" class="'.$align.'" width="'.$width.'" height="'.$height.'" />';
			}
		}
	} else {
		$image = $content;
		if( $url != '' ){
			return '<a href="'.$url.'"><img src="'.$image.'" class="'.$align.'" width="'.$width.'" height="'.$height.'" title="'.$title.'" /></a>';
		} else {
			return '<img src="'.$image.'" class="'.$align.'" width="'.$width.'" height="'.$height.'" title="'.$title.'" />';
		}
	}
}
add_shortcode('image', 'shortcode_image');

// [is_user]
function shortcode_is_user($atts, $content=NULL){
	$user_id = get_current_user_id();

	if($user_id == 0){
		$content = _e('Login to see this content.', 'Sandbox');
		return $content;
	} else {
		return do_shortcode($content);
	}
}
add_shortcode('is_user', 'shortcode_is_user');

// [is_admin]
function shortcode_is_admin($atts, $content=NULL){
	$user_id = get_current_user_id();
	$user = get_userdata($user_id);
	$user_level = $user->user_level;

	if($user_lever == 10){
		return ;
	} else {
		return do_shortcode($content);
	}
}
add_shortcode('is_admin', 'shortcode_is_admin');

// [gmaps]
function shortcode_gmaps($atts, $content=NULL){
	extract( shortcode_atts( array(
			'class' => 'gMaps',
			'id' => 'gMaps',
			'lat' => -6.599131,
			'lng' => -79.963989,
			'height' => 330
		), $atts ) 
	);

	$jquery = get_option('sb_jquery');
	if( $jquery['gmaps'] == 0 )
		return __('You need to enable gMaps on your Sandbox settings.', 'sandbox');

	return '<script type="text/javascript">jQuery(document).ready(function(){ map = new GMaps({ div: "#'.$id.'", lat: '.$lat.', lng: '.$lng.', height: "'.$height.'px" });'.do_shortcode($content).'});</script><div id="'.$id.'"></div>';
}
add_shortcode('gmaps', 'shortcode_gmaps');
?>