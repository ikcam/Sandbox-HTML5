<?php global $settings; ?>
	<footer id="footer">
		<?php sandbox_footer_sidebars() ?>

		<span id="generator-link"><a href="http://wordpress.org/" title="<?php _e( 'WordPress', 'sandbox' ) ?>" rel="generator">WordPress</a></span>
		<span class="meta-sep">|</span>
		<span id="theme-link"><a href="https://github.com/ikcam/Sandbox-HTML5" title="<?php _e( 'Sandbox theme for WordPress', 'sandbox' ) ?>" rel="designer">Sandbox</a></span>
		<?php wp_footer() ?>
	</footer><!-- #footer -->

</section><!-- #wrapper .hfeed -->

<?php if( $settings['site_ga'] != '' ) : ?>
<script>
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '<?php echo $settings["site_ga"] ?>']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
<?php endif; ?>
</body>
</html>