<?php if ( has_post_thumbnail() && (!is_category()) ): ?>

	<section class="hero-image">
		<?php the_post_thumbnail(); ?>
		<div class="positioner">
			<div class="table row">
				<div class="cell">
					<h1 class="hero-title panel">
						<?php if ( (!is_single()) && (!is_page()) && (!is_home()) || is_front_page()  ) : ?>
							<a href="<?php the_permalink(); ?>">
						<?php endif; ?>

						<?php if ( (!is_home()) && (!is_category()) ) :
							the_title();
						elseif ( (is_home()) ) :
							single_post_title() ;
						else :
							single_cat_title();
						endif ?>

						<?php if ( (!is_single()) && (!is_page()) && (!is_home()) || is_front_page()  ) : ?>
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
			
			<?php if ( (!is_single()) && (!is_page()) && (!is_home()) ) : ?>
				<a href="<?php the_permalink(); ?>">			
			<?php endif ?>

			<?php if ( (!is_home()) && (!is_category()) ) :
				the_title();
			elseif ( (is_home()) ) :
				single_post_title() ;
			else :
				single_cat_title();
			endif ?>

			<?php if ( (!is_single()) && (!is_page()) && (!is_home()) ) : ?>
				</a>
			<?php endif ?>
		</h1>
	</div>

<?php endif;