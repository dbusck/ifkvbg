<?php get_header(); ?>

	<section class="content search-page panel row">

			<?php if ( have_posts() ) : ?>

			<h1 class="hero-title standalone-title">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?><?php printf( __( 'Sökresultat för: %s' ), get_search_query() ); ?></a>
			</h1>

			<div class="panel">
				<?php get_template_part( 'content'); ?>
			</div>

	</section><!-- #primary -->

<?php get_footer(); ?>