<?php if ( has_post_thumbnail() ): ?>
	<section class="hero-image">
		<?php the_post_thumbnail(); ?>
		<div class="positioner">
			<div class="table row">
				<div class="cell">
					<h1 class="hero-title panel">
						<?php if ( (!is_single()) ) : ?>
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
		<h1 class="hero-title standalone-title">
			<?php if ( (!is_single()) && (!is_page()) ) : ?>
				<a href="<?php the_permalink(); ?>">
			<?php endif ?>
				<?php the_title(); ?>
			<?php if ( (!is_single()) && (!is_page()) ) : ?>
				</a>
			<?php endif ?>
		</h1>
	</div>

<?php endif;