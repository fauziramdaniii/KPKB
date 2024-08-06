<?php
use Cake\Core\Configure;
use Cake\Error\Debugger;

$this->layout = 'error';
$this->assign('title', $message);

if (Configure::read('debug')):
    $this->layout = 'dev_error';
    $this->assign('title', $message);
    $this->assign('templateName', 'error400.ctp');

    $this->start('file');
    if (!empty($error->queryString)): ?>
        <p class="notice">
            <strong>SQL Query: </strong>
            <?= h($error->queryString) ?>
        </p>
    <?php endif;
    if (!empty($error->params)): ?>
        <strong>SQL Query Params: </strong>
        <?php Debugger::dump($error->params) ?>
    <?php endif;
    echo $this->element('auto_table_warning');
    if (extension_loaded('xdebug')):
        xdebug_print_function_stack();
    endif;
    $this->end();
endif;

$this->start('css');
?>
<style>
    @import url('https://fonts.googleapis.com/css?family=Montserrat:400,600,700');
    @import url('https://fonts.googleapis.com/css?family=Catamaran:400,800');

    h1 {
        color: #ffffff;
    }

    .error-container {
        text-align: center;
        font-size: 180px;
        font-family: 'Catamaran', sans-serif;
        font-weight: 800;
        background-color: #426575;
        padding-bottom: 0px;
        padding-top: 80px;
    }

    .error-container>span {
        display: inline-block;
        line-height: 0.7;
        position: relative;
        color: #FFB485;
    }

    .error-container>span {
        display: inline-block;
        position: relative;
        vertical-align: middle;
    }

    .error-container>span:nth-of-type(1) {
        color: #D1F2A5;
        animation: colordancing 4s infinite;
    }

    .error-container>span:nth-of-type(3) {
        color: #F56991;
        animation: colordancing2 4s infinite;
    }

    .error-container>span:nth-of-type(2) {
        width: 120px;
        height: 120px;
        border-radius: 999px;
    }

    .error-container>span:nth-of-type(2):before,
    .error-container>span:nth-of-type(2):after {
        border-radius: 0%;
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: inherit;
        height: inherit;
        border-radius: 999px;
        box-shadow: inset 30px 0 0 rgba(209, 242, 165, 0.4),
            inset 0 30px 0 rgba(239, 250, 180, 0.4),
            inset -30px 0 0 rgba(255, 196, 140, 0.4),
            inset 0 -30px 0 rgba(245, 105, 145, 0.4);
        animation: shadowsdancing 4s infinite;
    }

    .error-container>span:nth-of-type(2):before {
        -webkit-transform: rotate(45deg);
        -moz-transform: rotate(45deg);
        transform: rotate(45deg);
    }

    .screen-reader-text {
        position: absolute;
        top: -9999em;
        left: -9999em;
    }

    @keyframes shadowsdancing {
        0% {
            box-shadow: inset 30px 0 0 rgba(209, 242, 165, 0.4),
                inset 0 30px 0 rgba(239, 250, 180, 0.4),
                inset -30px 0 0 rgba(255, 196, 140, 0.4),
                inset 0 -30px 0 rgba(245, 105, 145, 0.4);
        }

        25% {
            box-shadow: inset 30px 0 0 rgba(245, 105, 145, 0.4),
                inset 0 30px 0 rgba(209, 242, 165, 0.4),
                inset -30px 0 0 rgba(239, 250, 180, 0.4),
                inset 0 -30px 0 rgba(255, 196, 140, 0.4);
        }

        50% {
            box-shadow: inset 30px 0 0 rgba(255, 196, 140, 0.4),
                inset 0 30px 0 rgba(245, 105, 145, 0.4),
                inset -30px 0 0 rgba(209, 242, 165, 0.4),
                inset 0 -30px 0 rgba(239, 250, 180, 0.4);
        }

        75% {
            box-shadow: inset 30px 0 0 rgba(239, 250, 180, 0.4),
                inset 0 30px 0 rgba(255, 196, 140, 0.4),
                inset -30px 0 0 rgba(245, 105, 145, 0.4),
                inset 0 -30px 0 rgba(209, 242, 165, 0.4);
        }

        100% {
            box-shadow: inset 30px 0 0 rgba(209, 242, 165, 0.4),
                inset 0 30px 0 rgba(239, 250, 180, 0.4),
                inset -30px 0 0 rgba(255, 196, 140, 0.4),
                inset 0 -30px 0 rgba(245, 105, 145, 0.4);
        }
    }

    @keyframes colordancing {
        0% {
            color: #D1F2A5;
        }

        25% {
            color: #F56991;
        }

        50% {
            color: #FFC48C;
        }

        75% {
            color: #EFFAB4;
        }

        100% {
            color: #D1F2A5;
        }
    }

    @keyframes colordancing2 {
        0% {
            color: #FFC48C;
        }

        25% {
            color: #EFFAB4;
        }

        50% {
            color: #D1F2A5;
        }

        75% {
            color: #F56991;
        }

        100% {
            color: #FFC48C;
        }
    }

    * {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }

    body {
        background-color: #416475;
        margin-bottom: 50px;
    }

    html,
    button,
    input,
    select,
    textarea {
        font-family: 'Montserrat', Helvetica, sans-serif;
        color: #92a4ad;
    }

    h1 {
        text-align: center;
        margin: 30px 15px;
    }

    .zoom-area {
        max-width: 490px;
        margin: 30px auto 30px;
        font-size: 19px;
        text-align: center;
        color: #ffffff;
    }

    .link-container {
        text-align: center;
    }

    a.more-link {
        text-transform: uppercase;
        font-size: 13px;
        background-color: #ffffff;
        padding: 10px 15px;
        border-radius: 0;
        color: #416475;
        display: inline-block;
        margin-right: 5px;
        margin-bottom: 5px;
        line-height: 1.5;
        text-decoration: none;
        margin-top: 20px;
        letter-spacing: 1px;
    }
</style>
<?php
$this->end();
?>
<section class="error-container">
    <span>4</span>
    <span><span class="screen-reader-text">0</span></span>
    <span>4</span>
</section>
<h1><?= __d('cake', 'Error') ?> <?= h($message) ?></h1>
<p class="zoom-area">
    <b><?= __d('cake', 'The requested address {0} was not found on this server.', "<strong>'{$url}'</strong>") ?> </p>
<div class="link-container">
    <a href="<?= $this->Url->build(['controller' => 'Home', 'action' => 'index']); ?>" class="more-link">Beranda</a>
</div>
