<div class="instagram-feed">
	<div class="row panel">
		
		<?php

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
			if(!empty($post->caption->text)) {
				echo '<a class="instagram-image" target="blank" href="'.$post->link.'">
					<img src="'.$post->images->low_resolution->url.'" alt="'.$post->caption->text.'" width="100%" height="auto" />
				</a>';
			}
		}
		?>

	</div>
</div>