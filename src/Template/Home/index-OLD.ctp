
<!--section  -->
<section>
	<div class="container big-container">
		<div class="section-title">
			<h2><span>Berita</span></h2>
			<div class="section-subtitle">Berita Terbaru</div>
			<span class="section-separator"></span>
			<p>Proin dapibus nisl ornare diam varius tempus. Aenean a quam luctus, finibus tellus ut, convallis eros sollicitudin turpis.</p>
		</div>
		<div class="listing-filters gallery-filters fl-wrap">
			<a href="#" class="gallery-filter  gallery-filter-active" data-filter="*">All Categories</a>
			<?php foreach($tags as $tag) : ?>
				<a href="#" class="gallery-filter" data-filter=".<?= $tag->name; ?>"><?= $tag->name; ?></a>
			<?php endforeach; ?>
		</div>
		<div class="grid-item-holder gallery-items fl-wrap">
			<!--  gallery-item-->
			<?php foreach($highlight as $news) : ?>
			<div class="gallery-item <?= $news->tags[0]->name; ?>">
				<!-- listing-item  -->
				<div class="listing-item">
					<article class="geodir-category-listing fl-wrap">
						<div class="geodir-category-img">
							<a href="<?= $this->Url->build(['controller' => 'News', 'action' => 'view', $news->get('slug')]); ?>" class="geodir-category-img-wrap fl-wrap">
								<?php
								$blog_image = $news->get('image') ?
									$this->Url->build('/files/Blogs/image/' . $news->get('image'))
									: $this->Url->build('/files/Blogs/image/placeholder.jpg');
								if ($blog_image) :
								?>
									<img src="<?= $blog_image; ?>" alt="">
								<?php endif; ?>
							</a>
							<div class="geodir_status_date gsd_open"><i class="fal fa-tag"></i><?= $news->tags[0]->name; ?></div>
						</div>
						<div class="geodir-category-content fl-wrap title-sin_item">
							<div class="geodir-category-content-title fl-wrap">
								<div class="geodir-category-content-title-item">
									<h3 class="title-sin_map"><a href="<?= $this->Url->build(['controller' => 'News', 'action' => 'view', $news->get('slug')]); ?>"><?= $news->get('title'); ?></a></h3>
								</div>
							</div>
							<div class="geodir-category-text fl-wrap">
								<p class="small-text"><?= $this->Text->truncate(strip_tags($news->get('content')), 200); ?></p>
							</div>
							<?php /*
							<div class="geodir-category-footer fl-wrap">
								<a class="listing-item-category-wrap">
									<div class="listing-item-category red-bg"><i class="fal fa-cheeseburger"></i></div>
									<span>Restaurants</span>
								</a>
								<a href="<?= $this->Url->build(['controller' => 'News', 'action' => 'view', $news->get('slug')]); ?>" class="btn color2-bg">Lihat Selengkapnya<i class="fal fa-arrow-alt-right"></i></a>
							</div>
							*/ ?>
						</div>
					</article>
				</div>
				<!-- listing-item end -->
			</div>
			<?php endforeach; ?>
			<!-- gallery-item  end-->
		</div>
		<a href="<?= $this->Url->build(['controller' => 'News', 'action' => 'index']); ?>" class="btn  dec_btn  color2-bg">Lihat Semua Berita<i class="fal fa-arrow-alt-right"></i></a>
	</div>
</section>
<!--section end-->
