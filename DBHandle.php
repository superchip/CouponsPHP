<?php
include_once 'Entities.php';
use Entities\Coupon;


class CounponsDBConfig
{
    static $server_name = "localhost";
    static $db_name = "CouponsDB";
    static $db_username = "root";
    static $db_password = "221222";   
}

interface ICouponsDAO
{
    function getCoupon($id);
    function addCoupon(Coupon $ob);
    function getCoupons();
    function updateCoupon(Coupon $ob);  
}


class CouponsDAO implements ICouponsDAO
{
    private static $instance;
    private $connection;

    public function __construct()
    {
        $this->connection = new mysqli(CounponsDBConfig::$server_name,CounponsDBConfig::$db_username,CounponsDBConfig::$db_password,CounponsDBConfig::$db_name);
    }

    public function __destruct()
    {
        $this->connection->close();
    }

    static function getInstance()
    {
        if(CouponsDAO::$instance==null)
        {
            CouponsDAO::$instance = new CouponsDAO();
        }
        return CouponsDAO::$instance;
    }
    
    function getCoupon($id)
    {
        $result = $this->connection->query("SELECT id,category_id,business_id,name,description,imagefilename FROM coupons WHERE id=".$id);

        if($result==FALSE)
        {
            throw new Exception("the select query failed");
        }
        $row = $result->fetch_row();
        if($row==null)
        {
            throw new Exception("coupon does not exist");
        }
        list($id,$category_id,$business_id,$name,$description,$imagefilename) = $row;
        return new Coupon($category_id, $business_id, $name, $imagefilename,$id,$description);
    }
    function addCoupon(Coupon $ob)
    {
        $catagoryID = $ob->getCatagoryID();
        $businessID = $ob->getBusinessID();
        $name = $ob->getName();
        $decription = $ob->getDescription();
        $imageFileName = $ob->getImageFileName();
        
        $query = "INSERT INTO coupons (id,name,category_id,business_id,description,imagefilename) VALUES (
        NULL,
        '" . mysql_real_escape_string($name) . "',
        '" . mysql_real_escape_string($catagoryID) . "',
        '" . mysql_real_escape_string($businessID) . "',
        '" . mysql_real_escape_string($decription) . "',
        '" . mysql_real_escape_string($imageFileName) . "')";
        
        $this->connection->query($query);        
    }
    function getCoupons()
    {
        $result = $this->connection->query("SELECT id,name,category_id,business_id,description,imagefilename FROM coupons");
        $couponsArray = array();
        while(list($id,$name,$category_id,$business_id,$description,$imagefilename) = $result->fetch_row())
        {
            array_push($couponsArray,new Coupon($category_id, $business_id, $name, $imagefilename,$id,$description));
        }
        
        return $couponsArray;
    }
    function updateCoupon(Coupon $ob)
    {
        
    }

}

class Utilities
{
    public static function writeToCsvFile($data)
    {
        $path = getcwd()."/uploads/all_coupons.csv";
        $fp = fopen($path, 'w+');
        
        fputcsv($fp, array("id","name","description"));
        
        foreach ($data as $fields) {
            fputcsv($fp, array($fields->getID(),$fields->getName(),$fields->getDescription()));
        }
        
        fclose($fp);        
    }   
}


?>