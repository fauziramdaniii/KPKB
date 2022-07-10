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
        '/client-assets/client/base/style.bundle',
          '/client-assets/custom/user/login-v1'
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
<body style="background-image: url(<?= $this->Url->build('/client-assets/media/misc/bg_1.jpg'); ?>)" class="k-login-v1--enabledx custom-login-background k-header--fixed k-header-mobile--fixed k-aside--enabled k-aside--fixed"  >

<?= $this->fetch('content'); ?>
<?= $this->fetch('script') ?>
</body>
<!-- end::Body -->
</html>
