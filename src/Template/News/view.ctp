<style>
    .polo-carousel-item {
        width: 100% !important; /* Ensure full width */
        height: 100% !important; /* Ensure full height */
    }

    /* Container for the Flickity carousel */
    .carousel {
        width: 100%;
        height: 500px;
        overflow: hidden;
    }

    /* Individual carousel cells */
    .carousel-cell {
        width: 100%; /* Full width of the carousel */
        height: 100%; /* Full height of the carousel */
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Ensure images fill their container */
    .carousel-cell img {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Ensures the image covers the entire carousel cell */
    }

    /* Style for Flickity page dots */
    .flickity-page-dots {
        position: absolute;
        bottom: 10px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        justify-content: center;
        list-style: none;
        padding: 0;
        margin: 0;
        z-index: 10; /* Ensure dots are on top of other elements */
    }

    .flickity-page-dots .dot {
        width: 8px;
        height: 8px;
        background: #fff; /* Dot color */
        border-radius: 50%;
        margin: 0 4px;
        cursor: pointer;
    }

    .flickity-page-dots .dot.is-selected {
        background: #000; /* Selected dot color */
    }


</style>

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
                                    $imageString = $blog->get('image');
                                    $imageArray = explode(',', $imageString);
                                    $baseUrl = $this->Url->build('/files/Blogs/image/');
                                ?>
                                   <!-- Flickity Carousel -->
                                    <div class="carousel" data-flickity='{ "wrapAround": true, "autoPlay": true }'>
                                        <?php foreach ($imageArray as $image): ?>
                                            <div class="carousel-cell">
                                                <a href="<?= $baseUrl . $image; ?>">
                                                    <img src="<?= $baseUrl . $image; ?>" alt="">
                                                </a>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                            </div>


                            <div class="post-item-description">
                                <h2><?= __($blog->get('title')); ?></h2>
                                <div class="post-meta">
                                    <span class="post-meta-date"><i class="fa fa-calendar-o"></i><?= $blog->created->format('M j, Y'); ?></span>
                                    <span class="post-meta-category">
                                        <?php foreach($blog->tags as $tag) : ?>
                                            <a href=""><i class="fa fa-tag"></i><?= $tag->name; ?> </a>
                                        <?php endforeach; ?>
                                    </span>
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
                                    $imageString = $other_blog->get('image');
                                    $imageArray = explode(',', $imageString);
                                    $firstImage = !empty($imageArray[0]) ? $imageArray[0] : null;
                                    
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