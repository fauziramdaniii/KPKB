<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?= $this->Html->meta(
        'keywords',
        'gardukita, gardukita dwisukma mitra rotama, gardukita rotama, dwisukma mitra rotama, rotama, ganti rokok rotama, ganti rokok dapat duit anda, ganti rokok dapat duit kita, mau dapat duit ya ganti rokok, multilevel rokok, rokok di multilevelin, rokok tasikmalaya, rotama rokok tasikmalaya, gardukita adalah rotama, rotama pulen, rotama, rotama arsen, rotama aksa, rotama koper, rokok rotama pulen, rokok rotama, rokok rotama arsen, rokok rotama aksa, rokok rotama koper, jaringan rotama pulen, jaringan rotama,jaringan  rotama arsen, jaringan rotama aksa, jaringan rotama koper'
    );
    ?>
    <?= $this->Html->meta(
        'description',
        'ROTAMA adalah nama Merk rokok yang berasal dan diproduksi PR. Makmur di Tasikmalaya Jawa Barat sehingga disingkat menjadi RO TA MA (Rokok Tasik Malaya)'
    );
    ?>
    <?= $this->Html->meta(
        'author',
        'Rotama'
    );?>
  <title><?= $this->fetch('title') ?></title>


    <?= $this->Html->css([
            '/assets/css/plugins',
            '/assets/css/style',
            '/assets/css/responsive',
    ]); ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
</head>

<body>
    <div class="body-inner">
        <?= $this->element('Partial/header'); ?>
        <?= $this->fetch('content'); ?>
    </div>


  <?= $this->element('Partial/footer'); ?>
  <!-- Core -->


  <a id="scrollTop"><i class="icon-chevron-up1"></i><i class="icon-chevron-up1"></i></a>

  <?= $this->Html->script([
      '/assets/js/jquery.js',
      '/assets/js/plugins.js',
      '/assets/js/functions.js'
  ]); ?>

    <?= $this->fetch('script') ?>
</body>

</html>
