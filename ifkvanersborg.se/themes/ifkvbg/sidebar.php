<aside class="sidebar medium-4 column end">
	<a class="panel tickets button text-center">
		<h3>Köp biljett &rarr;</h3>
	</a>
	
	<?php $siblings = wp_list_pages('title_li=&depth=1&child_of='.get_post_top_ancestor_id().'&echo=0');?>
	<?php if ($siblings): ?>

		<nav class="panel widget">
			<h3 class="caps">Läs vidare</h3>
			<ul class="secondary-menu nav nav-list no-bullet">
				<?php echo $siblings ?>
			</ul>
		</nav>

	<?php endif ?>
	
	<?php dynamic_sidebar('default'); ?>
</aside>
