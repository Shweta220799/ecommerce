<?php

// get ID of the download to be edited
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

// set page headers

// core configuration
include_once "config/core.php";

// set page title
$page_title = "Delete Supplier";
 
// include login checker
include_once "login_checker.php";

// include database and object files
include_once 'config/database.php';
include_once 'objects/suppliers.php';

  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// pass connection to objects
$suppliers = new Suppliers($db);
// set ID property of product to be edited
$suppliers->supplierID = $id;
 
// read the details of product to be edited
$suppliers->readOne();

include_once "layout_head.php";

echo "<div class='right-button-margin'>
        <a href='read_supplier.php' class='btn btn-default pull-right'>Read Suppliers</a>
    </div>";

?>


<?php 

  
    $suppliers->supplierID = $_GET['id'];
    // create the download
    if($suppliers->delete()){
       
        echo "<div class='alert alert-success'>Supplier deleted successfully</div>";
       // header("Location: read_downloads.php");
    }
  
    // if unable to create the product, tell the user
    else{
        echo "<div class='alert alert-danger'>Unable to save supplier</div>";
    }

?>




<?php
  
// footer
include_once "layout_foot.php";
?>