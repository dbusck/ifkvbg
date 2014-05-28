<?php get_header(); ?>

		<?php if ( has_post_thumbnail() ): ?>
			<section class="hero-image">
				<?php the_post_thumbnail(); ?>
				<div class="positioner">
					<div class="table row">
						<div class="cell">
							<h1 class="hero-title panel">
								<?php if ( (!is_single()) && !(is_page()) ) : ?>
									<a href="<?php the_permalink(); ?>">
								<?php endif; ?>
									<?php the_title(); ?>
								<?php if ( (!is_single()) ) : ?>
									</a>
								<?php endif; ?>
							</h1>
						</div>
					</div>
				</div>
			</section>
		<?php else : ?>
			<div class="row">
				<h1 class="hero-title standalone-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
			</div>
		<?php endif ?>
	  	
	  	<div class="content row">
			<div class="panel medium-8 column">
				<?php get_template_part( 'content'); ?>
			</div>
			<a class="panel tickets button large-4 column end text-center">
				<h3>Köp biljett &rarr;</h3>
			</a>
			<?php get_sidebar(); ?>
	  	</div>

<?php get_footer(); ?>