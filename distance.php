<?php
/**
 * Created by ron.
 * User: admin
 * Date: 8/6/13
 * Time: 9:25 PM
 */

include_once 'Entities.php';
include_once 'DBHandle.php';

use Entities\Business;

class LocationData
{
    private static $instance = null;
    private $userLatitude;
    private $userLongtitude;

    public function setLatitude($latitudeVal)
    {
        $this->userLatitude = $latitudeVal;
    }
    public function setLongtitude($longtitudeVal)
    {
        $this->userLongtitude = $longtitudeVal;
    }

    public static function Instance()
    {
        if(LocationData::$instance == null)
        {
            $instance = new LocationData();
        }

        return $instance;
    }

    private function __construct()
    {
    }

    public function getLatitude()
    {
        return $this->userLatitude;
    }
    public function getLongtitude()
    {
        return $this->userLongtitude;
    }

    public function getNearestBusiness()
    {
        $businessesArray = CouponsDAO::getInstance()->getBusinesses();

        $minDistance = 1000000;

        foreach($businessesArray as $businessInfo)
        {
            $distance =
                sqrt(pow($businessInfo->getLatitude() - $this->userLatitude,2) + pow($businessInfo->getLongtitude() - $this->userLongtitude,2));
            if($distance < $minDistance)
            {
                $minDistance = $distance;
                $nearestBusiness = $businessInfo;
            }
        }

        return $nearestBusiness;
    }



}

if(!empty($_GET))
{
    LocationData::Instance()->setLatitude($_GET['latitude']);
    LocationData::Instance()->setLongtitude($_GET['longtitude']);

    echo LocationData::Instance()->getNearestBusiness()->getName();
}

?>