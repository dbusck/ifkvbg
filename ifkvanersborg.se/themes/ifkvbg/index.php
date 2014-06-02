<?php get_header(); ?>

		<?php get_template_part( 'content-hero'); ?>
	  	
	  	<div class="content row" id="page-content">
			<div class="panel large-8 column">
				<?php get_template_part( 'content'); ?>
			</div>
			<?php get_sidebar(); ?>
	  	</div>

<?php get_template_part( 'instagram-feed'); ?>
<?php get_footer(); ?>