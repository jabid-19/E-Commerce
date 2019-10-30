<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include_once '../classes/Category.php';?>
<?php include_once '../classes/Product.php';?>
<?php

if(!isset($_GET['proid'])){
    echo "<script> window.location = 'productlist.php';</script> ";
}
else{
    $id=$_GET['proid'];
}
$pd = new Product();

if($_SERVER['REQUEST_METHOD']=='POST'){

    $updateProduct = $pd->productUpdate($_POST, $_FILES, $id);
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Product</h2>
        <div class="block">           
            <?php
                if(isset($updateProduct)){
                    echo $updateProduct;
                }
            ?>
            <?php
                $getPro=$pd->getProById($id);
                if ($getPro) {
                    while($value=$getPro->fetch_assoc()){
            ?>
            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">
                
                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input type="text" name="productName" value="<?php echo $value['productName']?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Category</label>
                        </td>
                        <td>
                            <select id="select" name="id">
                                <option>Select Category</option>
                                <?php
                                    $cat= new Category();
                                    $getCat= $cat->getAllCat();
                                    if ( $getCat) {
                                    while($result = $getCat->fetch_assoc()){    
                                ?>
                                <option
                                <?php
                                    if($value['id']==$result['id']){ ?>
                                        selected="Selected";
                                <?php   }?>
                                value="<?php echo $result['id'];?>"><?php echo $result['catName'];?></option>
                                        <?php } }?>
                            </select>
                        </td>
                    </tr> 
                    
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Description</label>
                        </td>
                        <td>
                            <textarea name="body" class="tinymce" >
                                    <?php echo $value['body']?>
                            </textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Price</label>
                        </td>
                        <td>
                            <input type="text" name="price" value="<?php echo $value['price']?>" class="medium" />
                        </td>
                    </tr>
                
                    <tr>
                        <td>
                            <label>Upload Image</label>
                            <img src="<?php echo $value['image']?>" height="80px" width="200px" alt=""><br/>
                        </td>
                        <td>
                            <input type="file" name="image" />
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <label>Product Type</label>
                        </td>
                        <td>
                            <select id="select" name="type">
                                <option>Select Type</option>
                                <option value="0">Featured</option>
                                <option value="1">General</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" value="Update" />
                        </td>
                    </tr>
                </table>
                </form>
                <?php } }?>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>
