 <!--footer -->
<footer class="main-footer fl-wrap">
	<!--footer-inner-->
	<div class="footer-inner   fl-wrap">
		<div class="container">
			<div class="row">
				<!-- footer-widget-->
				<div class="col-md-4">
					<div class="footer-widget fl-wrap">
						<div class="footer-logo"><a href="index.html"><img src="<?= $this->Url->build('/front-assets/images/logo.png');?>" alt=""></a></div>
						<div class="footer-contacts-widget fl-wrap">
							<p>In ut odio libero, at vulputate urna. Nulla tristique mi a massa convallis cursus. Nulla eu mi magna. Etiam suscipit commodo gravida.   </p>
							<ul  class="footer-contacts fl-wrap no-list-style">
								<li><span><i class="fal fa-envelope"></i> E-Mail :</span><a href="#"><?= \Cake\Core\Configure::read('EmailConfig.emailInfo');?></a></li>
								<li> <span><i class="fal fa-map-marker"></i> Alamat :</span><a href="#"><?= \Cake\Core\Configure::read('EmailConfig.address');?></a></li>
								<li> <span><i class="fal fa-map-marker"></i> Alamat 2 :</span><a href="#"><?= \Cake\Core\Configure::read('EmailConfig.address2');?></a></li>
								<li><span><i class="fal fa-phone"></i> Telepon :</span><a href="#"><?= \Cake\Core\Configure::read('EmailConfig.phone');?></a></li>
							</ul>
							<div class="footer-social">
								<span>Find  us on: </span>
								<ul class="no-list-style">
									<li><a href="<?= \Cake\Core\Configure::read('SocialMedia.facebook');?>" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
									<li><a href="<?= \Cake\Core\Configure::read('SocialMedia.twitter');?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
									<li><a href="<?= \Cake\Core\Configure::read('SocialMedia.instagram');?>" target="_blank"><i class="fab fa-instagram"></i></a></li>
									<?php /*
									<li><a href="#" target="_blank"><i class="fab fa-vk"></i></a></li>
									<li><a href="#" target="_blank"><i class="fab fa-whatsapp"></i></a></li>
									*/ ?>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<!-- footer-widget end-->
				<!-- footer-widget-->
				<div class="col-md-4">
					<div class="footer-widget fl-wrap">
						<h3>Berita</h3>
						<div class="footer-widget-posts fl-wrap">
                            <?= $this->cell('Blogs::latest'); ?>
							<a href="<?= $this->Url->build(['controller' => 'News', 'action' => 'index']); ?>" class="footer-link">Lihat Semua <i class="fal fa-long-arrow-right"></i></a>
						</div>
					</div>
				</div>
				<!-- footer-widget end-->
				<!-- footer-widget  -->
				<div class="col-md-4">
					<div class="footer-widget fl-wrap ">
						<h3>Menu Footer</h3>
						<div class="footer-widget-posts fl-wrap">
							<ul class="no-list-style">
								<li class="clearfix">
									<div class="widget-posts-descr">
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'view', 'privacy-policy']); ?>">Privacy Policy</a>
									</div>
								</li>
								<li class="clearfix">
									<div class="widget-posts-descr">
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'view', 'terms-and-conditions']); ?>">Terms and Conditions</a>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- footer-widget end-->
			</div>
		</div>
		<!-- footer bg-->
		<div class="footer-bg" data-ran="4"></div>
		<div class="footer-wave">
			<svg viewbox="0 0 100 25">
				<path fill="#fff" d="M0 30 V12 Q30 17 55 12 T100 11 V30z" />
			</svg>
		</div>
		<!-- footer bg  end-->
	</div>
	<!--footer-inner end -->
	<!--sub-footer-->
	<div class="sub-footer  fl-wrap">
		<div class="container">
			<div class="copyright"> &#169; FastRun Business System <?php echo date('Y'); ?> .  All rights reserved.</div>
		</div>
	</div>
	<!--sub-footer end -->
</footer>
<!--footer end -->
