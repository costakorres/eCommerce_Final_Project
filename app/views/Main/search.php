<html>
<head><title>Search results</title></head><body>

<a href="/Main/logout">log out</a>

<table>
	<tr><th>Name</th><th>actions</th></tr>
<?php
/*<audio controls>
					<source src='/audio/$song->filename' type='audio/mp3' >
				</audio>
				<td><a href='/Song/details/$song->song_id'>View details</a></td>*/
if($data["users"] != null)
foreach($data["users"] as $user){

	echo "<tr>
			<td>$user->username</td>
			<td>option to check user profile here</td>
		</tr>";
}

if($data["songs"] != null)
foreach($data["songs"] as $song)
{
	echo "<tr>
			<td>$song->title</td>
			<td><a href='/Song/details/$song->song_id'>details</a></td>
		</tr>";
}

if($data["playlists"] != null)
foreach($data["playlists"] as $playlist)
{
	echo "<tr>
			<td>$playlist->name</td>
			<td>option to check playlist here</td>
		</tr>";
}
?>
</table>
</br>

</body>
</html>