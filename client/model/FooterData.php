<!-- Footer -->
    <footer class="bg6 p-t-20 p-b-20 p-l-20 p-r-20">
		<div class="flex-w">
			<div class="w-size6 p-t-30 p-l-15 p-r-15 respon3">
				<h4 class="s-text12 p-b-30">
					GET IN TOUCH
				</h4>

				<div>
					<p class="s-text7 w-size27">
						Any questions? <?php print($site->SITE_DATA['ADDRESS']) ?> or call us on (+91) <?php print($site->SITE_DATA['PHONE']) ?>
					</p>

					<div class="flex-m p-t-30">
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
				</div>
			</div>			
			
		</div>

		<div class="t-center p-l-15 p-r-15">
			<div class="t-center s-text8 p-t-20">
				Copyright © <?php print(date('Y')); ?> All rights reserved. | <?php print($site->SITE_DATA['SITE_NAME']) ?> </a>
			</div>
		</div>
	</footer>