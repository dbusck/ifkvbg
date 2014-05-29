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
						 
						        ?>

						      <h4> 
						      	<?php
						      	 the_sub_field('partners_rubrik');
						      	?>
						      </h4>
						      		<?php




 
														// check if the repeater field has rows of data
														if( have_rows('partners_logosection') ):
														 
														 	// loop through the rows of data
														    while ( have_rows('partners_logosection') ) : the_row(); ?>
																		 
																<div class="small-6 column"> 
																	<img src="<?php the_sub_field('partners_logo'); ?>" alt="logo" />
													 			</div>
														   <?php endwhile;
														 
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