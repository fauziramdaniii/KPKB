<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8" />
    <title><?= \Cake\Core\Configure::read('SiteName');?></title>
    <meta name="description" content="User login example">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">

    <?= $this->Html->css([
    '/admin-assets/css/pages/login/login-v2',
    ]); ?>

    <?= $this->Html->css([
    '/admin-assets/plugins/global/plugins.bundle',
    '/admin-assets/css/style.bundle',
    ]); ?>

    <?= $this->Html->meta(
    'favicon.ico',
    '/admin-assets/media/logos/favicon.ico',
    ['type' => 'icon']
    );?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
</head>

<body class="kt-login-v2--enabled kt-login-v2--enabled kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header--minimize-menu kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-page--loading">

<div class="kt-grid kt-grid--ver kt-grid--root">
    <div class="kt-grid__item   kt-grid__item--fluid kt-grid  kt-grid kt-grid--hor kt-login-v2" id="kt_login_v2">


        <div class="kt-grid__item  kt-grid  kt-grid--ver  kt-grid__item--fluid">

            <div class="kt-login-v2__body">

                <div class="kt-login-v2__wrapper">
                    <?= $this->fetch('content'); ?>
                </div>

                <div class="kt-login-v2__image">
                    <?= $this->Html->image('/admin-assets/media/misc/bg_icon.svg');?>
                </div>

            </div>

        </div>

        <div class="kt-grid__item">
            <div class="kt-login-v2__footer">
                <div class="kt-login-v2__link">
                    <a href="#" class="kt-link kt-font-brand">Privacy</a>
                    <a href="#" class="kt-link kt-font-brand">Legal</a>
                    <a href="#" class="kt-link kt-font-brand">Contact</a>
                </div>
                <div class="kt-login-v2__info">
                    <div class="copyright"> &#169; FastRun Business System <?php echo date('Y'); ?> .  All rights reserved.</div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    var KTAppOptions = {
        "colors": {
            "state": {
                "brand": "#4d5cf2",
                "metal": "#c4c5d6",
                "light": "#ffffff",
                "accent": "#00c5dc",
                "primary": "#5867dd",
                "success": "#34bfa3",
                "info": "#36a3f7",
                "warning": "#ffb822",
                "danger": "#fd3995",
                "focus": "#9816f4"
            },
            "base": {
                "label": [
                    "#c5cbe3",
                    "#a1a8c3",
                    "#3d4465",
                    "#3e4466"
                ],
                "shape": [
                    "#f0f3ff",
                    "#d9dffa",
                    "#afb4d4",
                    "#646c9a"
                ]
            }
        }
    };
</script>

<?= $this->Html->script([
'/admin-assets/plugins/global/plugins.bundle',
'/admin-assets/js/scripts.bundle',
'/admin-assets/js/pages/custom/user/login',
]); ?>

<?= $this->fetch('script') ?>
</body>

</html>


