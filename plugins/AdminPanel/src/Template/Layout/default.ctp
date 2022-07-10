
<html lang="en">

<!-- begin::Head -->
<head>
    <base href="">
    <meta charset="utf-8" />
    <title><?= \Cake\Core\Configure::read('SiteName');?></title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">


    <?= $this->Html->css([
        '/admin-assets/plugins/global/plugins.bundle',
        '/admin-assets/css/style.bundle',
        '/admin-assets/css/custom',
    ]); ?>

    <?= $this->Html->meta(
		'favicon.ico',
		'/admin-assets/media/logos/logo.png',
		['type' => 'icon']
    );?>

    <?= $this->fetch('css') ?>
</head>

<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header--minimize-menu kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-page--loading">


    <!-- begin:: Header Mobile -->
    <div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
        <div class="kt-header-mobile__logo">
            <a href="/">
                <?= $this->Html->image('/admin-assets/media/logos/logo.png',['alt' => 'Logo', 'width' => 'auto', 'height' => '100px']);?>
            </a>
        </div>
        <div class="kt-header-mobile__toolbar">
            <button class="kt-header-mobile__toolbar-toggler" id="kt_header_mobile_toggler"><span></span></button>
            <button class="kt-header-mobile__toolbar-topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more"></i></button>
        </div>
    </div>
    <!-- end:: Header Mobile -->

    <div class="kt-grid kt-grid--hor kt-grid--root">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

                <!-- begin:: Header -->
                <div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed " data-ktheader-minimize="on" style="background-image: url(<?= $this->Url->build('/admin-assets/media/layout/header-bg-demo3.jpg');?>)">
                    <div class="kt-header__top">
                        <div class="kt-container ">
                            <?= $this->Element('Menu/top-menu'); ?>
                        </div>
                    </div>
                    <div class="kt-header__bottom">
                        <div class="kt-container ">
                            <?= $this->Element('Menu/bottom-menu'); ?>
                        </div>
                    </div>
                </div>
                <!-- end:: Header -->

                <div class="kt-container  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-grid--stretch">
                    <div class="kt-body kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-grid--stretch" id="kt_body">
                        <div class="kt-content kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
                            <?= $this->fetch('content'); ?>
                        </div>
                    </div>
                </div>

                <!-- begin:: Footer -->
                <div class="kt-footer kt-grid__item" style="background-image: url(<?= $this->Url->build('/admin-assets/media/layout/footer-bg-demo3.jpg');?>)" id="kt_footer">
                    <div class="kt-container ">
                        <?= $this->Element('Footer/default'); ?>
                    </div>
                </div>
                <!-- end:: Footer -->
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
        //'/admin-assets/js/pages/dashboard',
        '/js/table2excel.js',
    ]); ?>
    <?= $this->fetch('script') ?>
</body>

</html>
