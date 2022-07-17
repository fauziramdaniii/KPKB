<section id="page-content" class="sidebar-right">
    <div class="container">
        <div class="row">
            <!-- content -->
            <div class="content col-lg-9">
                <!-- Blog -->
                <div id="blog" class="single-post">
                    <!-- Post single item-->
                    <div class="post-item">
                        <div class="post-item-wrap">
                            <div class="post-image">
                                <?php
                                $blog_head_image = $blog->get('image') ?
                                    $this->Url->build('/files/Blogs/image/' . $blog->get('image'))
                                    : $this->Url->build('/front-assets-new/images/blog/12.jpg');
                                ?>
                                <a href="<?= $blog_head_image;?>">
                                    <img src="<?= $blog_head_image;?>" alt="">
                                </a>
                            </div>
                            <div class="post-item-description">
                                <h2><?= __($blog->get('title')); ?></h2>
                                <div class="post-meta">
                                    <span class="post-meta-date"><i class="fa fa-calendar-o"></i><?= $blog->created->format('M j, Y'); ?></span>
                                    <span class="post-meta-category"><?php foreach($blog->tags as $tag) : ?><a href=""><i class="fa fa-tag"></i><?= $tag->name; ?> </a><?php endforeach; ?></span>
                                </div>
                                <?= $blog->get('content'); ?>
                            </div>
                            <div class="post-tags">
                                <?php foreach($blog->tags as $tag) : ?>
                                    <a href="#"><?= $tag->name; ?></a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <!-- end: Post single item-->
                </div>
            </div>
            <!-- end: content -->
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
</section>
