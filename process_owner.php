<?php

require_once "common.php";


$username = '';
if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
}

$dao = new ProfileDAO();

$results = $dao->get($username);
$json_obj = json_encode($results);
exit($json_obj);

?>

