<style>
    .breakpoint-xl .body-inner section{top:-80px;}
    .breakpoint-xl #mainMenu nav > ul > li > a, #mainMenu.dark nav > ul > li > a{color:#fff;}
    .breakpoint-xl .header-sticky.sticky-active #mainMenu nav > ul > li > a, #mainMenu.dark nav > ul > li > a{color:#000;}
    /*.breakpoint-md #header.dark .header-inner .lines {background-color: #484848 !important;}*/
    /*.breakpoint-md #header.dark .header-inner .lines:before {background-color: #484848 !important;}*/
    /*.breakpoint-md #header.dark .header-inner .lines:after {background-color: #484848 !important;}*/
    /*.breakpoint-sm #header.dark .header-inner .lines {background-color: #484848 !important;}*/
    /*.breakpoint-sm #header.dark .header-inner .lines:before {background-color: #484848 !important;}*/
    /*.breakpoint-sm #header.dark .header-inner .lines:after {background-color: #484848 !important;}*/
    /*.breakpoint-xs #header.dark .header-inner .lines {background-color: #484848 !important;}*/
    /*.breakpoint-xs #header.dark .header-inner .lines:before {background-color: #484848 !important;}*/
    /*.breakpoint-xs #header.dark .header-inner .lines:after {background-color: #484848 !important;}*/
</style>

<section class="m-0 p-0">
    <div class="bg-overlay"></div>
    <img class="home-img" src="<?= $this->Url->build('/front-assets-new/LandingPageUtama.png'); ?>" width="100%">
</section>
<!--end: Inspiro Slider -->



<section>
    <div class="container">
        <div class="row">
            <div class="content m-b-0">
                <div>
                    <ul class="grid grid-5-columns m-b-0">
                        <li>
                            <a href="#"><img alt="" src="<?= $this->Url->build('/front-assets-new/images/clients/1.png'); ?>"></a>
                        </li>
                        <li>
                            <a href="#"><img alt="" src="<?= $this->Url->build('/front-assets-new/images/clients/2.png'); ?>"></a>
                        </li>
                        <li>
                            <a href="#"><img alt="" src="<?= $this->Url->build('/front-assets-new/images/clients/3.png'); ?>"></a>
                        </li>
                        <li>
                            <a href="#"><img alt="" src="<?= $this->Url->build('/front-assets-new/images/clients/4.png'); ?>"></a>
                        </li>
                        <li>
                            <a href="#"><img alt="" src="<?= $this->Url->build('/front-assets-new/images/clients/5.png'); ?>"></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- MISSION & VISSION -->
<section class="section-fullwidth text-light no-padding">
    <div class="row">
        <?php /* <div class="col-lg-6 text-right background-image" style="background-image:url('https://koncepted.com/_nuxt/img/bg--mogul.377e6d5.png'); background-size: cover;"> */ ?>
        <div class="col-lg-6 text-right background-image no-padding no-margin">
            <div class="container no-padding">
                <a href="<?= $this->Url->build(['controller' => 'Tournament', 'action' => 'match-rules' ]); ?>"><img src="<?= $this->Url->build('/front-assets-new/AturanPertandingan.png'); ?>" width="100%"></a>
            </div>
        </div>

        <?php /* <div class="col-lg-6 text-left" data-bg-parallax="https://koncepted.com/_nuxt/img/bg--mogul.377e6d5.png"> */ ?>
        <div class="col-lg-6 text-left no-padding no-margin">
            <!--<div class="bg-overlay" data-style="5"></div>-->
            <div class="container no-padding">
                <a href="<?= $this->Url->build(['controller' => 'Tournament', 'action' => 'registration-method' ]); ?>"><img src="<?= $this->Url->build('/front-assets-new/CaraPendaftaran.png'); ?>" width="100%"></a>
            </div>
        </div>
    </div>
</section>
<!-- end: MISSION & VISSION -->

