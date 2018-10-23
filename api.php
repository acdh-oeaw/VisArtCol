<?php
  include("functions.php");
  
  //Set header type
  header('content-type: application/json; charset=utf-8');

  //Handle the request and parameters
  $urlArray = explode("/", substr(@$_SERVER['PATH_INFO'], 1));
  if(!empty($urlArray)) {
  	if ($urlArray[0] == "artwork") { //LIST REQUEST
    	$artworkID = $urlArray[1];
      $artwork = getArtworkData($artworkID);
      response(200,$artwork);
  	}
  } else {
  	response(400,"Invalid request");
  }

  //Get list for the user
  function get_list() {
    $listsfile = file_get_contents("lists.json");
    $lists = json_decode($listsfile, true);
    if ($lists) {
      return $lists;
    } else {
      return false;
    }
    
  }

  //REST HTTP response function
  function response($status,$data) {
  	header("HTTP/1.1 ".$status);
  	$response = $data;
  	$json_response = json_encode($response, JSON_PRETTY_PRINT);
  	echo $json_response;
  }


?>