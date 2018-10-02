<?php
// Accept coordinates and forward user to closest place on YR
// forecast service. Works for Norway only.

// Generate your own user at 
// http://www.geonames.org/login
$user = '*******';


// Construct url
$lat = $_GET['lat'];
$lon = $_GET['lon'];
$url = "http://api.geonames.org/findNearbyPlaceNameJSON?lat=$lat&lng=$lon&style=full&username=$user";

// Fetch and decode JSON
$string = file_get_contents($url);
$json = json_decode($string, true);

$country = $json['geonames'][0]['countryName'];
$county = $json['geonames'][0]['adminName1'];
$municipality = $json['geonames'][0]['adminName2'];
$place = $json['geonames'][0]['name'];

// Construct YR url
$url = "https://www.yr.no/place/$country/$county/$municipality/$place/?spr=eng";

// Forward user to YR weather service
//header("Location: $url");

// Forward user to YR
include_once('libraries/analyticstracking.php');
echo '<script>window.location.replace("'.$url.'");</script>';

?>
