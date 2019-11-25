<?php
$filepath=realpath(dirname(__FILE__));
 include_once ($filepath.'/../lib/Database.php');
 include_once ($filepath.'/../helpers/Format.php'); 
?>

<?php
class Cart{
    private $db;
    private $fm;

    public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function addToCart($quantity,$id){
        $quantity =  $this->fm->validation($quantity);
        $quantity = mysqli_real_escape_string( $this->db->link ,$quantity); 
        $productId = mysqli_real_escape_string( $this->db->link ,$id); 
        $sId = session_id();

        $squery="SELECT * FROM tbl_product WHERE productId='$productId'";
        $result= $this->db->select($squery)->fetch_assoc();
        
        $productName=$result['productName'];
        $price=$result['price'];
        $image=$result['image'];

        $query = "INSERT INTO tbl_cart(sid,productId, productName, price, quantity, image) VALUES('$sId','$productId','$productName', '$price', '$quantity', '$image')";
            $inserted_row= $this->db->insert($query);
            if($inserted_row){
                header("Location:cart.php");
            }
            else{
                header("Location:preview.php");

            }
    }
    public function getCartProduct(){
        $sid = session_id();
        $query="SELECT * FROM tbl_cart WHERE sid='$sid'";
        $result= $this->db->select($query);
        return $result;
    }

    public function updateCartQuantity($cartId,$quantity){
        $cartId = mysqli_real_escape_string( $this->db->link ,$cartId); 
        $quantity = mysqli_real_escape_string( $this->db->link ,$quantity);
        $query="UPDATE tbl_cart SET  quantity='$quantity' WHERE cartId='$cartId'";
        $update_row=$this->db->update($query);
        if($update_row){
            $msg = "<span class = 'success'> Cart Updated Successfully</span>";
            return $msg;
        }
        else{
            $msg = "<span class = 'error'>Not Successfully</span>";
            return $msg;
        } 

    }
    public function delProductByCart($id){
        $query="DELETE FROM tbl_cart WHERE cartId='$id'";
        $deldata=$this->db->delete($query);
    }
}


?>