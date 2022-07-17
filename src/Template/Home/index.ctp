<div id="slider" class="inspiro-slider slider-fullscreen dots-creative" data-fade="true">

    <?php if($slides) : ?>
        <?php foreach($slides as $k => $slide) : ?>
            <div class="slide kenburns" data-bg-image="<?= $this->Url->build('/files/Slides/image/'.$slide->image); ?>">
                <div class="bg-overlay"></div>
                <div class="container">
                    <div class="slide-captions text-center text-light">

                        <h1><?= $slide->title; ?></h1>
                        <p><?= $slide->subtitle; ?></p>
                        </span>

                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php /*
    <div class="slide kenburns" data-bg-image="<?= $this->Url->build('/front-assets-new/images/slider/notgeneric_bg3.jpg'); ?>">
        <div class="bg-overlay"></div>
        <div class="container">
            <div class="slide-captions text-center text-light">

                <h1>WELCOME TO THE WORLD OF POLO</h1>
                <p>Say hello to the smartest and most flexible bootstrap template. Polo is an powerful template that can build any type of websites, and quite possibly the only one you will ever need.</p>
                <div><a href="#welcome" class="btn scroll-to">Explore more</a></div>
                </span>

            </div>
        </div>
    </div>


    <div class="slide" data-bg-video="video/pexels-waves.mp4">
        <div class="bg-overlay"></div>
        <div class="container">
            <div class="slide-captions text-left text-light">

                <h1>220+ Laytout Demos</h1>
                <p class="text-small">POLO is packed with 220+ pre-made layouts that allow you to quickly jumpstart your project. Completely customizable for creating your own designs.</p>
                <div><a href="#welcome" class="btn scroll-to">Explore more</a></div>

            </div>
        </div>
    </div>
    */ ?>

</div>

<?php /*
<section class="m-0 p-0">
    <img class="home-img" src="" width="100%">
    <div id="slider" class="inspiro-slider slider-fullscreen dots-creative" data-fade="true">

        <div class="slide kenburns" data-bg-image="<?= $this->Url->build('/front-assets-new/sikami.jpg'); ?>">
            <div class="bg-overlay"></div>
            <div class="container">
                <div class="slide-captions text-center text-light">

                    <h1>SELAMAT DATANG DI WEBSITE KPKB</h1>
                    <div><a href="#welcome" class="btn scroll-to">EXPLORE HERE</a></div>
                    </span>

                </div>
            </div>
        </div>
    </div>
</section>
*/ ?>

<!--end: Inspiro Slider -->
<section id="welcome">
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
<section class="fullscreen" data-bg-parallax="<?= $this->Url->build('/front-assets-new/BaganYoutube.png'); ?>">
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
                                <img src="<?= $this->Url->build('/front-assets-new/youtubehd.jpg'); ?>" class="img-fluid" alt="" width="500">
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
            <div id="showMore m-b-40 text-center" style="margin: 0 auto;">
                <a href="<?= $this->Url->build(['controller' => 'News', 'action' => 'index']); ?>" class="btn btn-rounded btn-light text-center"><i class="icon-refresh-cw"></i> Lihat Berita Lainnya</a>
            </div>
        </div>
    </div>
</section>
