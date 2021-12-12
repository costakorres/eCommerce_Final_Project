<html>
<head>
	<title>Song details</title>
</head>
<body>
	<?php
	if( !empty($data["query"]) )
	{
		echo "<a href='/Main/search/".$data["query"]."'>Back to search results</a>";
	}

	?>
	<a href="/Main/index">Back to your page</a>
</br>
	<?php echo 
		"Title: ".$data["song"]->title."</br>".
		"Artist: ".$data["song"]->artist."</br>".
		"Description: ".$data["song"]->description."</br><audio controls>
					<source src='/audio/".$data['song']->filename."' type='audio/mp3'>
				</audio>";?>
		
</body>
</html>