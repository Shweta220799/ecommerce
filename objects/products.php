<?php


class Products
{
    private $conn;
    private $table_name = "product_master";

    public $productid;
    public $productCode;
    public $Description;
    public $Size;
    public $Pattern;
    public $Type;
    public $Category;
    public $UOM;
    public $reorderLevel;
    public $make;
    public $makeID;
    public $createdBy;
    public $createdOn;
    public $modifiedBy;
    public $modifiedOn;
    public $active;

    public function __construct($db){
        $this->conn = $db;
       // echo $this->conn;
    }



    // read downloads by search term
    public function search($search_term, $from_record_num, $records_per_page)
    {
        // select query
        $query = "SELECT productid, productCode, Description, Size, Pattern, Type, Category, UOM, reorderLevel,
        make, makeID, createdBy, createdOn
        FROM " . $this->table_name .  " where productCode LIKE ? OR Type LIKE ? LIMIT ?, ?";
                
        //echo "<br>" .$query;
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
        
        // bind variable values
        $search_term = "%{$search_term}%";
        $stmt->bindParam(1, $search_term);
        $stmt->bindParam(2, $search_term);
        $stmt->bindParam(3, $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(4, $records_per_page, PDO::PARAM_INT);
        
        // execute query
        $stmt->execute();
        // echo "<br>" .$stmt->rowCount();
        
        // return values from database
        return $stmt;
    }
   
   public function countAll_BySearch($search_term){
        // select query
       $query = "SELECT
                   COUNT(*) as total_rows
               FROM
                       " . $this->table_name . " p 
               WHERE
                   p.Description LIKE ? OR p.productCode LIKE ?";
    
        //echo "<br>" .$query;
       // prepare query statement
       $stmt = $this->conn->prepare( $query );
    
       // bind variable values
       $search_term = "%{$search_term}%";
       $stmt->bindParam(1, $search_term);
    
       $stmt->execute();
       $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
       return $row['total_rows'];
   }
   
    function readAll($from_record_num, $records_per_page){
 
        $query = "SELECT
                    productid, productCode,Description, Type, Category, UOM, createdOn
                FROM
                    " . $this->table_name . "
                ORDER BY createdOn desc
                LIMIT
                    {$from_record_num}, {$records_per_page}";
             
             //echo $query;      
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        
        return $stmt;
    } 
    
        
    function readOne(){
 
        $query = "SELECT   productid, productCode,Description, Type, Category, UOM, createdOn
        FROM " . $this->table_name .  " where productid = ?  LIMIT  0,1";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->productid);
        $stmt->execute();
     
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->productid = $row['productid'];
        $this->productCode = $row['productCode'];
        $this->Description = $row['Description'];
        $this->Type = $row['Type'];
        $this->Category = $row['Category'];
        $this->UOM = $row['UOM'];
        $this->createdOn = $row['createdOn'];
    }
    
    // used for paging products
    public function countAll(){
 
        $query = "SELECT productid FROM " . $this->table_name . "";
    
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
    
        $num = $stmt->rowCount();
    
        return $num;
    }
        
              
        
    function update(){

        // productCode = :productCode,
        //         Description = :Description,
        //         Type = :Type,
        //         Category = :Category,
        //         UOM = :UOM,
        //         createdOn = :createdOn,
        //         modifiedOn=:modifiedOn,active=0";
        $query = "UPDATE
        " . $this->table_name . "
              SET
              productCode = :productCode,
              Description = :Description,
              Type = :Type,
              Category = :Category,
              UOM = :UOM,
              modifiedOn = :modifiedOn
               WHERE
               productid = :productid";
      // echo $query;
      $stmt = $this->conn->prepare($query);
      // posted values
      $this->productid=htmlspecialchars(strip_tags($this->productid));
      $this->productCode=htmlspecialchars(strip_tags($this->productCode));
      $this->Description=htmlspecialchars(strip_tags($this->Description));
      $this->Type=htmlspecialchars(strip_tags($this->Type));
      $this->Category=htmlspecialchars(strip_tags($this->Category)); 
      $this->UOM=htmlspecialchars(strip_tags($this->UOM));       
      $this->modifiedOn=htmlspecialchars(strip_tags($this->modifiedOn));       
     // $this->CSTTinNo=htmlspecialchars(strip_tags($this->CSTTinNo)); 
      
            // to get time-stamp for 'created' field
            $this->timestamp = date('Y-m-d');
       
       // bind values 
       $stmt->bindParam(":productid", $this->productid);
       $stmt->bindParam(":productCode", $this->productCode);
       $stmt->bindParam(":Description", $this->Description);
       $stmt->bindParam(":Type", $this->Type);
       $stmt->bindParam(":Category", $this->Category);
       $stmt->bindParam(":UOM", $this->UOM);
       $stmt->bindParam(":modifiedOn", $this->timestamp);
       
  
      // execute the query
      if($stmt->execute()){
          return true;
      }
  
      return false;
        
        
    }
    function delete(){
    
        $query = "DELETE FROM " . $this->table_name . "  WHERE productid = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->productid);
    
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    function create(){
        //write query 
        $query = "INSERT INTO
                        " . $this->table_name . "
                SET
                productCode = :productCode,
                Description = :Description,
                Type = :Type,
                Category = :Category,
                UOM = :UOM,
                createdOn = :createdOn,
                modifiedOn=:modifiedOn,active=0";

                

        $stmt = $this->conn->prepare($query);
        // posted values
    
        $this->productCode=htmlspecialchars(strip_tags($this->productCode));
        $this->Description=htmlspecialchars(strip_tags($this->Description));
        $this->Type=htmlspecialchars(strip_tags($this->Type)); 
        $this->Category=htmlspecialchars(strip_tags($this->Category));       
        $this->UOM=htmlspecialchars(strip_tags($this->UOM));       
        $this->createdOn=htmlspecialchars(strip_tags($this->createdOn));   
        $this->modifiedOn=htmlspecialchars(strip_tags($this->modifiedOn));   
        
            // to get time-stamp for 'created' field
            $this->timestamp = date('Y-m-d');
            // $this->status=1;
            // bind values
            
            $stmt->bindParam(":productCode", $this->productCode);
            $stmt->bindParam(":Description", $this->Description);
            $stmt->bindParam(":Type", $this->Type);
            $stmt->bindParam(":Category", $this->Category);
            $stmt->bindParam(":UOM", $this->UOM);
            $stmt->bindParam(":createdOn", $this->timestamp);
            $stmt->bindParam(":modifiedOn", $this->timestamp);     
   
            if($stmt->execute()){
                return true;
            }else{
                return false;
            }
 
    }
  

        }


//$foo = new Foo($db);
//$funcname = "Variable";
//$foo->create(); // This calls $foo->Variable()

?>