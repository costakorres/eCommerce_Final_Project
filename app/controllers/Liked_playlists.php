<?php	

namespace app\controllers;

#[\app\filters\Login]
class Liked_playlists extends \app\core\Controller{
	public function like($playlist_id,$query=null,$isMain=null){

		$myUser = new \app\models\User();
		$myUser = $myUser->getById($_SESSION['user_id']);

		$liked_playlist= new \app\models\Liked_playlists();
		$temp = $liked_playlist->get($_SESSION['user_id'],$playlist_id);

		if(! empty($temp) )//if we had previously liked
		{	//we delete
			$liked_playlist->delete($playlist_id,$_SESSION['user_id']);

			if($isMain)
			{
				header('location:/Main/index');
				return;
			}
			//if were in a query
			if($query)
			{//go back
				header('location:/Main/search/'.$query);
				return;
			}
			
			//if not go home
			header('location:/Main/search');
			
			return;
		}
		$liked_playlist->playlist_id = $playlist_id;
		$liked_playlist->user_id = $_SESSION['user_id'];
		$liked_playlist->order = $liked_playlist->getCountByUser($_SESSION['user_id']) + 1;
		Liked_playlists::refreshLikedPlaylistsOrder($_SESSION['user_id']);
		$liked_playlist->insert();

		//if we are from main
		if($isMain)
			{
				header('location:/Main/index');
				return;
			}

		//if we previously were queried
			if($query)
			{
				header('location:/Main/search/'.$query);
				return;
			}

			header('location:/Main/search');
	}

	public static function refreshLikedPlaylistsOrder($user_id)
	{
		$myUser = new \app\models\User();
		$myUser = $myUser->getById($user_id);

		$liked_playlists = new \app\models\Liked_playlists();
		$count = $liked_playlists->getCountByUser($user_id);
		$liked_playlists = $liked_playlists->getAll($user_id);

		for ($i = 1; $i<=$count; $i++) 
		{
			$liked_playlists[$i-1]->order=$i;
			$liked_playlists[$i-1]->update();           
        }
	
	}

	
}

	