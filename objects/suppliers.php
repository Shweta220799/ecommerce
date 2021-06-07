<?php


class Suppliers
{
    private $conn;
    private $table_name = "supplier_master";

    public $supplierID;
    public $supplierName;
    public $supplierAddress;
    public $phone;
    public $mobile;
    public $email;
    public $vatTINNo;
    public $CSTTinNo;
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
        $query = "SELECT supplierID, supplierName, supplierAddress, phone, mobile, email, vatTINNo, CSTTinNo, 
              createdBy, createdOn 
        FROM " . $this->table_name .  " where supplierName LIKE ? OR supplierAddress LIKE ? LIMIT ?, ?";
                
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
                   p.supplierAddress LIKE ? OR p.supplierName LIKE ?";
    
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
                    supplierID, supplierName, supplierAddress, phone, mobile, vatTINNo, CSTTinNo, createdOn
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
 
        $query = "SELECT   supplierID, supplierName, supplierAddress, phone, mobile, vatTINNo, CSTTinNo, createdOn
        FROM " . $this->table_name .  " where supplierID = ?  LIMIT  0,1";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->supplierID);
        $stmt->execute();
     
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->supplierID = $row['supplierID'];
        $this->supplierName = $row['supplierName'];
        $this->supplierAddress = $row['supplierAddress'];
        $this->phone = $row['phone'];
        $this->mobile = $row['mobile'];
        $this->vatTINNo = $row['vatTINNo'];
        $this->CSTTinNo = $row['CSTTinNo'];
        $this->createdOn = $row['createdOn'];
    }
    
    // used for paging products
    public function countAll(){
 
        $query = "SELECT supplierID FROM " . $this->table_name . "";
    
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
    
        $num = $stmt->rowCount();
    
        return $num;
    }
        
              
        
    function update(){
  
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    supplierName = :supplierName,
                    supplierAddress = :supplierAddress,
                    phone = :phone,
                    mobile = :mobile,
                    vatTINNo = :vatTINNo,
                    CSTTinNo = :CSTTinNo
                    
                WHERE
                    supplierID = :supplierID";
        
  // echo $query;
        $stmt = $this->conn->prepare($query);
        // posted values
        $this->supplierID=htmlspecialchars(strip_tags($this->supplierID));
        $this->supplierName=htmlspecialchars(strip_tags($this->supplierName));
        $this->supplierAddress=htmlspecialchars(strip_tags($this->supplierAddress));
        $this->phone=htmlspecialchars(strip_tags($this->phone)); 
        $this->mobile=htmlspecialchars(strip_tags($this->mobile));       
        $this->vatTINNo=htmlspecialchars(strip_tags($this->vatTINNo));       
        $this->CSTTinNo=htmlspecialchars(strip_tags($this->CSTTinNo)); 
        
         
         // bind values 
         $stmt->bindParam(":supplierID", $this->supplierID);
         $stmt->bindParam(":supplierName", $this->supplierName);
         $stmt->bindParam(":supplierAddress", $this->supplierAddress);
         $stmt->bindParam(":phone", $this->phone);
         $stmt->bindParam(":mobile", $this->mobile);
         $stmt->bindParam(":vatTINNo", $this->vatTINNo);
         $stmt->bindParam(":CSTTinNo", $this->CSTTinNo);
    
        // execute the query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }
    function delete(){
    
        $query = "DELETE FROM " . $this->table_name . "  WHERE supplierID = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->supplierID);
    
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
                supplierName = :supplierName,
                    supplierAddress = :supplierAddress,
                    phone = :phone,
                    mobile = :mobile,
                    vatTINNo = :vatTINNo,
                    CSTTinNo = :CSTTinNo,
                    createdOn = :createdOn";

        $stmt = $this->conn->prepare($query);
        // posted values

        $this->supplierName=htmlspecialchars(strip_tags($this->supplierName));
        $this->supplierAddress=htmlspecialchars(strip_tags($this->supplierAddress));
        $this->phone=htmlspecialchars(strip_tags($this->phone)); 
        $this->mobile=htmlspecialchars(strip_tags($this->mobile));       
        $this->vatTINNo=htmlspecialchars(strip_tags($this->vatTINNo));       
        $this->CSTTinNo=htmlspecialchars(strip_tags($this->CSTTinNo));   
        
            // to get time-stamp for 'created' field
            $this->timestamp = date('Y-m-d H:i:s');
            // $this->status=1;
            // bind values 

            $stmt->bindParam(":supplierName", $this->supplierName);
            $stmt->bindParam(":supplierAddress", $this->supplierAddress);
            $stmt->bindParam(":phone", $this->phone);
            $stmt->bindParam(":mobile", $this->mobile);
            $stmt->bindParam(":vatTINNo", $this->vatTINNo);
            $stmt->bindParam(":CSTTinNo", $this->CSTTinNo);
            $stmt->bindParam(":createdOn", $this->timestamp);
    
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