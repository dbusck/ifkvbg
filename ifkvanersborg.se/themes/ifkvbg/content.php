<?php // Start the Loop
if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<?php if ( !is_page() ) : ?>
<article class="panel post">
<?php endif ?>				

	<?php if ( !(is_search()) && !(is_single()) && !(is_page()) && has_post_thumbnail() ) : ?>
		<div class="post-header-image">
			<?php the_post_thumbnail(); ?>
		</div>
	<?php endif ?>
	
		<?php if ( (!is_single()) && !(is_page()) ) : ?>
			<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
		<? endif ?>

		<?php if ( (!is_search()) && !(is_page()) ) : ?>
			<div class="meta">
				<p>
					<span class="date caps">
						<?php $time = the_date('l, j F Y', '', '', FALSE);
						echo ucfirst($time);  ?>
					</span>
					<span class="author right caps">Av: <?php the_author_link(); ?></span>
					<span class="tags"><?php the_tags(); ?></span>
				</p>
			</div>
		<?php endif ?>
		
		<?php if ( is_search() ) : // Only display Excerpts for Search
			the_excerpt();
		else : ?>
			<?php the_content();
		endif; ?>

<?php if ( !is_page() ) : ?>
</article>
<?php endif ?>

<?php endwhile; else: ?>
	<div class="content">
		<h3>Det finns tyvärr inget att visa.</h3>
	</div>
<?php endif; // end loop. ?>

<?php if ( is_home() || is_single() && !(is_page()) ) : ?>
	<div class="nav page-nav text-center panel caps">
		<?php posts_nav_link(' &#8211; ', '<i class="fi-arrow-left"></i> Nyare inlägg', 'Äldre inlägg <i class="fi-arrow-right"></i>'); ?>
	</div>
<?php endif ?>