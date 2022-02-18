<?php

require_once "common.php";


$username = '';
if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
}

$target_dir = "images/";

if(isset($_POST['owner_check'])) {
    $dao = new ProfileDAO();
    $user = $dao->get($username);
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $owner_dob = $_POST['owner_dob'];
    if(isset($_FILES["owner_img_src"]["tmp_name"]) && !empty($_FILES["owner_img_src"]["tmp_name"])) {
        $target_file = $target_dir . basename($_FILES["owner_img_src"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        move_uploaded_file($_FILES["owner_img_src"]["tmp_name"], $target_file);
        $owner_file = htmlspecialchars( basename( $_FILES["owner_img_src"]["name"]));
        $owner_img = $target_dir.$owner_file;
        $user->setImage_url($owner_img);

    }

    $owner_gender = '';
    if(isset($_POST['owner_gender'])) {
        $owner_gender = $_POST['owner_gender'];
    }
    $user->setGender($owner_gender);

    $user->setFname($first_name);
    $user->setLname($last_name);
    $user->setBirthday($owner_dob);

    
    $status = $dao->update($user);


    if($status) {
        $_SESSION['update_success'] = 'Y';
        header("Location: profile.php");
    }

    else {
        $_SESSION['update_success'] = 'N';
        header("Location: profile.html");

    }

}

if(isset($_POST['dog_check'])) {
    $dao = new DogDAO();
    $user = $dao->retrieve($username);
    $dog_name = $_POST['dog_name'];
    $dog_weight = $_POST['weight'];
    $fav_place = $_POST['fav_place'];
    $others = $_POST['others'];
    $dog_img = '';
    if(isset($_FILES["dog_img_src"]["tmp_name"]) && !empty($_FILES["dog_img_src"]["tmp_name"])) {
        $target_file = $target_dir . basename($_FILES["dog_img_src"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        move_uploaded_file($_FILES["dog_img_src"]["tmp_name"], $target_file);
        $dog_file = htmlspecialchars( basename( $_FILES["dog_img_src"]["name"]));
        $dog_img = $target_dir.$dog_file;
        $user->setImg_url($dog_img);

    }

    $dog_dob = '';
    $age = 0;
    if(isset($_POST['dog_dob']) && !empty($_POST['dog_dob'])){
        $dog_dob = $_POST['dog_dob'];
        $age = date("Y") - substr($dog_dob,0,4);
    }

    $user->setAge($age);
    $user->setBirthday($dog_dob);
    // $user->setLikes($likes);


    $dog_gender = '';
    if(isset($_POST['dog_gender'])) {
        $dog_gender = $_POST['dog_gender'];
    }
    $user->setGender($dog_gender);

    $dog_breed = '';
    if(isset($_POST['breed'])) {
        $dog_breed = $_POST['breed'];
    }
    $user->setBreed($dog_breed);

    $personality = '';
    if(isset($_POST['personality'])) {
        $personality = $_POST['personality'];
        if(in_array("others", $personality)) {
            array_pop($personality);
            $others_array = explode(",",$others);
            foreach($others_array as $description) {
                array_push($personality,$description);
            }
        }
        $personality = implode(",",$personality);
    }
    $user->setPersonality($personality);
    

    $user->setName($dog_name);
    $user->setWeight($dog_weight);
    $user->setFavplace($fav_place);

    $status = $dao->update($user);

    if($status) {
        $_SESSION['update_success'] = 'Y';
        header("Location: profile.php");
    }

    else {
        $_SESSION['update_success'] = 'N';
        header("Location: profile.php");

    }

    

}


?>

