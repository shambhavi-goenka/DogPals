<?php

class place {
    public $placeID;
    public $place;
    public $placeLoc;
    public $lat;
    public $lon;
    public $placeDesc;
    public $placeType;
    public $placeLink;
    public $likes;

    function __construct($placeID, $place, $placeLoc, $lat, $lon, $placeDesc, $placeType, $placeLink, $likes)
    {
        $this->placeID = $placeID;
        $this->place = $place;
        $this->placeLoc = $placeLoc;
        $this->lat = $lat;
        $this->lon = $lon;
        $this->placeDesc = $placeDesc;
        $this->placeType = $placeType;
        $this->placeLink = $placeLink;
        $this->likes = $likes;
    }
    


    /**
     * Get the value of placeID
     */ 
    public function getPlaceID()
    {
        return $this->placeID;
    }

    /**
     * Get the value of place
     */ 
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * Get the value of placeLoc
     */ 
    public function getPlaceLoc()
    {
        return $this->placeLoc;
    }

    /**
     * Get the value of lat
     */ 
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Get the value of lon
     */ 
    public function getLon()
    {
        return $this->lon;
    }

    /**
     * Get the value of placeDesc
     */ 
    public function getPlaceDesc()
    {
            return $this->placeDesc;
    }
    
    /**
     * Get the value of placeType
     */ 
    public function getPlaceType()
    {
        return $this->placeType;
    }
    
    /**
     * Get the value of placeLink
     */ 
    public function getPlaceLink()
    {
        return $this->placeLink;
    }
    
    /**
     * Get the value of likes
     */ 
    public function getLikes()
    {
        return $this->likes;
    }


}
