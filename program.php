<!DOCTYPE html>
<html>
<head>
	<title>program</title>
	<meta charset="utf-8">
	<meta name="description" content="Welcome to GeoListen! Check the program as often as you'd like to see if the World's Mix Playlist has been updated.">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">


	<style>
		body 
		{
			background: blueviolet;
			background: linear-gradient(225.24deg, #000205 -4.36%, #131518 118.8%);
			text-align: center;
			font-family: 'Noto Sans', sans-serif;
/*			height: 3000px;*/
		}

		p
		{
			color: whitesmoke;
			text-align: center;
			font-size: 2em;

		}

		h1 {
			color: whitesmoke;
			margin-top: 0;
			font-size: 4.5em;
			position: absolute;
			left: 50%;
			top: 35%;
			transform: translate(-50%, -50%);
			width: 80%;
			line-height: 1.5;
		}

		h2
		{
			color: #7289da;
			text-align: center;
			font-size: 3em;

		}

		nav 
		{
 		   margin-left: 75px;
 		   margin-top: 50px;

		}
		nav ul 
		{

  			list-style-type: none;
		}

		nav li 
		{
  			float: left;
		}

		nav li a 
		{
  			display: block;
  			color: white;
  			text-align: center;
  			padding: 14px 16px;
 			text-decoration: none;
 			font-size: 1.5em;
		}

		nav li a:hover 
		{
 			color: #5865F2;
/* 			color: #8684BD;*/

		}

		.row 
    {
      background-color: ghostwhite;
    }
    .highlight {
     background-color: yellow;
    }
    #rtop 
    {
      border-radius: 25px;
      border: 7px solid #7289da;
      padding: 20px;
      min-height: 550px;
    }
    
		.song-item {
			display: flex;
			align-items: center;
			margin-bottom: 50px;
		}
		.song-item img {
			max-width: 400px;
			margin-right: 300px;
		}
		.song-info {
		    text-align: left;
			flex-direction: column;
			font-size: 3em;
			color: whitesmoke;

		}
		.popularity {
			display: none;
		}

	</style>
</head>
<body>

	<nav>
      <ul>
        <li><a href="m2.html">Home</a></li>
      </ul>
    </nav>

    <br>    <br>    <br>

	<div id="rtop">
      	<h2>Top World Music Mix</h2>
      	<br>    <br>    <br>

    <?php
		//Set up the POST data
		$data = array(
		    'grant_type' => 'client_credentials',
		    'client_id' => '_',
		    'client_secret' => 'place API key here'
		);

		// Set up the cURL request
		$ch = curl_init('https://accounts.spotify.com/api/token');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		    'Content-Type: application/x-www-form-urlencoded'
		));

		// Send the request and get the response
		$response = curl_exec($ch);

		// Check for errors and parse the response
		if ($response === false) {
		    echo 'Error: ' . curl_error($ch);
		} else {
		    $json = json_decode($response, true);
		    // echo 'Access token: ' . $json['access_token'];
		    $access_token = $json['access_token'];
		}

		// Clean up
		curl_close($ch);

		$url = "https://api.spotify.com/v1/playlists/0q6c4fBoe3XFqkPgHo01KT/tracks?sort_by=popularity&order=desc";

		$options = array(
		    'http' => array(
		        'header' => "Authorization: Bearer $access_token\r\n"
		    )
		);

		$context = stream_context_create($options);

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer $access_token"));
		$response = curl_exec($ch);
		curl_close($ch);

		$data = json_decode($response, true);

		usort($data['items'], function($a, $b) {
		    $popularity_a = isset($a['track']['popularity']) ? $a['track']['popularity'] : -1;
		    $popularity_b = isset($b['track']['popularity']) ? $b['track']['popularity'] : -1;
		    return $popularity_b - $popularity_a;
		});

		foreach ($data['items'] as $item) {
		    $track = $item['track'];
		    $artist_name = $track['artists'][0]['name'];
		    $release_date = $track['album']['release_date'];
		    $image_url = $track['album']['images'][0]['url'];
		    $song_name = $track['name'];
			$popularity = isset($track['popularity']) ? $track['popularity'] : "N/A";

	?>
		<div class="song-item">
	        <img src="<?php echo $image_url ?>" alt="<?php echo $song_name ?> Album Cover">
	        <div class="song-info">
	            <div class="artist-name"><?php echo $artist_name ?></div>
	            <div class="song-name"><?php echo $song_name ?></div>
	            <div class="release-date">Release Date: <?php echo $release_date ?></div>
	            <div class="popularity">Popularity: <?php echo $popularity ?></div>
	        </div>
	    </div>

	<?php } ?>

  	</div>


</body>
</html>
