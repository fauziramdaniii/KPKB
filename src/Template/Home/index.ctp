<style>
    .breakpoint-xl .body-inner section {
        top: -80px;
    }

    .breakpoint-xl #mainMenu nav>ul>li>a,
    #mainMenu.dark nav>ul>li>a {
        color: #fff;
    }

    .breakpoint-xl .header-sticky.sticky-active #mainMenu nav>ul>li>a,
    #mainMenu.dark nav>ul>li>a {
        color: #000;
    }

    /*.breakpoint-md #header.dark .header-inner .lines {background-color: #484848 !important;}*/
    /*.breakpoint-md #header.dark .header-inner .lines:before {background-color: #484848 !important;}*/
    /*.breakpoint-md #header.dark .header-inner .lines:after {background-color: #484848 !important;}*/
    /*.breakpoint-sm #header.dark .header-inner .lines {background-color: #484848 !important;}*/
    /*.breakpoint-sm #header.dark .header-inner .lines:before {background-color: #484848 !important;}*/
    /*.breakpoint-sm #header.dark .header-inner .lines:after {background-color: #484848 !important;}*/
    /*.breakpoint-xs #header.dark .header-inner .lines {background-color: #484848 !important;}*/
    /*.breakpoint-xs #header.dark .header-inner .lines:before {background-color: #484848 !important;}*/
    /*.breakpoint-xs #header.dark .header-inner .lines:after {background-color: #484848 !important;}*/
</style>

<section class="m-0 p-0">
    <div class="bg-overlay"></div>
    <img class="home-img" src="<?= $this->Url->build('/front-assets-new/LandingPageUtama.jpeg'); ?>" width="100%">
</section>
<!--end: Inspiro Slider -->



<section>
    <div class="container">
        <div class="heading-text heading-section text-center">
            <h2>LAYANAN KAMI</h2>
            <p>Lorem ipsum dolor sit amet, consecte adipiscing elit. Suspendisse condimentum porttitor cursumus.
            </p>
        </div>
        <div class="row">
            <div class="col-lg-4" data-animate="fadeInUp" data-animate-delay="0">
                <div class="icon-box effect medium border small">
                    <div class="icon">
                        <a href="#"><i class="fa fa-plug"></i></a>
                    </div>
                    <h3>Powerful template</h3>
                    <p>Lorem ipsum dolor sit amet, consecte adipiscing elit. Suspendisse condimentum porttitor cursumus.
                    </p>
                </div>
            </div>
            <div class="col-lg-4" data-animate="fadeInUp" data-animate-delay="200">
                <div class="icon-box effect medium border small">
                    <div class="icon">
                        <a href="#"><i class="fa fa-desktop"></i></a>
                    </div>
                    <h3>Flexible Layouts</h3>
                    <p>Lorem ipsum dolor sit amet, consecte adipiscing elit. Suspendisse condimentum porttitor cursumus.
                    </p>
                </div>
            </div>
            <div class="col-lg-4" data-animate="fadeInUp" data-animate-delay="400">
                <div class="icon-box effect medium border small">
                    <div class="icon">
                        <a href="#"><i class="fa fa-cloud"></i></a>
                    </div>
                    <h3>Retina Ready</h3>
                    <p>Lorem ipsum dolor sit amet, consecte adipiscing elit. Suspendisse condimentum porttitor cursumus.
                    </p>
                </div>
            </div>
            <div class="col-lg-4" data-animate="fadeInUp" data-animate-delay="600">
                <div class="icon-box effect medium border small">
                    <div class="icon">
                        <a href="#"><i class="far fa-lightbulb"></i></a>
                    </div>
                    <h3>Fast processing</h3>
                    <p>Lorem ipsum dolor sit amet, consecte adipiscing elit. Suspendisse condimentum porttitor cursumus.
                    </p>
                </div>
            </div>
            <div class="col-lg-4" data-animate="fadeInUp" data-animate-delay="800">
                <div class="icon-box effect medium border small">
                    <div class="icon">
                        <a href="#"><i class="fa fa-trophy"></i></a>
                    </div>
                    <h3>Unlimited Colors</h3>
                    <p>Lorem ipsum dolor sit amet, consecte adipiscing elit. Suspendisse condimentum porttitor cursumus.
                    </p>
                </div>
            </div>
            <div class="col-lg-4" data-animate="fadeInUp" data-animate-delay="1000">
                <div class="icon-box effect medium border small">
                    <div class="icon">
                        <a href="#"><i class="fa fa-thumbs-up"></i></a>
                    </div>
                    <h3>Premium Sliders</h3>
                    <p>Lorem ipsum dolor sit amet, consecte adipiscing elit. Suspendisse condimentum porttitor cursumus.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>


