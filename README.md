Coupons Delivery Platform

Version 2.0.0

This platform enables business owners to publish their coupons through multiple platforms, such as mobile telephones web sites, mobile telephones hybrid applications, chrome os applications, word press plug-ins and applications deployed on the facebook platform.

The platform will be developed in phases during the ‘PHP Cross Platform Web Applications Development’ course delivered in HIT.

The server side will be developed in PHP. It will include the usage of MySQL database and will be deployed on a server connected to the web.

The client side will be developed in JavaScript, HTML5, jQuery, jQueryMobile and Java (in the case of hybrid application for android).

The purpose of this project is to create a practical proof of concept project that can demonstrate the professional capabilities acquired during the course.

This document sets the minimal requirement. You are encouraged to add new capabilities in according with your capabilities.

#1 Administrator Add Coupon Web Form (PHP Fundamentals \ Web Forms)
You should develop basic simple web form that allows the platform administrator to add a new coupon (no need in session handling). The web form should be generated using a PHP document that returns one of two possible outputs. The first includes the form. The form is displayed when none of the expected POST parameters is sent from the web browser. The second should be a textual feedback saying one of the following: The coupon was uploaded successfully or (in the case of errors) indicate what went wrong and provide a link through which the administrator can get the form. The web form that allows adding a new coupon should include the following fields: coupon name, coupon id, business name and coupon category. The business name should be selected from a SELECT element. The same with the coupon category. The uploaded file (coupon image) should be saved to a separated folder that includes all coupons images. For the moment, you can assume that there is a fixed list of businesses. For the moment you don’t need to update the database with the details of the new coupon.

#2 Server Side Classes (PHP Fundamentals \ Object Oriented Programming)
You should define the Business and Coupon classes. The Business class should include (at the minimum) the following fields: id, name, street, number, city, zip,telephone, latitude and longtitude. The Coupon class should include (at the minimum) the following fields: id, category_id, business_id, name,description and imagefilename.

#3 Database Schema (PHP Fundamentals \ Database Connectivity)
You should set up a database with the following three tables: categories, businesses and coupons. The coupons and the businesses tables should include columns in according with the fields defined in their matching classes. The categories table should include the category_id and the category_name columns. You should populate all three tables with data of 4-5 records in each table.
Define the ICouponsDAO interface that describes the data access object. It should include the following methods:
getCoupon($id)
addCoupon(Coupon $ob)
getCoupons()
updateCoupon(Coupon $ob)
Define the CouponsDAO class. It should implement ICouponsDAO and it should work with MySQL database using the MySQLi extension.
Develop a simple PHP script that prints out to the screen the details of all coupons. The data should be laid out in HTML table. You PHP script should use the CouponsDAO class.
Complete the Add Coupon web form by adding the required code that updates the database with the details of the new coupon.

#4  CSV File (PHP Fundamentals \ Files Access)
Develop a simple PHP script that generates a CSV file that includes the details of all coupons. The data should be fetched from the relevant tables. The data in each row should include the coupon id, the coupon name and the coupon short description.

#5 Security Aspects (PHP Security)
Go over your code so far and ensure that you implement all common security practices we covered in class.

#6 Coupons REStful Web Services (PHP Web Services)
Implement a REStful web service that returns an XML document that describes all coupons and a REStful web service that returns an XML document that describes a specific coupon.

#7 CouponsDAO Singleton Implementation (PHP Design Patterns)
Implement the Singleton design pattern in your definition for the CouponsDAO class.

#8 Using Log4PHP (Log4PHP Basics)
Add logging messages using Log4PHP to the CouponsDAO.

#9 Using PHPUnit (PHPUnit Framework)
Add unit tests for the CouponsDAO.
#9.5 Using Google Maps JavaScript API v3
You should develop a web page (part of the administrator interface) that shows a map (using Google Maps JavaScript API v3) and shows the location of each and every business (in according to the data that is already in the businesses table).

#9.6 Place Your On Going Project on GitHub
From now on, you should manage the versions you develop using the GitHub platform. You can find slides that explain how to do it in abelski.

#10 The Delete Coupon Web Form (Ajax Fundamentals)
Develop a web form through which the administrator can delete a coupon. The web form should include two SELECT elements. The first lists all businesses. The second lists the coupons associated with the business the administrator selects. Each change in the first SELECT element should update the other SELECT element accordingly. The update should be performed using Ajax.

#11 User Geo Location Coupons (HTML 5)
Develop a simple web page that lists the three nearest coupons (their associated business is the closest to the user geographic location).

#12 Coupons Platform Banner (CSS3 Basics)
Develop a CSS3 banner for mobile telephones web sites. You can develop it using the Sencha Animator. We will be able to use this banner when advertising the platform.

#13 Administrator Web Interface (jQuery Library)
Develop a simple web application composed of the web forms developed so far encapsulated in one web page that uses the jQuery UI Tabs widget.

#14 User Mobile Web Application (jQuery Mobile Basics, HTML5 Basics)
Complete the development of a mobile web application that presents the user with the nearest coupon. The first web page should present the user with a list of categories to choose from. The second web should present the user with the nearest coupons in the selected category. Make sure you keep the user category selection in $_SESSION. The user interface should be developed using jQuery Mobile.

#15 Android Coupons Application (Android Fundamentals, Phone Gap Basics)
Complete the development of an hybrid application for the android platform that presents the user with the three nearest coupons based on his category selection. Your hybrid application should use Phone Gap library for getting the user geo location data. Deploy your hybrid application for free download on the web.

#16 Chrome OS Application (Chrome OS Extensions)
Develop a simple Chrome OS application users will be able to install on their Chrome OS tablets. The application should allow the user to select the coupons category and get the nearest coupons in that category rendered on the screen.

#17 Chrome OS Extension (Chrome OS Extensions)
Develop a simple Chrome OS extension users will be able to install into their Chrome web browser. The extension should allow the user to select the coupons category and get the nearest coupons in that category rendered on the screen. The coupons category the user selects should be saved to the web browser local storage through the options page.

#18 Word Press Extension (WordPress Plugins Development)
Develop a simple word press plug-in that displays randomly selected coupons banners. The word press administrator should be capable of setting the number of displayed banners.

#19 Facebook Application (Facebook PHP SDK)
Develop a simple facebook applications that allows the user to browse the available coupons via the facebook platform.

#20 Administrator Interface (Zend Framework 2)
You should rewrite the code responsible for the administrator web interface in order to allow him to perform the various basic operations. You should use Zend Framework 2.

