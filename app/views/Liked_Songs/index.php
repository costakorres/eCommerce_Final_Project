<html>
<head>
	<title>Liked songs</title>
</head>
<body>
	<a href="/Main/index">Back to your page</a>
	<?php

		if($data["result"] != null)
		foreach($data["result"] as $song)
		{
			echo "<tr>
					<td>$song->title</td>
					<td>
						<audio controls>
							<source src='/audio/$song->filename' type='audio/mp3' >
						</audio>
						<td><a href='/Song/details/$song->song_id'>View details</a></td>
					</td>
				</tr>";
		}
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