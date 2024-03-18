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
</div>

<!-- Galeri Foto -->
<section id="welcome">
    <div class="container text-center">
        <div class="heading-text heading-section text-center">
            <h2>Galeri Foto</h2>
            <p> <b> Foto Kegiatan Koperasi Pegawai Pemerintah Kota Bandung </p>
        </div>
        <div class="grid-layout grid-3-columns" data-margin="20" data-item="grid-item" data-lightbox="gallery">
            <?php foreach ($galleries as $gallery) : ?>
            <?php
                        $imagePath = $this->Url->build('/' . $gallery->image->dir . $gallery->image->name);
                        ?>
            <div class="grid-item">
                <a class="image-hover-zoom" href="<?= $imagePath ?>" data-lightbox="gallery-image"><img
                        src="<?= $imagePath ?>"></a>
            </div>
            <?php endforeach ?>
        </div>
        <!-- <div class="text-center">
            <?= $this->Paginator->prev('<< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >>') ?>
        </div> -->
        <hr class="space">

        <a href="<?= $this->Url->build(['controller' => 'Galleries', 'action' => 'index']); ?>"
            class="btn btn-light btn-rounded active" target="_blank">Lihat Foto Lainnya</a>
    </div>
</section>
<!-- End Galeri Foto -->

<!-- Video -->
<div class="heading-text heading-section text-center">
    <h2>Video Terbaru</h2>
</div>
<section id="page-content">
    <div class="container">
        <div data-bg-video="https://inspirothemes.com/polo/video/pexels-waves.mp4">
            <!-- Gallery -->
            <div class="grid-layout grid-3-columns" data-margin="20" data-item="grid-item" data-lightbox="gallery">
                <?php foreach($video as $vid) : ?>
                <div class="grid-item">
                    <a class="image-hover-zoom"
                        href="<?= $this->Url->build(['controller' => 'Videos', 'action' => 'index']); ?>"
                        data-lightbox="gallery-image">
                        <?php echo $vid->embed; ?>

                    </a>
                </div>
                <?php endforeach ?>
            </div>

            <hr class="space">
            <div class="text-center">
                <a href="<?= $this->Url->build(['controller' => 'Videos', 'action' => 'index']); ?>"
                    class="btn btn-light btn-rounded justify-content-center" target="_blank">Lihat Selengkapnya</a>
            </div>

        </div>
        <!-- end: Gallery -->
    </div>
</section> <!-- end: Content -->
<!-- End Video -->

<!-- Berita -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 m-b-40">
                <div class="heading-text heading-section text-center">
                    <h2>Berita Terkini</h2>
                </div>
                <div class="carousel" data-items="3">
                    <?php foreach ($highlight as $news) : ?>
                    <!-- Post item-->
                    <div class="post-item border">
                        <div class="post-item-wrap">
                            <div class="post-image">
                                <a
                                    href="<?= $this->Url->build(['controller' => 'News', 'action' => 'view', $news->get('slug')]); ?>">
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
                                <span class="post-meta-date"><i
                                        class="fa fa-calendar-o"></i><?= $news->created->format('M j, Y'); ?></span>
                                <h2><a
                                        href="<?= $this->Url->build(['controller' => 'News', 'action' => 'view', $news->get('slug')]); ?>"><?= $news->get('title'); ?></a>
                                </h2>
                                <a href="<?= $this->Url->build(['controller' => 'News', 'action' => 'view', $news->get('slug')]); ?>"
                                    class="item-link active">Baca Selengkapnya <i class="icon-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- end: Post item-->
                    <?php endforeach; ?>
                </div>
            </div>
            <div id="showMore m-b-40 text-center" style="margin: 0 auto;">
                <a href="<?= $this->Url->build(['controller' => 'News', 'action' => 'index']); ?>"
                    class="btn btn-rounded btn-light text-center active" target="_blank"><i class="icon-refresh-cw"></i>
                    Lihat
                    Berita
                    Lainnya</a>
            </div>
        </div>
    </div>