<section>
    <div class="container">
        <div class="row">
            <div class="content m-b-0">
                <div class="page-title m-b-40 text-center">
                    <h4>Didukung Oleh</h4>
                </div>
                <div>
                    <ul class="grid grid-4-columns m-b-0">
                        <li>
                            <a href="#"><img alt="" src="<?= $this->Url->build('/front-assets-new/images/clients/dispora-jabar.png'); ?>"></a>
                        </li>
                        <li>
                            <a href="#"><img alt="" src="<?= $this->Url->build('/front-assets-new/images/clients/esi-jabar.png'); ?>"></a>
                        </li>
                        <li>
                            <a href="#"><img alt="" src="<?= $this->Url->build('/front-assets-new/images/clients/koni-jabar.png'); ?>"></a>
                        </li>
                        <li>
                            <a href="#"><img alt="" src="<?= $this->Url->build('/front-assets-new/images/clients/diskominfo-jabar.png'); ?>"></a>
                        </li>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<?php /* <section class="fullscreen" data-bg-parallax="https://c4.wallpaperflare.com/wallpaper/656/157/253/esport-electronic-sports-world-cup-dota-2-wallpaper-preview.jpg"> */ ?>
<section class="fullscreen" data-bg-parallax="<?= $this->Url->build('/front-assets-new/LandingPageLiveBagan.png'); ?>">
    <!--<div class="bg-overlay" data-style="13"></div>-->
    <div class="shape-divider" data-style="10"></div>
    <div class="container-wide">
        <div class="container-fullscreen">
            <div class="text-middle text-center">
                <div class="heading-text text-light center">
                    <h2 class="font-weight-800"><span>LIVE BAGAN</span></h2>
                    <div class="card">
                        <div class="card-body text-center">
                            <a href="<?= $this->Url->build(['controller' => 'Tournament', 'action' => 'live-bagan' ]); ?>">
                                <img src="<?= $this->Url->build('/front-assets-new/1554211802185.jpg'); ?>" class="img-fluid" alt="" width="980">
                            </a>
                        </div>
                    </div>
                    <a href="<?= $this->Url->build(['controller' => 'Tournament', 'action' => 'live-bagan' ]); ?>" class="btn btn-light btn-rounded">Read More</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!--<div class="col-lg-12">-->
<!--    <div class="line"></div>-->
<!--</div>-->

