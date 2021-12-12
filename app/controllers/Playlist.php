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
	/*
	public function addSong($song_id,$playlist_id,$query)
	{
		$song = new \app\models\Song();
		$song = $song->get($song_id);
	}*/

	//this function adds and removes to playlists
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
			$playlist->description = "";
			$playlist->insert();
			header('location:/Main/index');

		}
		else //1 present a form to the user
			$this->view('Playlist/make');
	}

	public function add($playlist_id, $song_id=null){

		$myUser = new \app\models\User();
		$myUser = $myUser->getById($_SESSION['user_id']);
	}
}