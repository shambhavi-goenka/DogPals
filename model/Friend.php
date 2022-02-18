<?php

class Friend {
    public $friendid;
    public $username;
    public $image_url;
    public $dog_name;
    public $friend_username;
    public $friend_image_url;
    public $friend_dog_name;

    function __construct($friendid, $username, $image_url, $dog_name, $friend_username, $friend_image_url, $friend_dog_name) {
        $this->friendid = $friendid;
        $this->username = $username;
        $this->image_url = $image_url;
        $this->dog_name = $dog_name;
        $this->friend_username = $friend_username;
        $this->friend_image_url = $friend_image_url;
        $this->friend_dog_name = $friend_dog_name;
    }

    public function getID() {
        return $this->friendid;
    }

    public function getUsername() {
        return $this->username;
    }
    
    /**
     * Get the value of name
     */ 
    public function getImage_url() {
        return $this->image_url;
    }

    public function getDog_name()
    {
        return $this->dog_name;
    }


    /**
     * Get the value of friend username
     */ 
    public function getFriend_username()
    {
        return $this->friend_username;
    }


    /**
     * Get the value of friend_image_dog
     */ 
    public function getFriend_image_url()
    {
        return $this->friend_image_url;
    }

    public function getFriend_dog_name()
    {
        return $this->friend_dog_name;
    }


}

?>
