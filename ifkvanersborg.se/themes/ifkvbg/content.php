<?php // Start the Loop
if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<?php if ( !is_page() ) { ?>
<article class="post">
<?php } ?>				

	<?php if ( !(is_search()) && has_post_thumbnail() ) { ?>
		<div class="main-content-header">
			<?php the_post_thumbnail(); ?>
		</div>
	<?php }; ?>
	
		<?php if ( (!is_single()) && !(is_page()) ) : ?>
			<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
		<? endif ?>
		
		<?php if ( is_search() ) : // Only display Excerpts for Search
			the_excerpt();
		else : ?>
			<h2><?php the_title(); ?></h2>
			<?php the_content();
		endif; ?>
		
	<?php if ( (!is_search()) && !(is_page()) ) : ?>
	<div class="meta"><p><span>
		<?php $time = the_date('l, j F Y', '', '', FALSE);
		echo ucfirst($time);  ?>
		</span>
		<span class="tags"><?php the_tags(); ?></span></p>
	</div>
	<?php endif ?>
<?php if ( !is_page() ) { ?>
</article>
<?php }; ?>

<?php endwhile; else: ?>
	<div class="main-content">
		<h3>Inget tyvärr inget att visa.</h3>
	</div>
<?php endif; // end loop. ?>

<div class="nav page-nav">
	<?php posts_nav_link(' &#8211; ', '&#171; Föregående sida', 'Nästa sida &#187;'); ?>
</div>