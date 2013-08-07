<?php
/**
 * Created by ron.
 * User: admin
 * Date: 7/29/13
 * Time: 7:11 PM
 */
include_once 'Entities.php';
include_once 'DBHandle.php';
include_once 'distance.php';

use Entities\Business;

$businessesArray = CouponsDAO::getInstance()->getBusinesses();
$latitude = $businessesArray[0]->getLatitude();
$longtitude = $businessesArray[0]->getLongtitude();
$name = $businessesArray[0]->getName();


?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <style type="text/css">
        html { height: 100%;width: 50% }
        body { height: 100%; margin: 0; padding: 0 }
        #map-canvas { height: 70% }
    </style>
    <script type="text/javascript" src="location.js"></script>
    <script>
        var userLocation = new UserLocation();
    </script>
    <script type="text/javascript"
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAUpKttMh0OGQK7M0T8DiBF1GoFObMHBBA&sensor=false">
    </script>
    <script type="text/javascript">
        function initialize() {

            var myLatlng = new google.maps.LatLng(<?php echo $latitude.",".$longtitude; ?>);

            var mapOptions = {
                center: myLatlng,
                zoom: 12,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var map = new google.maps.Map(document.getElementById("map-canvas"),
                mapOptions);

            <?php

                $info = "var markers = [";
                foreach ($businessesArray as $businessInfo)
                {
                    $info.= "[\"{$businessInfo->getName()}\",{$businessInfo->getLatitude()},{$businessInfo->getLongtitude()}],";
                }

                $info = substr($info,0, -1);
                $info.= "];";

                echo $info;
            ?>

            for (i = 0; i < markers.length; i++) {
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(markers[i][1], markers[i][2]),
                    map: map,
                    animation: google.maps.Animation.DROP,
                    title: markers[i][0]
                });
            }
        }
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
    <title>Businesses</title>
</head>
<body>
Closest Business to you is: <label id="response"></label>
<div id="map-canvas"></div>

</body>

</html>