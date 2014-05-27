<?php get_header(); ?>

		<section id="content" class="main-title">
		  	<h1 class="center"><?php the_title(); ?></h1>
	  	</section>
	  	
	  	<section class="content">
	  		<div class="center">
				<div class="main-content">
					<?php get_template_part( 'content'); ?>
				</div>
			
				<?php get_sidebar(); ?>
	  		</div>
	  	</section>

<?php get_footer(); ?>