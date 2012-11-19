/*!
 * Sandbox.jquery.js v0.2
 * http://github.com/ikcam/Sandbox-HTML5
 *
 * Copyright 2012, Irving Kcam
 * Released under a GPL2 License.
 */

jQuery(document).ready(function($){
	$('#tabs').each(function(){
		$(this).tabs();
	});

	$('#accordion').each(function(){
		$(this).accordion({
			collapsible: true
		});
	});
});