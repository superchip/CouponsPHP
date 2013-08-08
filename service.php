<?php
include_once 'DBHandle.php';

$request_method = strtolower($_SERVER['REQUEST_METHOD']);

if($request_method == 'get')
{
    Header('Content-type: text/xml');
    $xml = new DOMDocument("1.0");
    $xml->formatOutput = true;
    
    if(isset($_GET['couponid']))
    {
        try {
        $couponsArray = array(CouponsDAO::getInstance()->getCoupon($_GET['couponid']));
        }
        
        //no coupons were found with provided id
        catch(Exception $e)
        {
            //empty array
            echo  "no coupons were found with provided id";
        }
        
    }
    else
    {   
        $couponsArray = CouponsDAO::getInstance()->getCoupons();
    }
    
    $root = $xml->createElement("coupons");
    $root = $xml->appendChild($root);
    
    foreach ($couponsArray as $couponInfo)
    {
        $couponRoot = $xml->createElement("coupon");
        $couponRoot = $root->appendChild($couponRoot);
        $idElem = $xml->createElement("id",$couponInfo->getID());
        $nameElem = $xml->createElement("name",$couponInfo->getName());
        $catagoryElem = $xml->createElement("categoryid",$couponInfo->getCatagoryID());
        $businessElem = $xml->createElement("businessid",$couponInfo->getBusinessID());
        $descElem = $xml->createElement("description",$couponInfo->getDescription());
        $imgElem = $xml->createElement("imagefilename",$couponInfo->getImageFileName());
        $couponRoot->appendChild($idElem);
        $couponRoot->appendChild($nameElem);
        $couponRoot->appendChild($catagoryElem);
        $couponRoot->appendChild($businessElem);
        $couponRoot->appendChild($descElem);
        $couponRoot->appendChild($imgElem);
    }
        

    $xmlString = $xml->saveXML();
    echo $xmlString;  
}//end get
//$path = getcwd()."/uploads/miki.xml";
//echo $xml->save($path);




?>