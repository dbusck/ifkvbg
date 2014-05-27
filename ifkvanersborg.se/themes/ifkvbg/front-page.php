<?php get_header(); ?>

		<?php if ( has_post_thumbnail() ): ?>
			<section class="hero-image">
				<?php the_post_thumbnail(); ?>
				<div class="positioner">
					<div class="table row">
						<div class="cell">
							<h1 class="hero-title panel"><a href="<?php the_permalink(); ?>"><h1 class="center"><?php the_title(); ?></h1></a></h1>
						</div>
					</div>
				</div>
			</section>
		<?php else : ?>
			<div class="row">
				<h1 class="hero-title standalone-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
			</div>
		<?php endif ?>
	  	
	  	<div class="panels-container">
			<div class="row">

				<div class="panel news-feed medium-6 large-4 column">
					<h4 class="caps">Nyheter</h4>
						<ul class="no-bullet">
							<?php
								$args = array( 'numberposts' => '8' );
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

				<div class="panel twitter-feed medium-6 large-4 column">
					<h4 class="caps">Twitter (<a href="https://twitter.com/IFKVBG_">@IFKVBG_</a>)</h4>
						<!-- LOOP HERE -->
					<div class="curtain"></div>
				</div>

				<a class="panel tickets button large-4 column end text-center">
					<h3>Köp biljett &rarr;</h3>
				</a>

				<div class="panel next-game large-4 column end text-center">
					<h4 class="date caps">Nästa match spelas</h4>
					<h3 class="game-date">4 jun</h3>
					<h5 class="caps">IFK Vänersborg – Villa</h5>
				</div>

			</div>

			<div class="row">
				<div class="panel news-feed medium-6 large-4 column">
					<h4 class="caps">Plommons senaste</h4>
						<!-- LOOP HERE -->
					<div class="curtain"></div>
				</div>

				<a class="panel blurb medium-6 large-8 column end">
					<img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/18.jpg" alt="blurb-image">
				</a>

   		</div>
      </div>

<?php get_footer(); ?>