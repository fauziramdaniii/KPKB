<header id="header" data-fullwidth="true" data-transparent="true" class="dark submenu-light">
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
                            <li class="dropdown"><a href="#">Profil</a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?= $this->Url->build(['controller' => '', 'action' => 'sejarahKpkb']); ?>">Sejarah KPKB</a></li>
                                    <li><a href="<?= $this->Url->build(['controller' => '', 'action' => 'visi-misi']); ?>">Visi Misi</a></li>
                                    <li><a href="<?= $this->Url->build(['controller' => '', 'action' => 'struktur-organisasi']); ?>">Struktur Organisasi</a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a href="#">Produk</a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?= $this->Url->build(['controller' => 'tentang-kami', 'action' => 'sejarahKpkb']); ?>">Arsip Paparan</a></li>
                                    <li><a href="<?= $this->Url->build(['controller' => 'tentang-kami', 'action' => 'visi-misi']); ?>">Dokumen Perencanaan</a></li>
                                    <li><a href="<?= $this->Url->build(['controller' => 'tentang-kami', 'action' => 'struktur-organisasi']); ?>">Dokumen KPKB</a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a href="#">Informasi Publik</a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?= $this->Url->build(['controller' => 'tentang-kami', 'action' => 'sejarahKpkb']); ?>">Transparansi Anggaran</a></li>
                                    <li><a href="<?= $this->Url->build(['controller' => 'tentang-kami', 'action' => 'visi-misi']); ?>">Transparansi Kinerja</a></li>
                                    <li><a href="<?= $this->Url->build(['controller' => 'tentang-kami', 'action' => 'struktur-organisasi']); ?>">Program Unggulan</a></li>
                                </ul>
                            </li>
                            <li><a href="<?= $this->Url->build(['controller' => 'News', 'action' => 'index']); ?>">Berita</a></li>
                            <li><a href="<?= $this->Url->build(['controller' => 'Galleries', 'action' => 'index']); ?>">Galeri</a></li>
                            <li><a href="<?= $this->Url->build(['controller' => 'Faq', 'action' => 'index']); ?>">FAQ</a></li>
                            <!-- <li><a href="<?= $this->Url->build(['controller' => 'Contacts', 'action' => 'index']); ?>">Kontak Kami</a></li> -->
                        </ul>
                    </nav>
                </div>
            </div>
            <!--end: Navigation-->
        </div>
    </div>
</header>