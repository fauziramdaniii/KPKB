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
            <h2>Galeri Foto</h2>
            <p> <b> Foto Kegiatan Koperasi Pegawai Pemerintah Kota Bandung </p>
        </div>
        <div class="row">
            <div class="col-lg-4" data-animate="fadeInUp" data-animate-delay="0">
                <img src="https://4.bp.blogspot.com/-JSteHDHGpV4/UUCsnJmlnWI/AAAAAAAAEps/8A7zoM3T5jU/s1600/Wallpaper+Gambar+Burung+Betet.jpeg" alt="image" srcset="" style="width: 100%;">
            </div>
            
            <div class="col-lg-4" data-animate="fadeInUp" data-animate-delay="0">
                <img src="https://4.bp.blogspot.com/-JSteHDHGpV4/UUCsnJmlnWI/AAAAAAAAEps/8A7zoM3T5jU/s1600/Wallpaper+Gambar+Burung+Betet.jpeg" alt="image" srcset="" style="width: 100%;">
            </div>
            
            <div class="col-lg-4" data-animate="fadeInUp" data-animate-delay="0">
                <img src="https://4.bp.blogspot.com/-JSteHDHGpV4/UUCsnJmlnWI/AAAAAAAAEps/8A7zoM3T5jU/s1600/Wallpaper+Gambar+Burung+Betet.jpeg" alt="image" srcset="" style="width: 100%;">
            </div>
            
            <div class="col-lg-4 mt-5" data-animate="fadeInUp" data-animate-delay="0">
                <img src="https://4.bp.blogspot.com/-JSteHDHGpV4/UUCsnJmlnWI/AAAAAAAAEps/8A7zoM3T5jU/s1600/Wallpaper+Gambar+Burung+Betet.jpeg" alt="image" srcset="" style="width: 100%;">
            </div>
            
            <div class="col-lg-4 mt-5" data-animate="fadeInUp" data-animate-delay="0">
                <img src="https://4.bp.blogspot.com/-JSteHDHGpV4/UUCsnJmlnWI/AAAAAAAAEps/8A7zoM3T5jU/s1600/Wallpaper+Gambar+Burung+Betet.jpeg" alt="image" srcset="" style="width: 100%;">
            </div>

            <div class="col-lg-4 mt-5" data-animate="fadeInUp" data-animate-delay="0">
                <img src="https://4.bp.blogspot.com/-JSteHDHGpV4/UUCsnJmlnWI/AAAAAAAAEps/8A7zoM3T5jU/s1600/Wallpaper+Gambar+Burung+Betet.jpeg" alt="image" srcset="" style="width: 100%;">
            </div>
        </div>
    </div>
</section>


<?php /* <section class="fullscreen" data-bg-parallax="https://c4.wallpaperflare.com/wallpaper/656/157/253/esport-electronic-sports-world-cup-dota-2-wallpaper-preview.jpg"> */ ?>
<section class="fullscreen" data-bg-parallax="<?= $this->Url->build('/front-assets-new/bg.jpg'); ?>">
    <!--<div class="bg-overlay" data-style="13"></div>-->
    <div class="shape-divider" data-style="10"></div>
    <div class="container-wide">
        <div class="container-fullscreen">
            <div class="text-middle text-center">
                <div class="heading-text text-dark center">
                    <h2 class="font-weight-750">
                        <span>Video Terbaru</span>
                    </h2>
                    <div class="card">
                        <div class="card-body text-center">
                            <a href="<?= $this->Url->build(['controller' => 'Videos', 'action' => 'index']); ?>">
                                <?php if($video) : ?>
                                    <?php echo $video[0]->embed; ?>
                                <?php else : ?>
                                    <img src="<?= $this->Url->build('/front-assets-new/youtubehd.jpg'); ?>" class="img-fluid" alt="" width="500">
                                <?php endif; ?>
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
                <div class="heading-text heading-section text-center">
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

