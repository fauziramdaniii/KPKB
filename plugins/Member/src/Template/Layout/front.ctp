<!DOCTYPE html>
<!--
Theme: Keen - The Ultimate Bootstrap Admin Theme
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: You must have a valid license purchased only from https://themes.getbootstrap.com/product/keen-the-ultimate-bootstrap-admin-theme/ in order to legally use the theme for your project.
-->
<html lang="en"  class="k-sweetalert2--nopadding" >
<!-- begin::Head -->
<head>
    <meta charset="utf-8"/>

    <title><?= $this->fetch('title') ?></title>
    <meta name="description" content="Page not found page examples">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!--begin::Web font -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <!--end::Web font -->


    <!--begin::Page Custom Styles -->
    <?= $this->Html->css([
        '/client-assets/custom/error/404-v1.css',
    ]); ?>
    <!--end::Page Custom Styles -->

    <!--begin::Global Theme Styles -->
    <?= $this->Html->css([
        '/client-assets/client/base/style.bundle',
        //'/client-assets/custom/user/login-v1'
    ]); ?>
    <!--end::Base Styles -->
    <?= $this->Html->meta(
        'favicon.ico',
        '/client-assets/media/logos/favicon.ico',
        ['type' => 'icon']
    );
    ?>
    <!--end::Global Theme Styles -->

    <!--begin::Layout Skins -->
    <?= $this->Html->css([
        '/client-assets/client/skins/aside/brand',
    ]); ?>

    <?= $this->fetch('css') ?>

    <!--end::Layout Skins -->

</head>
<!-- end::Head -->

<!-- begin::Body -->
<body  class="k-page--loading-enabled k-page--loading k-bg-light k-sweetalert2--nopadding k-header--static k-header-mobile--fixed k-aside--enabled k-aside--fixed"  >

<!-- begin::Page loader -->

<!-- end::Page Loader -->

<?= $this->fetch('content'); ?>

<!-- begin::Global Config -->
<script>
    var KAppOptions = {"colors":{"state":{"brand":"#5578eb","metal":"#c4c5d6","light":"#ffffff","accent":"#00c5dc","primary":"#5867dd","success":"#34bfa3","info":"#36a3f7","warning":"#ffb822","danger":"#fd3995","focus":"#9816f4"},"base":{"label":["#c5cbe3","#a1a8c3","#3d4465","#3e4466"],"shape":["#f0f3ff","#d9dffa","#afb4d4","#646c9a"]}}};
</script>
<!-- end::Global Config -->

<!--begin::Global Theme Bundle -->
<?= $this->Html->script([
    '/client-assets/vendors/base/vendors.bundle',
    '/client-assets/client/base/scripts.bundle'
]); ?>
<!--end::Global Theme Bundle -->



<!--begin::Global App Bundle -->
<?= $this->Html->script([
    '/client-assets/app/scripts/bundle/app.bundle'
]); ?>
<!--end::Global App Bundle -->

<!-- begin::Page Loader -->
<script>
    $(window).on('load', function() {
        $('body').removeClass('k-page--loading');
    });
</script>
<?= $this->fetch('script') ?>
<!-- end::Page Loader -->
</body>
<!-- end::Body -->
</html>
