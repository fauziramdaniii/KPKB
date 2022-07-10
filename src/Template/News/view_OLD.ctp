<section class="gray-bg no-top-padding-sec" id="sec1">
	<div class="container">
		<div class="breadcrumbs inline-breadcrumbs fl-wrap block-breadcrumbs">
			<a href="#">Home</a><a href="<?= $this->Url->build(['controller' => 'News', 'action' => 'index']); ?>">Berita</a> <span><?= $blog->get('title');?></span> 
		</div>
		<div class="share-holder hid-share sing-page-share top_sing-page-share">
			<div class="share-container  isShare"></div>
		</div>
		<div class="post-container fl-wrap">
			<div class="row">
				<!-- blog content-->
				<div class="col-md-8">
					<!-- article> --> 
					<article class="post-article single-post-article">
						<div class="list-single-main-media fl-wrap">
							<?php
								$blog_head_image = $blog->get('image') ?
									$this->Url->build('/files/Blogs/image/' . $blog->get('image'))
									: $this->Url->build('/files/Blogs/image/placeholder.jpg');
							?>
							<img src="<?= $blog_head_image;?>" alt="">
							
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
							<h2 class="post-opt-title"><?= __($blog->get('title')); ?></a></h2>
							<div class="post-author"><img src="<?= $this->Url->build('/front-assets/images/avatar/5.jpg');?>" alt=""><span>Admin</span></div>
							<div class="post-opt">
								<ul class="no-list-style">
									<li><i class="fal fa-calendar"></i> <span><?= $blog->created->format('d M Y'); ?></span></li>
									<li><i class="fal fa-eye"></i> <span><?= $blog->view; ?></span></li>
									<li><i class="fal fa-tags"></i> <?php foreach($blog->tags as $tag) : ?><a href="#"><?= $tag->name; ?></a><?php endforeach; ?></li>
								</ul>
							</div>
							<span class="fw-separator"></span> 
							<div class="clearfix"></div>
							<?= $blog->get('content'); ?>
						</div>
					</article>
					<!-- article end -->                                                  
				</div>
				<!-- blog conten end-->
				<!-- blog sidebar -->
				<div class="col-md-4">
					<div class="box-widget-wrap fl-wrap fixed-bar">
						<!--box-widget-item -->
						<div class="box-widget-item fl-wrap block_box">
							<div class="box-widget-item-header">
								<h3>Berita Lainnya</h3>
							</div>
							<div class="box-widget  fl-wrap">
								<div class="box-widget-content">
									<!--widget-posts-->
									<div class="widget-posts  fl-wrap">
										<ul class="no-list-style">
										<?php if($top_blogs) : ?>
											<?php foreach($top_blogs as $other_blog) :?>
											<li>
												<div class="widget-posts-img"><a href="<?= $this->Url->build(['controller' => 'News', 'action' => 'view', $other_blog->get('slug')]); ?>">
													<?php
													$blog_image = $other_blog->get('image') ?
														$this->Url->build('/files/Blogs/image/' . $other_blog->get('image'))
														: $this->Url->build('/files/Blogs/image/placeholder.jpg');
													if ($blog_image) :
													?>
													<img src="<?= $blog_image; ?>" alt="">
													<?php endif; ?>
												</div>
												<div class="widget-posts-descr">
													<h4><a href="<?= $this->Url->build(['controller' => 'News', 'action' => 'view', $other_blog->get('slug')]); ?>"><?= __($other_blog->title); ?></a></h4>
													<div class="geodir-category-location fl-wrap"><i class="fal fa-calendar"></i> <?= $other_blog->created->format('d M Y'); ?></div>
												</div>
											</li>
											<?php endforeach; ?>
										<?php else : ?>
											<li><?= __('Tidak Ada Berita'); ?></li>
										<?php endif; ?>
										</ul>
									</div>
									<!-- widget-posts end-->
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
									</ul>
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