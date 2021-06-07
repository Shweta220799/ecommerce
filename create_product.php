<?php
// set page headers

// core configuration
include_once "config/core.php";

// set page title
$page_title = "Add Products";
 
// include login checker
include_once "login_checker.php";

// include database and object files
include_once 'config/database.php';
include_once 'objects/products.php';

  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// pass connection to objects
$products = new Products($db);

$page_title = "Create Product";
include_once "layout_head.php";
  
echo "<div class='right-button-margin'>
        <a href='read_product.php' class='btn btn-default pull-right'>Read Products</a>
    </div>";
  
?>
<?php 
// if the form was submitted - PHP OOP CRUD Tutorial
if($_POST){
  
    // set downloads property values
    $products->productCode = $_POST['productCode'];
    $products->Description = $_POST['Description'];
    $products->Type = $_POST['Type'];
    $products->Category = $_POST['Category'];
    $products->UOM =$_POST['UOM'];


    // create the download
    if($products->create()){
        // try to upload the submitted file
        // uploadPhoto() method will return an error message, if any.
        echo "<div class='alert alert-success'>Product saved successfully</div>";
    }
  
    // if unable to create the product, tell the user
    else{
        echo "<div class='alert alert-danger'>Unable to save Product</div>";
    }
}
?>

<!-- 'create downloads' html form will be here -->
<form method="post" enctype="multipart/form-data" class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
     
    <table class="table table-bordered table-responsive">


    <!-- <tr>
        <td><label class="control-label">Product ID</label><b style="color:red">*</b></td>
           <td><input class="form-control" value='' type="text" name="id"  readonly /></td>
       </tr> -->

       <tr>
        <td><label class="control-label">Product Code</label><b style="color:red">*</b></td>
           <td><input class="form-control" value='' type="text" name="productCode" required autofocus placeholder="Enter Product Code" value="" /></td>
       </tr>

       <tr>
        <td><label class="control-label">Description</label></td>
           <td><input class="form-control" value='' type="text" name="Description" placeholder="Enter Description" value="" /></td>
       </tr>

       <tr>
        <td><label class="control-label">Type</label></td>
           <td><input class="form-control" value='' type="text" name="Type" placeholder="Enter Type" value="" /></td>
       </tr>

       <tr>
        <td><label class="control-label">Category</label></td>
           <td><input class="form-control" type="text"  name="Category" placeholder="Enter Product Category" value="" /></td>
       </tr>

       <tr>
        <td><label class="control-label">UOM</label></td>
           <td><input class="form-control" type="text" name="UOM" placeholder="Enter UOM" value="" /></td>
       </tr>

       <tr>
           <td colspan="2"><button type="submit" name="btnsave" style="background-color: blue;color:white" class="btn btn-default">
           <span class="glyphicon glyphicon-save"></span> &nbsp; Save Product
           </button>
           </td>
       </tr>
       
       </table>
       
   </form>

<?php
  
// footer
include_once "layout_foot.php";
?>