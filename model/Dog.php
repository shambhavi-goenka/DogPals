<?php

class Dog {
    public $dogid;
    public $username;
    public $name;
    public $gender;
    public $age;
    public $birthday;
    public $breed;
    public $image_url;
    public $personality;
    public $weight;
    public $size;
    public $likes;
    public $fav_places;

    function __construct($dogid, $username, $name, $gender, $age, $birthday, $breed, $image_url, $personality, $weight, $size, $likes, $fav_places) {
        $this->dogid = $dogid;
        $this->username = $username;
        $this->name = $name;
        $this->gender = $gender;
        $this->age = $age;
        $this->birthday = $birthday;
        $this->breed = $breed;
        $this->image_url = $image_url;
        $this->personality = $personality;
        $this->weight = $weight;
        $this->size = $size;
        $this->likes = $likes;
        $this->fav_places = $fav_places;
    }

    
     /**
     * Get the value of ID
     */ 
    public function getID() {
        return $this->id;
    }

     /**
     * Get the value of owner's username
     */ 
    public function getUsername() {
        return $this->username;
    }
    
    /**
     * Get the value of name
     */ 
    public function getName() {
        return $this->name;
    }

    /**
     * Get the value of gender
     */ 
    public function getGender() {
        return $this->gender;
    }


    /**
     * Get the value of age
     */ 
    public function getAge() {
        return $this->age;
    }

    public function getBirthday() {
        return $this->birthday;
    }
    
    /**
     * Get the value of breed
     */ 
    public function getBreed() {
        return $this->breed;
    }

    /**
     * Get the value of img_url
     */ 
    public function getImg_url() {
        return $this->image_url;
    }

    /**
     * Get the value of personality
     */ 
    public function getPersonality() {
        return $this->personality;
    }

    /**
     * Get the value of weight
     */ 
    public function getWeight() {
        return $this->weight;
    }

    /**
     * Get the value of size
     */ 
    public function getSize() {
        return $this->size;
    }


    /**
     * Get the value of bio
     */ 
    public function getLikes() {
        return $this->likes;
    }

    
    /**
     * Get the value of favplace
     */ 
    public function getFavplace() {
        return $this->fav_places;
    }


    /* setter methods */

    public function setName($name) {
        $this->name = $name;
    }

    public function setGender($gender) {
        $this->gender = $gender;
    }

    public function setAge($age) {
        $this->age = $age;
    }

    
    public function setBirthday($birthday) {
        $this->birthday = $birthday;
    }

    public function setBreed($breed) {
        $this->breed = $breed;
    }

    public function setImg_url($image_url) {
        $this->image_url = $image_url;
    }

    public function setPersonality($personality) {
        $this->personality = $personality;
    }

    public function setWeight($weight) {
        $this->weight = $weight;
    }

    public function setLikes($like) {
        $this->likes = $like;
    }

    public function setFavplace($fav_places) {
        $this->fav_places = $fav_places;
    }

}
