<?php	

namespace app\controllers;

class LikedSongs extends \app\core\Controller{
	public function index($user_id){

		$myUser = new \app\models\User();
		$myUser = $myUser->getById($_SESSION['user_id']);

		$liked_songs = new \app\models\Liked_songs();
		$liked_songs = $liked_songs->getAll($_SESSION['user_id']);
		$result = array();

		foreach($liked_songs as $lk){
			$song = new \app\models\Song();
			$song = $song->get($lk->song_id);

			$result[]=$song;
		}

		//note: the paths here are not subject to namespacing because these are NOT classes
		$this->view('Liked_songs',['$result'=>$result,'my_user'=>$myUser]);
	}
	}

	