<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta charset="utf-8">
    <meta name="robots" content="index, follow" />
    <?= $this->Html->meta(
        'keywords',
        'company profile koperasi pemerintah kota bandung,kpkb'
    );
    ?>
    <?= $this->Html->meta(
        'description',
        'Company Profile Koperasi Pemerintah Kota Bandung'
    );
    ?>
    <?= $this->Html->meta(
        'author',
        'Koperasi Pemerintah Kota Bandung'
    ); ?>
    <title><?= Cake\Core\Configure::read('SiteName'); ?> - <?= $this->fetch('title') ?></title>


    <?= $this->Html->css([
        '/front-assets-new/css/plugins',
        '/front-assets-new/css/style',
    ]); ?>

    <?= $this->Html->meta(
        'favicon.ico',
        '/front-assets-new/logo-white.png',
        ['type' => 'icon']
    ); ?>

    <?= $this->fetch('meta'); ?>
    <?= $this->fetch('css'); ?>
    <style>
        body,
        .body-inner {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            /* Makes sure the body takes up at least the full viewport height */
            margin: 0;
        }

        .content-wrapper {
            flex-grow: 1;
            /* Allows this section to grow and fill the remaining space */
        }

        footer {
            /* Your existing footer styles here */
        }
        section {
            background-color: #f8f9fa!important;
            padding: 30px!important;
        }
    </style>
</head>

<body>
    <div class="body-inner">
        <?= $this->element('Partial/header2'); ?>

        <!-- Add a wrapper with flex properties -->
        <div class="content-wrapper bg-light" style="flex-grow: 1;">
            <?= $this->fetch('content'); ?>
        </div>

        <!-- Footer element -->
        <?= $this->element('Partial/footer'); ?>
    </div>

    <a id="scrollTop"><i class="icon-chevron-up1"></i><i class="icon-chevron-up1"></i></a>

    <?= $this->Html->script([
        '/front-assets-new/js/jquery.js',
        '/front-assets-new/js/plugins.js',
        '/front-assets-new/js/functions.js'
    ]); ?>

    <?php $this->append('css'); ?>
    <!-- isi CSS untuk layout global -->
    <?php $this->end(); ?>

    <?php $this->append('script'); ?>
    <!-- isi JS untuk layout global -->
    <?php $this->end(); ?>

    <?= $this->fetch('script') ?>
</body>

</html>
