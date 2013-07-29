<?php
/**
 * Created by ron.
 * User: admin
 * Date: 7/29/13
 * Time: 7:11 PM
 */
include_once 'Entities.php';
include_once 'DBHandle.php';

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
        #map-canvas { height: 50% }
    </style>
    <script type="text/javascript"
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAUpKttMh0OGQK7M0T8DiBF1GoFObMHBBA&sensor=false">
    </script>
    <script type="text/javascript">
        function initialize() {
            var myLatlng = new google.maps.LatLng(<?php echo $latitude.",".$longtitude; ?>);

            var mapOptions = {
                center: myLatlng,
                zoom: 16,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var map = new google.maps.Map(document.getElementById("map-canvas"),
                mapOptions);

            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                title:<?php echo "\"".$name."\""; ?>
            });
        }
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
    <title>Businesses</title>
</head>
<body>
<?php echo $name; ?>
<div id="map-canvas"/>
</body>

</html>