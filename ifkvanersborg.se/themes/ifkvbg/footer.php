<div class="instagram-feed">
	<div class="row panel">
		
		<?php
		ini_set('display_errors', 1);
		error_reporting(E_ALL);


		function fetchData($url){
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_TIMEOUT, 20);
			$result = curl_exec($ch);
			curl_close($ch); 
			return $result;
		}

		$result = fetchData("https://api.instagram.com/v1/users/527121447/media/recent/?client_id=50a52f06b8d64b4cb310aea76098a981&count=6");

		$result = json_decode($result);
		foreach ($result->data as $post) {
			if(empty($post->caption->text)) {
				// Do Nothing
			}
			else {
				echo '<a class="instagram-image" target="blank" href="'.$post->link.'">
					<img src="'.$post->images->low_resolution->url.'" alt="'.$post->caption->text.'" width="100%" height="auto" />
				</a>';
			}
		}
		?>

	</div>
</div>


<!--FOOTER-->
<footer>
	<div class="row">
		<div class="medium-3 column">
			<ul class="no-bullet">
				<li><strong><?php echo get_bloginfo('title'); ?></strong></li>
				<li><a href="#">0521-17274</a></li>
				<li><a href="#">info@ifkvanersborg.se</a></li>
			</ul>
		</div>

		<div class="medium-3 column">
          <ul class="no-bullet">
            <li>Arena Vänersborg</li>
            <li>Brättevägen 15</li>
            <li>462 35 Vänersborg</li>
          </ul>
        </div>

        <div class="medium-3 column">
          <ul class="no-bullet">
            <li><a href="#">Facebook</a></li>
            <li><a href="#">Twitter</a></li>
            <li><a href="#">Instagram</a></li>
          </ul>
        </div>

        <div class="medium-3 column">
          <a href="#" class="left">Till toppen &uarr;</a>
          <img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/ifk_vbglogo_simpel.png" class="logo right" alt="logo">
        </div>

	</div>
</footer>

<!--SCRIPTS-->
<?php wp_footer(); ?>

<script>
	$(document).foundation();
</script>
	  
</body>
</html>