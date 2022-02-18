<?php

require_once 'common.php';

$places_dao = new PlaceDAO();
$results = $places_dao->retrievePlaces();

//var_dump($results);
$output = [];

for ($i=0 ;$i < sizeof($results); $i++){
    $out = array("placeID" => utf8_encode($results[$i]->getPlaceID()), "place" => utf8_encode($results[$i]->getPlace()),  "placeLoc" => utf8_encode($results[$i]->getPlaceLoc()),  "lat" => utf8_encode($results[$i]->getLat()), "lon" => utf8_encode($results[$i]->getLon()),  "placeDesc" => utf8_encode($results[$i]->getPlaceDesc()), "placeType" => utf8_encode($results[$i]->getPlaceType()), "placeLink" => utf8_encode($results[$i]->getPlaceLink()), "likes" => utf8_encode($results[$i]->getLikes()));
    //var_dump($out);
    array_push($output,$out);
}
//var_dump($output);
//$json_obj = mb_convert_encoding($output, "utf-8");
$json_obj = json_encode($output);
//var_dump($json_obj);

exit($json_obj);

?>