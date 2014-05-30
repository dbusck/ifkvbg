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
		foreach ($result->data as $instagram) {
			if(!empty($instagram->caption->text)) {
				echo '<a class="instagram-image" target="blank" href="'.$instagram->link.'">
					<img src="'.$instagram->images->low_resolution->url.'" alt="'.$instagram->caption->text.'" width="100%" height="auto" />
				</a>';
			}
		}
		?>

	</div>
</div>