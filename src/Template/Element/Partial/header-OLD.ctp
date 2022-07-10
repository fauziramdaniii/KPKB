<!-- header -->
<header class="main-header">
	<!-- logo-->
	<a href="<?= $this->Url->build(['controller' => 'Home', 'action' => 'index'])?>" class="logo-holder"><img src="<?= $this->Url->build('/front-assets/images/logo.png');?>" alt=""></a>
	<!-- logo end-->

	<!-- header-search_btn-->
		<!-- <div class="header-search_btn show-search-button"><i class="fal fa-search"></i><span>Search</span></div> -->
	<!-- header-search_btn end-->

	<!-- header opt -->
	<a href="<?= $this->Url->build(['controller' => 'SignUp', 'action' => 'index'])?>" class="add-list color-bg">Register</a>

	<!-- <div class="cart-btn   show-header-modal" data-microtip-position="bottom" role="tooltip" aria-label="Your Wishlist"><i class="fal fa-heart"></i><span class="cart-counter green-bg"></span> </div> -->

	<div class="show-reg-form modal-open avatar-img" data-srcav="<?= $this->Url->build('/front-assets/images/avatar/3.jpg');?>"><i class="fal fa-user"></i>Sign in</div>
	<!-- header opt end-->

	<!-- lang-wrap-->
	<?php /*
	<div class="lang-wrap">
		<div class="show-lang"><span><i class="fal fa-globe-europe"></i><strong>En</strong></span><i class="fa fa-caret-down arrlan"></i></div>
		<ul class="lang-tooltip lang-action no-list-style">
			<li><a href="#" class="current-lan" data-lantext="En">English</a></li>
			<li><a href="#" data-lantext="Fr">Franais</a></li>
			<li><a href="#" data-lantext="Es">Espaol</a></li>
			<li><a href="#" data-lantext="De">Deutsch</a></li>
		</ul>
	</div>
	*/ ?>
	<!-- lang-wrap end-->

	<!-- nav-button-wrap-->
	<div class="nav-button-wrap color-bg">
		<div class="nav-button">
			<span></span><span></span><span></span>
		</div>
	</div>
	<!-- nav-button-wrap end-->
	<!--  navigation -->
	<div class="nav-holder main-menu">
		<nav>
			<ul class="no-list-style">
				<li>
					<a href="<?= $this->Url->build(['controller' => 'Home', 'action' => 'index'])?>">Beranda</a>
				</li>
				<li>
					<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'view', 'tentang-kami'])?>">Tentang Kami</a>
				</li>
				<li>
					<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'view', 'marketing-plan'])?>">Marketing Plan</a>
				</li>
				<li>
					<a href="#">Produk <i class="fa fa-caret-down"></i></a>
					<!--second level -->
					<?= $this->cell('Products::allproduct'); ?>
					<!--second level end-->
				</li>
				<li>
					<a href="<?= $this->Url->build(['controller' => 'News', 'action' => 'index'])?>">Berita</a>
				</li>
				<li>
					<a href="<?= $this->Url->build(['controller' => 'Galleries', 'action' => 'index'])?>">Galeri</a>
				</li>
				<li>
					<a href="<?= $this->Url->build(['controller' => 'Contacts', 'action' => 'index'])?>">Kontak</a>
				</li>

				<?php /*
				<li>
					<a href="#" class="act-link">Beranda <i class="fa fa-caret-down"></i></a>
					<!--second level -->
					<ul>
						<li><a href="index.html">Parallax Image</a></li>
						<li><a href="index2.html">Slider</a></li>
						<li><a href="index3.html">Slideshow</a></li>
						<li><a href="index4.html">Video</a></li>
						<li><a href="index5.html">Map</a></li>
					</ul>
					<!--second level end-->
				</li>
				<li>
					<a href="#">Listings <i class="fa fa-caret-down"></i></a>
					<!--second level -->
					<ul>
						<li><a href="listing.html">Column map</a></li>
						<li><a href="listing2.html">Column map 2</a></li>
						<li><a href="listing3.html">Fullwidth Map</a></li>
						<li><a href="listing4.html">Fullwidth Map 2</a></li>
						<li><a href="listing5.html">Without Map</a></li>
						<li><a href="listing6.html">Without Map 2</a></li>
						<li>
							<a href="#">Single <i class="fa fa-caret-down"></i></a>
							<!--third  level  -->
							<ul>
								<li><a href="listing-single.html">Style 1</a></li>
								<li><a href="listing-single2.html">Style 2</a></li>
								<li><a href="listing-single3.html">Style 3</a></li>
								<li><a href="listing-single4.html">Style 4</a></li>
							</ul>
							<!--third  level end-->
						</li>
					</ul>
					<!--second level end-->
				</li>
				<li>
					<a href="blog.html">News</a>
				</li>
				<li>
					<a href="#">Pages <i class="fa fa-caret-down"></i></a>
					<!--second level -->
					<ul>
						<li>
							<a href="#">Shop<i class="fa fa-caret-down"></i></a>
							<!--third  level  -->
							<ul>
								<li><a href="shop.html">Products</a></li>
								<li><a href="product-single.html">Product single</a></li>
								<li><a href="cart.html">Cart</a></li>
							</ul>
							<!--third  level end-->
						</li>
						<li><a href="about.html">About</a></li>
						<li><a href="contacts.html">Contacts</a></li>
						<li><a href="author-single.html">User single</a></li>
						<li><a href="help.html">How it Works</a></li>
						<li><a href="booking.html">Booking</a></li>
						<li><a href="pricing-tables.html">Pricing</a></li>
						<li><a href="dashboard.html">User Dasboard</a></li>
						<li><a href="blog-single.html">Blog Single</a></li>
						<li><a href="dashboard-add-listing.html">Add Listing</a></li>
						<li><a href="invoice.html">Invoice</a></li>
						<li><a href="404.html">404</a></li>
					</ul>
					<!--second level end-->
				</li>
				*/ ?>

				<li>
					<a href="<?= $this->Url->build(['controller' => 'SignUp', 'action' => 'index'])?>" class="hide-xl">Register</a>
				</li>
			</ul>
		</nav>
	</div>
	<!-- navigation  end -->
</header>
