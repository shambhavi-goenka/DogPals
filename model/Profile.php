<?php

class Profile {
    public $profileid;
    public $username;
    public $fname;
    public $lname;
    public $gender;
    public $birthday;
    public $image_url;

    function __construct($profileid, $username, $fname, $lname, $gender, $birthday, $image_url) {
        $this->profileid = $profileid;
        $this->username = $username;
        $this->fname = $fname;
        $this->lname = $lname;
        $this->gender = $gender;
        $this->birthday = $birthday;
        $this->image_url = $image_url;
    }


    /**
     * Get the value of profileid
     */ 
    public function getProfileid()
    {
        return $this->profileid;
    }

    /**
     * Get the value of username
     */ 
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Get the value of fname
     */ 
    public function getFname()
    {
        return $this->fname;
    }

        /**
         * Get the value of lname
         */ 
        public function getLname()
        {
                return $this->lname;
        }

    /**
     * Get the value of gender
     */ 
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Get the value of birthday
     */ 
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Get the value of image_url
     */ 
    public function getImage_url()
    {
        return $this->image_url;
    }


     /* setter */

    public function setFname($fname)
    {
        $this->fname = $fname;
    }

    public function setLname($lname)
    {
        $this->lname = $lname;
    }


    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    }


    public function setImage_url($image_url) {
        $this->image_url = $image_url;
    }
}
