<?php
/*
Template Name: Partners
*/
?>

<?php get_header(); ?>

		<?php get_template_part( 'content-hero'); ?>
	  	
	  	<div class="content row">
			<div class="medium-3 column">
				<?php
 
						// check if the repeater field has rows of data
						if( have_rows('players') ):
						 
						 	// loop through the rows of data
						    while ( have_rows('players') ) : the_row();
						 
						        ?>
						     <img src="<?php the_sub_field('player-image'); ?>" alt="player" />
						      
						      	<?php
						      	 the_sub_field('player-info');
						      	?>
						      
						      		<?php


														 
														
						 
						    endwhile;
						 
						else :
						 
						    // no rows found
						 
						endif;
						 
						?>


				<?php get_template_part( 'content'); ?>
			</div>
			<?php get_sidebar(); ?>
	  	</div>

<?php get_footer(); ?>