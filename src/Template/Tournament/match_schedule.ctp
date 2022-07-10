<section id="page-title" class="text-light" style="background-image:url('<?= $this->Url->build('/front-assets-new/TentangKami_2.png'); ?>'); background-size: cover; background-position: center center;">
    <div class="container">
        <div class="bg-overlay"></div>
        <div class="page-title">
            <h1>Jadwal Pertandingan</h1>
            <span>Piala Gubernur Jawa Barat</span>
        </div>
        <div class="breadcrumb">
            <ul>
                <li><a href="<?= $this->Url->build(['controller' => 'Home', 'action' => 'index' ]); ?>">Beranda</a>
                </li>
                <li class="active"><a href="<?= $this->Url->build(['controller' => 'Tournament', 'action' => 'matchSchedule' ]); ?>">Jadwal Pertandingan</a>
                </li>
            </ul>
        </div>
    </div>
</section>
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
