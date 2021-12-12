<html>
<head><title>User index</title></head><body>

<p>Logged in as: <?php echo $data['my_user']->username;?></p>

<a href="/Main/logout">log out</a>
<a href="/Song/upload/<?php echo $data['my_user']->user_id;?>">Upload a new song</a>
<a href="/Liked_songs/index">Liked songs</a>
<form action='/Main/search' method='post'>
	<input type='text' name='query' placeholder="Search for user/song/playlist by name"/>
	<input type='submit' name='action' value='Search'/>
</form>
<h1>Your saved playlists</h1>
<table>
	<tr><th>name</th><th>Description</th><th>Actions</th>
<?php

foreach($data["playlists"] as $p){

	echo "<tr>
			<td>$p->name</td>
			<td>$p->description</td>
			<td><a href='/Playlist/consultPlaylist/$p->playlist_id'>View playlist</a> |
				<a href='/Playlist/addSong/$p->playlist_id'>Modify</a> | 
				<a href='/Playlist/delete/$p->playlist_id'>Delete</a></td>
		</tr>";
}
?>
</table>
</br>



<a href="/Playlist/make">Make new playlist</a>
</body>
</html>