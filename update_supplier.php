<?php

// get ID of the download to be edited
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

// set page headers

// core configuration
include_once "config/core.php";

// set page title
$page_title = "Update Supplier";
 
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
// if the form was submitted - PHP OOP CRUD Tutorial
if($_POST){
  
    // set downloads property values
    $suppliers->supplierID = $_POST['supplierID'];
    $suppliers->supplierName = $_POST['supplierName'];
    $suppliers->supplierAddress = $_POST['supplierAddress'];
    $suppliers->phone = $_POST['phone'];
    $suppliers->mobile = $_POST['mobile'];
    $suppliers->vatTINNo = $_POST['vatTINNo'];
    $suppliers->CSTTinNo = $_POST['CSTTinNo'];
    // create the download
    if($suppliers->update()){
        // try to upload the submitted file       
        echo "<div class='alert alert-success'>Product Updated successfully</div>";
    }
  
    // if unable to create the product, tell the user
    else{
        echo "<div class='alert alert-danger'>Unable to save product</div>";
    }
}
?>

<!-- 'create downloads' html form will be here -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">

     
    <table class="table table-bordered table-responsive">
    
    <tr>
        <td><label class="control-label">Suppliers ID</label><b style="color:red">*</b></td>
           <td><input class="form-control" value='<?php echo $id ?>' type="text" name="supplierID"  readonly /></td>
       </tr>

       <tr>
        <td><label class="control-label">Name</label><b style="color:red">*</b></td>
           <td><input class="form-control" value='<?php echo $suppliers->supplierName; ?>' type="text" name="supplierName" required autofocus placeholder="Enter Title" value="" /></td>
       </tr>
       
       <tr>
        <td><label class="control-label">Address</label></td>
           <td><input class="form-control" value='<?php echo $suppliers->supplierAddress; ?>' type="text" name="supplierAddress" placeholder="Enter Course" value="" /></td>
       </tr>

       <tr>
        <td><label class="control-label">Phone</label></td>
           <td><input class="form-control" value='<?php echo $suppliers->phone; ?>' type="text" name="phone" placeholder="Enter Course" value="" /></td>
       </tr>

       <tr>
        <td><label class="control-label">Mobile</label></td>
           <td><input class="form-control" value='<?php echo $suppliers->mobile; ?>' type="text" name="mobile" placeholder="Enter Course" value="" /></td>
       </tr>

       <tr>
        <td><label class="control-label">VAT</label></td>
           <td><input class="form-control" value='<?php echo $suppliers->vatTINNo; ?>' type="text" name="vatTINNo" placeholder="Enter Course" value="" /></td>
       </tr>
        
       <tr>
        <td><label class="control-label">CST</label></td>
           <td><input class="form-control" value='<?php echo $suppliers->CSTTinNo; ?>' type="text" name="CSTTinNo" placeholder="Enter Course" value="" /></td>
       </tr>
      
       <tr>
           <td colspan="2"><button type="submit" name="btnsave" style="background-color: blue;color:white" class="btn btn-default">
           <span class="glyphicon glyphicon-save"></span> &nbsp; Save Supplier
           </button>
           </td>
       </tr>
       
       </table>
       
   </form>

<?php
  
// footer
include_once "layout_foot.php";
?>