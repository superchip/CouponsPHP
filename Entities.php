<?php
namespace Entities
{
    class Business
    {
        private $id;
        private $name;
        private $street;
        private $number;
        private $city;
        private $zip;
        private $telephone;
        private $latitude;
        private $longtitude;


        function __construct($idVal = 0,$nameVal, $streetVal, $numberVal, $cityVal, $zipVal, $telephoneVal, $latitudeVal, $longtitudeVal)
        {
            $this->id = $idVal;
            $this->name = $nameVal;
            $this->street = $streetVal;
            $this->number = $numberVal;
            $this->city = $cityVal;
            $this->zip = $zipVal;
            $this->telephone = $telephoneVal;
            $this->latitude = $latitudeVal;
            $this->longtitude = $longtitudeVal;
        }

        public function getID()
        {
            return $this->id;
        }

        public function getName()
        {
            return $this->name;
        }

        public function getStreet()
        {
            return $this->street;
        }

        public function getNumber()
        {
            return $this->number;
        }

        public function getCity()
        {
            return $this->city;
        }

        public function getZip()
        {
            return $this->zip;
        }

        public function getTelephone()
        {
            return $this->telephone;
        }

        public function getLatitude()
        {
            return $this->latitude;
        }

        public function getLongtitude()
        {
            return $this->longtitude;
        }


    }

    class Category
    {
        private $id;
        private $name;

        function __construct($idVal,$nameVal)
        {
            $this->id = $idVal;
            $this->name = $nameVal;
        }

        public function getID()
        {
            return $this->id;
        }

        public function getName()
        {
            return $this->name;
        }
    }
    
    class Coupon
    {
        private $id;
        private $category_id;
        private $business_id;
        private $name;
        private $description ;
        private $imagefilename;
        
        function __construct($category_idVal,$business_idVal,$nameVal,$imagefilenameVal,$idVal = 0,$descriptionVal = "none")
        {
            $this->id = $idVal;
            $this->category_id = $category_idVal;
            $this->business_id = $business_idVal;
            $this->name = $nameVal;
            $this->description = $descriptionVal;
            $this->imagefilename = $imagefilenameVal;
        }
        
        
        public function getID()
        {
            return $this->id;
        }
        
        public function getCatagoryID()
        {
            return $this->category_id;
        }
        
        public function getBusinessID()
        {
            return $this->business_id;
        }
        
        public function getName()
        {
            return $this->name;
        }
        
        public function getDescription()
        {
            return $this->description;
        }
        
        public function getImageFileName()
        {
            return $this->imagefilename;
        }
    }
}

?>