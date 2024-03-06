<!--  section  -->


<section id="page-title" data-bg-parallax="<?= $this->Url->build('/front-assets-new/bg.jpg'); ?>">
    <div class="container">
        <div class="page-title text-dark">
            <h1>Galeri</h1>
            <span>KPKB</span>
        </div>
        <div class="breadcrumb">
            <ul>
                <li><a href="<?= $this->Url->build(['controller' => 'Galleries', 'action' => 'index']); ?>"
                        style="color: black;">Beranda</a></li>
                <li class="active"><a href="<?= $this->Url->build(['controller' => 'Faq', 'action' => 'index']); ?>"
                        style="color: black;">Galeri</a></li>
            </ul>
        </div>
    </div>
</section>
<!-- end: Page title -->
<!-- Content -->
<section id="page-content">
    <div class="container text-center">
        <div class="heading-text heading-line text-center">
            <h4>Album</h4>
        </div>
        <div class="btn-group">
            <a href="<?= $this->Url->build(['controller' => 'Galleries', 'action' => 'index']); ?>"
                class="btn btn-primary">Show All</a>
            <?php foreach ($albums as $albumItem) : ?>
            <a href="<?= $this->Url->build(['controller' => 'Galleries', 'action' => 'index', $albumItem->id]); ?>"
                class="btn btn-secondary">
                <?= $albumItem->name ?>
            </a>
            <?php endforeach ?>
        </div>
        <!-- Gallery -->
        <div class="grid-layout grid-3-columns" data-margin="20" data-item="grid-item" data-lightbox="gallery">
            <?php foreach ($galleries as $gallery) :
        if ($albumId === null || $gallery->album->id == $albumId) : ?>
            <?php
            $imagePath = $this->Url->build('/' . $gallery->image->dir . $gallery->image->name);
            ?>
            <div class="grid-item <?= strtolower(str_replace(' ', '-', $gallery->album->name)) ?>">
                <a class="image-hover-zoom" href="<?= $imagePath ?>" data-lightbox="gallery-image">
                    <img src="<?= $imagePath ?>">
                </a>
            </div>
            <?php endif;
    endforeach; ?>
        </div>
        <!-- end: Gallery -->
    </div>

    <ul class="pagination justify-content-center">
        <?= $this->Paginator->prev('Previous') ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next('Next') ?>
    </ul>
</section> <!-- end: Content -->

<script>
function filterGallery(albumId) {
    // Mengarahkan ke URL yang sesuai dengan album yang dipilih
    window.location.href = '<?= $this->Url->build(['controller' => 'Galleries', 'action' => 'index']) ?>' + '/index' +
        '/' +
        albumId;

}
</script>
<style>
/* Pagination links */
.pagination a {
    color: black;
    /* Warna teks */
    float: left;
    /* Mengapung ke kiri */
    padding: 8px 16px;
    /* Jarak antara teks dan border */
    text-decoration: none;
    /* Menghilangkan garis bawah */
    transition: background-color .3s;
    /* Membuat efek transisi warna latar belakang */
}

/* Style the active/current link */
.pagination a.active {
    background-color: dodgerblue;
    /* Warna latar belakang */
    color: white;
    /* Warna teks */
}

/* Add a grey background color on mouse-over */
.pagination a:hover:not(.active) {
    background-color: #ddd;
    /* Warna latar belakang */
}
</style>