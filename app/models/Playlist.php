<?php
namespace app\models;

class Playlist extends \app\core\Model{
	public $name;
	public $description;
	public $user_id;
	public $playlist_id;

	public function setName($name){
		$this->name = $name;
	}

	public function getName(){
		return $this->name;
	}
	
	public function setDescription($description){
		$this->description = $description;
	}

	public function getDescription(){
		return $description->description;
	}	
	
	public function getAll($user_id){
		$SQL = 'SELECT * FROM playlist WHERE `user_id` = :user_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['user_id'=>$user_id]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS,'app\\models\\Playlist');
		return $STMT->fetchAll();//returns an array of all the records
	}

	public function get($playlist_id){
		$SQL = 'SELECT * FROM playlist WHERE playlist_id = :playlist_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['playlist_id'=>$playlist_id]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS,'app\\models\\Playlist');
		return $STMT->fetch();//return the record
	}

	public function insert(){
		$SQL = 'INSERT INTO Playlist(name,description ,user_id) VALUES (:name,:description,:user_id)';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['name'=>$this->name,'description'=>$this->description,'user_id'=>$this->user_id]);
	}

	public function update($playlist_id){
		$SQL = 'UPDATE `Playlist` SET `name`=:name,`description`=:description WHERE playlist_id = :playlist_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['title'=>$this->title,'description'=>$this->description,'playlist_id'=>$this->playlist_id]);
	}

	public function delete($playlist_id){//update an Playlist record
		$SQL = 'DELETE FROM `Playlist` WHERE playlist_id = :playlist_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['playlist_id'=>$playlist_id]);//associative array with key => value pairs
	}
	
	public function query($query){
		$SQL = 'SELECT * FROM Playlist WHERE name LIKE :query';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['query'=>"%$query%"]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS,'app\\models\\Playlist');
		return $STMT->fetchAll();
	}
	public function getCount($user_id){
		$SQL = 'SELECT COUNT(*) FROM playlist WHERE user_id LIKE :user_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['user_id'=>$user_id]);
		return $STMT->fetchColumn();//return the record
	}

}