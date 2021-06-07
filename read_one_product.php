<?php
// core configuration
include_once "config/core.php";
 
// check if logged in as admin
include_once "login_checker.php";

// get ID of the product to be read
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

// retrieve records here
// include database and object files
// include classes

include_once 'config/database.php';
include_once 'objects/products.php';


// get database connection
$database = new Database();
$db = $database->getConnection();
 
$objProducts = new Products($db);

// set ID property of download to be read
$objProducts->productid=$id;

  
// read the details of download to be read
$objProducts->readOne();
// set page header
$page_title = "Read Product";

include_once "layout_head.php";


 
// read products button
echo "<div class='right-button-margin'>";
    echo "<a href='read_product.php' class='btn btn-primary pull-right'>";
        echo "<span class='glyphicon glyphicon-list'></span> Read Products";
    echo "</a>";
echo "</div>";
 
// HTML table for displaying a download details
echo "<table class='table table-hover table-responsive table-bordered'>";
  
    echo "<tr>";
        echo "<td>Product ID</td>";
        echo "<td>{$objProducts->productid}</td>";
    echo "</tr>";
  
    echo "<tr>";
        echo "<td>Product Code</td>";
        echo "<td>{$objProducts->productCode}</td>";
    echo "</tr>";

    echo "<tr>";
        echo "<td>Product Description</td>";
        echo "<td>{$objProducts->Description}</td>";
    echo "</tr>";
  
    echo "<tr>";
        echo "<td>Product Type</td>";
        echo "<td>{$objProducts->Type}</td>";
    echo "</tr>";
  
    echo "<tr>";
        echo "<td>Product Category</td>";
        echo "<td>{$objProducts->Category}</td>";
    echo "</tr>";
  
    echo "<tr>";
        echo "<td>UOM</td>";
        echo "<td>{$objProducts->UOM}</td>";
    echo "</tr>";

    echo "<tr>";
        echo "<td>Uploaded Date</td>";
        echo "<td>{$objProducts->createdOn}</td>";
    echo "</tr>";
echo "</table>";
// set footer
include_once "layout_foot.php";
?>