<section id="page-title" class="text-light" style="background-image:url('<?= $this->Url->build('/front-assets-new/TentangKami_2.png'); ?>'); background-size: cover; background-position: center center;">
    <div class="container">
        <div class="bg-overlay"></div>
        <div class="page-title">
            <h1>Kontak Kami</h1>
            <span>Koperasi Pegawai Pemerintahan Kota Bandung</span>
        </div>
        <div class="breadcrumb">
            <ul>
                <li><a href="<?= $this->Url->build(['controller' => 'Home', 'action' => 'index' ]); ?>">Beranda</a>
                </li>
                <li class="active"><a href="<?= $this->Url->build(['controller' => 'Contacts', 'action' => 'index' ]); ?>">Kontak Kami</a>
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
                    <?php echo $this->Form->create('Contacts',['url' => ['action' => 'index'], 'id' => 'form1', 'class' => 'form-validate', 'type' => 'file']);?>
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

                        <button class="btn" type="submit"><i class="fa fa-paper-plane"></i>&nbsp;Kirim Pesan</button>
<!--                        <button type="submit" class="btn m-t-30 mt-3">Submit</button>-->
                    <?php echo $this->Form->end();?>
                </div>
            </div>
            <div class="col-lg-6">
                <h3 class="text-uppercase">Peta dan Alamat</h3>
                <div class="row">
                    <div class="col-lg-12">
                        <address>
                            <strong>Kantor Koperasi Pegawai Pemerintahan Kota Bandung.</strong><br>
                            Jl. xxxxx no.123<br>
                            Bandung, 40123<br>
                            <h4>Telp:</h4> (022) 123-4567
                        </address>
                    </div>
                </div>

<!--                <div class="map" data-latitude="-37.817240" data-longitude="144.955826" data-style="light" data-info="Hello from &lt;br&gt; Inspiro Themes"></div>-->

            </div>
        </div>
    </div>
</section>
<?php /*
    <section id="page-content">
    <div class="container">
        <!--Images -->
        <div class="row">
            <div class="col-lg-6">
                <h2>PES</h2>
                <p>Jadwal Pertandingan kategori game PES.</p>
                <a href="<?= $this->Url->build(['controller' => 'Tournament', 'action' => 'schedulePes' ]); ?>"><img src="<?= $this->Url->build('/front-assets-new/pes-2021.jpg'); ?>" class="img-fluid rounded" alt=""> </a>
            </div>
            <div class="col-lg-6">
                <h2>Valorant</h2>
                <p>Jadwal Pertandingan kategori game Valorant.</p>
                <a href="<?= $this->Url->build(['controller' => 'Tournament', 'action' => 'scheduleValorant' ]); ?>"><img src="<?= $this->Url->build('/front-assets-new/valorant.jpg'); ?>" class="img-fluid rounded" alt=""> </a>
            </div>
            <hr class="space">
            <div class="col-lg-4">
                <h2>Mobile Legends</h2>
                <p>Jadwal Pertandingan kategori game Mobile Legend.</p>
                <a href="<?= $this->Url->build(['controller' => 'Tournament', 'action' => 'scheduleMole' ]); ?>"><img src="<?= $this->Url->build('/front-assets-new/mobile-legend.jpg'); ?>" class="img-fluid rounded" alt=""> </a>
            </div>
            <div class="col-lg-4">
                <h2>Free Fire</h2>
                <p>Jadwal Pertandingan kategori game Free Fire.</p>
                <a href="<?= $this->Url->build(['controller' => 'Tournament', 'action' => 'scheduleFreefire' ]); ?>"><img src="<?= $this->Url->build('/front-assets-new/free-fire.jpg'); ?>" class="img-fluid rounded" alt=""> </a>
            </div>
            <div class="col-lg-4">
                <h2>PUBG Mobile</h2>
                <p>Jadwal Pertandingan kategori game PUBG Mobile.</p>
                <a href="<?= $this->Url->build(['controller' => 'Tournament', 'action' => 'schedulePubg' ]); ?>"><img src="<?= $this->Url->build('/front-assets-new/pubg-mobile.jpg'); ?>" class="img-fluid rounded" alt=""> </a>
            </div>
        </div>
    </div>
</section>
 */ ?>
