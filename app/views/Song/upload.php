<html>
<head>
	<title>Song upload</title>
</head>
<body>
	<a href="/Main/index">Back to your page</a>
	<h1>Your Songs</h1>
	<?php
		if($data['error'] != null){
			echo "<p>".$data['error']."</p>";
		}

		foreach($data['songs'] as $song)
			echo "<br><audio controls>
			<source src='/audio/$song->filename' type='audio/mp3'>
			</audio><br>title: ".$song->title
			."<br>artist: ".$song->artist
			."<br>description: ".$song->description;
	?>

	<h1>Upload a new song</h1>
	<form method="post" enctype="multipart/form-data">
	Select an audio file to upload:<input type="file" name="newSong">
	<br>
	Song title: <input type='text' name='title' /><br>
	Song artist: <input type='text' name='artist' /><br>
	description <input type='text' name='description' /><br>
		<input type="submit" name="action">
	</form>

</body>
</html>