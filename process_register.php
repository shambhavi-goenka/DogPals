<?php
require_once "common.php";

$errors = [];

$username = $_POST["username"]; 
$email = $_POST["email"];
$password = $_POST["password"]; 
$confirm_password = $_POST["confirmPassword"];

$hashed = password_hash($password, PASSWORD_DEFAULT);
$new_user = new User($username,$email, $hashed);
$dao = new UserDAO();

$status = $dao->create($new_user);


if ( $status ) {
    // success; redirect page
    $_SESSION["username"] = $username;
    header("Location: profile_setup.html");
    exit();
}
else
{
    
    $errors[] = "Error in registering user.";
    header("Location: sign_in.php");
    return;
}

?>

