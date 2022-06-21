<?php
  header("Content-type:application/json");
  if (isset($_GET["ip"])) {
    $string = file_get_contents('http://api.ipstack.com/' . $_GET["ip"]. '?access_key=5b8997103a5b718d5f973b994baa7480&fields=city,country_code,region_code,country_name');
  }
  else {
	$string = "{\"error\": \"No IP Address Specified\"}";
  }
  echo $string;
