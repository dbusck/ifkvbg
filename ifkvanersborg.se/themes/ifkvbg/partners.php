<?php
/*
Template Name: Partners
*/
?>

<?php get_header(); ?>

		<?php get_template_part( 'content-hero'); ?>
	  	
	  	<div class="content row">
			<div class="panel medium-8 column"><?php 

				if( have_rows('partners') ):

				    while ( have_rows('partners') ) : the_row(); ?>
						<h4><?php the_sub_field('partners_rubrik'); ?></h4>
						
						<?php if( have_rows('partners_logosection') ): ?>
							<div class="partner-logo-section">

							<?php while ( have_rows('partners_logosection') ) : the_row(); 
								?><div class="partner-logo inline-block small-6 column"> 
									<img src="<?php the_sub_field('partners_logo'); ?>" alt="logo" />
								</div><?php 
							endwhile; 

							?></div>
						<?php endif;
					endwhile;				 
				endif; ?>

				<?php get_template_part( 'content'); ?>
			</div>
			<?php get_sidebar(); ?>
	  	</div>

<?php get_template_part( 'instagram-feed'); ?>
<?php get_footer(); ?>