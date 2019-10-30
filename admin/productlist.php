<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Product.php';?>
<?php include_once '../helpers/Format.php';?>

<?php
	$pd=new Product();
	$fm=new Format();

	if (isset($_GET['delpro'])) {
		$id=$_GET['delpro'];
		$delProduct=$pd->delProductById($id);
	}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Product List</h2>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Serial No</th>
					<th>Post Title</th>
					<th>Description</th>
					<th>Category</th>
					<th>Image</th>
					<th>Price</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php
				$getPd= $pd->getAllProduct();
				if($getPd){
					$i=0;
					while($result=$getPd->fetch_assoc()){
						$i++;
				
			  ?>
				<tr class="odd gradeX">
					<td><?php echo $i?></td>
					<td><?php echo $result['productName']?></td>
					<td><?php echo $fm->textShorten($result['body'],50)?></td>
					<td><?php echo $result['catName']?></td>
					<td><img src="<?php echo $result['image']?>" height="40px" width="60px" alt=""></td>
					<td>$<?php echo $result['price']?></td>
					<td><?php if ($result['type']==0) {
						echo "Featured";
					}
					else{
						echo "GENERAL";
					}?></td>
					<td><a href="productedit.php?proid=<?php echo $result['productId']?>">Edit</a> || <a href="?delpro=<?php echo $result['productId']?>">Delete</a></td>				</tr>
				<?php 	}
				}?>

			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
