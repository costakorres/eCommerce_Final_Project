<?php
namespace app\models;

class Liked_songs extends \app\core\Model{
	public $song_id;
	public $user_id;
	public $order;//date

	public function get($user_id,$song_id){
		$SQL = 'SELECT * FROM liked_songs WHERE user_id = :user_id AND song_id=:song_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['user_id'=>$this->user_id,'song_id'=>$this->song_id]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS,'app\\models\\liked_songs');
		return $STMT->fetch();//return the record
	}

	public function insert(){
		$SQL = 'INSERT INTO liked_songs(song_id,user_id,order) VALUES (:song_id,:user_id,:order)';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['user_id'=>$this->user_id,'song_id'=>$this->song_id,'order'=>$this->order]);//associative array with key => value pairs
	}
	public function delete($song_id,$user_id){//update an Song record
		$SQL = 'DELETE FROM `liked_songs` WHERE song_id =:song_id AND user_id=:user_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['user_id'=>$this->user_id,'song_id'=>$this->song_id]);//associative array with key => value pairs
	}

}