<?php /* <section class="fullscreen" data-bg-parallax="https://c4.wallpaperflare.com/wallpaper/656/157/253/esport-electronic-sports-world-cup-dota-2-wallpaper-preview.jpg"> */ ?>
<section class="fullscreen" data-bg-parallax="<?= $this->Url->build('/front-assets-new/LandingPageLiveBagan.png'); ?>">
    <!--<div class="bg-overlay" data-style="13"></div>-->
    <div class="shape-divider" data-style="10"></div>
    <div class="container-wide">
        <div class="container-fullscreen">
            <div class="text-middle text-center">
                <div class="heading-text text-light center">
                    <h2 class="font-weight-800"><span>YOUTUBE</span></h2>
                    <div class="card">
                        <div class="card-body text-center">
                            <a href="<?= $this->Url->build(['controller' => 'Videos', 'action' => 'index']); ?>">
                                <img src="<?= $this->Url->build('/front-assets-new/youtubehd.jpg'); ?>" class="img-fluid" alt="" width="980">
                            </a>
                        </div>
                    </div>
                    <a href="<?= $this->Url->build(['controller' => 'Videos', 'action' => 'index']); ?>" class="btn btn-light btn-rounded">Lihat Selengkapnya</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 m-b-40">
                <!-- Page title -->
                <div class="page-title m-b-40">
                    <h2>Berita Terkini</h2>
                </div>
                <!-- end: Page title -->
                <!-- Blog -->
                <div class="carousel" data-items="3">
                    <?php foreach ($highlight as $news) : ?>
                        <!-- Post item-->
                        <div class="post-item border">
                            <div class="post-item-wrap">
                                <div class="post-image">
                                    <a href="<?= $this->Url->build(['controller' => 'News', 'action' => 'view', $news->get('slug')]); ?>">
                                        <?php
                                        $blog_image = $news->get('image') ?
                                            $this->Url->build('/files/Blogs/image/' . $news->get('image'))
                                            : $this->Url->build('/front-assets-new/images/blog/12.jpg');
                                        if ($blog_image) :
                                        ?>
                                            <img src="<?= $blog_image; ?>" alt="">
                                        <?php endif; ?>
                                    </a>
                                    <span class="post-meta-category"><a href="#"><?= $news->tags[0]->name; ?></a></span>
                                </div>
                                <div class="post-item-description">
                                    <span class="post-meta-date"><i class="fa fa-calendar-o"></i><?= $news->created->format('M j, Y'); ?></span>
                                    <h2><a href="<?= $this->Url->build(['controller' => 'News', 'action' => 'view', $news->get('slug')]); ?>"><?= $news->get('title'); ?></a></h2>
                                    <!--                                    <p>Curabitur pulvinar euismod ante, ac sagittis ante posuere ac. Vivamus luctus-->
                                    <!--                                        commodo dolor porta feugiat. Fusce at velit id ligula pharetra laoreet.</p>-->
                                    <a href="<?= $this->Url->build(['controller' => 'News', 'action' => 'view', $news->get('slug')]); ?>" class="item-link">Baca Selengkapnya <i class="icon-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- end: Post item-->
                    <?php endforeach; ?>
                </div>
                <!-- end: Blog -->
            </div>
            <div id="showMore m-b-40 text-center">
                <a href="<?= $this->Url->build(['controller' => 'News', 'action' => 'index']); ?>" class="btn btn-rounded btn-light text-center"><i class="icon-refresh-cw"></i> Lihat Berita Lainnya</a>
            </div>
        </div>
    </div>
</section>
