<?php
include_once 'Entities.php';
//include('log4php/Logger.php');
use Entities\Coupon;



class CouponsDBConfig
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
    private $logger;

    public function __construct()
    {
        $this->connection = new mysqli(CouponsDBConfig::$server_name,CouponsDBConfig::$db_username,CouponsDBConfig::$db_password,CouponsDBConfig::$db_name);
        //$this->logger = Logger::getLogger("main");
        //$this->logger->info("Opening DB connection");
    }

    public function __destruct()
    {
        $this->connection->close();
        //$this->logger->info("closing DB connection");
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
            $this->logger->error("the select query failed");
            throw new Exception("the select query failed");
        }
        $row = $result->fetch_row();
        if($row==null)
        {
            $this->logger->debug("coupon does not exist");
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

    function getBusinessInfo($businessID)
    {
        $result = $this->connection->query("SELECT * FROM businesses WHERE id=".$businessID);

        if($result==FALSE)
        {
            $this->logger->error("the select query failed");
            throw new Exception("the select query failed");
        }
        $row = $result->fetch_row();
        if($row==null)
        {
            $this->logger->debug("business does not exist");
            throw new Exception("business does not exist");
        }
        list($id, $name, $street, $number, $city, $zip, $telephone, $latitude, $longtitude) = $row;
        return new \Entities\Business($id, $name, $street, $number, $city, $zip, $telephone, $latitude, $longtitude);
    }

    function getBusinesses()
    {
        $result = $this->connection->query("SELECT * FROM businesses");
        $businessesArray = array();
        while(list($id, $name, $street, $number, $city, $zip, $telephone, $latitude, $longtitude) = $result->fetch_row())
        {
            array_push($businessesArray,new \Entities\Business($id, $name, $street, $number, $city, $zip, $telephone, $latitude, $longtitude));
        }

        return $businessesArray;
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