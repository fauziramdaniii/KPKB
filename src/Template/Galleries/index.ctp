<!--  section  -->
<section class="parallax-section single-par" data-scrollax-parent="true">
	<div class="bg par-elem "  data-bg="<?= $this->Url->build('/front-assets/images/bg/5.jpg');?>" data-scrollax="properties: { translateY: '30%' }"></div>
	<div class="overlay op7"></div>
	<div class="container">
		<div class="section-title center-align big-title">
			<h2><span>Galleries</span></h2>
			<span class="section-separator"></span>
			<div class="breadcrumbs fl-wrap"><a href="#">Home</a><span>Galleries</span></div>
		</div>
	</div>
</section>
<!--  section  end-->   
<!--section -->
<section   class="gray-bg hidden-section particles-wrapper">
	<div class="container">
		<div class="section-title">
			<h2>Galleries</h2>
			<div class="section-subtitle">Catalog of Galleries</div>
			<span class="section-separator"></span>
			<p>In ut odio libero, at vulputate urna. Nulla tristique mi a massa convallis cursus.</p>
		</div>
		<div class="listing-item-grid_container fl-wrap">
			<div class="row">
				<!--  listing-item-grid  -->
				<?php foreach($galleries as $gallery) : ?>
				<div class="col-sm-4">
					<div class="listing-item-grid">
						
						<div class="bg" data-bg="<?= $this->Url->build('/'.$gallery->image->dir .$gallery->image->name); ?>"></div>
						<div class="d-gr-sec"></div>
						<div class="listing-item-grid_title">
							<h3><a href="<?= $this->Url->build('/'.$gallery->image->dir .$gallery->image->name); ?>"><?= $gallery->title; ?></a></h3>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
				<!--  listing-item-grid end  -->
			</div>
		</div>
	</div>
							
</section> 
<!--section end-->