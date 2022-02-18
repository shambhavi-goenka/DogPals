<?php

class DogDAO {
    
    // insert dog into database  
    function create($dog) {
        $result = true;

        // connect to database
        $connMgr = new ConnectionManager();
        $conn = $connMgr->connect();
    
        // prepare insert
        $sql = "INSERT INTO dogs (username, name, gender, age, birthday, breed, image_url, personality, weight, size, likes, fav_places) VALUES (:username, :name, :gender, :age, :birthday, :breed, :image_url, :personality, :weight, :size,  :likes,  :fav_places)";

        $stmt = $conn->prepare($sql);
        
        $username = $dog->getUsername();
        $name = $dog->getName();
        $gender = $dog->getGender();
        $age = $dog->getAge();
        $birthday = $dog->getBirthday();
        $breed = $dog->getBreed();
        $image_url = $dog->getImg_url();
        $personality = $dog->getPersonality();
        $weight = $dog->getWeight();
        $size = $dog->getSize();
        $likes = $dog->getLikes();
        $fav_places = $dog->getFavplace();

        $stmt->bindParam(':username',$username,PDO::PARAM_STR);
        $stmt->bindParam(':name',$name,PDO::PARAM_STR);
        $stmt->bindParam(':gender',$gender,PDO::PARAM_STR);
        $stmt->bindParam(':age',$age,PDO::PARAM_INT);
        $stmt->bindParam(':birthday',$birthday,PDO::PARAM_STR);
        $stmt->bindParam(':breed',$breed,PDO::PARAM_STR);
        $stmt->bindParam(':image_url',$image_url,PDO::PARAM_STR);
        $stmt->bindParam(':weight',$weight,PDO::PARAM_STR);
        $stmt->bindParam(':personality',$personality,PDO::PARAM_STR);
        $stmt->bindParam(':size',$size,PDO::PARAM_STR);
        $stmt->bindParam(':likes',$likes,PDO::PARAM_INT);
        $stmt->bindParam(':fav_places',$fav_places,PDO::PARAM_STR);

        $result = $stmt->execute();
        if (! $result ){ // encountered error
            $parameters = [ "user" => $dog, ];
            $connMgr->handleError( $stmt, $sql, $parameters );
        }
        
        
        // close connections
        $stmt = null;
        $conn = null;        
        
        return $result;
    }

    // retrieve dog by owner's username from database
    function retrieve($username) {

        // connect to database
        $connMgr = new ConnectionManager();
        $conn = $connMgr->connect();

        // prepare insert
        $sql = "Select * from dogs where username = :username";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);

        // fetch dogs
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $result = null;
        if($row = $stmt->fetch()){
            $result = new Dog($row['DogID'],$row['username'], $row["name"], $row["gender"], $row["age"], $row["birthday"], $row["breed"], $row["image_url"], $row["personality"], $row["weight"], $row["size"], $row["likes"], $row["fav_places"]);
        }
    
        // close connections
        $stmt = null;
        $conn = null;        
        
        return $result;
    }


    // retrieve dogs from database
    function retrieveDogs() {

        // connect to database
        $connMgr = new ConnectionManager();
        $conn = $connMgr->connect();

        // prepare insert
        $sql = "Select * from dogs";
        $stmt = $conn->prepare($sql);

        // fetch dogs
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $result = [];
        while($row = $stmt->fetch()){
            $result[] = new Dog($row["DogID"], $row['username'], $row["name"], $row["gender"], $row["age"], $row["birthday"], $row["breed"], $row["image_url"], $row["personality"], $row["weight"], $row["size"], $row["likes"], $row["fav_places"]);
        }
    
        // close connections
        $stmt = null;
        $conn = null;        
        
        return $result;
    }


    // retrieve dog by ID from database
    function getDogByID($id) {
        
        // connect to database
        $connMgr = new ConnectionManager();
        $conn = $connMgr->connect();

        // prepare insert
        $sql = "Select * from dogs where DogID = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $dog_object = null;
        if( $row = $stmt->fetch() ) {
            $dog_object = new Dog($row["DogID"], $row['username'], $row["name"], $row["gender"], $row["age"], $row["birthday"], $row["breed"], $row["image_url"], $row["personality"], $row["weight"], $row["size"], $row["likes"], $row["fav_places"]);
        
        }

        // close connections
        $stmt = null;
        $conn = null;  

        return $dog_object;
    }


    // update dog details 
    function update($dog) {
        $result = true;

        // connect to database
        $connMgr = new ConnectionManager();
        $conn = $connMgr->connect();
        
        // prepare insert
        $sql = "UPDATE dogs SET name = :name, gender = :gender,age = :age, birthday = :birthday, breed = :breed, image_url = :image_url, personality = :personality, weight = :weight, fav_places = :fav_places  WHERE username = :username";

        $stmt = $conn->prepare($sql);
        
        $username = $dog->getUsername();
        $name = $dog->getName();
        $gender = $dog->getGender();
        $age = $dog->getAge();
        $birthday = $dog->getBirthday();
        $breed = $dog->getBreed();
        $image_url = $dog->getImg_url();
        $personality = $dog->getPersonality();
        $weight = $dog->getWeight();
        $fav_places = $dog->getFavplace();
        
        $stmt->bindParam(':username',$username,PDO::PARAM_STR);
        $stmt->bindParam(':name',$name,PDO::PARAM_STR);
        $stmt->bindParam(':gender',$gender,PDO::PARAM_STR);
        $stmt->bindParam(':age',$age,PDO::PARAM_INT);        
        $stmt->bindParam(':birthday',$birthday,PDO::PARAM_STR);
        $stmt->bindParam(':breed',$breed,PDO::PARAM_STR);
        $stmt->bindParam(':image_url',$image_url,PDO::PARAM_STR);
        $stmt->bindParam(':weight',$weight,PDO::PARAM_STR);
        $stmt->bindParam(':personality',$personality,PDO::PARAM_STR);
        $stmt->bindParam(':fav_places',$fav_places,PDO::PARAM_STR);


        $result = $stmt->execute();
        if (! $result ){ // encountered error
            $parameters = [ "user" => $dog, ];
            $connMgr->handleError( $stmt, $sql, $parameters );
        }
        
        // close connections
        $stmt = null;
        $conn = null;        
        
        return $result;
    }

}