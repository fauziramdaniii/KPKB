<!--section  -->
<section class="hero-section"   data-scrollax-parent="true">
	<div class="bg-tabs-wrap">
		<div class="bg-parallax-wrap" data-scrollax="properties: { translateY: '200px' }">
			<div class="bg bg_tabs"  data-bg="images/bg/hero/1.jpg"></div>
			<div class="overlay op7"></div>
		</div>
	</div>
	<div class="container small-container">
		<div class="intro-item fl-wrap">
			<span class="section-separator"></span>
			<div class="bubbles">
				<h1>Explore Best Places In City</h1>
			</div>
			<h3>Find some of the best tips from around the city from our partners and friends.</h3>
		</div>
		<!-- main-search-input-tabs-->
		<div class="main-search-input-tabs  tabs-act fl-wrap">
			<ul class="tabs-menu change_bg no-list-style">
				<li class="current"><a href="#tab-inpt1" data-bgtab="images/bg/hero/1.jpg"> Places</a></li>
				<li><a href="#tab-inpt2" data-bgtab="images/bg/hero/2.jpg"> Events</a></li>
				<li><a href="#tab-inpt3" data-bgtab="images/bg/hero/3.jpg"> Restaurants</a></li>
				<li><a href="#tab-inpt4" data-bgtab="images/bg/hero/4.jpg"> Hotels</a></li>
			</ul>
			<!--tabs -->                       
			<div class="tabs-container fl-wrap  ">
				<!--tab -->
				<div class="tab">
					<div id="tab-inpt1" class="tab-content first-tab">
						<div class="main-search-input-wrap fl-wrap">
							<div class="main-search-input fl-wrap">
								<div class="main-search-input-item">
									<label><i class="fal fa-keyboard"></i></label>
									<input type="text" placeholder="What are you looking for?" value=""/>
								</div>
								<div class="main-search-input-item location autocomplete-container">
									<label><i class="fal fa-map-marker-check"></i></label>
									<input type="text" placeholder="Location" class="autocomplete-input" id="autocompleteid" value=""/>
									<a href="#"><i class="fa fa-dot-circle-o"></i></a>
								</div>
								<div class="main-search-input-item">
									<select data-placeholder="All Categories"  class="chosen-select" >
										<option>All Categories</option>
										<option>Shops</option>
										<option>Hotels</option>
										<option>Restaurants</option>
										<option>Fitness</option>
										<option>Events</option>
									</select>
								</div>
								<button class="main-search-button color2-bg" onclick="window.location.href='listing.html'">Search <i class="far fa-search"></i></button>
							</div>
						</div>
					</div>
				</div>
				<!--tab end-->
				<!--tab -->
				<div class="tab">
					<div id="tab-inpt2" class="tab-content">
						<div class="main-search-input-wrap fl-wrap">
							<div class="main-search-input fl-wrap">
								<div class="main-search-input-item">
									<label><i class="fal fa-handshake-alt"></i></label>
									<input type="text" placeholder="Event Name or Place" value=""/>
								</div>
								<div class="main-search-input-item">
									<select data-placeholder="Loaction" class="chosen-select on-radius" >
										<option>All Cities</option>
										<option>New York</option>
										<option>London</option>
										<option>Paris</option>
										<option>Kiev</option>
										<option>Moscow</option>
										<option>Dubai</option>
										<option>Rome</option>
										<option>Beijing</option>
									</select>
								</div>
								<div class="main-search-input-item clact date-container">
									<span class="iconn-dec"><i class="fal fa-calendar"></i></span>
									<input type="text" placeholder="Event Date"     name="datepicker-here"   value=""/>
									<span class="clear-singleinput"><i class="fal fa-times"></i></span>
								</div>
								<button class="main-search-button color2-bg" onclick="window.location.href='listing.html'">Search <i class="far fa-search"></i></button>
							</div>
						</div>
					</div>
				</div>
				<!--tab end-->                                
				<!--tab -->
				<div class="tab">
					<div id="tab-inpt3" class="tab-content">
						<div class="main-search-input-wrap fl-wrap">
							<div class="main-search-input fl-wrap">
								<div class="main-search-input-item">
									<label><i class="fal fa-cheeseburger"></i></label>
									<input type="text" placeholder="Restaurant Name" value=""/>
								</div>
								<div class="main-search-input-item clact date-container">
									<span class="iconn-dec"><i class="fal fa-calendar"></i></span>
									<input type="text" placeholder="Date and Time"     name="datepicker-here-time"   value=""/>
									<span class="clear-singleinput"><i class="fal fa-times"></i></span>
								</div>

								<div class="main-search-input-item">
									<label><i class="fal fa-user-friends"></i></label>
									<input type="number" placeholder="Persons" value=""/>
								</div>
								<button class="main-search-button color2-bg" onclick="window.location.href='listing.html'">Search <i class="far fa-search"></i></button>
							</div>
						</div>
					</div>
				</div>
				<!--tab end-->                                 
				<!--tab -->
				<div class="tab">
					<div id="tab-inpt4" class="tab-content">
						<div class="main-search-input-wrap fl-wrap">
							<div class="main-search-input fl-wrap">
								<div class="main-search-input-item">
									<label><i class="fal fa-cheeseburger"></i></label>
									<input type="text" placeholder="Hotel Name" value=""/>
								</div>
								<div class="main-search-input-item">
									<label><i class="fal fa-user-friends"></i></label>
									<input type="number" placeholder="Persons" value=""/>
								</div>
								<div class="main-search-input-item clact date-container3 daterangepicker_big">
									<span class="iconn-dec"><i class="fal fa-calendar"></i></span>
									<input type="text" placeholder="Date In Out"     name="dates"   value=""/>
									<span class="clear-singleinput"><i class="fal fa-times"></i></span>
								</div>
								<button class="main-search-button color2-bg" onclick="window.location.href='listing.html'">Search <i class="far fa-search"></i></button>
							</div>
						</div>
					</div>
				</div>
				<!--tab end-->                                  
			</div>
			<!--tabs end-->
		</div>
		<!-- main-search-input-tabs end-->
		<div class="hero-categories fl-wrap">
			<h4 class="hero-categories_title">Just looking around ? Use quick search by category :</h4>
			<ul class="no-list-style">
				<li><a href="listing.html"><i class="far fa-cheeseburger"></i><span>Restaurants</span></a></li>
				<li><a href="listing.html"><i class="far fa-bed"></i><span>Hotels</span></a></li>
				<li><a href="listing.html"><i class="far fa-shopping-bag"></i><span>Shops</span></a></li>
				<li><a href="listing.html"><i class="far fa-dumbbell"></i><span>Fitness</span></a></li>
				<li><a href="listing.html"><i class="far fa-cocktail"></i><span>Events</span></a></li>
			</ul>
		</div>
	</div>
	<div class="header-sec-link">
		<a href="#sec1" class="custom-scroll-link"><i class="fal fa-angle-double-down"></i></a> 
	</div>
</section>
<!--section end-->