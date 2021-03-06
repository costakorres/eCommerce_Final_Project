<?php
namespace app\controllers;

class Main extends \app\core\Controller{

#[\app\filters\Login]
	public function index(){

		$myUser = new \app\models\User();
		$myUser = $myUser->getById($_SESSION['user_id']);

		$mySong = new \app\models\Song();
		$results = $mySong->getAll($_SESSION['user_id']);

		$myPlaylist = new \app\models\Playlist();
		$playlists = $myPlaylist->getAll($_SESSION['user_id']);

		$liked_playlists = array();
    $lp = new \app\models\Liked_playlists();
		$temp = new \app\models\Liked_playlists();

		$likedPlaylists = array();

    foreach ($myPlaylist->query("") as $x) 
    {
    	$temp = $lp->get($_SESSION['user_id'],$x->playlist_id);
      if($temp)
  		{
  			$liked_playlists[$x->playlist_id]=$temp;
  			$likedPlaylists[$x->playlist_id]=$myPlaylist->get($x->playlist_id);;
  		}	
    }


		//note: the paths here are not subject to namespacing because these are NOT classes
		$this->view('Main/index',['results'=>$results,'my_user'=>$myUser,"playlists"=>$playlists,"liked_playlists"=>$liked_playlists,"liked"=>$likedPlaylists ]);
	}

	/*
	public function insert(){
		if(isset($_POST['action'])){
			$user = new \app\models\User();
			$user->insert();
			//redirect the user back to the index
			header('location:/Main/index');

		}else //1 present a form to the user
			$this->view('Main/addUser');
	}
	*/

	public function delete($animal_id){//delete a record with the known animal_id PK value
		$animal = new \app\models\Animal;
		$animal->delete($animal_id);
		header('location:/Main/index');
	}

	public function edit($animal_id){//edit a record for te record with known animal_id PK
		$animal = new \app\models\Animal;
		$animal = $animal->get($animal_id);

		if(isset($_POST['action'])){//am i submitting the form?
			//handle the input overwriting the existing properties
			$animal->setSpecies($_POST['species']);
			$animal->setColour($_POST['colour']);
			$animal->update();//call the update SQL
			//redirect after changes
			header('location:/Main/index');
		}else
			$this->view('Main/edit',$animal);
	}

	public function details($animal_id){
		$animal = new \app\models\Animal;
		$animal = $animal->get($animal_id);
		$this->view('Main/details',$animal);
	}


	#[\app\filters\Login]
	public function search($methodQuery=null){ 

		$query="";
        if(isset($_POST['action'])) 
        { 
        	if(empty($_POST['query'] ))
        	{
							header('location:/Main/index');
							return;
        	}
        	$query = ($_POST['query']);
		}
		if(!empty($methodQuery))
		{
			$query = $methodQuery;
		}
        	//first we get all the users with names matching the query
            $user = new \app\models\User(); 
            $users = $user->query($query); // Query the username in the database 

            //this loop is to remove the logged in user from the list if they are included
            for ($i = 0; $i <= sizeof($users) - 1; $i++) {
                  if (($users[$i])->user_id == $_SESSION['user_id']) {
                      unset($users[$i]);
                  }
            }
            //then we get all the songs matching the query
            $song = new \app\models\Song(); 
            $songs = $song->query($query);


             //for all the songs that the query has retrieved, check which ones our user liked 
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

            //then we get all the playlists
						$playlist = new \app\models\Playlist(); 
            $playlists = $playlist->query($query);

            //get liked playlists
            $liked_playlists = array();
            $lp= new \app\models\Liked_playlists();

            foreach ($playlists as $x) 
            {
            	$temp = $lp->get($_SESSION['user_id'],$x->playlist_id);
	            if($temp)
	        		{
	        			$liked_playlists[$x->playlist_id]=$temp;
	        		}	
            }

            $this->view('Main/search', ['users'=>$users,'songs'=>$songs,'playlists'=>$playlists,"query"=>$query,"liked_songs"=>$liked_songs,"liked_playlists"=>$liked_playlists]);      
        
    }
	public function register(){

		if(isset($_POST['action']) && $_POST['password'] == $_POST['password_confirm']){//verify that the user clicked the submit button
			$user = new \app\models\User();
			$user->username = $_POST['username'];
			$user->password = $_POST['password'];
			$user->insert();//password hashing done here
			//redirect the user back to the index
			header('location:/Main/login');

		}else //1 present a form to the user
			$this->view('Main/register');
	}

	
	public function login(){
		//TODO: register session variables to stay logged in
		if(isset($_POST['action'])){//verify that the user clicked the submit button
			$user = new \app\models\User();
			$user = $user->get($_POST['username']);

			if($user!=false && password_verify($_POST['password'], $user->password_hash))
			{
				$_SESSION['user_id'] = $user->user_id;
				$_SESSION['username'] = $user->username;
				header('location:/Main/index');
			}else{
				$this->view('Main/login','Wrong username and password combination!');
			}

		}else //1 present a form to the user
			$this->view('Main/login');
	}


	public function logout(){
		//destroy session variables
		session_destroy();
		header('location:/Main/login');
	}

}