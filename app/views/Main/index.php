<html>
<head><title>User index</title></head><body>

<a href="/Main/register">Create a new user</a>
<a href="/Main/logout">log out</a>
<a href="/Song/index/<?php echo $data['user_id'];?>">Upload a new song</a>
<table>
	<tr><th>Username</th><th>user_id</th><th>actions</th></tr>
<?php
foreach($data["results"] as $user){

	echo "<tr>
			<td>$user->username</td>
			<td>$user->user_id</td>
			<td>
				<a href='/Main/details/$user->user_id'>details</a> | 
				<a href='/Main/edit/$user->user_id'>edit</a> | 
				<a href='/Main/delete/$user->user_id'>delete</a> |
				<a href='/Vaccine/index/$user->user_id'>vaccination</a>
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