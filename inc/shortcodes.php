<?php
function shortcode_one_half($content=NULL){
	return '<div class="one_half">'.$content.'</div>';
}
add_shortcode('one_half', 'shortcode_one_half');

function shortcode_one_half_last($content=NULL){
	return '<div class="one_half last">'.$content.'</div><div class="clearfix"></div>';
}
add_shortcode('one_half_last', 'shortcode_one_half_last');

function shortcode_one_third($content=NULL){
	return '<div class="one_third">'.$content.'</div>';
}
add_shortcode('one_third', 'shortcode_one_third');

function shortcode_one_third_last($content=NULL){
	return '<div class="one_third last">'.$content.'</div><div class="clearfix"></div>';
}
add_shortcode('one_third_last', 'shortcode_one_third_last');

function shortcode_image($atts, $content=NULL){
	extract( shortcode_atts( array(
			'url' => '',
			'title' => '',
			'align' => 'aligncenter',
			'width' => get_option('sb_image_width'),
			'height' => get_option('sb_image_height')
		) , $atts)
	);

	$align = esc_attr($align);

	if( $title != '' ){
		$title = esc_attr($title);

		if( $url != '' ){
			$url = esc_attr($url);
			$
		}
	}



	if( $url == '' ){
		$image = '<img src="'.$content.'" width="'.$width.'" height="'.$height.'" title="'.$title.'" />';
	} else {
		return '<a href="'.$url.'"><img class="'.$align.'" src="'.$content.'" width="'.$width.'" height="'.$height.'" title="'.$title.'" /></a>';
	}

}
add_shortcode('image', 'shortcode_image');
?>