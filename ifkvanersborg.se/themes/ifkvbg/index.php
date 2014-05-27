<?php get_header(); ?>

		<?php if ( has_post_thumbnail() ): ?>
			<section class="hero-image">
				<?php the_post_thumbnail(); ?>
				<div class="positioner">
					<div class="table row">
						<div class="cell">
							<h1 class="hero-title panel"><a href="<?php the_permalink(); ?>"><h1 class="center"><?php the_title(); ?></h1></a></h1>
						</div>
					</div>
				</div>
			</section>
		<?php else : ?>
			<div class="row">
				<h1 class="hero-title standalone-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
			</div>
		<?php endif ?>
	  	
	  	<div class="row">
			<div class="panel medium-8 column">
				<?php get_template_part( 'content'); ?>
			</div>
			<div class="panel medium-4 column">
				<?php get_sidebar(); ?>
			</div>
	  	</div>

<?php get_footer(); ?>