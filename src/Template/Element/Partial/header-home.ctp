<header id="header" data-fullwidth="true" data-transparent="true" class="submenu-light">
    <div class="header-inner">
        <div class="container">
            <!--Logo-->
            <div id="logo">
                <a href="<?= $this->Url->build(['controller' => 'Home', 'action' => 'index']); ?>">
                    <span class="logo-default"><img src="<?= $this->Url->build('/front-assets-new/logo-white.png'); ?>" height="50"></span>
                    <span class="logo-dark"><img src="<?= $this->Url->build('/front-assets-new/logo-white.png'); ?>" height="50"></span>

                    <!--                    <span class="logo-default"><img class="m-b-20" src="https://disporallg.lubuklinggaukota.go.id/wp-content/uploads/2021/07/dispora-logo-transparan-1024x340.png" width="150px"></span>-->
                    <!--                    <span class="logo-dark"><img class="m-b-20" src="https://disporallg.lubuklinggaukota.go.id/wp-content/uploads/2021/07/dispora-logo-transparan-1024x340.png" width="150px"></span>-->
                </a>
            </div>
            <!--End: Logo-->
            <!--Navigation Resposnive Trigger-->
            <div id="mainMenu-trigger">
                <a class="lines-button x"> <span class="lines"></span> </a>
            </div>
            <!--end: Navigation Resposnive Trigger-->
            <!--Navigation-->
            <div id="mainMenu">
                <div class="container">
                    <nav>
                        <ul>
                            <li><a href="<?= $this->Url->build(['controller' => 'Home', 'action' => 'index']); ?>">Beranda</a></li>
                            <li><a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'view', 'tentang-kami']); ?>">Tentang Kami</a></li>
                            <li class="dropdown"><a href="#">Turnamen</a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?= $this->Url->build(['controller' => 'Tournament', 'action' => 'liveBagan']); ?>">Live Bagan</a></li>
                                    <li><a href="<?= $this->Url->build(['controller' => 'Tournament', 'action' => 'matchRules']); ?>">Aturan Pertandingan</a></li>
                                    <li><a href="<?= $this->Url->build(['controller' => 'Tournament', 'action' => 'registrationRules']); ?>">Aturan Pendaftaran</a></li>
                                    <li><a href="<?= $this->Url->build(['controller' => 'Tournament', 'action' => 'matchSchedule']); ?>">Jadwal Pertandingan</a></li>
                                </ul>
                            </li>
                            <li><a href="<?= $this->Url->build(['controller' => 'Faq', 'action' => 'index']); ?>">FAQ</a></li>
                            <li class="dropdown"><a href="#">Pendaftaran</a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?= $this->Url->build(['controller' => 'Registration', 'action' => 'pes']); ?>">PES 2021</a></li>
                                    <li><a href="<?= $this->Url->build(['controller' => 'Registration', 'action' => 'ml']); ?>">Mobile Legends</a></li>
                                    <li><a href="<?= $this->Url->build(['controller' => 'Registration', 'action' => 'pubgm']); ?>">PUBG Mobile</a></li>
                                    <li><a href="<?= $this->Url->build(['controller' => 'Registration', 'action' => 'ff']); ?>">Free Fire</a></li>
                                    <li><a href="<?= $this->Url->build(['controller' => 'Registration', 'action' => 'valorant']); ?>">Valorant</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!--end: Navigation-->
        </div>
    </div>
</header>