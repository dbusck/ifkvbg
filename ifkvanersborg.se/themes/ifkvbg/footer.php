<div class="front-page-sponsors sponsors text-center">
	<?php if( have_rows('front-page-sponsors') ):	?>
		<div class="row">
			<?php while ( have_rows('front-page-sponsors') ) : the_row(); ?>
				<div class="sponsor-logo medium-6 large-3 column">
					<img src="<?php the_sub_field('front-page-sponsor-logo'); ?>" alt="sponsor-logo">
				</div>
			<?php endwhile; ?>
		</div>
	<?php endif; ?>
</div>


<?php get_sidebar('footer'); ?>

<!--SCRIPTS-->
<?php wp_footer(); ?>

<script>
	$(document).foundation();
</script>
	  
</body>
</html>