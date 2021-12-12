<html>
<head>
	<title>Liked songs</title>
</head>
<body>
	<a href="/Main/index">Back to your page</a>
	<table>
	<tr><th>Name</th><th>actions</th></tr>
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
						<td><a href='/Liked_Songs/like/$song->song_id'>Remove from liked</a></td>
					</td>
				</tr>";
		}
	?>
</table>
</body>
</html>