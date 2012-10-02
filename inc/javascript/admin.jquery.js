jQuery(document).ready(function($){
	$( "#site-layout" ).buttonset();
	$( "#footer-layout" ).buttonset();
	$('#upload_image_button').click(function() {
		formfield = $('#site_logo').attr('name');
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
		return false;
	});
 
	window.send_to_editor = function(html) {
		imgurl = $('img',html).attr('src');
		$('#site_logo').val(imgurl);
		$('#current_logo').attr( 'src', imgurl );
		tb_remove();
	}
});