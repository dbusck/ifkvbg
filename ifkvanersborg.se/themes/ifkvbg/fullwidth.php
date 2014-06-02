<?php
/*
Template Name: Fullbredd
*/
?>

<?php get_header(); ?>

		<?php get_template_part( 'content-hero'); ?>
	  	
	  	<div class="content row" id="page-content">
			<div class="panel">
				<?php get_template_part( 'content'); ?>
			</div>
	  	</div>

<?php get_template_part( 'instagram-feed'); ?>
<?php get_footer(); ?>