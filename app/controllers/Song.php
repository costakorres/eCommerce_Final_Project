<?php
namespace app\controllers;

class Song extends \app\core\Controller{
	private $folder='audio/';

	public function index($user_id){
		//implement file uploads

		if(isset($_POST['action'])){
			//get the form data and process it
			if(isset($_FILES['newSong'])){
				$check = filesize($_FILES['newSong']['tmp_name']);

				$mime_type_to_extension = ['audio/wav'=>'.wav',
											'audio/mpeg'=>'.mp3',
											'audio/mp3'=>'.mp3',
											'audio/ogg'=>'.ogg',
											'audio/flac'=>'.flac'
											];

				if($check !== false && isset($mime_type_to_extension[mime_content_type($_FILES['newSong']['tmp_name']) ] )){
					$extension = $mime_type_to_extension[mime_content_type($_FILES['newSong']['tmp_name'])];
				}
				else{
					$song = new \app\models\Song();
					$songs = $song->getAll($user_id);
					$this->view('Song/index', ['error'=>"Bad file type or file missing.". 
						$_FILES['newSong']['tmp_name'],'songs'=>$songs ]);
					return;
				}

				$filename = uniqid().$extension;
				$filepath = $this->folder.$filename;

				/*if($_FILES['newSong']['size'] > 4000000){
					$this->view('Song/index', ['error'=>"File too large",
						'songs'=>[]]);
					return;
				}*/
				if(move_uploaded_file($_FILES['newSong']['tmp_name'], $filepath)){
					$song = new \app\models\Song();
					$song->filename = $filename;
					if(empty($_POST['title']) || empty($_POST['artist']) )
					{
						//if either title or artist are empty, print error and resend request(?).
						$songs = $song->getAll($user_id);
						$this->view('Song/index',['error'=>"Error.Do not leave title or artist empty.",'songs'=>$songs]);
						return;
					}
					$song->title = $_POST['title'];
					$song->artist = $_POST['artist'];
					$song->description = $_POST['description'];
					$song->insert($user_id);
					header('location:/Main/index');
				}
				else
					echo "There was an error";
			}
		}
		else
		{
			//present the form
			$song = new \app\models\Song();
			$songs = $song->getAll($user_id);
			$this->view('Song/index',['error'=>null,'songs'=>$songs]);
		}
	}
}