<?php get_header(); ?>

		<section class="hero-image">
	      <img src="images/startsida.jpg" alt="hero">
	      <div class="positioner">
	        <div class="table row">
	          <div class="cell">
	          <h1 class="hero-title panel"><a href="#"><h1 class="center"><?php the_title(); ?></h1></a></h1>
	          </div>
	        </div>
	      </div>
	    </section>
	  	
	  	<div class="row">
			<div class="medium-8 column">
				<?php get_template_part( 'content'); ?>
			</div>
			<div class="medium-4 column">
				<?php get_sidebar(); ?>
			</div>
	  	</div>

<?php get_footer(); ?>