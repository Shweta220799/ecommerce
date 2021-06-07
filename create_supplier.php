<?php
// set page headers

// core configuration
include_once "config/core.php";

// set page title
$page_title = "Add Suppliers";
 
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

$page_title = "Create Supplier";
include_once "layout_head.php";
  
echo "<div class='right-button-margin'>
        <a href='read_supplier.php' class='btn btn-default pull-right'>Read Suppliers</a>
    </div>";
  
?>
<?php 
// if the form was submitted - PHP OOP CRUD Tutorial
if($_POST){
  
    // set downloads property values 
    $suppliers->supplierName = $_POST['supplierName'];
    $suppliers->supplierAddress = $_POST['supplierAddress'];
    $suppliers->phone = $_POST['phone'];
    $suppliers->mobile = $_POST['mobile'];
    $suppliers->vatTINNo = $_POST['vatTINNo'];
    $suppliers->CSTTinNo = $_POST['CSTTinNo'];


    // create the download
    if($suppliers->create()){
        // try to upload the submitted file
        // uploadPhoto() method will return an error message, if any.
        echo "<div class='alert alert-success'>Supplier saved successfully</div>";
    }
  
    // if unable to create the product, tell the user
    else{
        echo "<div class='alert alert-danger'>Unable to save supplier</div>";
    }
}
?>

<!-- 'create downloads' html form will be here -->
<form method="post" enctype="multipart/form-data" class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
     
    <table class="table table-bordered table-responsive">
    
    <!-- <tr>
        <td><label class="control-label">Suppliers ID</label><b style="color:red">*</b></td>
           <td><input class="form-control" value='' type="text" name="id"  readonly /></td>
       </tr> -->

       <tr>
        <td><label class="control-label">Name</label><b style="color:red">*</b></td>
           <td><input class="form-control" value='' type="text" name="supplierName" required autofocus placeholder="Enter Title" value="" required /></td>
       </tr>
       
       <tr>
        <td><label class="control-label">Address</label></td>
           <td><input class="form-control" value='' type="text" name="supplierAddress" placeholder="Enter Course" value="" required/></td>
       </tr>

       <tr>
        <td><label class="control-label">Phone</label></td>
           <td><input class="form-control" value='' type="text" name="phone" placeholder="Enter Course" value="" required /></td>
       </tr>

       <tr>
        <td><label class="control-label">Mobile</label></td>
           <td><input class="form-control" value='' type="text" name="mobile" placeholder="Enter Course" value="" required /></td>
       </tr>

       <tr>
        <td><label class="control-label">VAT</label></td>
           <td><input class="form-control" value='' type="text" name="vatTINNo" placeholder="Enter Course" value="" required /></td>
       </tr>
        
       <tr>
        <td><label class="control-label">CST</label></td>
           <td><input class="form-control" value='' type="text" name="CSTTinNo" placeholder="Enter Course" value="" required/></td>
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