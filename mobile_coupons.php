<?php
include_once 'Entities.php';
include_once 'DBHandle.php';

use Entities\Category;

if(!empty($_GET['category_id']))
{
    $categoryID = $_GET['category_id'];
    $_SESSION['category_id'] = $categoryID;
    $dao = new CouponsDAO();
    $couponsArray = $dao->getCouponsByCategory($categoryID);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Page Title</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.1/jquery.mobile-1.2.1.min.css" />
    <script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.2.1/jquery.mobile-1.2.1.min.js"></script>
</head>
<body>
<!-- Start of first page -->
<div data-role="page" id="page-coupons">

    <div data-role="header" data-theme="b">
        <h1>Nearest Coupons</h1>
    </div><!-- /header -->

    <div data-role="content">
        <?php
        $str = '<ul data-split-theme="a" data-inset="true" data-role="listview">';
        foreach($couponsArray as $coupon)
        {
            $str.= '<li><a><h3>'.$coupon->getName().'</h3><img src="uploads/'.$coupon->getImageFileName().'"/></a></li>';
        }

        $str.= '</ul>';
        echo $str;
        ?>
    </div><!-- /content -->

    <div data-role="footer" data-theme="b">
        <h4>Coupons</h4>
    </div><!-- /footer -->
</div><!-- /page -->
</body>
</html>