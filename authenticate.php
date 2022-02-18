<?php

require_once "common.php";


$username = '';
if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
}

// var_dump($username);
$dao = new DogDAO();

$results = $dao->retrieve($username);

$output = array("username" => $results->getUsername(), "dog_name" => $results->getName(), "img_src" => $results->getImg_url(), "gender" => $results->getGender(),  "birthday" => $results->getBirthday(),  "breed" => $results->getBreed(), "personality" => $results->getPersonality(), "weight" => $results->getWeight(),  "fav_place" => $results->getFavplace());
$json_obj = json_encode($output);

// var_dump($json_obj);

exit($json_obj);

?>

