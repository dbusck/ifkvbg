<!--FOOTER-->
<footer>
<img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/logotype_med.png"  class="logo" width="65" height="57" alt="Time Häggvall" />
<span class="copy"><?php echo get_bloginfo('title') . ', ' . get_bloginfo('description'); ?></span>
</footer>

	<!--SCRIPTS-->
	<?php wp_footer(); ?>
	<script src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/vendor/jquery.js"></script>
	<script src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/min/foundation.min.js"></script>
	<script>
		$(document).foundation();
	</script>
	  
</body>
</html>