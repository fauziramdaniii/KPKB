<!--  section  -->
<section class="parallax-section single-par" data-scrollax-parent="true">
	<div class="bg par-elem "  data-bg="<?= $this->Url->build('/front-assets/images/bg/5.jpg');?>" data-scrollax="properties: { translateY: '30%' }"></div>
	<div class="overlay op7"></div>
	<div class="container">
		<div class="section-title center-align big-title">
			<h2><span><?= $title; ?></span></h2>
			<span class="section-separator"></span>
			<h4><?= $description; ?></h4>
		</div>
	</div>
	<div class="header-sec-link">
		<a href="#sec1" class="custom-scroll-link"><i class="fal fa-angle-double-down"></i></a>
	</div>
</section>
<!--  section  end-->
<section class="gray-bg no-top-padding-sec" id="sec1">
	<div class="container">
		<div class="breadcrumbs inline-breadcrumbs fl-wrap block-breadcrumbs">
			<a href="#">Home</a><span><?= $title; ?></span>
			<!-- <div  class="showshare brd-show-share color2-bg"> <i class="fas fa-share"></i> Share </div> -->
		</div>
		<div class="share-holder hid-share sing-page-share top_sing-page-share">
			<div class="share-container  isShare"></div>
		</div>
		<div class="post-container fl-wrap">
			<div class="row">
				<!-- blog content-->
				<div class="col-md-8">
					<!-- article> -->
					<?php foreach($blogs as $news) : ?>
					<article class="post-article">
						<div class="list-single-main-media fl-wrap">
							<?php
							$blog_image = $news->get('image') ?
								$this->Url->build('/files/Blogs/image/' . $news->get('image'))
								: $this->Url->build('/files/Blogs/image/placeholder.jpg');
							if ($blog_image) :
							?>
							<img src="<?= $blog_image; ?>" class="respimg" alt="">
							<?php endif; ?>
						</div>
						<div class="list-single-main-item fl-wrap block_box">
							<h2 class="post-opt-title"><a href="<?= $this->Url->build(['controller' => 'News', 'action' => 'view', $news->get('slug')]); ?>"><?= __($news->get('title')); ?></a></h2>
							<p><?= $this->Text->truncate(strip_tags($news->get('content')), 200); ?></p>
							<span class="fw-separator"></span>
							<div class="post-author"><a href="#"><img src="<?= $this->Url->build('/front-assets/images/avatar/5.jpg');?>" alt=""><span>Admin</span></a></div>
							<div class="post-opt">
								<ul class="no-list-style">
									<li><i class="fal fa-calendar"></i> <span><?= $news->created->format('d M Y'); ?></span></li>
									<li><i class="fal fa-eye"></i> <span><?= $news->get('view'); ?></span></li>
									<li><i class="fal fa-tags"></i> <?php foreach($news->tags as $tag) : ?><a href="#"><?= $tag->name; ?></a><?php endforeach; ?></li>
								</ul>
							</div>
							<a href="<?= $this->Url->build(['controller' => 'News', 'action' => 'view', $news->get('slug')]); ?>" class="btn  color2-bg float-btn">Baca Selengkapnya<i class="fal fa-angle-right"></i></a>
						</div>
					</article>
					<?php endforeach; ?>
					<!-- article end -->
                    <?= $this->Tools->pagination(); ?>
				</div>
				<!-- blog conten end-->
				<!-- blog sidebar -->
				<div class="col-md-4">
					<div class="box-widget-wrap fl-wrap fixed-bar">
						<!--box-widget-item -->
						<div class="box-widget-item fl-wrap block_box">
							<div class="box-widget-item-header">
								<h3>Kategori</h3>
							</div>
							<div class="box-widget fl-wrap">
								<div class="box-widget-content">
									<ul class="cat-item no-list-style">
									<?php if (isset($topics)) : ?>
										<?php foreach($topics as $topic) : ?>
										<li><a href="<?= $this->Url->build(['controller' => 'News', 'action' => 'topic', $topic->id]); ?>"><?= $topic['name']; ?></a></li>
										<?php endforeach; ?>
									<?php else : ?>
										<li><?= __('Tidak Ada Kategori'); ?></li>
									<?php endif; ?>
								</div>
							</div>
						</div>
						<!--box-widget-item end -->
						<!--box-widget-item -->
						<div class="box-widget-item fl-wrap">
							<div class="banner-wdget fl-wrap">
								<div class="overlay"></div>
								<div class="bg"  data-bg="<?= $this->Url->build('/front-assets/images/bg/13.jpg');?>"></div>
								<div class="banner-wdget-content fl-wrap">
									<h4>Whant to be notified about new post and news ? Subscribe For a Newsletter.</h4>
									<a href="#subscribe" class="custom-scroll-link color-bg" > Sign up</a>
								</div>
							</div>
						</div>
						<!--box-widget-item end -->
						<!--box-widget-item -->
						<div class="box-widget-item fl-wrap block_box">
							<div class="box-widget-item-header">
								<h3>Tags</h3>
							</div>
							<div class="box-widget fl-wrap">
								<div class="box-widget-content">
									<div class="list-single-tags tags-stylwrap">
									<?php if (isset($tags)) : ?>
										<?php foreach($tags as $tag) : ?>
										<a href="<?= $this->Url->build(['action' => 'tag', $tag->id]); ?>"><?= $tag->name; ?></a>
										<?php endforeach; ?>
									<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
						<!--box-widget-item end -->
					</div>
				</div>
				<!-- blog sidebar end -->
			</div>
		</div>
	</div>
</section>
<div class="limit-box fl-wrap"></div>
