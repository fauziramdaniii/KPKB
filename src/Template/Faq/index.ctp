<section id="page-title" data-bg-parallax="<?= $this->Url->build('/front-assets-new/sikami.jpg'); ?>">
    <div class="container">
        <div class="page-title">
            <h1>FAQs</h1>
            <span>Frequently Asked Questions</span>
        </div>
        <div class="breadcrumb">
            <ul>
                <li><a href="<?= $this->Url->build(['controller' => 'Home', 'action' => 'index']); ?>">Beranda</a>
                </li>
                <li class="active"><a href="<?= $this->Url->build(['controller' => 'Faq', 'action' => 'index']); ?>">FAQs</a>
                </li>
            </ul>
        </div>
    </div>
</section>
<!-- end: Page title -->
<!-- Section -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3>Pertanyaan Umum</h3>
                <p>Pertanyaan mengenai segala hal yang berkaitan dengan turnamen Piala Gubernur Jawa Barat. </p>
                <div class="accordion toggle fancy radius clean">
                    <?php foreach ($faqs as $k => $v) : ?>
                        <div class="ac-item">
                            <h5 class="ac-title"><i class="fa fa-question-circle"></i><?= $v->question; ?></h5>
                            <div style="display: none;" class="ac-content"><?= $v->answer; ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
