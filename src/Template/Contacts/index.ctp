<!--  section  -->
<section class="parallax-section single-par" data-scrollax-parent="true">
	<div class="bg par-elem "  data-bg="<?= $this->Url->build('/front-assets/images/bg/11.jpg');?>" data-scrollax="properties: { translateY: '30%' }"></div>
	<div class="overlay op7"></div>
	<div class="container">
		<div class="section-title center-align big-title">
			<h2><span>Our Contacts</span></h2>
			<span class="section-separator"></span>
			<div class="breadcrumbs fl-wrap"><a href="#">Home</a><span>Contacts</span></div>
		</div>
	</div>
	<div class="header-sec-link">
		<a href="#sec1" class="custom-scroll-link"><i class="fal fa-angle-double-down"></i></a> 
	</div>
</section>
<!--  section  end-->               
<!--  section  -->
<section   id="sec1" data-scrollax-parent="true">
	<div class="container">
		<!--about-wrap -->
		<div class="about-wrap">
			<div class="row">
				<div class="col-md-4">
					<div class="ab_text-title fl-wrap">
						<h3>Informasi Kontak</h3>
						<span class="section-separator fl-sec-sep"></span>
					</div>
					<!--box-widget-item -->                                       
					<div class="box-widget-item fl-wrap block_box">
						<div class="box-widget">
							<div class="box-widget-content bwc-nopad">
								<div class="list-author-widget-contacts list-item-widget-contacts bwc-padside">
									<ul class="no-list-style">
										<li><span><i class="fal fa-map-marker"></i> Alamat :</span> <a href="#" class="custom-scroll-link"><?= \Cake\Core\Configure::read('EmailConfig.address');?></a></li>
										<li><span><i class="fal fa-phone"></i> Nomor Telepon :</span> <a href="#"><?= \Cake\Core\Configure::read('EmailConfig.phone');?></a></li>
										<li><span><i class="fal fa-envelope"></i> E-Mail :</span> <a href="#"><?= \Cake\Core\Configure::read('EmailConfig.emailInfo');?></a></li>
									</ul>
								</div>
								<div class="list-widget-social bottom-bcw-box  fl-wrap">
									<ul class="no-list-style">
										<li><a href="<?= \Cake\Core\Configure::read('SocialMedia.facebook');?>" target="_blank" ><i class="fab fa-facebook-f"></i></a></li>
										<li><a href="<?= \Cake\Core\Configure::read('SocialMedia.twitter');?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
										<li><a href="<?= \Cake\Core\Configure::read('SocialMedia.instagram');?>" target="_blank" ><i class="fab fa-instagram"></i></a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<!--box-widget-item end -->  
					<!--box-widget-item -->
					<div class="box-widget-item fl-wrap" style="margin-top:20px;">
						<div class="banner-wdget fl-wrap">
							<div class="overlay op4"></div>
							<div class="bg"  data-bg="<?= $this->Url->build('/front-assets/images/bg/18.jpg');?>"></div>
							<div class="banner-wdget-content fl-wrap">
								<h4>Participate in our loyalty program. Refer a friend and get a discount.</h4>
								<a href="#" class="color-bg">Read more</a>
							</div>
						</div>
					</div>
					<!--box-widget-item end -->                                            
				</div>
				<div class="col-md-8">
					<div class="ab_text">
						<div class="ab_text-title fl-wrap">
							<h3>Drop us a line</h3>
							<span class="section-separator fl-sec-sep"></span>
						</div>
						<p>Ut euismod ultricies sollicitudin. Curabitur sed dapibus nulla. Nulla eget iaculis lectus. Mauris ac maximus neque. Nam in mauris quis libero sodales eleifend. Morbi varius, nulla sit amet rutrum elementum, est elit finibus tellus, ut tristique elit risus at metus. In ut odio libero, at vulputate urna. Nulla tristique mi a massa convallis cursus. Nulla eu mi magna. Etiam suscipit commodo gravida.</p>
						<div id="contact-form">
							<div id="message"></div>
							<?= $this->Flash->render() ?>
							<br />
							<?php echo $this->Form->create('Contacts',['class' => 'custom-form']);?>
								<fieldset>
									<label><i class="fal fa-user"></i></label>
									<input type="text" name="name" id="name" placeholder="Nama Lengkap" required />
									<div class="clearfix"></div>
									<label><i class="fal fa-envelope"></i>  </label>
									<input type="text"  name="email" id="email" placeholder="Email" required />
									<textarea name="message"  id="message" cols="40" rows="3" placeholder="Pesan :" required></textarea>
								</fieldset>
								<button type="submit" class="btn float-btn color2-bg">Kirim<i class="fal fa-paper-plane"></i></button>
							<?php echo $this->Form->end();?>
						</div>
						<!-- contact form  end--> 
					</div>
				</div>
			</div>
		</div>
		<!-- about-wrap end  --> 
	</div>
</section>