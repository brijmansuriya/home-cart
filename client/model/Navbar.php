    <div class="wrap_header fixed-header2 trans-0-4">
		<a href="index.php" class="logo">
			<img src="data:images/*;base64,<?php print(base64_encode($site->SITE_DATA['COMPANY_LOGO'])) ?>" alt="IMG-LOGO">
		</a>
		<div class="wrap_menu">
			<nav class="menu">
				<ul class="main_menu">
					<li>
						<a href="index.php">Home</a>
					</li>

					<li>
						<a href="product.php">Shop</a>
					</li>

					<li>
						<a href="about.php">About</a>
					</li>

					<li>
						<a href="contact.php">Contact</a>
					</li>
					<?php
						if(isset($_SESSION['AccessToken'])){
					?>
					<li>
						<a href="profile.php">My Profile</a>
					</li>

					<li>
						<a href="#">Logout</a>
					</li>
					<?php
						}
					?>
				</ul>
			</nav>
		</div>

		
		<div class="header-icons">
					<?php
					if(isset($_SESSION['AccessToken'])){						
					?>
						<a href="profile.php" class="header-wrapicon1 dis-block">
							<?php print (isset($_SESSION['AccessToken']) ? $site->GetClientIdByAccessTocken()."&nbsp;&nbsp;" : ''); ?>
							<img src="images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
						</a>

					<?php
						}
						else{
					?>
						<a href="login.php" class="header-wrapicon1 dis-block">
								<img src="images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
						</a>

					<?php
						}
					?>
			<span class="linedivide1"></span>

			<a href="cart.php" class="header-wrapicon2 dis-block">
				<img src="images/icons/icon-header-02.png" class="header-icon1" alt="ICON">
			</a>
		</div>
	</div>	
	<header class="header2">
		<div class="container-menu-header-v2 p-t-26">
			<div class="topbar2">
				<!-- <div class="topbar-social"> follow
					<?php 	if(!empty($site->SITE_DATA['GOOGLE'])){ ?>
								<a href="<?php print($site->SITE_DATA['GOOGLE']) ?>" class="topbar-social-item fa fa-google"></a>
					<?php }	if(!empty($site->SITE_DATA['FACEBOOK'])){ ?>
								<a href="<?php print($site->SITE_DATA['FACEBOOK']) ?>" class="topbar-social-item fa fa-facebook"></a>
					<?php } if(!empty($site->SITE_DATA['INSTAGRAM'])){	?>
								<a href="<?php print($site->SITE_DATA['INSTAGRAM']) ?>" class="topbar-social-item fa fa-instagram"></a>
					<?php } if(!empty($site->SITE_DATA['YOUTUBE'])){ ?>
								<a href="<?php print($site->SITE_DATA['YOUTUBE']) ?>" class="topbar-social-item fa fa-youtube-play"></a>
					<?php } if(!empty($site->SITE_DATA['LINKEDIN'])){ ?>
							<a href="<?php print($site->SITE_DATA['LINKEDIN']) ?>" class="topbar-social-item fa fa-youtube-play"></a>
					<?php } if(!empty($site->SITE_DATA['WHATSAPP'])){ ?>?>
							<a href="<?php print($site->SITE_DATA['WHATSAPP']) ?>" class="topbar-social-item fa fa-whatsapp"></a>
					<?php } ?>
				</div> -->

				<a href="index.php" class="logo2">
					<img src="data:images/*;base64,<?php print(base64_encode($site->SITE_DATA['COMPANY_LOGO'])) ?>" alt="IMG-LOGO" style="max-height:65px;">
				</a>

				<div class="topbar-child2">
					<span class="topbar-email">
						<?php print (isset($_SESSION['AccessToken']) ? $site->GetClientIdByAccessTocken()."&nbsp;&nbsp;" : ''); ?>
					</span>

					<?php
					if(isset($_SESSION['AccessToken'])){
						
					?>
						<a href="profile.php" class="header-wrapicon1 dis-block">
							<img src="images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
						</a>

					<?php
						}
						else{
					?>
						<a href="login.php" class="header-wrapicon1 dis-block">
								<img src="images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
						</a>

					<?php
						}
					?>
					<span class="linedivide1"></span>

					<a href="cart.php" class="header-wrapicon2 dis-block">
						<img src="images/icons/icon-header-02.png" class="header-icon1" alt="ICON">
					</a>
					

				</div>
			</div>

			<div class="wrap_header">

				<!-- Menu -->
				<div class="wrap_menu">
					<nav class="menu">
						<ul class="main_menu">
							<li>
								<a href="index.php">Home</a>
							</li>

							<li>
								<a href="product.php">Shop</a>
							</li>

							<li>
								<a href="about.php">About</a>
							</li>

							<li>
								<a href="contact.php">Contact</a>
							</li>
							<?php
						if(isset($_SESSION['AccessToken'])){
						?>
						<li>
							<a href="profile.php">My Profile</a>
						</li>

						<li>
							<a href="#">Logout</a>
						</li>
						<?php
							}
						?>
						</ul>
					</nav>
				</div>

				<!-- Header Icon -->
				<div class="header-icons">

				</div>
			</div>
		</div>

		<!-- Header Mobile -->
		<div class="wrap_header_mobile">
			<!-- Logo moblie -->
			<a href="index.php" class="logo-mobile">
				<img src="data:images/*;base64,<?php print(base64_encode($site->SITE_DATA['COMPANY_LOGO'])) ?>" alt="IMG-LOGO">
			</a>

			<!-- Button show menu -->
			<div class="btn-show-menu">
				<!-- Header Icon mobile -->
				<div class="header-icons-mobile">
					
					<?php
					if(isset($_SESSION['AccessToken'])){
						
					?>
						<a href="profile.php" class="header-wrapicon1 dis-block">
							<img src="images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
						</a>

					<?php
						}
						else{
					?>
						<a href="login.php" class="header-wrapicon1 dis-block">
								<img src="images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
						</a>

					<?php
						}
					?>

					<span class="linedivide2"></span>

					<a href="cart.php" class="header-wrapicon2 dis-block">
						<img src="images/icons/icon-header-02.png" class="header-icon1" alt="ICON">
					</a>

				</div>

				<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
					<span class="hamburger-box">
						<span class="hamburger-inner"></span>
					</span>
				</div>
			</div>
		</div>

		<!-- Menu Mobile -->
		<div class="wrap-side-menu" >
			<nav class="side-menu">
				<ul class="main-menu">
					<?php if(isset($_SESSION['AccessToken']))
						{
					?>
						<li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
							<div class="topbar-child2-mobile">
								<span class="topbar-email">
									<?php print (isset($_SESSION['AccessToken']) ? $site->GetClientIdByAccessTocken()."&nbsp;&nbsp;" : ''); ?>
								</span>
							</div>
						</li>
					<?php
						}
					?>

					<li class="item-topbar-mobile p-l-10">
						<div class="topbar-social-mobile">
						<?php 	if(!empty($site->SITE_DATA['GOOGLE'])){ ?>
								<a href="<?php print($site->SITE_DATA['GOOGLE']) ?>" class="topbar-social-item fa fa-google"></a>
						<?php }	if(!empty($site->SITE_DATA['FACEBOOK'])){ ?>
									<a href="<?php print($site->SITE_DATA['FACEBOOK']) ?>" class="topbar-social-item fa fa-facebook"></a>
						<?php } if(!empty($site->SITE_DATA['INSTAGRAM'])){	?>
									<a href="<?php print($site->SITE_DATA['INSTAGRAM']) ?>" class="topbar-social-item fa fa-instagram"></a>
						<?php } if(!empty($site->SITE_DATA['YOUTUBE'])){ ?>
									<a href="<?php print($site->SITE_DATA['YOUTUBE']) ?>" class="topbar-social-item fa fa-youtube-play"></a>
						<?php } if(!empty($site->SITE_DATA['LINKEDIN'])){ ?>
								<a href="<?php print($site->SITE_DATA['LINKEDIN']) ?>" class="topbar-social-item fa fa-youtube-play"></a>
						<?php } if(!empty($site->SITE_DATA['WHATSAPP'])){ ?>?>
								<a href="<?php print($site->SITE_DATA['WHATSAPP']) ?>" class="topbar-social-item fa fa-whatsapp"></a>
						<?php } ?>
						</div>
					</li>

					<li class="item-menu-mobile">
						<a href="index.php">Home</a>						
					</li>

					<li class="item-menu-mobile">
						<a href="product.php">Shop</a>
					</li>

					<li class="item-menu-mobile">
						<a href="about.php">About</a>
					</li>

					<li class="item-menu-mobile">
						<a href="contact.php">Contact</a>
					</li>
					<?php
						if(isset($_SESSION['AccessToken'])){
					?>
					<li class="item-menu-mobile">
						<a href="profile.php">My Profile</a>
					</li>

					<li class="item-menu-mobile">
						<a href="#">Logout</a>
					</li>
					<?php
						}
					?>
				</ul>
			</nav>
		</div>
	</header>