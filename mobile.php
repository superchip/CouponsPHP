<?php
include_once 'Entities.php';
include_once 'DBHandle.php';

use Entities\Category;

$dao = new CouponsDAO();
$categoriesArray = $dao->getCategories();


?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <title>Page Title</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.1/jquery.mobile-1.2.1.min.css" />
    <script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.2.1/jquery.mobile-1.2.1.min.js"></script>
    <script>
        $('#ul-categories li').live('click', function() {

        });
    </script>

</head>
<body>
    <!-- Start of first page -->
    <div data-role="page" id="page-categories">

        <div data-role="header" data-theme="b">
            <h1>Categories</h1>
        </div><!-- /header -->

        <div data-role="content">
            <?php
                $str = '<ul id="ul-categories" data-role="listview">';
                foreach($categoriesArray as $category)
                {
                    $str.= '<li><a href="mobile_coupons.php?category_id='.$category->getID().'">'.$category->getName().'</a></li>';
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