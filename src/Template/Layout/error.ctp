<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?= $this->Html->meta(
        'keywords',
        'dispora,piala gubernur,esports'
    );
    ?>
    <?= $this->Html->meta(
        'description',
        'Company Profile Koperasi Pemerintah Kota Bandung'
    );
    ?>
    <?= $this->Html->meta(
        'author',
        'Dispora Jawa Barat'
    ); ?>
    <title><?= $this->fetch('title') ?></title>


    <?= $this->Html->css([
        '/front-assets-new/css/plugins',
        '/front-assets-new/css/style',
    ]); ?>

    <?= $this->Html->meta(
        'favicon.ico',
        '/front-assets-new/logo-white.png',
        ['type' => 'icon']
    ); ?>

    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        .body-inner {
            min-height: 100%;
            display: flex;
            flex-direction: column;
        }

        .content-wrapper {
            flex: 1;
        }
    </style>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
</head>

<body>
    <div class="body-inner">
        <?= $this->element('Partial/header2'); ?>
        <div class="content-wrapper">
            <?= $this->fetch('content'); ?>
        </div>
        <?= $this->element('Partial/footer'); ?>
    </div>

    <a id="scrollTop"><i class="icon-chevron-up1"></i><i class="icon-chevron-up1"></i></a>

    <?= $this->Html->script([
        '/front-assets-new/js/jquery.js',
        '/front-assets-new/js/plugins.js',
        '/front-assets-new/js/functions.js'
    ]); ?>

    <?= $this->fetch('script') ?>
</body>


</html>