<section>
    <div class="container">
        <div class="heading-text heading-section text-center">
            <h2>Kontak</h2>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <h3 class="text-uppercase">Kontak Kami</h3>
                <p>Jika ada keluhan atau pertanyaan yang ingin disampaikan, silahkan kirim pesan dengan mengisi formulir dibawah ini.</p>
                <div class="m-t-30">
                    <?php echo $this->Form->create('Contacts', ['url' => ['action' => 'index'], 'id' => 'form1', 'class' => 'form-validate', 'type' => 'file']); ?>
                    <?= $this->Flash->render(); ?>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" class="form-control" name="name" placeholder="Masukan Nama Lengkap" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Masukan Email" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="subject">Subjek Pesan</label>
                            <input type="text" class="form-control" name="subject" placeholder="Masukan Subjek Pesan" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea type="text" name="message" required rows="5" class="form-control required" placeholder="Masukan Pesan"></textarea>
                    </div>
                    <button
                        class="btn g-recaptcha"
                        data-sitekey="<?= \Cake\Core\Configure::read('GoogleCaptcha.siteKey'); ?>"
                        data-badge="inline"
                        id="contact-submit"
                        data-callback="onSubmit">
                        <i class="fa fa-paper-plane"></i>
                        <?php echo __('Kirim Pesan'); ?>
                    </button>
<!--                    <button class="btn" type="submit"><i class="fa fa-paper-plane"></i>&nbsp;Kirim Pesan</button>-->
                    <!--                        <button type="submit" class="btn m-t-30 mt-3">Submit</button>-->
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
            <div class="col-lg-6">
                <h3 class="text-justify"> Alamat</h3>
                <div class="row">
                    <div class="col-lg-12">
                        <address>
                            <p>Kantor Koperasi Pegawai Pemerintahan Kota Bandung.
                            Jl. Wastukencana Blk No.5, Babakan Ciamis, Kec. Sumur Bandung
                            Kota Bandung, Jawa Barat 40117</p>
                            <p>Telp: (022) 4200195</p>
                        </address>
                    </div>
                </div>

                <!--                <div class="map" data-latitude="-37.817240" data-longitude="144.955826" data-style="light" data-info="Hello from &lt;br&gt; Inspiro Themes"></div>-->
                <div id="mapContainer" style="position: relative; cursor: pointer;">
                <h3 class="text-uppercase"> Rute </h3>
                    <a id="directionsLink" href="#" target="_blank" rel="noopener noreferrer">
                        <iframe
                            width="100%"
                            height="300"
                            frameborder="0"
                            style="border:0"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31685.451348178514!2d107.56597498609483!3d-6.928630602061996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e6386e87e99d%3A0xe49b67f8adf38abc!2sKPKB%20-%20Kota%20Bandung!5e0!3m2!1sen!2sid!4v1709041040043!5m2!1sen!2sid"
                            allowfullscreen
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                        ></iframe>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div id="whatsapp-popup" onclick="openWhatsApp()">
    <i class="fab fa-whatsapp" placeholder="Chat With Us"></i>
    </div>
</section>


<?php
$this->Html->script(['https://www.google.com/recaptcha/api.js'],['block' => true]);
$this->Html->script(['https://kit.fontawesome.com/d8bd919f93.js" crossorigin="anonymous"']);
?>
<?php $this->append('css'); ?>
<style>
    .grecaptcha-badge{
        margin-bottom : 20px;
    }
        /* Styling untuk popup chat */
        #whatsapp-popup {
            position: fixed;
            bottom: 50px;
            right: 20px;
            padding: 15px;
            background-color: #25D366; /* Warna hijau WhatsApp */
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
            display: flex;
            align-items: center;
            font-size: 24px;
        }

</style>
<?php $this->end(); ?>
<?php $this->append('script'); ?>
<script>
    var onSubmit = function(response) {
        document.getElementById("form1").submit();
    };

    // Add an event listener to the map container
    document.getElementById('mapContainer').addEventListener('click', function() {
        // Get the latitude and longitude of your location
        var latitude = -6.928630602061996;
        var longitude = 107.56597498609483;

        // Open the Google Maps Directions link in a new tab
        var directionsLink = 'https://www.google.com/maps/dir/?api=1&destination=' + latitude + ',' + longitude;
        document.getElementById('directionsLink').href = directionsLink;
    });
    function openWhatsApp() {
        // Ganti "6281234567890" dengan nomor WhatsApp Anda
        var phoneNumber = "62895337732828";
        
        // Buka link WhatsApp dengan nomor yang ditentukan
        window.open("https://wa.me/" + phoneNumber, "_blank");
    }
</script>
<?php $this->end(); ?>

