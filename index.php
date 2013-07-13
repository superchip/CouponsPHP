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
    $couponImage = $_FILES['coupon_image_upload']['name'];
    
    $couponObj = new Coupon($couponCatagoryID, $businessID, $couponName, $couponImage);
    
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
    echo '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
    <html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="form_design.css" type="text/css" media="all" />  
    <title>Insert Coupons Site</title>
    </head>
    <body>
    <form class="form" action="index.php" method="post" enctype="multipart/form-data">
      <label for="coupon_name">Name:</label><br />
      <input type="text" name="coupon_name"><br />
      <label for="business_id">Business Name:</label>
       <div class="styled-select"> 
        <select name="business_id"></p>
          <option value="1">Moses</option>
          <option value="2">Wolfnights</option>
          <option value="3">Agadir</option>
        </select>
        </div>
      <label>Business Catagory:</label>
       <div class="styled-select">
         <select name=coupon_catagory_id>
          <option value="1">Food</option>
          <option value="2">Clothing</option>
          <option value="3">Retail</option>
        </select>
       </div>
        <label for="coupon_image_upload">Coupon Image:</label><br />
        <input type="file" name="coupon_image_upload" value=""><br />
        <p class="submit"><input type="submit" name="Submit" value="submit"></p>
    </form>
    </body>
    </html>';
}
?>
