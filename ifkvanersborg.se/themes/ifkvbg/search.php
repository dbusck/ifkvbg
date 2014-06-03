<?php get_header(); ?>

	<section class="search-page row">

			<?php if ( have_posts() ) : ?>

				<h1 class="hero-title standalone-title">
					<?php printf( __( 'Sökresultat för: "%s"' ), get_search_query() ); ?>
				</h1>

				<div class="search-results">
					<div class="content" id="page-content">
						<?php get_template_part( 'content'); ?>
					</div>
				</div>

			<?php else : ?>
				<hgroup class="hero-title standalone-title text-center">
					<h1>
						Det gick inte att hitta det du sökte efter.
					</h1>
					<h2 class="subheader">
						Testa att söka igen, eller använd menyn för att hitta rätt.
					</h2>
				</hgroup>

				<div class="search-results">
					<?php get_search_form(); ?>
				</div>
			<?php endif ?>

	</section><!-- #primary -->

<?php get_template_part( 'instagram-feed'); ?>
<?php get_footer(); ?>