<?php

class PlaceDAO {

    // retrieve places by type from database
    function retrieveByPlaceType($placeType) {

        // connect to database
        $connMgr = new ConnectionManager();
        $conn = $connMgr->connect();

        // prepare insert
        $sql = "SELECT * from places where placeType = :placeType";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":placeType", $placeType, PDO::PARAM_STR);

        // fetch places
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $result = null;
        while($row = $stmt->fetch()){
            $result[] = new Place($row["placeID"], $row["place"], $row["placeLoc"], $row["lat"], $row["lon"],  $row["placeDesc"], $row["placeType"], $row["placeLink"], $row['likes']);
        }
    
        // close connections
        $stmt = null;
        $conn = null;        
        
        return $result;
    }


    // retrieve places from database
    function retrievePlaces() {

        // connect to database
        $connMgr = new ConnectionManager();
        $conn = $connMgr->connect();

        // prepare insert
        $sql = "SELECT * from places";
        $stmt = $conn->prepare($sql);

        // fetch places
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $result = [];
        while($row = $stmt->fetch()){
            $result[] = new Place($row["placeID"], $row["place"], $row["placeLoc"], $row["lat"], $row["lon"], $row["placeDesc"], $row["placeType"], $row["placeLink"], $row['likes']);
        }
    
        // close connections
        $stmt = null;
        $conn = null;        
        
        return $result;
    }
}