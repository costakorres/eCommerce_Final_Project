<?php
namespace app\models;

class Liked_playlists extends \app\core\Model{
	public $playlist_id;
	public $user_id;
	public $order;//date

	public function get($user_id,$playlist_id){
		$SQL = 'SELECT * FROM liked_playlists WHERE user_id = :user_id AND playlist_id=:playlist_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['user_id'=>$user_id,'playlist_id'=>$playlist_id]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS,'app\\models\\liked_playlists');
		return $STMT->fetch();//return the record
	}
	public function getAll($user_id){
		$SQL = 'SELECT * FROM liked_playlists WHERE user_id=:user_id ORDER BY `order` ASC';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['user_id'=>$user_id]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS,'app\\models\\liked_playlists');
		return $STMT->fetchAll();
	}

	public function insert(){
		$SQL = 'INSERT INTO liked_playlists(`user_id`, `playlist_id`, `order`) VALUES (:user_id,:playlist_id,:order)';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['user_id'=>$this->user_id,'playlist_id'=>$this->playlist_id,'order'=>$this->order]);//associative array with key => value pairs
	}
	public function getCountByUser($user_id){
		$SQL = 'SELECT COUNT(*) FROM liked_playlists WHERE user_id LIKE :user_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['user_id'=>$user_id]);
		return $STMT->fetchColumn();//return the record
	}
	public function delete($playlist_id,$user_id){
		$SQL = 'DELETE FROM `liked_playlists` WHERE playlist_id =:playlist_id AND user_id=:user_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['user_id'=>$user_id,'playlist_id'=>$playlist_id]);
	}
	public function update(){
		$SQL = 'UPDATE `liked_playlists` SET `order`=:order WHERE `user_id`=:user_id AND `playlist_id` = :playlist_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['user_id'=>$this->user_id,'playlist_id'=>$this->playlist_id,'order'=>$this->order]);
	}

}