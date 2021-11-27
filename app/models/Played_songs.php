<?php
namespace app\models;

class Played_songs extends \app\core\Model{
	public $song_id;
	public $user_id;
	public $order;

	public function get($user_id,$song_id,$order){
		$SQL = 'SELECT * FROM played_songs WHERE user_id = :user_id AND song_id=:song_id AND order=:order';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['user_id'=>$this->user_id,'song_id'=>$this->song_id,'order'=>$this->order]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS,'app\\models\\Played_songs');
		return $STMT->fetch();//return the record
	}

	public function insert(){
		$SQL = 'INSERT INTO played_songs(song_id,user_id) VALUES (:song_id,:user_id)';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['user_id'=>$this->user_id,'song_id'=>$this->song_id]);//associative array with key => value pairs
	}
	public function delete($song_id,$user_id,$order){//update an Song record
		$SQL = 'DELETE FROM `played_songs` WHERE song_id =:song_id AND user_id=:user_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['user_id'=>$this->user_id,'song_id'=>$this->song_id,'order'=>$this->order]);//associative array with key => value pairs
	}

}