<?php include 'inc/header.php';?>
<?php
if(!isset($_GET['proid'])){
    echo "<script> window.location = 'index.php';</script> ";
}
else{
    $id=$_GET['proid'];
}
if($_SERVER['REQUEST_METHOD']=='POST'){
    $quantity = $_POST['quantity'];
    $addCart = $ct->addToCart($quantity,$id);
}
?>

 <div class="main">
    <div class="content">
    	<div class="section group">
				<div class="cont-desc span_1_of_2">	
				<?php
				$getPd=$pd->getSingleProduct($id);
				if ($getPd) {
					while($result= $getPd->fetch_assoc()){
				?>			
					<div class="grid images_3_of_2">
						<img src="admin/<?php echo $result['image']?>" alt="" />
					</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $result['productName']?> </h2>
					<div class="price">
						<p>Price: <span>$<?php echo $result['price']?></span></p>
						<p>Category: <span><?php echo $result['catName']?></span></p>
					</div>
				<div class="add-cart">
					<form action="" method="post">
						<input type="number" class="buyfield" name="quantity" value="1"/>
						<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
					</form>				
				</div>
			</div>
			<div class="product-desc">
			<h2>Product Details</h2>
			<p><?php echo $result['body']?></p>
	    </div>
				<?php 	}
							}?>
				
	</div>
			
 		</div>
 	</div>
	</div>

	<?php include 'inc/footer.php';?>
