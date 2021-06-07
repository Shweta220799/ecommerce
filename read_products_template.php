<?php

// search form
echo "<form role='search' action='search_products.php'>";
    echo "<div class='input-group col-md-3 pull-left margin-right-1em'>";
        $search_value=isset($search_term) ? "value='{$search_term}'" : "";
        echo "<input type='text' class='form-control' placeholder='Type course or title...' name='s' id='srch-term' required {$search_value} />";
        echo "<div class='input-group-btn'>";
            echo "<button class='btn btn-primary' type='submit'><i class='glyphicon glyphicon-search'></i></button>";
        echo "</div>";
    echo "</div>";
echo "</form>";
echo "<br>";
// add User button
echo "<div class='right-button-margin'>";
    echo "<a href='create_product.php' class='btn btn-primary pull-right'>";
        echo "<span class='glyphicon glyphicon-plus'></span> Add Products";
    echo "</a>";
echo "</div>";

if($total_rows>0){
 

    echo "<table class='table table-hover table-responsive table-bordered'>";
        echo "<tr>";
            echo "<th>Product ID</th>";
            echo "<th>Product Code</th>";
            echo "<th>Product Description</th>";
            echo "<th>Product Type</th>";
            echo "<th>Product Category</th>";
            echo "<th>UOM</th>";
            echo "<th>Uploaded Date</th>";

        echo "</tr>";
 
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
 
            extract($row);
 
            echo "<tr>";
            
                echo "<td>{$productid}</td>";
                echo "<td>{$productCode}</td>";
                echo "<td>{$Description}</td>";
                echo "<td>{$Type}</td>";
                echo "<td>{$Category}</td>";
                echo "<td>{$UOM}</td>";
                
                $date=date_create($createdOn);
                $newDate= date_format($date, "d-m-Y");
                
                echo "<td> {$newDate}</td>";
                echo "<td>";
 
                    // read downloads button
                    echo "<a href='read_one_product.php?id={$productid}' class='btn btn-primary left-margin'>";
                        echo "<span class='glyphicon glyphicon-list'></span> Read ";
                    echo "</a> &nbsp";
 
                    // edit downloads button
                    echo "<a href='update_product.php?id={$productid}' class='btn btn-info left-margin'>";
                        echo "<span class='glyphicon glyphicon-edit'></span> Edit";
                    echo "</a> &nbsp";
 
                    // delete downloads button
                    echo "<a href='delete_product.php?id={$productid}' class='btn btn-danger delete-object'>";
                        echo "<span class='glyphicon glyphicon-remove'></span> Delete";
                    echo "</a> &nbsp";
 
 
                echo "</td>";
 
            echo "</tr>";
 
        }
 
    echo "</table>";
 
 $page_url="read_products.php?";
    $total_rows = $objProducts->countAll();
    // paging buttons
    include_once 'paging.php';
}
 
// tell the user there are no products
else{
    echo "<div class='alert alert-danger'>No Products found.</div>";
}
?>
