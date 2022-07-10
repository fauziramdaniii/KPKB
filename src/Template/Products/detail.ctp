<section class="gray-bg no-top-padding-sec" id="sec1">
	<div class="container">
		<div class="breadcrumbs inline-breadcrumbs fl-wrap block-breadcrumbs">
			<a href="#">Home</a><a href="#">Produk</a> <span><?= $product->name; ?></span>
		</div>
		<div class="share-holder hid-share sing-page-share top_sing-page-share">
			<div class="share-container  isShare"></div>
		</div>
		<div class="post-container fl-wrap">
			<div class="row">
				<!-- blog content-->
				<div class="col-md-12">
					<!-- article> -->
					<article class="post-article single-post-article">
						<div class="list-single-main-media fl-wrap">
                            <?php
                            $product_image = $product->get('image') ?
                                $this->Url->build('/files/Products/image/' . $product->get('image'))
                                : $this->Url->build('/files/Products/image/placeholder.jpg');
                            if ($product_image) :
                                ?>
                                <img src="<?= $product_image; ?>" alt="">
                            <?php endif; ?>
							<?php /*
							<div class="single-slider-wrap">
								<div class="single-slider fl-wrap">
									<div class="swiper-container">
										<div class="swiper-wrapper lightgallery">
											<div class="swiper-slide hov_zoom"><img src="images/all/7.jpg" alt=""><a href="images/all/7.jpg" class="box-media-zoom   popup-image"><i class="fal fa-search"></i></a></div>
											<div class="swiper-slide hov_zoom"><img src="images/all/6.jpg" alt=""><a href="images/all/6.jpg" class="box-media-zoom   popup-image"><i class="fal fa-search"></i></a></div>
											<div class="swiper-slide hov_zoom"><img src="images/all/17.jpg" alt=""><a href="images/all/17.jpg" class="box-media-zoom   popup-image"><i class="fal fa-search"></i></a></div>
										</div>
									</div>
								</div>
								<div class="listing-carousel_pagination">
									<div class="listing-carousel_pagination-wrap">
										<div class="ss-slider-pagination"></div>
									</div>
								</div>
								<div class="ss-slider-cont ss-slider-cont-prev color2-bg"><i class="fal fa-long-arrow-left"></i></div>
								<div class="ss-slider-cont ss-slider-cont-next color2-bg"><i class="fal fa-long-arrow-right"></i></div>
							</div>
							*/ ?>
						</div>
						<div class="list-single-main-item fl-wrap block_box">
							<h2 class="post-opt-title"><?= $product->name; ?></h2>
							<span class="fw-separator"></span>
							<div class="clearfix"></div>
							<p><?= $product->description; ?></p>
							<span class="fw-separator"></span>
						</div>
					</article>
					<!-- article end -->
				</div>
				<!-- blog conten end-->
			</div>
		</div>
	</div>
</section>
<div class="limit-box fl-wrap"></div>
