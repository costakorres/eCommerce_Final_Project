<html>
<head><title>Search results</title></head><body>

<a href="/Main/index">Back to your page</a>

<table>
	<tr><th>Name</th><th>actions</th></tr>
<?php
/*<audio controls>
					<source src='/audio/$song->filename' type='audio/mp3' >
				</audio>
				<td><a href='/Song/details/$song->song_id'>View details</a></td>*/
if($data["users"] != null)
foreach($data["users"] as $user){

$var = $data["query"];

	echo "<tr>
			<td>$user->username</td>
			<td><a href='/Playlist/viewPlaylists/$user->user_id/$var'>Check user's playlists</a></td>
		</tr>";
}

if($data["songs"] != null)
foreach($data["songs"] as $song)
{

	$var = $data["query"];
	echo "<tr>
			<td>$song->title</td>
			<td><a href='/Song/details/$song->song_id'>details</a> | 
				<a href='/Liked_songs/like/$song->song_id/$var'>".(isset($data["liked_songs"][$song->song_id])?"Unlike":"Like")."</a>
			</td>
		</tr>";
}

if($data["playlists"] != null)
foreach($data["playlists"] as $playlist)
{

	$var = $data["query"];
	echo "<tr>
			<td>$playlist->name</td>
			<td><a href='/Playlist/consultPlaylist/$playlist->playlist_id/$var'>Consult playlist</a></td>
		</tr>";
}
?>
</table>
</br>

</body>
</html>