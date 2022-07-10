<section id="page-content" class="sidebar-right">
    <div class="container">
        <div class="row">
            <!-- post content -->
            <div class="content col-lg-9">
                <!-- Page title -->
                <div class="page-title">
                    <h1>BERITA</h1>
                    <div class="breadcrumb float-left">
                        <ul>
                            <li><a href="<?= $this->Url->build(['controller' => 'Home', 'action' => 'index' ]); ?>">Beranda</a>
                            </li>
                            <li><a href="<?= $this->Url->build(['controller' => 'News', 'action' => 'index' ]); ?>">Berita</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- end: Page title -->
                <!-- Blog -->
                <div id="blog" class="post-thumbnails">
                    <!-- Post item-->
                    <?php foreach($blogs as $news) : ?>
                        <div class="post-item">
                            <div class="post-item-wrap">
                                <div class="post-image">
                                    <?php
                                    $blog_image = $news->get('image') ?
                                        $this->Url->build('/files/Blogs/image/' . $news->get('image'))
                                        : $this->Url->build('/front-assets-new/images/blog/12.jpg');
                                    if ($blog_image) :
                                        ?>
                                        <a href="<?= $blog_image; ?>">
                                            <img alt="" src="<?= $blog_image; ?>">
                                        </a>
                                    <?php endif; ?>
                                    <span class="post-meta-category"><?php foreach($news->tags as $tag) : ?><a href="#"><?= $tag->name; ?></a><?php endforeach; ?></span>
                                </div>
                                <div class="post-item-description">
                                    <span class="post-meta-date"><i class="fa fa-calendar-o"></i><?= $news->created->format('d M Y'); ?></span>
                                    <h2><a href="<?= $this->Url->build(['controller' => 'News', 'action' => 'view', $news->get('slug')]); ?>"><?= __($news->get('title')); ?>
                                        </a></h2>
                                    <p><?= $this->Text->truncate(strip_tags($news->get('content')), 200); ?></p>
                                    <a href="<?= $this->Url->build(['controller' => 'News', 'action' => 'view', $news->get('slug')]); ?>" class="item-link">Baca Selengkapnya <i class="icon-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <!-- end: Post item-->
                </div>
                <!-- end: Blog -->
                <!-- Pagination -->
                <?= $this->Tools->pagination(); ?>
                <!-- end: Pagination -->
            </div>
            <!-- end: post content -->
            <!-- Sidebar-->
            <div class="sidebar sticky-sidebar col-lg-3">
                <!--Tabs with Posts-->
                <div class="widget ">
                    <h4 class="widget-title">Berita Lainnya</h4>
                    <div class="post-thumbnail-list">
                        <?php if($top_blogs) : ?>
                            <?php foreach($top_blogs as $other_blog) :?>
                                <div class="post-thumbnail-entry">
                                    <?php
                                    $blog_image = $other_blog->get('image') ?
                                        $this->Url->build('/files/Blogs/image/' . $other_blog->get('image'))
                                        : $this->Url->build('/front-assets-new/images/blog/12.jpg');
                                    if ($blog_image) :
                                        ?>
                                        <img src="<?= $blog_image; ?>" alt="">
                                    <?php endif; ?>
                                    <div class="post-thumbnail-content">
                                        <a href="<?= $this->Url->build(['controller' => 'News', 'action' => 'view', $other_blog->get('slug')]); ?>"><?= __($other_blog->title); ?></a>
                                        <span class="post-date"><i class="icon-clock"></i> <?= $other_blog->created->format('d M Y'); ?></span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <div class="post-thumbnail-entry">
                                TIDAK ADA BERITA.
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <!--End: Tabs with Posts-->
                <!--widget tags -->
                <div class="widget  widget-tags">
                    <h4 class="widget-title">Tags</h4>
                    <div class="tags">
                        <?php if (isset($tags)) : ?>
                            <?php foreach($tags as $tag) : ?>
                                <a href="<?= $this->Url->build(['action' => 'tag', $tag->id]); ?>"><?= $tag->name; ?></a>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <!--end: widget tags -->
            </div>
            <!-- end: Sidebar-->
        </div>
    </div>
</section> <!-- end: Content -->
