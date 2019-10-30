<?php
$filepath=realpath(dirname(__FILE__));
 include_once ($filepath.'/../lib/Database.php');
 include_once ($filepath.'/../helpers/Format.php'); 
?>

<?php
class Product {
    private $db;
    private $fm;

    public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function productInsert($data,$file){
        $productName = mysqli_real_escape_string( $this->db->link ,$data['productName']); 
        $id = mysqli_real_escape_string( $this->db->link ,$data['id']); 
        $body = mysqli_real_escape_string( $this->db->link ,$data['body']); 
        $price = mysqli_real_escape_string( $this->db->link ,$data['price']); 
        $type = mysqli_real_escape_string( $this->db->link ,$data['type']); 

        $permited  = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $file['image']['name'];
        $file_size = $file['image']['size'];
        $file_temp = $file['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "uploads/".$unique_image;

        if (empty($file_name)) {
            echo "<span class='error'>Please Select any Image !</span>";
        }elseif ($file_size >1048567) {
             echo "<span class='error'>Image Size should be less then 1MB!
              </span>";
        } elseif (in_array($file_ext, $permited) === false) {
            echo "<span class='error'>You can upload only:-"
            .implode(', ', $permited)."</span>";
        } else{
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "INSERT INTO tbl_product(productName, id, body, price, image, type) VALUES('$productName','$id','$body', '$price', '$uploaded_image', '$type')";
            $productinsert= $this->db->insert($query);
            if($productinsert){
                $msg = "<span class = 'success'> Product Inserted Successfully</span>";
                return $msg;
            }
            else{
                $msg = "<span class = 'error'> Cat Not Inserted Successfully</span>";
                return $msg;
            }
            
            $inserted_rows = $db->insert($query);
            if ($inserted_rows) {
                 echo "<span class='success'>Image Inserted Successfully.
                 </span>";
            }else {
                 echo "<span class='error'>Image Not Inserted !</span>";
            }
          }
        }

        public function getAllProduct(){
            $query = "SELECT  tbl_product.*, tbl_category.catName
            FROM  tbl_product
            INNER JOIN  tbl_category
            ON tbl_product.id = tbl_category.id
            ORDER BY tbl_product.productId DESC";
            $result = $this->db->select($query);
            return $result;
        }
        public function getProById($id){
            $query="SELECT * FROM tbl_product WHERE productId='$id'";
            $result= $this->db->select($query);
            return $result;
        }

        public function productUpdate($data, $file, $id){
            $productName = mysqli_real_escape_string( $this->db->link ,$data['productName']); 
            $catId = mysqli_real_escape_string( $this->db->link ,$data['id']); 
            $body = mysqli_real_escape_string( $this->db->link ,$data['body']); 
            $price = mysqli_real_escape_string( $this->db->link ,$data['price']); 
            $type = mysqli_real_escape_string( $this->db->link ,$data['type']); 

            $permited  = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $file['image']['name'];
            $file_size = $file['image']['size'];
            $file_temp = $file['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "uploads/".$unique_image;

            if ($productName=="" || $id=="" || $body=="" || $price=="" || $type=="") {
                echo "<span class='error'>Please Select any Image !</span>";
            }else{
                if(!empty($file_name)){
                    if ($file_size >1048567) {
                        echo "<span class='error'>Image Size should be less then 1MB!
                        </span>";
                    } elseif (in_array($file_ext, $permited) === false) {
                        echo "<span class='error'>You can upload only:-"
                        .implode(', ', $permited)."</span>";
                    } else{
                        move_uploaded_file($file_temp, $uploaded_image);
                        $query  = "UPDATE tbl_product
                                    SET
                                    productName='$productName'
                                    id='$catId'
                                    body='$body'
                                    price='$price'
                                    image='$uploaded_image'
                                    type='$type'

                                    WHERE productId='$id'
                                    ";
                        $productinsert= $this->db->insert($query);
                        if($productinsert){
                            $msg = "<span class = 'success'> Product Updated Successfully</span>";
                            return $msg;
                        }
                        else{
                            $msg = "<span class = 'error'> Product Not Updated Successfully</span>";
                            return $msg;
                        }
                        
                        $updated_rows = $db->update($query);
                        if ($inserted_rows) {
                            echo "<span class='success'>Image Inserted Successfully.
                            </span>";
                        }else {
                            echo "<span class='error'>Image Not Inserted !</span>";
                        }
                    }
                }else{
                    $query  = "UPDATE tbl_product
                                SET
                                productName='$productName',
                                id='$catId',
                                body='$body',
                                price='$price',
                                type='$type'

                                WHERE productId='$id'
                                ";
                    $productUpdate= $this->db->update($query);
                    if($productUpdate){
                        $msg = "<span class = 'success'> Product Updated Successfully</span>";
                        return $msg;
                    }
                    else{
                        $msg = "<span class = 'error'> Product Not Updated Successfully</span>";
                        return $msg;
                    }
                }
             }

        }

        public function getFeaturedProduct(){
            $query="SELECT * FROM tbl_product WHERE type='0' ORDER BY productId DESC LIMIT 4";
            $result= $this->db->select($query);
            return $result;
        }

        public function getSingleProduct($id){
            $query = "SELECT  tbl_product.*, tbl_category.catName
            FROM  tbl_product
            INNER JOIN  tbl_category
            ON tbl_product.id = tbl_category.id AND tbl_product.productId='$id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function delProductById($id){
            $query="DELETE FROM tbl_product WHERE productId='$id'";
            $deldata=$this->db->delete($query);
        }
       
    }
?>