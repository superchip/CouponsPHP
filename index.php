<?php
include_once 'Entities.php';
include_once 'DBHandle.php';

use Entities\Coupon;

if(!empty($_POST))
{
    //why cant i use the list on post?
    //list($couponName,$businessName,$couponCatagory,$couponImage) = $_POST;
     
    $couponName = $_POST['coupon_name'];
    $businessID = $_POST['business_id'];
    $couponCatagoryID = $_POST['coupon_catagory_id'];
    $couponDescription = $_POST['description'];
    $couponImage = $_FILES['coupon_image_upload']['name'];
    
    $couponObj = new Coupon($couponCatagoryID, $businessID, $couponName, $couponImage,null,$couponDescription);
    
    //if one of the var is empty output proper error
    if(empty($couponName) || empty($couponImage))
    {
        $problemsString = "<h3>the following errors were found: </h3><ul>";
        
        if(empty($couponName))
        {
            $problemsString .= "<li>You didn't enter coupon name</li>";
        }
        if(empty($couponImage))
        {
            $problemsString .= "<li>You didn't choose an image to upload</li>";
        }
            
        $problemsString .= "</ul><br /><a href='http://localhost:10088/Coupons/'>Back to form</a>";
        echo $problemsString;
    }
    
    //move the uploaded file from the server to uploads dir
    else
    {
        $target_path = getcwd()."/uploads/";       
        $target_path .= basename( $_FILES['coupon_image_upload']['name']);
        
        if(move_uploaded_file($_FILES['coupon_image_upload']['tmp_name'], $target_path)) 
        {
            $dao = new CouponsDAO();
            
            try
            {
                $dao->addCoupon($couponObj);
            }
            catch(Exception $e)
            {
                echo "failed adding coupon to database";
            }
            
            echo "<h3>Coupon was successfully uploaded!</h3>";
        } 
        else
        {
            echo "There was an error uploading the file, please try again!";
        }
        
    }    
}
//web site request was without post - show the form
else
{
    $dao = new CouponsDAO();
    $businesses = $dao->getBusinesses();

    foreach($businesses as $businessInfo)
    {
        $busSelection .= "<option value={$businessInfo->getID()}>{$businessInfo->getName()}</option>";
    }

    $categories = $dao->getCategories();

    foreach($categories as $categoryInfo)
    {
        $categoriesSelection .= "<option value={$categoryInfo->getID()}>{$categoryInfo->getName()}</option>";
    }

    echo '<!DOCTYPE html>
    <html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/signin.css" rel="stylesheet">
    <title>Insert Coupons Site</title>
    </head>
    <body>
    <div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Insert Coupon</h3>
        </div>
    <form class="form-signin" action="index.php" method="post" enctype="multipart/form-data">
      <input type="text" name="coupon_name" class="input-block-level" placeholder="Name" autofocus><br />
      <label for="business_id">Business Name:</label>
      <div class="styled-select">
        <select class="selectpicker" name="business_id">'
        .$busSelection.'
        </select>
      </div>
       <label>Coupon Catagory:</label>
       <div class="styled-select">
         <select class="selectpicker" name=coupon_catagory_id>'
        .$categoriesSelection.'
        </select>
       </div>
       <br />
       <div class="input-group">
          <textarea name="description" class="form-control" placeholder="Description"></textarea>
       </div>
        <label for="coupon_image_upload">Coupon Image:</label><br />
        <input type="file" name="coupon_image_upload" value=""><br />
        <p class="submit"><input type="submit" name="Submit" value="submit" class="btn btn-large btn-primary btn-block"></p>
    </form>
    </div>
    </div>
        <!-- JavaScript plugins (requires jQuery) -->
    <script src="http://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    </body>
    </html>';
}
?>
