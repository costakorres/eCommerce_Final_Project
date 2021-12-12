<?php
namespace app\models;

class Playlist_songs extends \app\core\Model{
	public $song_id;
	public $playlist_id;

	public function get($playlist_id,$song_id){
		$SQL = 'SELECT * FROM playlist_songs WHERE playlist_id = :playlist_id AND song_id=:song_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['playlist_id'=>$playlist_id,'song_id'=>$song_id]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS,'app\\models\\Playlist_songs');
		return $STMT->fetch();//return the record
	}
	
	public function getAllFromPlaylist($playlist_id){
		$SQL = 'SELECT * FROM playlist_songs WHERE playlist_id = :playlist_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['playlist_id'=>$playlist_id]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS,'app\\models\\Playlist_songs');
		return $STMT->fetchAll();//return the record
	}

	public function insert(){
		$SQL = 'INSERT INTO playlist_songs(playlist_id,user_id) VALUES (:playlist_id,:user_id)';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['playlist_id'=>$this->playlist_id, 'user_id'=>$this->user_id]);//associative array with key => value pairs
	}
	public function delete($playlist_id,$user_id){//update an Song record
		$SQL = 'DELETE FROM `playlist_songs` WHERE playlist_id = :playlist_id AND song_id=:song_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['playlist_id'=>$playlist_id]);//associative array with key => value pairs
	}

}