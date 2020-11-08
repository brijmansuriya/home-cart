<?php
	require_once(__DIR__ ."\admin\controller\Functional.php");
	$site = new Assets();

	if(isset($_SESSION['AccessToken']))
		header('location:profile.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<?php require_once('client/model/HeaderScript.php'); ?>
</head>

<title>Login | Home Cart</title>
<body class="animsition">

	<?php require_once('client/model/Navbar.php') ?>
	
	<!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(images/heading-pages-06.jpg);">
		<h2 class="l-text2 t-center">
			Login | Subscribe With Us
		</h2>
	</section>

	<!-- content page -->
	<section class="bgwhite p-t-66 p-b-60">
		<div class="container" style=" display: flex; justify-content: center;">
				<div class="col-md-6 p-b-30" id="reg_form_holder_block">
					<form class="leave-comment" id="frm_login">
						<h4 class="m-text26 p-b-36 p-t-15">
							Provide Some Details
						</h4>
						<div class="bo4 of-hidden size15 m-b-20">
							<input class="sizefull s-text7 p-l-22 p-r-22" type="text" id="username" placeholder="Username">
						</div>

						<div class="bo4 of-hidden size15 m-b-20">
							<input class="sizefull s-text7 p-l-22 p-r-22" type="password" id="pwd" placeholder="Password">
						</div>
						<div class="w-size25">
							<button class="flex-c-m size2 bg1 bo-rad-23 hov1 m-text3 trans-0-4" type="submit">
								Login
							</button>
						</div>
						<div class="form-group" style='margin-top:10px'>
							<ul>
								<li>
									<a href='register.php' class='btn btn-default'>Register !</a>
								</li>
								<li>
									<a href='register.php' class='btn btn-default'>Forgot Details ? Dont'Worry Click Here</a>
								</li>
							</ul>
						</div>
						<div class="form-group" style='margin-top:10px'>
							
						</div>
						<div class="of-hidden" style="margin-top:10px;" id="frm_l_err">
							
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
			$('#frm_login').on('submit',function(e){
				e.preventDefault();

				var data = new FormData();
				
				data.append('username',$("#username").val());
				data.append('pwd',$("#pwd").val());				
				data.append('action','auth_cust');
				site.Transaction('admin/controller/Auth.php','POST',data,'');
				// $.ajax({
				// 	type:'POST',
				// 	enctype : 'mutipart/form-data',
				// 	url : 'admin/controller/Auth.php',
				// 	data : data,
				// 	processData : false,
				// 	contentType : false,
				// 	cache : false,
				// 	beforeSend : function(){
				// 		swal("#frm_l_err",'info','Data','Checking !');
				// 	},
				// 	success : function(result){
				// 	console.log(result);
				// 	try {
				// 			var r = jQuery.parseJSON(result);
				// 			if(r.statusCode == 'VISIT_SITE'){
				// 				window.location.href = 'index.php';
				// 			}
				// 			site.JSON_CODE_MSG(r.statusCode,'#frm_l_err');
							
				// 		} catch (e) {
							
				// 		}
				// 	}
				// });

			});
		});


		function Reset() {
			
			$("#email").val("");
			$("#pwd").val("");
			
		}
	</script>