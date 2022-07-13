<!--  section  -->
<?php /* <section id="page-title" data-bg-parallax="<?= $this->Url->build('/front-assets-new/images/parallax/14.jpg'); ?>"> */ ?>
<section id="page-title" data-bg-parallax="<?= $this->Url->build('/front-assets-new/sikami.jpg'); ?>">
	<div class="bg-overlay"></div>
	<div class="container">
		<div class="page-title">
			<h1 class="text-uppercase text-medium"><?= $title; ?></h1>
		</div>
		<div class="breadcrumb">
			<ul>
				<li><a href="<?= $this->Url->build(['controller' => 'Home', 'action' => 'index']); ?>">Beranda</a>
				</li>
				<li><a href="#">Halaman</a>
				</li>
				<li class="active"><a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'view', 'tentang-kami']); ?>">Tentang Kami</a>
				</li>
			</ul>
		</div>
	</div>
</section>
<!--  section  end-->
<?= $page['content']; ?>

<?php /*
<section   id="sec1" data-scrollax-parent="true">
	<div class="container">
		<div class="section-title">
			<h2> How We Work</h2>
			<div class="section-subtitle">who we are</div>
			<span class="section-separator"></span>
			<p>Explore some of the best tips from around the city from our partners and friends.</p>
		</div>
		<!--about-wrap -->
		<div class="about-wrap">
			<div class="row">
				<div class="col-md-6">
					<div class="list-single-main-media fl-wrap" style="box-shadow: 0 9px 26px rgba(58, 87, 135, 0.2);">
						<img src="images/all/55.jpg" class="respimg" alt="">
						<a href="https://vimeo.com/70851162" class="promo-link   image-popup"><i class="fal fa-video"></i><span>Our Story</span></a>
					</div>
				</div>
				<div class="col-md-6">
					<div class="ab_text">
						<div class="ab_text-title fl-wrap">
							<h3>Our Awesome  Team <span>Story</span></h3>
							<h4>Check video presentation to find   out more about us .</h4>
							<span class="section-separator fl-sec-sep"></span>
						</div>
						<p>Ut euismod ultricies sollicitudin. Curabitur sed dapibus nulla. Nulla eget iaculis lectus. Mauris ac maximus neque. Nam in mauris quis libero sodales eleifend. Morbi varius, nulla sit amet rutrum elementum, est elit finibus tellus, ut tristique elit risus at metus. Sed tempor iaculis massa faucibus feugiat. </p>
						<p>
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla. Nulla posuere sapien vitae lectus suscipit, et pulvinar nisi tincidunt. Curabitur convallis fringilla diam sed aliquam. Sed tempor iaculis massa faucibus feugiat. In fermentum facilisis massa, a consequat purus viverra. Aliquam erat volutpat. Curabitur convallis fringilla diam sed aliquam. Sed tempor iaculis massa faucibus feugiat. In fermentum facilisis massa, a consequat purus viverra.
						</p>
						<a href="#sec3" class="btn color2-bg float-btn custom-scroll-link">Our Team <i class="fal fa-users"></i></a>
					</div>
				</div>
			</div>
		</div>
		<!-- about-wrap end  -->
		<span class="fw-separator"></span>
		<div class=" single-facts bold-facts fl-wrap">
			<!-- inline-facts -->
			<div class="inline-facts-wrap">
				<div class="inline-facts">
					<div class="milestone-counter">
						<div class="stats animaper">
							<div class="num" data-content="0" data-num="1254">1254</div>
						</div>
					</div>
					<h6>New Visiters Every Week</h6>
				</div>
			</div>
			<!-- inline-facts end -->
			<!-- inline-facts  -->
			<div class="inline-facts-wrap">
				<div class="inline-facts">
					<div class="milestone-counter">
						<div class="stats animaper">
							<div class="num" data-content="0" data-num="12168">12168</div>
						</div>
					</div>
					<h6>Happy customers every year</h6>
				</div>
			</div>
			<!-- inline-facts end -->
			<!-- inline-facts  -->
			<div class="inline-facts-wrap">
				<div class="inline-facts">
					<div class="milestone-counter">
						<div class="stats animaper">
							<div class="num" data-content="0" data-num="2172">2172</div>
						</div>
					</div>
					<h6>Won Awards</h6>
				</div>
			</div>
			<!-- inline-facts end -->
			<!-- inline-facts  -->
			<div class="inline-facts-wrap">
				<div class="inline-facts">
					<div class="milestone-counter">
						<div class="stats animaper">
							<div class="num" data-content="0" data-num="732">732</div>
						</div>
					</div>
					<h6>New Listing Every Week</h6>
				</div>
			</div>
			<!-- inline-facts end -->
		</div>
	</div>
</section>
<!--section end-->
<!--section  -->
<section class="gray-bg particles-wrapper">
	<div class="container">
		<div class="section-title">
			<h2> Working Process</h2>
			<div class="section-subtitle">How we work</div>
			<span class="section-separator"></span>
			<p>Morbi varius, nulla sit amet rutrum elementum, est elit finibus tellus, ut tristique elit risus at metus. Sed tempor iaculis massa faucibus feugiat.</p>
		</div>
		<div class="process-wrap_time-line fl-wrap">
			<!--process-item-->
			<div class="process-item_time-line">
				<div class="pi_head color-bg">1</div>
				<div class="pi-text fl-wrap">
					<h4>Developing an effective strategy</h4>
					<p>Maecenas faucibus non tellus eu ultricies. Vivamus lacinia ultrices nulla sit amet venenatis.</p>
				</div>
			</div>
			<!--process-item end-->
			<!--process-item-->
			<div class="process-item_time-line">
				<div class="pi_head color-bg">2</div>
				<div class="pi-text fl-wrap">
					<h4>Website development and integration</h4>
					<p>Maecenas faucibus non tellus eu ultricies. Vivamus lacinia ultrices nulla sit amet venenatis.</p>
				</div>
			</div>
			<!--process-item end-->
			<!--process-item-->
			<div class="process-item_time-line">
				<div class="pi_head color-bg">3</div>
				<div class="pi-text fl-wrap">
					<h4>Testing and professional support</h4>
					<p>Maecenas faucibus non tellus eu ultricies. Vivamus lacinia ultrices nulla sit amet venenatis.</p>
				</div>
			</div>
			<!--process-item end-->
		</div>
		<a href="#" class="btn color2-bg">View More Details<i class="fal fa-angle-right"></i></a>
	</div>
	<div id="particles-js" class="particles-js"></div>
</section>
<!--section end-->
<!--section  -->
<section class="parallax-section video-section" data-scrollax-parent="true" id="sec2">
	<div class="bg par-elem "  data-bg="images/bg/34.jpg" data-scrollax="properties: { translateY: '30%' }"></div>
	<div class="overlay op7"></div>
	<!--container-->
	<div class="container">
		<div class="video_section-title fl-wrap">
			<h4>Aliquam erat volutpat interdum</h4>
			<h2>Get ready to start your exciting journey. <br> Our agency will lead you through the amazing digital world</h2>
		</div>
		<a href="https://vimeo.com/70851162" class="promo-link big_prom   image-popup"><i class="fal fa-play"></i><span>Promo Video</span></a>
	</div>
</section>
<!--section end-->
<!--section -->
<section id="sec3">
	<div class="container">
		<div class="section-title">
			<h2> Our Team</h2>
			<div class="section-subtitle">the crew</div>
			<span class="section-separator"></span>
			<p>Explore some of the best tips from around the city from our partners and friends.</p>
		</div>
		<div class="about-wrap team-box2 fl-wrap">
			<!-- team-item -->
			<div class="team-box">
				<div class="team-photo">
					<img src="images/team/2.jpg" alt="" class="respimg">
				</div>
				<div class="team-info fl-wrap">
					<h3><a href="#">Alisa Gray</a></h3>
					<h4>Business consultant</h4>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  </p>
					<div class="team-social">
						<ul class="no-list-style">
							<li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-vk"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
			<!-- team-item  end-->
			<!-- team-item -->
			<div class="team-box">
				<div class="team-photo">
					<img src="images/team/3.jpg" alt="" class="respimg">
				</div>
				<div class="team-info fl-wrap">
					<h3><a href="#">Austin Evon</a></h3>
					<h4>Photographer</h4>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  </p>
					<div class="team-social">
						<ul class="no-list-style">
							<li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-vk"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
			<!-- team-item end  -->
			<!-- team-item -->
			<div class="team-box">
				<div class="team-photo">
					<img src="images/team/4.jpg" alt="" class="respimg">
				</div>
				<div class="team-info fl-wrap">
					<h3><a href="#">Taylor Roberts</a></h3>
					<h4>Co-manager associated</h4>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  </p>
					<div class="team-social">
						<ul class="no-list-style">
							<li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-vk"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
			<!-- team-item end  -->
		</div>
	</div>
	<div class="waveWrapper waveAnimation">
	  <div class="waveWrapperInner bgMiddle">
		<div class="wave-bg-anim waveMiddle" style="background-image: url('images/wave-top.png')"></div>
	  </div>
	  <div class="waveWrapperInner bgBottom">
		<div class="wave-bg-anim waveBottom" style="background-image: url('images/wave-top.png')"></div>
	  </div>
	</div>
</section>
<!--section end-->
<!--section  -->
<section class="gray-bg">
	<div class="container">
		<div class="clients-carousel-wrap fl-wrap">
			<div class="cc-btn   cc-prev"><i class="fal fa-angle-left"></i></div>
			<div class="cc-btn cc-next"><i class="fal fa-angle-right"></i></div>
			<div class="clients-carousel">
				<div class="swiper-container">
					<div class="swiper-wrapper">
						<!--client-item-->
						<div class="swiper-slide">
							<a href="#" class="client-item"><img src="images/clients/1.png" alt=""></a>
						</div>
						<!--client-item end-->
						<!--client-item-->
						<div class="swiper-slide">
							<a href="#" class="client-item"><img src="images/clients/2.png" alt=""></a>
						</div>
						<!--client-item end-->
						<!--client-item-->
						<div class="swiper-slide">
							<a href="#" class="client-item"><img src="images/clients/3.png" alt=""></a>
						</div>
						<!--client-item end-->
						<!--client-item-->
						<div class="swiper-slide">
							<a href="#" class="client-item"><img src="images/clients/1.png" alt=""></a>
						</div>
						<!--client-item end-->
						<!--client-item-->
						<div class="swiper-slide">
							<a href="#" class="client-item"><img src="images/clients/2.png" alt=""></a>
						</div>
						<!--client-item end-->
						<!--client-item-->
						<div class="swiper-slide">
							<a href="#" class="client-item"><img src="images/clients/3.png" alt=""></a>
						</div>
						<!--client-item end-->
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!--section end-->
<!--section  -->
<section class="parallax-section" data-scrollax-parent="true" id="sec4">
	<div class="bg par-elem "  data-bg="images/bg/33.jpg" data-scrollax="properties: { translateY: '30%' }"></div>
	<div class="overlay op7"></div>
	<!--container-->
	<div class="container">
		<div class="section-title center-align big-title">
			<h2><span>Why Choose Us</span></h2>
			<span class="section-separator"></span>
			<h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nec tincidunt arcu, sit amet fermentum sem.</h4>
		</div>
	</div>
</section>
<!--section end-->
<!--section  -->
<section class="gray-bg absolute-wrap_section">
	<div class="container">
		<div class="absolute-wrap fl-wrap">
			<!-- features-box-container -->
			<div class="features-box-container fl-wrap">
				<div class="row">
					<!--features-box -->
					<div class="col-md-4">
						<div class="features-box">
							<div class="time-line-icon">
								<i class="fal fa-headset"></i>
							</div>
							<h3>24 Hours Support</h3>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar.    </p>
						</div>
					</div>
					<!-- features-box end  -->
					<!--features-box -->
					<div class="col-md-4">
						<div class="features-box gray-bg">
							<div class="time-line-icon">
								<i class="fal fa-users-cog"></i>
							</div>
							<h3>Admin Panel</h3>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar.   </p>
						</div>
					</div>
					<!-- features-box end  -->
					<!--features-box -->
					<div class="col-md-4">
						<div class="features-box ">
							<div class="time-line-icon">
								<i class="fal fa-mobile"></i>
							</div>
							<h3>Mobile Friendly</h3>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar.  </p>
						</div>
					</div>
					<!-- features-box end  -->
				</div>
			</div>
			<!-- features-box-container end  -->
		</div>
		<div class="section-separator"></div>
	</div>
</section>
<!--section end-->
<!--section  -->
<section id="sec5">
	<div class="container">
		<div class="section-title">
			<h2> Testimonilas</h2>
			<div class="section-subtitle">Clients Reviews</div>
			<span class="section-separator"></span>
			<p>Explore some of the best tips from around the city from our partners and friends.</p>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="testimonilas-carousel-wrap fl-wrap">
		<div class="listing-carousel-button listing-carousel-button-next"><i class="fas fa-caret-right"></i></div>
		<div class="listing-carousel-button listing-carousel-button-prev"><i class="fas fa-caret-left"></i></div>
		<div class="testimonilas-carousel">
			<div class="swiper-container">
				<div class="swiper-wrapper">
					<!--testi-item-->
					<div class="swiper-slide">
						<div class="testi-item fl-wrap">
							<div class="testi-avatar"><img src="images/avatar/4.jpg" alt=""></div>
							<div class="testimonilas-text fl-wrap">
								<div class="listing-rating card-popup-rainingvis" data-starrating2="5"></div>
								<p>"Vestibulum orci felis, ullamcorper non condimentum non, ultrices ac nunc. Mauris non ligula suscipit, vulputate mi accumsan, dapibus felis. Nullam sed sapien dui. Nulla auctor sit amet sem non porta. "</p>
								<a href="#" class="testi-link" target="_blank">Via Facebook</a>
								<div class="testimonilas-avatar fl-wrap">
									<h3>Centa Simpson</h3>
									<h4>Restaurant Owner</h4>
								</div>
							</div>
						</div>
					</div>
					<!--testi-item end-->
					<!--testi-item-->
					<div class="swiper-slide">
						<div class="testi-item fl-wrap">
							<div class="testi-avatar"><img src="images/avatar/4.jpg" alt=""></div>
							<div class="testimonilas-text fl-wrap">
								<div class="listing-rating card-popup-rainingvis" data-starrating2="5"></div>
								<p>"Vestibulum orci felis, ullamcorper non condimentum non, ultrices ac nunc. Mauris non ligula suscipit, vulputate mi accumsan, dapibus felis. Nullam sed sapien dui. Nulla auctor sit amet sem non porta. "</p>
								<a href="#" class="testi-link" target="_blank">Via Facebook</a>
								<div class="testimonilas-avatar fl-wrap">
									<h3>Centa Simpson</h3>
									<h4>Restaurant Owner</h4>
								</div>
							</div>
						</div>
					</div>
					<!--testi-item end-->
					<!--testi-item-->
					<div class="swiper-slide">
						<div class="testi-item fl-wrap">
							<div class="testi-avatar"><img src="images/avatar/4.jpg" alt=""></div>
							<div class="testimonilas-text fl-wrap">
								<div class="listing-rating card-popup-rainingvis" data-starrating2="5"></div>
								<p>"Vestibulum orci felis, ullamcorper non condimentum non, ultrices ac nunc. Mauris non ligula suscipit, vulputate mi accumsan, dapibus felis. Nullam sed sapien dui. Nulla auctor sit amet sem non porta. "</p>
								<a href="#" class="testi-link" target="_blank">Via Facebook</a>
								<div class="testimonilas-avatar fl-wrap">
									<h3>Centa Simpson</h3>
									<h4>Restaurant Owner</h4>
								</div>
							</div>
						</div>
					</div>
					<!--testi-item end-->
					<!--testi-item-->
					<div class="swiper-slide">
						<div class="testi-item fl-wrap">
							<div class="testi-avatar"><img src="images/avatar/4.jpg" alt=""></div>
							<div class="testimonilas-text fl-wrap">
								<div class="listing-rating card-popup-rainingvis" data-starrating2="5"></div>
								<p>"Vestibulum orci felis, ullamcorper non condimentum non, ultrices ac nunc. Mauris non ligula suscipit, vulputate mi accumsan, dapibus felis. Nullam sed sapien dui. Nulla auctor sit amet sem non porta. "</p>
								<a href="#" class="testi-link" target="_blank">Via Facebook</a>
								<div class="testimonilas-avatar fl-wrap">
									<h3>Centa Simpson</h3>
									<h4>Restaurant Owner</h4>
								</div>
							</div>
						</div>
					</div>
					<!--testi-item end-->
					<!--testi-item-->
					<div class="swiper-slide">
						<div class="testi-item fl-wrap">
							<div class="testi-avatar"><img src="images/avatar/4.jpg" alt=""></div>
							<div class="testimonilas-text fl-wrap">
								<div class="listing-rating card-popup-rainingvis" data-starrating2="5"></div>
								<p>"Vestibulum orci felis, ullamcorper non condimentum non, ultrices ac nunc. Mauris non ligula suscipit, vulputate mi accumsan, dapibus felis. Nullam sed sapien dui. Nulla auctor sit amet sem non porta. "</p>
								<a href="#" class="testi-link" target="_blank">Via Facebook</a>
								<div class="testimonilas-avatar fl-wrap">
									<h3>Centa Simpson</h3>
									<h4>Restaurant Owner</h4>
								</div>
							</div>
						</div>
					</div>
					<!--testi-item end-->
				</div>
			</div>
		</div>
		<div class="tc-pagination"></div>
	</div>
</section>
<!--section end-->
*/ ?>