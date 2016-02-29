<?php
include 'LocationObject.php';
include 'include/DbConnect.php';

$db = getDB();
$city = "San Francisco";
$title = $_GET['title'];

$sql = "select MovieId from movie where movietitle = '$title'";
$result = mysqli_query($db, $sql);
$locationIds = array();
$locations = array();

while ($movieRow = $result->fetch_assoc()) {
    $id = $movieRow['MovieId'];
    $locationSql = "select locationId from movie_location where movieid = '$id'";
    $locationResult = mysqli_query($db, $locationSql);
    while ($locationRow = $locationResult->fetch_assoc()) {
        array_push($locationIds, $locationRow['locationId']);
    }


}

foreach ($locationIds as $id) {
    $locationNameSql = "select LocationName from location where locationId = '$id'";
    $locationNameResult = mysqli_query($db, $locationNameSql);
    while ($row3 = $locationNameResult->fetch_assoc()) {
        array_push($locations, $row3['LocationName']);
    }

}

$movieLocations = array();

foreach ($locations as $name) {


    $address = str_replace(" ", "%20", $name) . "," . str_replace(" ", "%20", $city);
    $url = "http://maps.google.com/maps/api/geocode/json?sensor=false&address=$address";
    $response = file_get_contents($url);
    $json = json_decode($response, TRUE); //generate array object from the response from the web
    $locationDetails = new LocationObject();
    $locationDetails->setLatitude($json['results'][0]['geometry']['location']['lat']);
    $locationDetails->setLongitude($json['results'][0]['geometry']['location']['lng']);
    $locationDetails->setCity($name);
    // assign it to the array here; you don't need the [0] index then

    $movieLocations[] = $locationDetails;


}
$response = array('locations' => $movieLocations);
echo json_encode($response);

mysqli_close($db);

?>