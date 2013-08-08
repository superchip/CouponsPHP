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
    <title>Remove coupon page</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/signin.css" rel="stylesheet">
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
                zoom: 9,
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
<div class="navbar">
    <a class="navbar-brand" href="#">Coupons Managment</a>
    <ul class="nav navbar-nav">
        <li><a href="index.php">Insert</a></li>
        <li><a href="remove.php">Remove</a></li>
        <li class="active"><a href="businessPage.php">Businesses Map</a></li>
    </ul>
</div>
<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Businesses Map</h3>
        </div>
        Closest Business to you is: <label id="response"></label>
    </div>
</div>
<div id="map-canvas"></div>
<!-- JavaScript plugins (requires jQuery) -->
<script src="http://code.jquery.com/jquery.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>

</html>