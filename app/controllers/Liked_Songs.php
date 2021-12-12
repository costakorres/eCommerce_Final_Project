<?php	

namespace app\controllers;

#[\app\filters\Login]
class Liked_songs extends \app\core\Controller{
	public function index($user_id=null){

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
		$this->view('Liked_songs/index',['result'=>$result,'my_user'=>$myUser]);
	}

	public function like($song_id,$query){

		$myUser = new \app\models\User();
		$myUser = $myUser->getById($_SESSION['user_id']);

		$liked_song = new \app\models\Liked_songs();
		$temp = $liked_song->get($_SESSION['user_id'],$song_id);

		if(! empty($temp) )
		{	
			$liked_song->delete($song_id,$_SESSION['user_id']);
			if(!empty($query))//if query isnt empty it means we called like from search page
			{
				header('location:/Main/search/'.$query);
				
				return;
			}

		}
		$liked_song->song_id = $song_id;
		$liked_song->user_id = $_SESSION['user_id'];
		$liked_song->order = $liked_song->getCount($song_id) + 1;
		Liked_songs::refreshLikedSongsOrder($_SESSION['user_id']);
		$liked_song->insert();

		if(!empty($query))//if query isnt empty it means we called like from search page
		{
			header('location:/Main/search/'.$query);
			
		}
	}

	public static function refreshLikedSongsOrder($user_id)
	{
		$myUser = new \app\models\User();
		$myUser = $myUser->getById($user_id);

		$liked_songs = new \app\models\Liked_songs();
		$count = $liked_songs->getCountByUser($user_id);
		$liked_songs = $liked_songs->getAll($user_id);

		for ($i = 1; $i<=$count; $i++) 
		{
			$liked_songs[$i-1]->order=$i;
			$liked_songs[$i-1]->update();
                 
        }
	

	}

	
}

	