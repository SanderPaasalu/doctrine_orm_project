<?php

namespace App\Entity;

use DateTime;

/**
* @Entity
*/
class Article {
	/**
	* @Column(type="integer")
	* @Id
	* @GeneratedValue
	*/
	private $id;
	/**
	* @Column(type="string")
	*/
	private $name;
	/**
	* @Column(type="string", unique=true)
	*/
	private $slug;
		/**
	* @Column(type="string")
	*/
	private $image;
		/**
	* @Column(type="text")
	*/
	private $body;
		/**
	* @Column(type="datetime")
	*/
	private $published;

	public function getId(){
		return $this->id;
	}
	public function setId($value){
		$this->id = $value;
	}

	public function getName(){
		return $this->name;
	}
	public function setName($value){
		$this->name = $value;
	}
	
	public function getslug(){
		return $this->slug;
	}
	public function setSlug($value){
		$this->slug = $value;
	}
	
	public function getImage(){
		return $this->image;
	}
	public function set($value){
		$this->image = $value;
	}
	
	public function getBody(){
		return $this->body;
	}
	public function setBody($value){
		$this->body = $value;
	}
	
	public function getPublished(){
		return $this->published;
	}
	public function setPublished(DateTime $value = null){
		$this->published = $value;
	}
	
}