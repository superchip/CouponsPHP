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