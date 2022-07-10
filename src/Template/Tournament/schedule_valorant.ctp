<section id="page-title" class="text-light" style="background-image:url('<?= $this->Url->build('/front-assets-new/TentangKami_2.png'); ?>'); background-size: cover; background-position: center center;">
    <div class="container">
        <div class="bg-overlay"></div>
        <div class="page-title">
            <h1>Jadwal Pertandingan (Valorant)</h1>
            <span>Piala Gubernur Jawa Barat</span>
        </div>
        <div class="breadcrumb">
            <ul>
                <li><a href="<?= $this->Url->build(['controller' => 'Home', 'action' => 'index' ]); ?>">Beranda</a>
                </li>
                <li class="active"><a href="<?= $this->Url->build(['controller' => 'Tournament', 'action' => 'matchSchedule' ]); ?>">Jadwal Pertandingan</a>
                </li>
            </ul>
        </div>
    </div>
</section>
<?php if($valorant_schedules) : ?>
    <section>
        <div class="container">
            <div class="heading-text heading-section text-center">
                <h2>Jadwal Pertandingan (Valorant)</h2>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center" style="overflow: auto;">
                    <table class="table table-striped table-dark" style="min-width: 800px;">
                        <thead>
                        <tr>
                            <th scope="col" class="text-center">Kategori</th>
                            <th scope="col" class="text-center">Tim 1</th>
                            <th scope="col" class="text-center">Skor</th>
                            <th scope="col" class="text-center">Tim 2</th>
                            <th scope="col" class="text-center">Waktu</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($valorant_schedules as $k => $valorant) : ?>
                            <tr>
                                <th scope="row" class="text-center"><?= $valorant->game->name; ?></th>
                                <td scope="row" class="text-center"><?= $valorant->team_name_1; ?></td>
                                <td scope="row" class="text-center"><?= isset($valorant->score_team_1)? $valorant->score_team_1 : '0'; ?> - <?= isset($valorant->score_team_2)? $valorant->score_team_2 : '0'; ?></td>
                                <td scope="row" class="text-center"><?= $valorant->team_name_2; ?></td>
                                <td scope="row" class="text-center"><?= $valorant->match_time->format('j F Y H:i'); ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
<?php else : ?>
    <section>
        <div class="container">
            <h2 class="text-center">JADWAL BELUM TERSEDIA.</h2>
        </div>
    </section>
<?php endif; ?>
