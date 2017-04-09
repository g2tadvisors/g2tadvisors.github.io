<?php 
if(!empty($_GET['location'])){
	$maps_url = 'https://maps.googleapis.com/maps/api/geocode/json?address='. urlencode($_GET['location']);
	$maps_json = file_get_contents($maps_url);
	$maps_array = json_decode($maps_json,true);
	$lat = $maps_array['results'][0]['geometry']['location']['lat'];
	$lng = $maps_array['results'][0]['geometry']['location']['lng'];
	echo $lat;
	echo $lng;
	$instagram_url = 'https://api.instagram.com/v1/media/search?lat=' . $lat . '&lng=' . $lng .'&client_id=107e1b752951437991959c727039618d'; // NOTE TO SELF, REPLACE XXXXX WITH CLIENT ID ON INSTAGRAM API.
	echo $instagram_url;
	$instagram_json = file_get_contents($instagram_url);
	$instagram_array =json_decode($instagram_json, true);
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form action="">
	<input type ="text" name="location"/>
	<button type ="submit">submit</button>
	<br />
	<?php
	if(!empty($instagram_array)){
		foreach($instagram_array['data'] as $image){
			echo '<img src="' . $image['images']['low_resolution']['url'] . '" alt=""/>';
		}
	}
	?>
</form>
</body>
</html>