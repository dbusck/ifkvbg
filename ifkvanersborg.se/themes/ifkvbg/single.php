<?php get_header(); ?>

		<?php get_template_part( 'content-hero'); ?>
	  	
	  	<div class="content row collapse">
			<div class="medium-8 column">
				<?php get_template_part( 'content'); ?>
			</div>

			<?php get_sidebar('news'); ?>
	  	</div>

<?php get_template_part( 'instagram-feed'); ?>
<?php get_footer(); ?>