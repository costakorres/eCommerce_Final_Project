<?php
namespace app\models;

class Liked_songs extends \app\core\Model{
	public $song_id;
	public $user_id;
	public $order;//number

	public function get($user_id,$song_id){
		$SQL = 'SELECT * FROM liked_songs WHERE user_id = :user_id AND song_id=:song_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['user_id'=>$user_id,'song_id'=>$song_id]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS,'app\\models\\liked_songs');
		return $STMT->fetch();//return the record
	}
	public function getAll($user_id){
		$SQL = 'SELECT * FROM liked_songs WHERE user_id=:user_id ORDER BY `order` ASC';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['user_id'=>$user_id]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS,'app\\models\\liked_songs');
		return $STMT->fetchAll();
	}

	public function insert(){
		$SQL = 'INSERT INTO liked_songs(`user_id`, `song_id`, `order`) VALUES (:user_id,:song_id,:order)';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['user_id'=>$this->user_id,'song_id'=>$this->song_id,'order'=>$this->order]);//associative array with key => value pairs
	}
	public function delete($song_id,$user_id){//update an Song record
		$SQL = 'DELETE FROM `liked_songs` WHERE song_id =:song_id AND user_id=:user_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['user_id'=>$user_id,'song_id'=>$song_id]);//associative array with key => value pairs
	}
	public function getCount($user_id){
		$SQL = 'SELECT COUNT(*) FROM liked_songs WHERE user_id LIKE :user_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['user_id'=>$user_id]);
		return $STMT->fetchColumn();//return the record
	}
	public function getCountByUser($user_id){
		$SQL = 'SELECT COUNT(*) FROM liked_songs WHERE user_id LIKE :user_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['user_id'=>$user_id]);
		return $STMT->fetchColumn();//return the record
	}

	public function update(){
		$SQL = 'UPDATE `liked_songs` SET `order`=:order WHERE `user_id`=:user_id AND `song_id` = :song_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['user_id'=>$this->user_id,'song_id'=>$this->song_id,'order'=>$this->order]);
	}


}