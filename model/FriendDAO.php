<?php

class FriendDAO {
    
    // insert friend into database
    function create($friend) {
        
        $result = true;

        // connect to database
        $connMgr = new ConnectionManager();
        $conn = $connMgr->connect();
    
        // prepare insert
        $sql = "INSERT INTO friends (username, image_url, dog_name, friend_username, friend_image_url, friend_dog_name) VALUES (:username, :image_url, :dog_name, :friend_username, :friend_image_url, :friend_dog_name)";
        $stmt = $conn->prepare($sql);
        
        $username = $friend->getUsername();
        $image_url = $friend->getImage_url();
        $dog_name = $friend->getDog_name();
        $friend_username = $friend->getFriend_username();
        $friend_image_url = $friend->getFriend_image_url();
        $friend_dog_name = $friend->getFriend_dog_name();
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':image_url', $image_url, PDO::PARAM_STR);
        $stmt->bindParam(':dog_name', $dog_name, PDO::PARAM_STR);
        $stmt->bindParam(':friend_username', $friend_username, PDO::PARAM_STR);
        $stmt->bindParam(':friend_image_url', $friend_image_url, PDO::PARAM_STR);
        $stmt->bindParam(':friend_dog_name', $friend_dog_name, PDO::PARAM_STR);
        
        $result = $stmt->execute();
        if (! $result ){ // encountered error
            $parameters = [ "user" => $friend, ];
            $connMgr->handleError( $stmt, $sql, $parameters );
        }
        
        
        // close connections
        $stmt = null;
        $conn = null;        
        
        return $result;
    }


    // retrieve friend from database
    function retrieveFriends($username) {

        // connect to database
        $connMgr = new ConnectionManager();
        $conn = $connMgr->connect();

        // prepare insert
        $sql = "Select * from friends where username = :username or friend_username = :username";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);

        // fetch dogs
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $result = null;
        while($row = $stmt->fetch()){
            $result[] = new Friend($row['friendID'],$row['username'], $row["image_url"], $row["dog_name"], $row["friend_username"], $row["friend_image_url"], $row['friend_dog_name']);
        }
    
        // close connections
        $stmt = null;
        $conn = null;        
        
        return $result;
    }


    // check if both username and friend_username exist in database
    function checkIfExists($username, $friend_username) {

        // connect to database
        $connMgr = new ConnectionManager();
        $conn = $connMgr->connect();

        // prepare insert
        $sql = "Select * from friends where (username = :username and friend_username = :friend_username)";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->bindParam(":friend_username", $friend_username, PDO::PARAM_STR);

        // fetch dogs
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $result = null;
        while($row = $stmt->fetch()){
            $result[] = new Friend($row['friendID'],$row['username'], $row["image_url"], $row["dog_name"], $row["friend_username"], $row["friend_image_url"], $row['friend_dog_name']);
        }
    
        // close connections
        $stmt = null;
        $conn = null;        
        
        return $result;
    }
}

?>
