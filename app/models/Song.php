<?php
namespace app\models;

class Song extends \app\core\Model{
	public $title;
	public $artist;
	public $runtime;
	public $filename;
	public $user_id;
	public $description;

	public function __construct(){
		parent::__construct();
		self::$number += 1;
	}

	public function getNumberOfSongs(){
		return self::$number;
	}

	public function setUser_id($user_id){
		$this->user_id = $user_id;
	}
	public function getUser_id(){
		return $user_id;
	}

	public function setTitle($title){
		$this->title = $title;
	}
	public function getTitle(){
		return $this->title;
	}
//just make an array for those.
	public function setArtist($artist){
		$this->colour = $colour;
	}
	public function getArtists($artists){
		return $this->colour;
	}

	public function setRuntime($runtime){
		$this->runtime = $runtime;
	}
	public function getRuntime($runtime){
		return $this->runtime;
	}

	public function setFilename($filename){
		$this->runtime = $runtime;
	}
	public function getFilename($filename){
		return $this->runtime;
	}

	public function setDescription($description){
		$this->runtime = $runtime;
	}
	public function getDescription($description){
		return $this->runtime;
	}
	public function getAll(){
		$SQL = 'SELECT * FROM Song';
		$STMT = self::$_connection->query($SQL);
		$STMT->setFetchMode(\PDO::FETCH_CLASS,'app\\models\\Song');
		return $STMT->fetchAll();//returns an array of all the records
	}
	public function getAll($user_id){
		$SQL = 'SELECT * FROM Song WHERE user_id = :user_id';
		$STMT = self::$_connection->query($SQL);
		$STMT->execute(['user_id'=>$user_id]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS,'app\\models\\Song');
		return $STMT->fetchAll();//returns an array of all the records
	}

	public function get($song_id){
		$SQL = 'SELECT * FROM Song WHERE song_id = :song_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['song_id'=>$song_id]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS,'app\\models\\Song');
		return $STMT->fetch();//return the record
	}

	public function insert(){
		$SQL = 'INSERT INTO Song(title, artist,runtime,filename,user_id,description) VALUES (:title,:artist)';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['title'=>$this->title,'colour'=>$this->colour]);//associative array with key => value pairs
	}

	public function update(){//update an Song record
		$SQL = 'UPDATE `Song` SET `title`=:title,`colour`=:colour WHERE Song_id = :Song_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['title'=>$this->title,'colour'=>$this->colour,'Song_id'=>$this->Song_id]);//associative array with key => value pairs
	}

	public function delete($Song_id){//update an Song record
		$SQL = 'DELETE FROM `Song` WHERE Song_id = :Song_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['Song_id'=>$Song_id]);//associative array with key => value pairs
	}

}