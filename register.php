<?php
	require_once(__DIR__ ."\admin\controller\Functional.php");
	$site = new Assets();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Register</title>
	<?php require_once('client/model/HeaderScript.php'); ?>
</head>

<body class="animsition">

	<?php require_once('client/model/Navbar.php') ?>
	
	<!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(images/heading-pages-06.jpg);">
		<h2 class="l-text2 t-center">
			Register | Subscribe With Us
		</h2>
	</section>

	<!-- content page -->
	<section class="bgwhite p-t-66 p-b-60">
		<div class="container" style=" display: flex; justify-content: center;">
				<div class="col-md-6 p-b-30" id="reg_form_holder_block">
					<form class="leave-comment" id="frm_register">
						<h4 class="m-text26 p-b-36 p-t-15">
							Provide Some Details
						</h4>
						<div class="bo4 of-hidden size15 m-b-20">
							<input class="sizefull s-text7 p-l-22 p-r-22" type="text" id="username" placeholder="Create Username For Login">
						</div>

						<div class="bo4 of-hidden size15 m-b-20">
							<input class="sizefull s-text7 p-l-22 p-r-22" type="text" id="name" placeholder="Full Name">
						</div>

						<div class="bo4 of-hidden size15 m-b-20">
							<input class="sizefull s-text7 p-l-22 p-r-22" type="text" id="email" placeholder="Email Address">
						</div>

						<div class="bo4 of-hidden size15 m-b-20">
							<input class="sizefull s-text7 p-l-22 p-r-22" type="password" id="pwd" placeholder="Password">
						</div>

						<div class="bo4 of-hidden size15 m-b-20">
							<input class="sizefull s-text7 p-l-22 p-r-22" type="text" id="phone" placeholder="Phone Number">
						</div>
						<div class="w-size25">
							<button class="flex-c-m size2 bg1 bo-rad-23 hov1 m-text3 trans-0-4" type="submit">
								Register
							</button>
						</div>
						<div class="of-hidden" style="margin-top:10px;" id="frm_r_err">
							
						</div>
					</form>
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
			$('#frm_register').on('submit',function(e){
				e.preventDefault();
				var data = new FormData();
				data.append('user_id',$("#username").val());
				data.append('fname',$("#name").val());
				data.append('email',$("#email").val());
				data.append('pwd',$("#pwd").val());
				data.append('phNo',$("#phone").val());
				data.append('action','reg_new_cust');
				site.Transaction('admin/controller/Customer.php','POST',data,'');

				// $.ajax({
				// 	type:'POST',
				// 	enctype : 'mutipart/form-data',
				// 	url : 'private/script/server/Customer.php',
				// 	data : data,
				// 	processData : false,
				// 	contentType : false,
				// 	cache : false,
				// 	beforeSend : function(){
				// 		site.WriteError('#frm_r_err','info','Saving',' Details !');
				// 	},
				// 	success : function(result){
				// 	console.log(result);
				// 	try {
				// 			var r = jQuery.parseJSON(result);
				// 			if(r.statusCode == 200)
				// 			{
				// 				window.location.href = 'login.php';
				// 			}
				// 			else if(r.statusCode ==  409){
				// 			    site.WriteError('#frm_r_err',"warning","Password"," Must Be 6 to 16 Character long. Contains The Least One Digit,Capital Char,Special Characters");
				// 			}
				// 			else if(r.statusCode == 500)
				// 			{
				// 				site.WriteError('#frm_r_err',"danger","Server"," Not Responding !");
				// 			}
				// 			else if(r.statusCode == 400){
				// 			    site.WriteError('#frm_r_err',"danger","Empty"," Feilds Not Allowed.");
				// 			}
				// 			else if(r.statusCode == 'EXIST'){
				// 				site.WriteError('#frm_r_err',"warning","Customer"," Already Register !");
				// 			}
				// 			else if(r.statusCode == 'PHONE'){
				// 				site.WriteError('#frm_r_err',"warning","Phone Number"," Should Be Indian Only !");
				// 			}
				// 			else if(r.statusCode == 'EMAIL'){
				// 				site.WriteError('#frm_r_err',"warning","Email"," Address Invalid !");
				// 			}
				// 		} catch (e) {
				// 			site.WriteError('#frm_r_err',"danger","Internal Server"," Error !");
				// 		}
				// 	}
				// });

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