<?php
/*
Template Name: Spelare
*/
?>

<?php get_header(); ?>

		<?php get_template_part('content-hero'); ?>

		<div class="content row">
			<div class="players panel medium-8 column">
				
				<?php if( have_rows('players') ):
					while ( have_rows('players') ) : the_row(); 
						?><figure class="player inline-block medium-4 column">
							<img src="<?php the_sub_field('player-image'); ?>" alt="player" />
							<figcaption class="player-description">
								<?php the_sub_field('players-info'); ?>
							</figcaption>
						</figure><?php 
					endwhile;
				endif; ?>
				
				<?php get_template_part( 'content'); ?>
			</div>
			<?php get_sidebar(); ?>
	  	</div>

<?php get_template_part( 'instagram-feed'); ?>
<?php get_footer(); ?>