<?php get_header(); ?>

	<section class="search-page row">

			<?php if ( have_posts() ) : ?>

				<h1 class="hero-title standalone-title">
					<?php printf( __( 'Sökresultat för: "%s"' ), get_search_query() ); ?>
				</h1>

				<div class="search-results">
					<div class="content">
						<?php get_template_part( 'content'); ?>
					</div>
				</div>

			<?php endif ?>

	</section><!-- #primary -->

<?php get_template_part( 'instagram-feed'); ?>
<?php get_footer(); ?>