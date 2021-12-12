<html>
<head><title>Manage playlist</title>
</head>
<body>
	<table>
	<tr><th>Name</th><th>actions</th></tr>
<?php

	if($data["songs"] != null)
	{
		foreach($data["songs"] as $song)
		{

		$var = $data["myPaylist"];
		echo "<tr>
				<td>$song->title</td>
				<td><a href='/Song/details/$song->song_id'>details</a> |
					<a href='/Playlist/delete/$var->playlist_id/$song->song_id'>delete</a>
				</td>
			</tr>";
		}
	}
	else
	{
		echo "No songs!";
	}

?>

</table>
<a href='/Playlist/add/<?php echo $data["myPaylist"]->$playlist_id?>'>Add song</a>
</body>
</html>