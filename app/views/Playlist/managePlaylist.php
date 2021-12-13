<html>
<head><title>Manage playlist</title>
</head>
<body>
	<h1>Manage playlist</h1>
	<?php
	if( !empty($data["query"]) )
	{
		echo "<a href='/Main/search/".$data["query"]."'>Back to search results</a>";
	}

	?>
	<a href="/Main/index">Back to your page</a>
	<table>
	<tr><th>Name</th><th>actions</th></tr>
<?php

	if($data["songs"] != null)
	{
		
		foreach($data["songs"] as $song)
		{

		$var = $data["myPlaylist"];
		echo "<tr>
				<td>$song->title</td>
				<td><a href='/Song/details/$song->song_id'>details</a> |
					<a href='/Playlist/delete/$var->playlist_id/$song->song_id".(empty($data["query"])?"":"/".$data["query"])."'>delete</a>
				</td>
			</tr>";
		}
	}
	else
	{
		echo "<tr><td>No songs!</td></tr>";
	}

?>

</table>
<a href='/Playlist/add/<?php echo ($data["myPlaylist"]->playlist_id)."/".$data["query"];?>'>Add song </a>
</body>
</html>