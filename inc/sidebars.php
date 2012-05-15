<?php
$sidebar = array(
	'name'           =>   __( 'Primary Sidebar', 'Sandbox' ),
	'id'             =>   "primary",
	'before_widget'  =>   "\n\t\t\t" . '<li id="%1$s" class="widget %2$s">',
	'after_widget'   =>   "\n\t\t\t</li>\n",
	'before_title'   =>   "\n\t\t\t\t". '<h3 class="widgettitle">',
	'after_title'    =>   "</h3>\n"
);
register_sidebar( $sidebar );

$sidebar = array(
	'name'           =>   __( 'Secondary Sidebar', 'Sandbox' ),
	'id'             =>   "secondary",
	'before_widget'  =>   "\n\t\t\t" . '<li id="%1$s" class="widget %2$s">',
	'after_widget'   =>   "\n\t\t\t</li>\n",
	'before_title'   =>   "\n\t\t\t\t". '<h3 class="widgettitle">',
	'after_title'    =>   "</h3>\n"
);
register_sidebar( $sidebar );

$footer_sidebars = get_option('sb_footer_sidebars');

for($i=1;$i<=$footer_sidebars;$i++){
	$sidebar = array(
		'name'           =>   sprintf( __( 'Footer Sidebar %d', 'Sandbox' ), $i ),
		'id'             =>   "footer-$i",
		'before_widget'  =>   "\n\t\t\t" . '<li id="%1$s" class="widget %2$s">',
		'after_widget'   =>   "\n\t\t\t</li>\n",
		'before_title'   =>   "\n\t\t\t\t". '<h3 class="widgettitle">',
		'after_title'    =>   "</h3>\n"    
	);
	register_sidebar( $sidebar );
}

function sandbox_footer_sidebars(){
	$count = get_option('sb_footer_sidebars');
	$class = 'footer-sidebar ';

	switch ( $count ){
		case 1:
			$class .= 'one-column';
			break;
		case 2:
			$class .= 'two-columns';
			break;
		case 3:
			$class .= 'three-columns';
			break;
		case 4:
			$class .= 'four-columns';
			break;
		default:
			return;
	}

	for($i=1;$i<=$count;$i++){
?>
	<aside class="<?php echo $class ?>">
		<ul>
		<?php 
			$id = 'footer-'.$i;
			if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar( $id ) ) :
			endif;
		?>
		</ul>
	</aside>
<?php
		if( $i==$count ){
			echo '<div class="clearfix"></div>';
		}
	}
}
?>