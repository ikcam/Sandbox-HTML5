<?php
global $settings;

if( $settings['site_layout'] != 6 ) :
	$sidebar = array(
			'name'           =>   __( 'Primary Sidebar', 'sandbox' ),
			'id'             =>   "primary",
			'before_widget'  =>   "\n\t\t\t" . '<li id="%1$s" class="widget %2$s">',
			'after_widget'   =>   "\n\t\t\t</li>\n",
			'before_title'   =>   "\n\t\t\t\t". '<h3 class="widgettitle">',
			'after_title'    =>   "</h3>\n"
		);
	register_sidebar( $sidebar );

	if( $settings['site_layout'] == 3 || $settings['site_layout'] == 4 || $settings['site_layout'] == 5 ) :
		$sidebar = array(
				'name'           =>   __( 'Secondary Sidebar', 'sandbox' ),
				'id'             =>   "secondary",
				'before_widget'  =>   "\n\t\t\t" . '<li id="%1$s" class="widget %2$s">',
				'after_widget'   =>   "\n\t\t\t</li>\n",
				'before_title'   =>   "\n\t\t\t\t". '<h3 class="widgettitle">',
				'after_title'    =>   "</h3>\n"
			);
		register_sidebar( $sidebar );
	endif; // Site layout: 3, 4, 5
endif; // Site layout: 6

$footer_sidebars = $settings['footer_layout'];
if ( $footer_sidebars == 5 || $footer_sidebars == 6 )
	$footer_sidebars = 2;

for($i=1;$i<=$footer_sidebars;$i++){
	$sidebar = array(
			'name'           =>   sprintf( __( 'Footer Sidebar %d', 'sandbox' ), $i ),
			'id'             =>   "footer-$i",
			'before_widget'  =>   "\n\t\t\t" . '<li id="%1$s" class="widget %2$s">',
			'after_widget'   =>   "\n\t\t\t</li>\n",
			'before_title'   =>   "\n\t\t\t\t". '<h3 class="widgettitle">',
			'after_title'    =>   "</h3>\n"    
		);
	register_sidebar( $sidebar );
}

function sandbox_footer_sidebars(){
	global $settings;
	$layout = $settings['footer_layout'];
	$class = 'footer-sidebar ';

	switch ( $layout ){
		case 1:
			$count = 1;
			$class .= 'one_column';
			break;
		case 2:
			$count = 2;
			$class .= 'one_half';
			break;
		case 3:
			$count = 3;
			$class .= 'one_third';
			break;
		case 4:
			$count = 4;
			$class .= 'one_fourth';
			break;
		case 5:
			$count = 2;
			$class .= 'one_third';
			break;
		case 6:
			$count = 2;
			$class .= 'two_third';
			break;
		default:
			return;
	}

	for( $i=1;$i<=$count;$i++ ) {
		$id = 'footer-'.$i;
		if( $i != $count ) :
?>
			<aside class="<?php echo $class ?>">
				<ul>
				<?php 
					if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar( $id ) ) :
					endif;
				?>
				</ul>
			</aside>
<?php 
		else : 
			if( $layout == 5 )
				$class = "footer-sidebar two_third";
			if( $layout == 6 )
				$class = "footer-sidebar one_third";
?>
			<aside class="<?php echo $class ?> last">
				<ul>
				<?php 
					if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar( $id ) ) :
					endif;
				?>
				</ul>
			</aside>
			<div class="clearfix"></div>
<?php 
		endif;
	}
}
?>