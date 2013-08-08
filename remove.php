<?php
/**
 * Created by ron.
 * User: admin
 * Date: 8/7/13
 * Time: 5:31 PM
 */
include_once 'Entities.php';
include_once 'DBHandle.php';

use Entities\Coupon;
use Entities\Business;

$dao = new CouponsDAO();

if(!empty($_GET['q']))
{
    $coupons = $dao->getBusinessCoupons($_GET['q']);
    $couponsSelection = "";
    foreach($coupons as $couponInfo)
    {
        echo '<option value="'.$couponInfo->getID().'">'.$couponInfo->getName().'</option>';
    }

}

else if(!empty($_GET['couponID']))
{
    $dao->deleteCoupon($_GET['couponID']);
    echo $_GET['couponID'];
}



else
{
    $businesses = $dao->getBusinesses();
    $busSelection="";
    $coupons = $dao->getBusinessCoupons($businesses[0]->getID());
    $couponsSelection = "";

    foreach($businesses as $businessInfo)
    {
        $busSelection .= "<option value={$businessInfo->getID()}>{$businessInfo->getName()}</option>";
    }

    foreach($coupons as $couponInfo)
    {
        $couponsSelection .= "<option value={$couponInfo->getID()}>{$couponInfo->getName()}</option>";
    }
}



?>

<!DOCTYPE html>
<html>
<head>
    <title>Remove coupon page</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/signin.css" rel="stylesheet">

    <script>
        function showCoupons(str)
        {
            xmlhttp=new XMLHttpRequest();
            if(xmlhttp)
            {
                xmlhttp.onreadystatechange=function()
                {
                    if (xmlhttp.readyState==4 && xmlhttp.status==200)
                    {
                        document.getElementById("response").innerHTML=xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET","remove.php?q="+str);
                xmlhttp.send(null);
            }
        }

        function removeCoupon()
        {
             if(confirm('Delete coupon?'))
             {
                 xmlhttp=new XMLHttpRequest();
                 if(xmlhttp)
                 {
                     xmlhttp.onreadystatechange=function()
                     {
                         if (xmlhttp.readyState==4 && xmlhttp.status==200)
                         {
                             alert('Coupon was deleted');
                             var e = document.getElementById("business_id");
                             var businessID = e.options[e.selectedIndex].value;
                             showCoupons(businessID);
                         }

                     }

                     var e = document.getElementById("response");
                     var couponID = "couponID=" + e.options[e.selectedIndex].value;
                     xmlhttp.open("GET","remove.php?" + couponID);
                     xmlhttp.send(null);
                 }
            }
        }
    </script>
</head>
<body>
<div class="navbar">
    <a class="navbar-brand" href="#">Coupons Managment</a>
    <ul class="nav navbar-nav">
        <li><a href="index.php">Insert</a></li>
        <li class="active"><a href="remove.php">Remove</a></li>
        <li><a href="businessPage.php">Businesses Map</a></li>
    </ul>
</div>
<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Remove Coupon</h3>
        </div>
    <form class="form-signin">
        <label for="business_id">Business Name:</label>
        <div class="styled-select">
            <select class="selectpicker" id="business_id" name="business_id" onchange="showCoupons(this.value)">
                <?php echo $busSelection ?>
            </select>
        </div>
        <label for="coupon_id">Coupon Name:</label>
        <div class="styled-select">
            <select id="response" class="selectpicker" name="coupon_id">
                <?php echo $couponsSelection ?>
            </select>
        </div>
        <br />
        <p class="submit"><input type="button" name="Submit" value="Remove" class="btn btn-large btn-primary btn-block" onclick="removeCoupon()"></p>
    </form>
    </div>
</div>
<!-- JavaScript plugins (requires jQuery) -->
<script src="http://code.jquery.com/jquery.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>