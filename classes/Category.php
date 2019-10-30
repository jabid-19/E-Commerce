<?php
$filepath=realpath(dirname(__FILE__));
 include_once ($filepath.'/../lib/Database.php');
 include_once ($filepath.'/../helpers/Format.php'); 
?>

<?php
class Category {
    private $db;
    private $fm;

    public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function catInsert($catName){
        $catName =  $this->fm->validation($catName);
        $catName = mysqli_real_escape_string( $this->db->link ,$catName); 
        if(empty($catName)){
            $msg = "Category Name Needed ";
            return $msg; 
        }
        else{
            $query="INSERT INTO tbl_category(catName) VALUES('$catName')";
            $catinsert= $this->db->insert($query);
            if($catinsert){
                $msg = "<span class = 'success'> Cat Inserted Successfully</span>";
                return $msg;
            }
            else{
                $msg = "<span class = 'error'> Cat Not Inserted Successfully</span>";
                return $msg;
            }
        }
    }

    public function catUpdate($catName, $id){
        $catName =  $this->fm->validation($catName);
        $catName = mysqli_real_escape_string( $this->db->link ,$catName); 
        $id = mysqli_real_escape_string( $this->db->link ,$id); 
        if(empty($catName)){
            $msg = "Category Fields Needed ";
            return $msg; 
        }
        else{
            $query="UPDATE tbl_category SET  catName='$catName' WHERE id='$id'";
            $update_row=$this->db->update($query);
            if($update_row){
                $msg = "<span class = 'success'> Cat Updated Successfully</span>";
                return $msg;
            }
            else{
                $msg = "<span class = 'error'>Not Successfully</span>";
                return $msg;
            }
        }
    }

    public function getAllCat(){
        $query="SELECT * FROM tbl_category ORDER BY id DESC";
        $result= $this->db->select($query);
        return $result;
    }

    public function getCatById($id){
        $query="SELECT * FROM tbl_category WHERE id='$id'";
        $result= $this->db->select($query);
        return $result;
    }
    public function delCatById($id){
        $query="DELETE FROM tbl_category WHERE id='$id'";
        $deldata=$this->db->delete($query);
    }
}

?>

