<!DOCTYPE html>
<html lang="en" >
<!-- begin::Head -->
<head>
    <meta charset="utf-8" />
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,height=device-height, initial-scale=1, shrink-to-fit=no">
    <?= $this->fetch('css') ?>
    <!--begin::Web font -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <!--end::Web font -->
    <!--begin::Base Styles -->

    <?= $this->Html->css([
			'/assets/theme/css/bootstrap.min',
			'/assets/theme/fonts/themify/style.min',
			'/assets/theme/fonts/flag-icon-css/css/flag-icon.min',
			'/assets/theme/vendors/animate/animate.min',
			'/assets/theme/vendors/flipclock/flipclock',
			'/assets/theme/vendors/swiper/css/swiper.min',
			'/assets/theme/css/template-counter',
			'/assets/css/style', 
    ]); ?>
    <!--end::Base Styles -->
    <?= $this->Html->meta(
        'favicon.ico',
        '/client-assets/media/logos/favicon.ico',
        ['type' => 'icon']
    );
    ?>
</head>
<!-- end::Head -->
<!-- end::Body -->
<body class=" 1-column    template-counter blank-page" data-menu-open="hover" data-menu="">
<div id="loader-wrapper">
    <svg viewbox=" 0 0 512 512" id="loader">
        <linearGradient id="loaderLinearColors" x1="0" y1="0" x2="1" y2="1">
            <stop offset="5%" stop-color="#28bcfd"></stop>
            <stop offset="100%" stop-color="#1d78ff"></stop>
        </linearGradient>        
        <g>
            <circle cx="256" cy="256" r="150" fill="none" stroke="url(#loaderLinearColors)" />
        </g>
        <g>
            <circle cx="256" cy="256" r="125" fill="none" stroke="url(#loaderLinearColors)" />
        </g>
        <g>
            <circle cx="256" cy="256" r="100" fill="none" stroke="url(#loaderLinearColors)" />
        </g>
        <g>
            <circle cx="256" cy="256" r="75" fill="none" stroke="url(#loaderLinearColors)" />
        </g>
        <circle cx="256" cy="256" r="60" fill="url(#loaderImage)" stroke="none" stroke-width="0" />

        <!-- Change the preloader logo here -->
        <defs>
            <pattern id="loaderImage" height="100%" width="100%" patternContentUnits="objectBoundingBox">
                <image href="<?= $this->Url->build('/assets/theme/images/loader-logo.png'); ?>" preserveAspectRatio="none" width="1" height="1"></image>
            </pattern>
        </defs>
    </svg>

    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
</div> 
<?= $this->fetch('content'); ?>
<?= $this->Html->script([
    '/assets/theme/vendors/vendors.min',
    '/assets/theme/vendors/flipclock/flipclock.min',
    '/assets/theme/vendors/swiper/js/swiper.min',
    '/assets/theme/vendors/particles.min',
    '/assets/theme/vendors/waypoints/jquery.waypoints.min',
    '/assets/theme/js/theme',
    '/assets/theme/js/sales-notification',
    '/assets/theme/js/scripts/particles-type2',
]); ?>
<?= $this->fetch('script') ?>
</body>
<!-- end::Body -->
</html>
