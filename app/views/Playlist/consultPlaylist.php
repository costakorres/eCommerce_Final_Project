<html>
<head>
	<title>Consult Playlist <?php echo $data["playlist_id"]?></title>
</head>
<body>
	<h1>Consult Playlist</h1>
	<a href='/Main/search/<?php if(isset($data["query"])){echo $data["query"];} ?>'>Back to search results</a>

	<table>
	<tr><th>Title</th><th>artist</th><th>Actions</th></tr>
<?php
if( !empty($data["result"]) )
{
	$var = isset($data["query"])?$data["query"]:"";
	foreach($data["result"] as $song)
	{
		echo "<tr>
				<td>$song->title</td>
				<td>$song->artist</td>
				<td><a href='/Song/details/$song->song_id/$var'>details</a> | 
					<audio controls>
						<source src='/audio/$song->filename' type='audio/mp3'>
					</audio></td>
				<td> 
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
</br>


</body>
</html>