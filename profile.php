<?php
	require_once(__DIR__ ."\admin\controller\Functional.php");
	$site = new Assets();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>My Profile</title>
	<?php require_once('client/model/HeaderScript.php'); ?>
</head>
<body class="animsition">

	
	<?php require_once('client/model/Navbar.php') ?>
	
	<!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(images/profile-banner.png);">
		<h2 class="l-text2 t-center">
			My Profile
		</h2>
	</section>

	<!-- content page -->
	<section class="bgwhite p-t-66 p-b-60">
		<div class="container" style=" display: flex; justify-content: center;">
				<div class="col-md-6 p-b-30" id="reg_form_holder_block">
					<form class="leave-comment" id="user_profile_update">
						<h4 class="m-text26 p-b-36 p-t-15">
							My Details
						</h4>
						<?php 
							$r = $site->select('','_ecm_customer_mstr',"user_id = '".$site->GetClientIdByAccessTocken()."'");
							while($data = mysqli_fetch_assoc($r)){
						?>
						<div class="bo4 of-hidden size15 m-b-20">
							<input class="sizefull s-text7 p-l-22 p-r-22" type="text" value="<?php print($site->GetClientIdByAccessTocken()); ?>" id="username" placeholder='Username' disabled />
						</div>

						<div class="bo4 of-hidden size15 m-b-20">
							<input class="sizefull s-text7 p-l-22 p-r-22" type="text" value="<?php print(html_entity_decode($data['fname'])); ?>" id="name" placeholder='full name'>
						</div>

						<div class="bo4 of-hidden size15 m-b-20">
							<input class="sizefull s-text7 p-l-22 p-r-22" type="text" value="<?php print(html_entity_decode($data['email'])); ?>" id="email" placeholder='email'>
						</div>

						<div class="bo4 of-hidden size15 m-b-20">
							<input class="sizefull s-text7 p-l-22 p-r-22" type="text" value="<?php print(html_entity_decode($data['phNo'])); ?>" id="phone" placeholder='phone'>
						</div>

						<div class="bo4 of-hidden size15 m-b-20">
							<input class="sizefull s-text7 p-l-22 p-r-22" type="text" value="<?php print(html_entity_decode($data['f_addr'])); ?>" id="address" placeholder='address'>
						</div>

						<div class="bo4 of-hidden size15 m-b-20">
							<input class="sizefull s-text7 p-l-22 p-r-22" type="text" value="<?php print(html_entity_decode($data['pincode'])); ?>" id="pincode" placeholder='pincode'>
						</div>
						<?php 
						}
						?>
						<div class="w-size25">
							<button class="flex-c-m size2 bg1 bo-rad-23 hov1 m-text3 trans-0-4" type="submit">
								Update Data
							</button>
						</div>
						<div class="of-hidden" style="margin-top:10px;" id="frm_profile_update">
							
						</div>
					</form>
				</div>
			</div>
	</section>
	<section class="shipping bgwhite p-t-62 p-b-46">
		<div class="flex-w p-l-15 p-r-15">
			<div class="flex-col-c w-size5 p-l-15 p-r-15 p-t-16 p-b-15 respon1">				
				<a href="cart.php" class=" t-center">
					<img src="images/cart-icon.png" alt="" srcset="" style="max-height:200px">
				</a>
				<p class='m-text12 t-center'>My Cart</p>
			</div>

			<div class="flex-col-c w-size5 p-l-15 p-r-15 p-t-16 p-b-15 bo2 respon2">
				<a href="myorder.php" class=" t-center">
					<img src="images/my-orders.png" alt="" srcset="" style="max-height:200px">
				</a>
				<p class='m-text12 t-center'>My Orders</p>
			</div>

			<div class="flex-col-c w-size5 p-l-15 p-r-15 p-t-16 p-b-15 respon1">

				<a href="#" class=" t-center">
					<img src="images/notification.png" alt="" srcset="" style="max-height:200px">
				</a>
				<p class='m-text12 t-center'>Notification</p>
				
			</div>
		</div>
	</section>

	
	<?php require_once('client/model/FooterData.php'); ?>	
	<?php require_once('client/model/FooterScript.php'); ?>
</body>
</html>
	<script type="text/javascript" src="assets/js/site-custom.js"></script>	
	<script>
		let site = new SiteGlobal();
		$(document).ready(function(e){
			$('#user_profile_update').on('submit',function(e){
				e.preventDefault();
				var data = new FormData();
				data.append('fname',$('#name').val());
				data.append('email',$('#email').val());
				data.append('phNo',$('#phone').val());
				data.append('f_addr',$('#address').val());
				data.append('pincode',$('#pincode').val());
				data.append('user_id',$('#username').val());
				data.append('action','update_profile')
				site.Transaction('admin/Controller/Customer.php','POST',data,'#frm_profile_update');
			});
		});


		function Reset() {
			$("#username").val("");
			$("#name").val("");
			$("#email").val("");
			$("#pwd").val("");
			$("#phone").val("");
		}
	</script>
