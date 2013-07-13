<?php
include_once 'DBHandle.php';
Utilities::writeToCsvFile(CouponsDAO::getInstance()->getCoupons());
?>