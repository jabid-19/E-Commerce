<?php include 'inc/header.php';?>

<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    $cartId = $_POST['cartId'];
    $quantity = $_POST['quantity'];
    $updateCart = $ct->updateCartQuantity($cartId,$quantity);
}
if (isset($_GET['delId'])) {
	$delId=$_GET['delId'];
	$delProduct=$ct->delProductByCart($delId);
}
?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your Cart</h2>
						<table class="tblone">
							<tr>
								<th width="5%">Serial</th>
								<th width="30%">Product Name</th>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								<th width="15%">Quantity</th>
								<th width="15%">Total Price</th>
								<th width="10%">Action</th>
							</tr>
							<tr>

							<?php
							$getPro= $ct->getCartProduct();
							if($getPro){
								$sum=0;
								$fSum=0;
								$i=0;
								while($result = $getPro->fetch_assoc()){
									$i++;
							
							?>
								<td><?php echo $i?></td>
								<td><?php echo $result['productName']?></td>
								<td><img src="admin/<?php echo $result['image'];?>" alt=""/></td>
								<td><?php echo $result['price']?></td>
								<td>
									<form action="" method="post">
										<input type="hidden" name="cartId" value="<?php echo $result['cartId']?>"/>
										<input type="number" name="quantity" value="<?php echo $result['quantity']?>"/>
										<input type="submit" name="submit" value="Update"/>
									</form>
								</td>
								<td>$<?php 
									$total = $result['price'] * $result['quantity']; 
									echo $total;
								?></td>
								<td><a href="?delId=<?php echo $result['cartId']?>">X</a></td>
							</tr>
							<?php 
								$sum=$sum+$total;
							?>
							<?php 	}
							}
							?>
							
							<?php
							
							$fSum=$sum+$sum*.1;
							?>
						</table>
						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Sub Total : </th>
								<td>$<?php echo $sum?></td>
							</tr>
							<tr>
								<th>VAT : </th>
								<td>10%</td>
							</tr>
							<tr>
								<th>Grand Total :</th>
								<td>$<?php echo $fSum?></td>
							</tr>
					   </table>
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="login.php"> <img src="images/check.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>
  
<?php include 'inc/footer.php';?>

