<?php
/*
Template Name: Partners
*/
?>

<?php get_header(); ?>

		<?php get_template_part( 'content-hero'); ?>
	  	
	  	<div class="content row">
			<div class="panel medium-8 column">
				<?php
 
						// check if the repeater field has rows of data
						if( have_rows('partners') ):
						 
						 	// loop through the rows of data
						    while ( have_rows('partners') ) : the_row();
						 
						        // display a sub field value
						        the_sub_field('partners_rubrik');




 
														// check if the repeater field has rows of data
														if( have_rows('partners_logosection') ):
														 
														 	// loop through the rows of data
														    while ( have_rows('partners_logosection') ) : the_row();
														 
														        // display a sub field value
														        the_sub_field('partners_logo');
														 
														    endwhile;
														 
														else :
														 
														    // no rows found
														 
														endif;
														 
														
						 
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