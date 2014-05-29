<?php get_header(); ?>

		<?php
			$posts = get_posts(
				array(
					'numberposts' => 1,
					'meta_query' => array(
						array(
							'key' => 'important_news',
							'value' => '1',
							'compare' => '=='
						)
					)
				)
			); 
			if( $posts ) :

				foreach( $posts as $post ) :
					setup_postdata( $post );
					get_template_part( 'content-hero');
				endforeach;
				wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly	

			endif; ?>


	  	<div class="panels-container">
			<div class="row">

				
				<div class="panel news-feed medium-6 large-4 column">
					<h4 class="caps">Nyheter</h4>
						<ul class="no-bullet">
							<?php
								$args = array( 'numberposts' => '7', 'category__not_in' => 4, );
								$recent_posts = wp_get_recent_posts( $args );
								foreach( $recent_posts as $recent ){
									echo '<li class="row news-entry"><span class="date caps medium-3 column">'.esc_attr(mysql2date('j M', $recent["post_date"])).'</span>
										<a href="' . get_permalink($recent["ID"]) . '" title="'.esc_attr($recent["post_title"]).'" class="post-title medium-9 column">' .   $recent["post_title"].'</a>
									</li> ';
								}
							?>
						</ul>
					<div class="curtain"></div>
				</div>

				<div class="panel news-feed medium-6 large-4 column">
					<h4 class="caps">Twitter (<a href="https://twitter.com/search?q=%23ifkvaenersborg&src=tyah">@IFKVBG_</a>)</h4>
						<ul class="no-bullet">
							<?php the_widget( 'Latest_Tweets_Widget', 'title=&screen_name=IFKVBG_', 'before_title=&after_title='); ?>
						</ul>
					<div class="curtain"></div>
				</div>
				
				<a href="<?php the_field('biljettkopslank'); ?>" class="panel tickets button large-4 column end text-center">
					<h3><?php the_field('biljettkopstext'); ?></h3>
				</a>

				<div class="panel next-game large-4 column end text-center">
					<h4 class="caps">Nästa match spelas</h4>
					<h3 class="game-date">4 jun</h3>
					<h5 class="caps">IFK Vänersborg – Villa</h5>
				</div>

			</div>

			<div class="row">
				<div class="panel news-feed medium-6 large-4 column">
					<h4 class="caps">Plommons senaste</h4>
						<ul class="no-bullet">
							<?php
								$args = array( 'numberposts' => '7', 'category' => 4, );
								$recent_posts = wp_get_recent_posts( $args );
								foreach( $recent_posts as $recent ){
									echo '<li class="row news-entry"><span class="date caps medium-3 column">'.esc_attr(mysql2date('j M', $recent["post_date"])).'</span>
										<a href="' . get_permalink($recent["ID"]) . '" title="'.esc_attr($recent["post_title"]).'" class="post-title medium-9 column">' .   $recent["post_title"].'</a>
									</li> ';
								}
							?>
						</ul>
					<div class="curtain"></div>
				</div>

				<a href="<?php the_field('image_blurb_link'); ?>" class="panel blurb medium-6 large-8 column end">
					<img src="<?php the_field('image_blurb_big'); ?>" alt="blurb-image">
					<div class="positioner">
						<div class="table">
							<div class="cell text-center">
								<h3 class="panel"><?php the_field('image_blurb_text'); ?></h3>
							</div>
						</div>
					</div>
				</a>

   		</div>

   		<?php if( have_rows('partners_logosection') ):	?>
				<div class="logo-section">		

					<?php	while ( have_rows('partners_logosection') ) : the_row(); ?>							 
						<div class="small-6 column"> 
							<img src="<?php the_sub_field('partners_logo'); ?>" alt="logo" />
			 			</div>
				   <?php endwhile; ?>

			   </div>
			<?php endif; ?>


			<?php if( have_rows('front-page-blurbs') ):	?>
				<div class="row">
	   			<?php	while ( have_rows('front-page-blurbs') ) : the_row(); ?>
	   				<a href="<?php the_sub_field('front-page-blurb-link'); ?>" class="panel blurb medium-6 large-4 column end">
							<img src="<?php the_sub_field('front-page-blurb-image'); ?>" alt="blurb-image">
							<div class="positioner">
								<?php if (the_sub_field('front-page-blurb-text')) : ?>
									<div class="table">
										<div class="cell text-center">
											<h3 class="panel"><?php the_sub_field('front-page-blurb-text'); ?></h3>
										</div>
									</div>
								<?php endif ?>
							</div>
						</a>
					<?php endwhile; ?>
   			</div>
   		<?php endif; ?>
      </div>

<?php get_footer(); ?>