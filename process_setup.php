<?php 

require_once "common.php";

// dog 

$username = '';
if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
}

$dogname = '';
if(isset($_POST['dog_name'])){
    $dogname = $_POST['dog_name'];
}

$dog_dob = '';
$age = 0;
if(isset($_POST['dog_dob']) && !empty($_POST['dog_dob'])){
    $dog_dob = $_POST['dog_dob'];
    $age = date("Y") - substr($dog_dob,0,4);
}

$breed = '';
if(isset($_POST['breed'])) {
    $breed = $_POST['breed'];
}

$dog_gender = '';
if(isset($_POST['dog_gender'])) {
    $dog_gender = $_POST['dog_gender'];

}

$weight = '';
if(isset($_POST['dog_weight'])){
    $weight = $_POST['dog_weight'];
}

$personality = '';
$personality_type = '';
if(isset($_POST['personality'])){
    $personality = $_POST['personality'];
    $personality = array_map("ucfirst",$personality);
    $personality_type = implode(",",$personality);
}

$favplace = '';
if(isset($_POST['favplace'])) {
    $favplace = $_POST['favplace'];
}


$target_dir = "images/";
$img_url = '';
if(isset($_FILES["dog_img_src"]["tmp_name"]) && !empty($_FILES["dog_img_src"]["tmp_name"])) {
    $target_file = $target_dir . basename($_FILES["dog_img_src"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    move_uploaded_file($_FILES["dog_img_src"]["tmp_name"], $target_file);
    $dog_file = htmlspecialchars( basename( $_FILES["dog_img_src"]["name"]));
    $img_url = $target_dir.$dog_file;
}
else {
    $img_url = "images/default_profile.png";
}




$size = '';
if($weight == 'Less than 15kg') {
    $size = 'small';
}
else if($weight == '15kg - 25kg')
{
    $size = 'medium';
}
else {
    $size = 'large';
}

$likes = rand(1,30);


$new_dog = new Dog(null, $username,$dogname,$dog_gender, $age, $dog_dob, $breed, $img_url, $personality_type, $weight, $size, $likes, $favplace);
$dao = new DogDAO();

$status = $dao->create($new_dog);

// user profile
$first_name = '';
$last_name = '';
$owner_gender = '';
$owner_dob = '';

if(isset($_POST['fname'])){
    $first_name = $_POST['fname'];
}

if(isset($_POST['lname'])){
    $last_name = $_POST['lname'];
}

if(isset($_POST['owner_gender'])){
    $owner_gender = $_POST['owner_gender'];
}

if(isset($_POST['owner_dob'])){
    $owner_dob= $_POST['owner_dob'];
}




$owner_img = '';
if(isset($_FILES["owner_img_src"]["tmp_name"]) && !empty($_FILES["owner_img_src"]["tmp_name"])) {
    $target_file = $target_dir . basename($_FILES["owner_img_src"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    move_uploaded_file($_FILES["owner_img_src"]["tmp_name"], $target_file);
    $owner_file = htmlspecialchars( basename( $_FILES["owner_img_src"]["name"]));
    $owner_img = $target_dir.$owner_file;
}
else {
    $owner_img = "images/profile_avatar.png";
}

$new_user_profile = new Profile(null, $username,$first_name,$last_name,$owner_gender,$owner_dob, $owner_img);
$dao1 = new ProfileDAO();

$status1 = $dao1->create($new_user_profile);




if ( $status && $status1) {

    header("Location: index.html");
    exit();
}
else
{

    header("Location: sign_in.php");
    return;
}



?>