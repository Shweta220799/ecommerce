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
include_once 'objects/suppliers.php';


// get database connection
$database = new Database();
$db = $database->getConnection();
 
$objSuppliers = new Suppliers($db);

// set ID property of download to be read
$objSuppliers->supplierID=$id;

  
// read the details of download to be read
$objSuppliers->readOne();
// set page header
$page_title = "Read Supplier";

include_once "layout_head.php";


 
// read products button
echo "<div class='right-button-margin'>";
    echo "<a href='read_supplier.php' class='btn btn-primary pull-right'>";
        echo "<span class='glyphicon glyphicon-list'></span> Read Suppliers";
    echo "</a>";
echo "</div>";
 
// HTML table for displaying a download details
echo "<table class='table table-hover table-responsive table-bordered'>";
  
    echo "<tr>";
        echo "<td>Supplier ID</td>";
        echo "<td>{$objSuppliers->supplierID}</td>";
    echo "</tr>";
  
    echo "<tr>";
        echo "<td>Name</td>";
        echo "<td>{$objSuppliers->supplierName}</td>";
    echo "</tr>";
  
    echo "<tr>";
        echo "<td>Address</td>";
        echo "<td>{$objSuppliers->supplierAddress}</td>";
    echo "</tr>";
  
    echo "<tr>";
        echo "<td>Phone</td>";
        echo "<td>{$objSuppliers->phone}</td>";
    echo "</tr>";
  
    echo "<tr>";
        echo "<td>Mobile</td>";
        echo "<td>{$objSuppliers->mobile}</td>";
    echo "</tr>";

    echo "<tr>";
        echo "<td>VAT</td>";
        echo "<td>{$objSuppliers->vatTINNo}</td>";
    echo "</tr>";

    echo "<tr>";
        echo "<td>CST</td>";
        echo "<td>{$objSuppliers->CSTTinNo}</td>";
    echo "</tr>";

    echo "<tr>";
        echo "<td>Uploaded Date</td>";
        echo "<td>{$objSuppliers->createdOn}</td>";
    echo "</tr>";
echo "</table>";
// set footer
include_once "layout_foot.php";
?>