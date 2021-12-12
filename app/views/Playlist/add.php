<html>
<head><title>Adding song to playlist</title></head>
<body>
<form action="" method='post'>
	<input type='text' name='query' placeholder="Search for song to add"/>
	<input type='submit' name='action' value='Search'/>
</form>

<table>
	<tr><th>Name</th><th>Artist</th><th></th></tr>

<?php

if( isset($data["result"]) )
{
	/**/
	foreach($data["result"] as $song)
	{
		$var = $data["addingQuery"];
		$searchQuery = $data["query"];
		$pid = $data["playlist"]->playlist_id;
	echo "<tr>
			<td>$song->title</td>
			<td>$song->artist</td>
			<td><a href='/Song/details/$song->song_id'>details</a> | 
				<a href='/Liked_songs/like/$song->song_id/$var/$pid'>".(isset($data["liked_songs"][$song->song_id])?"Unlike":"Like")."</a> | 
				<a href='/Playlist/add/$pid/".(empty($searchQuery)?$var:$searchQuery)."/$song->song_id'>".(isset($data["playlist_songs"][$song->song_id])?"remove from playlist":"add to playlist")."</a>
			</td>
		</tr>";
	}
}
?>
</table>
</body>
</html>

