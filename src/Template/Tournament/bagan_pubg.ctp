<section id="page-title" class="text-light" style="background-image:url('<?= $this->Url->build('/front-assets-new/TentangKami_2.png'); ?>'); background-size: cover; background-position: center center;">
    <div class="container">
        <div class="bg-overlay"></div>
        <div class="page-title">
            <h1>Live Bagan</h1>
            <span>Piala Gubernur Jawa Barat</span>
        </div>
        <div class="breadcrumb">
            <ul>
                <li><a href="<?= $this->Url->build(['controller' => 'Home', 'action' => 'index' ]); ?>">Beranda</a>
                </li>
                <li class="active"><a href="<?= $this->Url->build(['controller' => 'Tournament', 'action' => 'liveBagan' ]); ?>">Live Bagan</a>
                </li>
            </ul>
        </div>
    </div>
</section>
<?php if($baganpubg) : ?>
    <?php foreach ($baganpubg as $k => $v) : ?>
        <section>
            <div class="container">
                <div class="heading-text heading-section text-center">
                    <h2><?= $v['name']; ?></h2>
                </div>
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div>
                            <div class="text-center">
                                <?= $v['embed']; ?>
                            </div>
                        </div>
                        <a href="<?= $v['link']; ?>" class="btn btn-info btn-rounded">Lihat Detail</a>
                    </div>
                </div>
            </div>
        </section>
    <?php endforeach; ?>
<?php else : ?>
    <section>
        <div class="container">
            <h2 class="text-center">BAGAN BELUM TERSEDIA.</h2>
        </div>
    </section>
<?php endif; ?>
