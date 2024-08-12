<!--  section  -->


<!-- <section id="page-title" data-bg-parallax="<?= $this->Url->build('/front-assets-new/bg.jpg'); ?>">
    <div class="container">
        <div class="page-title text-dark">
            <h1>Galeri</h1>
            <span>KPKB</span>
        </div>
        <div class="breadcrumb">
            <ul>
                <li><a href="<?= $this->Url->build(['controller' => 'Galleries', 'action' => 'index']); ?>"
                        style="color: black;">Almbum</a></li>
                <li class="active"><a href="<?= $this->Url->build(['controller' => 'Faq', 'action' => 'index']); ?>"
                        style="color: black;">Galeri</a></li>
            </ul>
        </div>
    </div>
</section> -->
<!-- end: Page title -->
<!-- Content -->
<section id="page-content" class="bg-light">
    <div class="container text-center">
        <div class="heading-text heading-line text-center">
            <h4>Album</h4>
        </div>
        <div class="btn-group">
            <a href="<?= $this->Url->build(['controller' => 'Galleries', 'action' => 'index']); ?>"
                class="btn btn-rounded btn-success album-main">Terbaru</a>
            <?php foreach ($albums as $albumItem): ?>
                <a href="#" class="btn btn-info btn-rounded album-link" data-album-id="<?= $albumItem->id ?>">
                    <?= $albumItem->name ?>
                </a>
            <?php endforeach ?>
        </div>
        <!-- Gallery -->
        <div class="grid-layout grid-3-columns pt-2" data-margin="20" data-item="grid-item" data-lightbox="gallery">
            <?php foreach ($galleries as $gallery):
                if ($albumId === null || $gallery->album->id == $albumId): ?>
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

    <hr class="space">

    <div class="pagination-container">
    </div>

</section> <!-- end: Content -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('.album-link').click(function (e) {
            e.preventDefault();
            var albumId = $(this).data('album-id');

            // button class
            $('.album-main').removeClass('btn-success');
            $('.album-main').addClass('btn-info');
            $('.album-link').removeClass('btn-success');
            $('.album-link').addClass('btn-info');
            $(this).removeClass('btn-info');
            $(this).addClass('btn-success');

            filterGallery(albumId, 1); // Mulai dari halaman pertama setiap kali album diubah
        });

        function filterGallery(albumId, page) {
            $.ajax({
                url: '<?= $this->Url->build(['controller' => 'Galleries', 'action' => 'filterGalleryAjax']) ?>/' +
                    albumId + '?page=' + page, // Tambahkan nomor halaman ke permintaan AJAX
                method: 'GET',
                success: function (response) {
                    // Perbarui tampilan galeri dengan data yang diterima
                    var data = JSON.parse(response);
                    var galleries = data.galleries;
                    var galleryHtml = '';
                    $.each(galleries, function (index, gallery) {
                        var imagePath = '<?= $this->Url->build('/') ?>' + gallery.image.dir +
                            gallery.image.name;
                        imagePath = imagePath.replace('/webroot',
                            ''); // Menghapus bagian '/webroot'
                        galleryHtml += '<div class="grid-item ' + gallery.album.name
                            .toLowerCase().replace(" ", "-") + '">';
                        galleryHtml += '<a class="image-hover-zoom" href="' + imagePath +
                            '" data-lightbox="gallery-image">';
                        galleryHtml += '<img src="' + imagePath + '">';
                        galleryHtml += '</a>';
                        galleryHtml += '</div>';
                    });
                    $('.grid-layout').html(galleryHtml);

                    // Tambahkan navigasi pagination
                    var totalPages = Math.ceil(data.total / data.limit);
                    var currentPage = parseInt(data.page); // Konversi ke integer

                    // Tombol "Previous"
                    var prevPage = currentPage - 1;
                    var nextPage = currentPage + 1;

                    // Jika halaman sebelumnya kurang dari 1, set ke halaman pertama
                    if (prevPage < 1) {
                        prevPage = 1;
                    }

                    // Jika halaman berikutnya melebihi total halaman, set ke halaman terakhir
                    if (nextPage > totalPages) {
                        nextPage = totalPages;
                    }

                    var paginationHtml = '<ul class="pagination justify-content-center">';

                    paginationHtml += '<li class="page-item ' + (currentPage == 1 ? 'disabled' : '') +
                        '">';
                    paginationHtml += '<a class="page-link" href="#" data-page="' + prevPage +
                        '">Previous</a>';
                    paginationHtml += '</li>';

                    for (var i = 1; i <= totalPages; i++) {
                        paginationHtml +=
                            '<li class="page-item ' + (currentPage == i ? 'active' : '') +
                            '"><a class="page-link" href="#" data-page="' +
                            i + '">' + i + '</a></li>';
                    }

                    paginationHtml += '<li class="page-item ' + (currentPage == totalPages ?
                        'disabled' : '') + '">';
                    paginationHtml += '<a class="page-link" href="#" data-page="' + nextPage +
                        '">Next</a>';
                    paginationHtml += '</li>';

                    paginationHtml += '</ul>';
                    $('.pagination-container').html(paginationHtml);

                    // Tambahkan event handler untuk pagination
                    $('.page-link').click(function (e) {
                        e.preventDefault();
                        var page = $(this).data('page');
                        filterGallery(albumId, page);
                    });
                }
            });
        }
    });
</script>
