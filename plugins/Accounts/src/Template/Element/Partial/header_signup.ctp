<?php
/**
 * Use this annotation for IDE suggestion
 * @var \App\View\AppView $this
 */
?>
<header class="header-global">
    <nav id="navbar-main" class="navbar navbar-main navbar-expand-lg navbar-dark bg-default navbar-transparent navbar-lightx headroom">
        <div class="container">
            <a class="navbar-brand mr-lg-5" href="<?= $this->Url->build('/'); ?>">
                <img src="<?= $this->Url->build('/assets/img/brand/white.png'); ?>" alt="brand">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse" id="navbar_global">
                <div class="navbar-collapse-header">
                    <div class="row">
                        <div class="col-6 collapse-brand">
                            <a href="<?= $this->Url->build('/'); ?>">
                                <img src="<?= $this->Url->build('/assets/img/brand/blue.png'); ?>" alt="brand">
                            </a>
                        </div>
                        <div class="col-6 collapse-close">
                            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
                                <span></span>
                                <span></span>
                            </button>
                        </div>
                    </div>
                </div>
                <ul class="navbar-nav navbar-nav-hover align-items-lg-center ml-lg-auto">

                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link" data-toggle="dropdown" role="button">
                            <?php
                            $languages = $this->Language->get();
                            $lang = $this->Language->current();
                            $currentLang = isset($languages[$lang]) ? $languages[$lang] : array_shift($languages);
                            ?>

                            <img
                                    src="<?= $this->Language->getFlagIcon($currentLang['flag']); ?>"
                                    alt="<?= $currentLang['name']; ?>"
                                    class="language flags" />
                            <span class="nav-link-inner--text"> <?= __($currentLang['name']); ?></span>
                        </a>
                        <div class="dropdown-menu">
                            <?php foreach($languages as $langKey => $val) : ?>
                            <?php if ($langKey === $lang) continue; ?>
                            <a href="<?= $this->Url->build(['lang' => $langKey]); ?>" class="dropdown-item">
                                <img
                                        src="<?= $this->Language->getFlagIcon($val['flag']); ?>"
                                        alt="<?= $langKey; ?>"
                                        class="language flags" />
                                <span class="nav-link-inner--text"><?= __($val['name']); ?></span>
                            </a>
                            <?php endforeach; ?>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a href="<?= $this->Url->build(['controller' => 'login', 'action' => 'index', 'plugin' => false]); ?>" class="nav-link" role="button">
                            <i class="ni ni-ui-04 d-lg-none"></i>
                            <span class="nav-link-inner--text"><?= __('Login'); ?></span>
                        </a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>
</header>