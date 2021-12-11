<html>
<head><title>User index</title></head><body>

<p>Logged in as: <?php echo $data['my_user']->username;?></p>

<a href="/Main/logout">log out</a>
<a href="/Song/upload/<?php echo $data['my_user']->user_id;?>">Upload a new song</a>
<a href="/LikedSongs/index">Liked songs</a>
<table>
	<tr><th>Title</th><th>Artist</th><th>Details</th><th>Actions</th>
<?php
foreach($data["results"] as $song){

	echo "<tr>
			<td>$song->title</td>
			<td>$song->artist</td>
			<td><a href='/Song/details/$song->song_id'>details</a></td>
			<td> 
				<a href='/Main/edit/$song->song_id'>edit</a> | 
				<a href='/Main/delete/$song->song_id'>delete</a>
			</td>
		</tr>";
}
?>
</table>
</br>


<form action='/Main/search' method='post'>
	<input type='text' name='query' placeholder="Search for user/song/playlist by name"/>
	<input type='submit' name='action' value='Search'/>
</form>
</body>
</html>