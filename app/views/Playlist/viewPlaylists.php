<html>
<head>
	<title>Playlists</title>
</head>
<body>

<table>
<tr><th>Name</th><th>Description</th><th>Actions</th></tr>
<?php
if( !empty($data["playlists"]) )
{
	foreach($data["playlists"] as $p)
	{
		$var = $data["query"];
		echo "<tr>
				<td>$p->name</td>
				<td>$p->description</td>
				<td><a href='/Playlist/consultPlaylist/$p->playlist_id/$var'>Consult playlist</a></td>
			</tr>";
	}
}
else
{
	echo "No playlists!";
}

?>
</table>

</body>
</html>