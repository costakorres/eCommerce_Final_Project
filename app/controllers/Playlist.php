<?php
namespace app\controllers;

class Playlist extends \app\core\Controller
{

	public function viewPlaylists($user_id,$query=null)
	{
		$user = new \app\models\User();
		$user = $user->getById($user_id);

		$playlists = new \app\models\Playlist();

		$playlists=$playlists->getAll($user_id);
		$this->view('Playlist/viewPlaylists',["playlists"=>$playlists,"query"=>$query]);
		return;
	}

	public function consultPlaylist($playlist_id,$query=null)
	{

		//get all playlist songs
		$playlist_songs = new \app\models\Playlist_songs();
		$playlist_songs = $playlist_songs->getAllFromPlaylist($playlist_id);

		$result = array();
		//and add them to the result array to transfer later
		foreach($playlist_songs as $ps)
		{
			$song = new \app\models\Song();
			$song = $song->get($ps->song_id);

			$result[]=$song;
		}

		//check if playlist belongs to us
		$playlist = new \app\models\Playlist();
		$temp = $playlist->get($playlist_id);
		//if this playlist belongs to us, we can manage it. if not, we can only consult it.
		if($temp->user_id == $_SESSION["user_id"])
		{
			$this->view('Playlist/managePlaylist',["songs"=>$result, "myPlaylist"=>$temp, "query"=>$query]);
		}
		else
		{
			$this->view('Playlist/consultPlaylist',["playlist_id"=>$playlist_id,"query"=>$query,"result"=>$result]);
		}
	}

	
	public function managePlaylist($playlist_id,$query=null)
	{

		$myPlaylist = new \app\models\Playlist();
		$myPlaylist = $myPlaylist->get($playlist_id);

		$playlist_song = new \app\models\Playlist_songs();
		$playlist_songs = $playlist_song->getAllFromPlaylist($playlist_id);

 		$songs = array();
		$song =  new \app\models\Song();
		foreach($playlist_songs as $ps)
		{
			$songs[]=$song->get($ps->song_id);
		}

		$this->view('Playlist/managePlaylist',["songs"=>$songs, "myPlaylist"=>$myPlaylist, "query"=>$query]);
		return;	
	}
	public function make()
	{

		$myUser = new \app\models\User();
		$myUser = $myUser->getById($_SESSION['user_id']);

		if( isset($_POST['action']) && !empty($_POST['name'])  ) 
		{
			$playlist = new \app\models\Playlist();
			$playlist->name = $_POST['name'];
			$playlist->user_id = $_SESSION['user_id'];
			$playlist->description = $_POST['description'];
			$playlist->insert();
			header('location:/Main/index');

		}
		else //1 present a form to the user
			$this->view('Playlist/make');
	}

	public function delete($playlist_id,$song_id,$query=null)
	{
			$ps = new \app\models\Playlist_songs();
			if($ps->get($playlist_id,$song_id))
			{
				$ps->delete($playlist_id,$song_id);
				
			}
			else
			{
				$ps->playlist_id=$playlist_id;
				$ps->song_id=$song_id;
				$ps->insert();
			}
			header('location:/Playlist/consultPlaylist/'.$playlist_id."/".$query);

	}
	public function deletePlaylist($playlist_id,$query=null)
	{
			$p = new \app\models\Playlist();
			if($p->get($playlist_id))
			{
				$p->delete($playlist_id);
				
			}
			header('location:/Main/index/');

	}
	
	public function add($playlist_id,$query=null,$song_id=null){
		$myUser = new \app\models\User();
		$myUser = $myUser->getById($_SESSION['user_id']);

		$playlist = new \app\models\Playlist();
		$playlist = $playlist->get($playlist_id);

		if($song_id)
		{
			$ps = new \app\models\Playlist_songs();
			if($ps->get($playlist_id,$song_id))
			{
				$ps->delete($playlist_id,$song_id);
				header('location:/Playlist/consultPlaylist/'.$playlist_id);
				return;

			}
			else
			{
				$ps->playlist_id=$playlist_id;
				$ps->song_id=$song_id;
				$ps->insert();
				header('location:/Playlist/consultPlaylist/'.$playlist_id);
				return;
			}
		}

		//has the user seen and used the search bar?
		if(isset($_POST['action']) )
		{
			//get songs that match the query
			$song = new \app\models\Song(); 
        	$songs = $song->query($_POST['query']);

        	//get if we like them or not (to like and dislike)
	        $liked_songs = array();

	        $lk = new \app\models\Liked_songs();
	        $temp = new \app\models\Liked_songs();
	        foreach ($songs as $x) 
	        {
	        	$temp = $lk->get($_SESSION['user_id'],$x->song_id);
	        	if($temp)
	    		{
	    			$liked_songs[$x->song_id]=$temp;
	    		}	
	        }
	        //get all the songs already present in the playlist so we can inform the user
			$ps = new \app\models\Playlist_songs();
			$playlist_songs = array();
			foreach ($songs as $x) 
	        {
	        	$temp = $ps->get($playlist_id,$x->song_id);
	        	if($temp)
	    		{
	    			$playlist_songs[$x->song_id]=$temp;
	    		}	
	        }


	        //if the query parameter is not empty, it means that we were adding songs from main's search results
		    $this->view('Playlist/add',["result"=>$songs,"query"=>$query,"addingQuery"=>$_POST['query'],"liked_songs"=>$liked_songs,"playlist"=>$playlist,"playlist_songs"=>$playlist_songs]);
		}
		else //if not show it to them
		{
			$this->view('Playlist/add',["playlist"=>$playlist,"query"=>$query]);
		}
	}

	// public function modifyPlaylist($playlist_id) {
	// 	$playlist = new \app\models\Playlist();
	// 	$playlist = $playlist->get($playlist_id);
	// 	if(isset($_POST['action'])){
	// 		$playlist->setName($_POST['name']);
	// 		$playlist->setDescription($_POST['description']);
	// 		$playlist->update($playlist_id);
	// 		header('location:/Main/index');
	// 	} else {
	// 		$this->view('Main/modifyPlaylist', $playlist);
	// 	}
	// }

	// public function delete($playlist_id) {
	// 	$playlist = new \app\models\Playlist();
    //     $playlist->delete($playlist_id);
    //     header("Location:/Main/index/");
	// }
}