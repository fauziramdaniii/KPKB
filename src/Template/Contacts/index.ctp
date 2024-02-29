<section id="page-title" data-bg-parallax="<?= $this->Url->build('/front-assets-new/bg.jpg'); ?>">
    <div class="container">
        <div class="page-title">
            <h1>Kontak Kami</h1>
            <span>Koperasi Pegawai Pemerintahan Kota Bandung</span>
        </div>
        <div class="breadcrumb">
            <ul>
                <li><a href="<?= $this->Url->build(['controller' => 'Home', 'action' => 'index']); ?>">Beranda</a>
                </li>
                <li class="active"><a href="<?= $this->Url->build(['controller' => 'Contacts', 'action' => 'index']); ?>">Kontak Kami</a>
                </li>
            </ul>
        </div>
    </div>
</section>

<section>
    <div class="container">
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
                <h3 class="text-uppercase"> Alamat</h3>
                <div class="row">
                    <div class="col-lg-6">
                        <address>
                            <strong>Kantor Koperasi Pegawai Pemerintahan Kota Bandung.</strong><br>
                            Jl. Wastukencana Blk No.5, Babakan Ciamis, Kec. Sumur Bandung<br>
                            Kota Bandung, Jawa Barat 40117<br>
                            <h4>Telp:</h4> (022) 4200195
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
</section>

<?php
$this->Html->script(['https://www.google.com/recaptcha/api.js'],['block' => true]);
?>
<?php $this->append('css'); ?>
<style>
    .grecaptcha-badge{
        margin-bottom : 20px;
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
</script>
<?php $this->end(); ?>

