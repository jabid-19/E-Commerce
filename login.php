<?php include 'inc/header.php'; ?>


<?php
$login=Session::get("userLogin");
if($login==true){ 
	header("Location:cart.php");
 } 
?>

<?php
$us = new User();
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	$email = $_GET['email'];
	$password = $_GET['password'];

	$loginChk = $us->userLogin($email, $password);
}
?>
<?php
$us = new User();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$insertUser = $us->userInsert($_POST);
}
?>
<div class="main">
	<div class="content">
		<div class="login_panel">
			<h3>Existing Customers</h3>
			<p>Sign in with the form below.</p>
			<form action="" method="get" id="member">
				<span style="color:red">
					<?php
					if (isset($loginChk)) {
						echo $loginChk;
					}
					?>
				</span>
				<input name="email" type="text" value="Email" class="field" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Username';}">
				<input name="password" type="password" value="Password" class="field" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}">
				<p class="note">If you forgot your passoword just enter your email and click <a href="#">here</a></p>
				<div class="buttons">
					<div><button class="grey">Sign In</button></div>
				</div>
			</form>
		</div>
		<div class="register_account">

			<form action="" method="post" enctype="multipart/form-data">
				<h3>Register New Account</h3>
				<?php
				if (isset($insertUser)) {
					echo $insertUser;
				}
				?>
				<table>
					<tbody>
						<tr>
							<td>
								<div>
									<input type="text" name="userName" placeholder="Name">
								</div>
								<div>
									<input type="text" name="city" placeholder="City">
								</div>
								<div>
									<input type="text" name="zip" placeholder="Zip-Code">
								</div>
								<div>
									<input type="text" name="email" placeholder="E-Mail">
								</div>
							</td>
							<td>
								<div>
									<input type="text" name="address" placeholder="Address">
								</div>
								<div>
									<select id="country" name="country" onchange="change_country(this.value)" class="frm-field required">
										<option value="null">Select a Country</option>
										<option value="AF">Afghanistan</option>
										<option value="AL">Albania</option>
										<option value="DZ">Algeria</option>
										<option value="AR">Argentina</option>
										<option value="AM">Armenia</option>
										<option value="AW">Aruba</option>
										<option value="AU">Australia</option>
										<option value="AT">Austria</option>
										<option value="AZ">Azerbaijan</option>
										<option value="BS">Bahamas</option>
										<option value="BH">Bahrain</option>
										<option value="BD">Bangladesh</option>
									</select>
								</div>

								<div>
									<input type="text" name="phone" placeholder="Phone">
								</div>

								<div>
									<input type="text" name="password" placeholder="Password">
								</div>
							</td>
						</tr>
					</tbody>
				</table>
				<div class="search">
					<div><button class="grey">Create Account</button></div>
				</div>
				<p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
				<div class="clear"></div>
			</form>
		</div>
		<div class="clear"></div>
	</div>
</div>
</div>

<?php include 'inc/footer.php'; ?>