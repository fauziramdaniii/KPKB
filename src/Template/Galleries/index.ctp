<!--  section  -->
<section id="page-title" data-bg-parallax="<?= $this->Url->build('/front-assets-new/bg.jpg'); ?>">
    <div class="container">
        <div class="page-title">
            <h1 style="color: black;">Galeri</h1>
            <span style="color: black;">Galeri</span>
        </div>
        <div class="breadcrumb">
            <ul>
                <li><a href="<?= $this->Url->build(['controller' => 'Galleries', 'action' => 'index']); ?>" style="color: black;">Beranda</a></li>
                <li class="active"><a href="<?= $this->Url->build(['controller' => 'Faq', 'action' => 'index']); ?>" style="color: black;">Galeri</a></li>
            </ul>
        </div>
    </div>
</section>

<!--  section end -->
<!-- section -->
<section class="gray-bg hidden-section particles-wrapper">
    <div class="container">
        <div class="section-title">
            <h2>Galleries</h2>
            <div class="section-subtitle">Catalog of Galleries</div>
            <span class="section-separator"></span>
            <p>In ut odio libero, at vulputate urna. Nulla tristique mi a massa convallis cursus.</p>
        </div>
        <div class="listing-item-grid_container fl-wrap">
		<div class="row">
            <?php foreach ($galleries as $gallery) : ?>
                <div class="col-sm-3"><!-- Adjust the grid column size based on your layout -->
                    <div class="listing-item-grid">
                        <?php
                        $imagePath = $this->Url->build('/' . $gallery->image->dir . $gallery->image->name);
                        ?>
                        <img src="<?= $imagePath ?>" alt="<?= h($gallery->title) ?>" class="gallery-image">
                        <div class="d-gr-sec"></div>
                        <div class="listing-item-grid_title">
                            <h3><a href="<?= $this->Url->build('/' . $gallery->image->dir . $gallery->image->name); ?>"><?= $gallery->title; ?></a></h3>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        </div>
    </div>
</section>
<!-- section end -->