<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 m-b-80">
                <div class="page-title m-b-40">
                    <h2>Jadwal Pertandingan</h2>
                </div>
                <div class="col-lg-12 p-0 m-b-20 overflow-auto">

                    <table class="table table-striped table-dark" style="min-width: 800px;">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center" >Kategori</th>
                                <th scope="col" class="text-center" width="25%">Tim 1</th>
                                <th scope="col" class="text-center" style="min-width: 75px;">Skor</th>
                                <th scope="col" class="text-center" width="25%">Tim 2</th>
                                <th scope="col" class="text-center" >Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($pes_schedules) : ?>
                                <?php foreach($pes_schedules as $k => $pes) : ?>
                                    <tr>
                                        <th scope="row" class="text-center"><?= $pes->game->name; ?></th>
                                        <td scope="row" class="text-center"><?= $pes->team_name_1; ?></td>
                                        <td scope="row" class="text-center"><?= isset($pes->score_team_1)? $pes->score_team_1 : '0'; ?> - <?= isset($pes->score_team_2)? $pes->score_team_2 : '0'; ?></td>
                                        <td scope="row" class="text-center"><?= $pes->team_name_2; ?></td>
                                        <td scope="row" class="text-center"><?= $pes->match_time->format('j F Y H:i'); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <?php if($ml_schedules) : ?>
                                <?php foreach($ml_schedules as $k => $ml) : ?>
                                    <tr>
                                        <th scope="row" class="text-center"><?= $ml->game->name; ?></th>
                                        <td scope="row" class="text-center"><?= $ml->team_name_1; ?></td>
                                        <td scope="row" class="text-center"><?= isset($ml->score_team_1)? $ml->score_team_1 : '0'; ?> - <?= isset($ml->score_team_2)? $ml->score_team_2 : '0'; ?></td>
                                        <td scope="row" class="text-center"><?= $ml->team_name_2; ?></td>
                                        <td scope="row" class="text-center"><?= $ml->match_time->format('j F Y H:i'); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <?php if($valorant_schedules) : ?>
                                <?php foreach($valorant_schedules as $k => $valorant) : ?>
                                    <tr>
                                        <th scope="row" class="text-center"><?= $valorant->game->name; ?></th>
                                        <td scope="row" class="text-center"><?= $valorant->team_name_1; ?></td>
                                        <td scope="row" class="text-center"><?= isset($valorant->score_team_1)? $valorant->score_team_1 : '0'; ?> - <?= isset($valorant->score_team_2)? $valorant->score_team_2 : '0'; ?></td>
                                        <td scope="row" class="text-center"><?= $valorant->team_name_2; ?></td>
                                        <td scope="row" class="text-center"><?= $valorant->match_time->format('j F Y H:i'); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <?php if($pubg_schedules) : ?>
                                <?php foreach($pubg_schedules as $k => $pubg) : ?>
                                    <tr>
                                        <th scope="row" class="text-center"><?= $pubg->game->name; ?></th>
                                        <td scope="row" class="text-center" colspan="3"><?= $pubg->map; ?></td>
                                        <td scope="row" class="text-center"><?= $pubg->match_time->format('j F Y H:i'); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <?php if($ff_schedules) : ?>
                                <?php foreach($ff_schedules as $k => $ff) : ?>
                                    <tr>
                                        <th scope="row" class="text-center"><?= $ff->game->name; ?></th>
                                        <td scope="row" class="text-center" colspan="3"><?= $ff->map; ?></td>
                                        <td scope="row" class="text-center"><?= $ff->match_time->format('j F Y H:i'); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div id="showMore m-b-40">
                    <a href="<?= $this->Url->build(['controller' => 'Tournament', 'action' => 'match-schedule']); ?>" class="btn btn-rounded btn-light"><i class="icon-refresh-cw"></i> Lihat Jadwal Lainnya</a>
                </div>
            </div>
            <div class="col-lg-12 m-b-40">
                <!-- Page title -->
                <div class="page-title m-b-40">
                    <h2>Artikel</h2>
                </div>
                <!-- end: Page title -->
                <!-- Blog -->
                <div class="carousel" data-items="3">
                    <?php foreach($highlight as $news) : ?>
                        <!-- Post item-->
                        <div class="post-item border">
                            <div class="post-item-wrap">
                                <div class="post-image">
                                    <a href="<?= $this->Url->build(['controller' => 'News', 'action' => 'view', $news->get('slug')]); ?>">
                                        <?php
                                        $blog_image = $news->get('image') ?
                                            $this->Url->build('/files/Blogs/image/' . $news->get('image'))
                                            : $this->Url->build('/front-assets-new/images/blog/12.jpg');
                                        if ($blog_image) :
                                            ?>
                                            <img src="<?= $blog_image; ?>" alt="">
                                        <?php endif; ?>
                                    </a>
                                    <span class="post-meta-category"><a href="#"><?= $news->tags[0]->name; ?></a></span>
                                </div>
                                <div class="post-item-description">
                                    <span class="post-meta-date"><i class="fa fa-calendar-o"></i><?= $news->created->format('M j, Y'); ?></span>
                                    <h2><a href="<?= $this->Url->build(['controller' => 'News', 'action' => 'view', $news->get('slug')]); ?>"><?= $news->get('title'); ?></a></h2>
<!--                                    <p>Curabitur pulvinar euismod ante, ac sagittis ante posuere ac. Vivamus luctus-->
<!--                                        commodo dolor porta feugiat. Fusce at velit id ligula pharetra laoreet.</p>-->
                                    <a href="<?= $this->Url->build(['controller' => 'News', 'action' => 'view', $news->get('slug')]); ?>" class="item-link">Baca Selengkapnya <i class="icon-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- end: Post item-->
                    <?php endforeach; ?>
                </div>
                    <!-- end: Blog -->
            </div>
            <div id="showMore m-b-40 text-center">
                <a href="<?= $this->Url->build(['controller' => 'News', 'action' => 'index']); ?>" class="btn btn-rounded btn-light text-center"><i class="icon-refresh-cw"></i> Lihat Berita Lainnya</a>
            </div>
        </div>
    </div>
</section>

