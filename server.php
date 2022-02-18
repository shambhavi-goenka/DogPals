<?php

require_once 'common.php';

$dog_dao = new DogDAO();
$results = $dog_dao->retrieveDogs();

$json_obj = json_encode($results);

exit($json_obj);

?>