</section>
<!-- End Berita -->

<!-- Kontak -->
<section>
    <div class="container">
        <div class="heading-text heading-section text-center">
            <h2>Kontak</h2>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <h3 class="text-uppercase">Kontak Kami</h3>
                <p>Jika ada keluhan atau pertanyaan yang ingin disampaikan, silahkan kirim pesan dengan mengisi
                    formulir
                    dibawah ini atau bisa chat melalui popup whatsapp yang telah kami sediakan.</p>
                <div class="m-t-30">
                    <?php echo $this->Form->create('Contacts', ['url' => ['action' => 'index'], 'id' => 'form1', 'class' => 'form-validate', 'type' => 'file']); ?>
                    <?= $this->Flash->render(); ?>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" class="form-control" name="name" placeholder="Masukan Nama Lengkap"
                                required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Masukan Email" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="subject">Subjek Pesan</label>
                            <input type="text" class="form-control" name="subject" placeholder="Masukan Subjek Pesan"
                                required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea type="text" name="message" required rows="5" class="form-control required"
                            placeholder="Masukan Pesan"></textarea>
                    </div>
                    <button class="btn g-recaptcha"
                        data-sitekey="<?= \Cake\Core\Configure::read('GoogleCaptcha.siteKey'); ?>" data-badge="inline"
                        id="contact-submit" data-callback="onSubmit">
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
                        <iframe width="100%" height="300" frameborder="0" style="border:0"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31685.451348178514!2d107.56597498609483!3d-6.928630602061996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e6386e87e99d%3A0xe49b67f8adf38abc!2sKPKB%20-%20Kota%20Bandung!5e0!3m2!1sen!2sid!4v1709041040043!5m2!1sen!2sid"
                            allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div id="whatsapp-popup" onclick="openWhatsApp()">
        <i class="fab fa-whatsapp" placeholder="Chat With Us"></i>
    </div>
</section>
<!-- End Kontak -->

<?php
$this->Html->script(['https://www.google.com/recaptcha/api.js'],['block' => true]);
$this->Html->script(['https://kit.fontawesome.com/d8bd919f93.js" crossorigin="anonymous"']);
$this->Html->script('https://code.jquery.com/jquery-3.6.4.min.js', ['block' => true]);
?>

<?php $this->append('css'); ?>
<style>
.grecaptcha-badge {
    margin-bottom: 20px;
}

/* Styling untuk popup chat */
#whatsapp-popup {
    position: fixed;
    bottom: 50px;
    right: 20px;
    padding: 15px;
    background-color: #25D366;
    /* Warna hijau WhatsApp */
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
    <?php 
        $noWhatsApp = $whatsapp[0]->no_whatsapp;
    ?>
    // Buka link WhatsApp dengan nomor yang ditentukan
    window.open("https://wa.me/+62" + <?php echo $noWhatsApp ?>, "_blank");
}

$(document).ready(function() {
    // Function to handle the Ajax request and update content
    function loadNextPage(url) {
        $.ajax({
            url: url,
            type: 'get',
            dataType: 'html',
            success: function(data) {
                // Replace the content of the gallery container with the loaded data
                $('#gallery-container').html(data);

                // Scroll to the top of the container to improve user experience
                $('#gallery-container').scrollTop(0);

                // Update the browser history with the new URL
                history.pushState(null, null, url);
            }
        });
    }

    // Pagination links click event
    $(document).on('click', '.pagination a', function(event) {
        event.preventDefault();

        // Get the pagination link URL
        var url = $(this).attr('href');

        // Load the next page content
        loadNextPage(url);
    });

    // Use the History API to handle back and forward buttons
    $(window).on('popstate', function(event) {
        // Get the current URL when using back or forward buttons
        var url = location.pathname + location.search;

        // Load the content for the current URL
        loadNextPage(url);
    });
});
</script>
<?php $this->end(); ?>