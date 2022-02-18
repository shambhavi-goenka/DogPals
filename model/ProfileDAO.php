<?php 


class ProfileDAO {
    function create($user) {
        $result = true;

        // connect to database
        $connMgr = new ConnectionManager();
        $conn = $connMgr->connect();
    
        // prepare insert
        $sql = "INSERT INTO profile (username, first_name, last_name, gender, birthday, image_url) VALUES (:username, :first_name, :last_name, :gender, :birthday, :image_url)";

        $stmt = $conn->prepare($sql);
        
        $username = $user->getUsername();
        $first_name = $user->getFName();
        $last_name = $user->getLName();
        $gender = $user->getGender();
        $birthday = $user->getBirthday();
        $image_url = $user->getImage_url();


        $stmt->bindParam(':username',$username,PDO::PARAM_STR);
        $stmt->bindParam(':first_name',$first_name,PDO::PARAM_STR);
        $stmt->bindParam(':last_name',$last_name,PDO::PARAM_STR);
        $stmt->bindParam(':gender',$gender,PDO::PARAM_STR);
        $stmt->bindParam(':birthday',$birthday,PDO::PARAM_STR);
        $stmt->bindParam(':image_url',$image_url,PDO::PARAM_STR);



        $result = $stmt->execute();
        if (! $result ){ // encountered error
            $parameters = [ "user" => $user, ];
            $connMgr->handleError( $stmt, $sql, $parameters );
        }
        
        
        // close connections
        $stmt = null;
        $conn = null;        
        
        return $result;
    }


    function get($username) {
        
        // connect to database
        $connMgr = new ConnectionManager();
        $conn = $connMgr->connect();
        
        // prepare select
        $sql = "SELECT * FROM profile WHERE username = :username";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
            
        $user = null;
        if ( $stmt->execute() ) {
            
            while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
                $user = new Profile($row["profileID"], $row['username'],$row["first_name"],$row["last_name"],$row['gender'],$row['birthday'],$row['image_url']);
            }
            
        }
        else {
            $connMgr->handleError( $stmt, $sql );
        }
        
        // close connections
        $stmt = null;
        $conn = null;        
        
        return $user;
    }

    function update($user) {
        $result = true;

        // connect to database
        $connMgr = new ConnectionManager();
        $conn = $connMgr->connect();
        
        // prepare insert
        $sql = "UPDATE profile SET first_name = :first_name, last_name = :last_name, gender = :gender, birthday = :birthday, image_url = :image_url  WHERE username = :username";

        $stmt = $conn->prepare($sql);
        
        $username = $user->getUsername();
        $first_name = $user->getFName();
        $last_name = $user->getLName();
        $gender = $user->getGender();
        $birthday = $user->getBirthday();
        $image_url = $user->getImage_url();
        
        $stmt->bindParam(':username',$username,PDO::PARAM_STR);
        $stmt->bindParam(':first_name',$first_name,PDO::PARAM_STR);
        $stmt->bindParam(':last_name',$last_name,PDO::PARAM_STR);
        $stmt->bindParam(':gender',$gender,PDO::PARAM_STR);
        $stmt->bindParam(':birthday',$birthday,PDO::PARAM_STR);
        $stmt->bindParam(':image_url',$image_url,PDO::PARAM_STR);
        

        $result = $stmt->execute();
        if (! $result ){ // encountered error
            $parameters = [ "user" => $user, ];
            $connMgr->handleError( $stmt, $sql, $parameters );
        }
        
        // close connections
        $stmt = null;
        $conn = null;        
        
        return $result;
    }

}























?>