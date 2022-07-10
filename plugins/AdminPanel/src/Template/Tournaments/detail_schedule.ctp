<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $product
 */
?>
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Jadwal Pertandingan</h3>
            <span class="kt-subheader__separator kt-hidden"></span>
            <div class="kt-subheader__breadcrumbs">
                <?= $this->Breadcrumb->display($BreadCrumbCrumbs);?>
            </div>
        </div>
    </div>
</div>
<!-- end:: Subheader -->

<!-- begin:: Content -->
<div class="kt-container  kt-grid__item kt-grid__item--fluid">
    <div class="row">
        <div class="col-lg-12">

            <div class="kt-portlet kt-portlet--height-fluid">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title"><?= __('Rincian Jadwal Pertandingan') ?></h3>
                    </div>
                </div>
                <?= $this->Form->create($schedule,['class' => 'kt-form', 'templates' => 'AdminPanel.app_form', 'novalidate', 'type' => 'file']); ?>
                <div class="kt-portlet__body">
                    <div class="row">
                        <?php
                        echo $this->Flash->render();
                        $default_class = 'form-control';
                        $this->Form->setConfig('errorClass', 'is-invalid');
                        ?>
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="input text form-group row">
                                <label class="col-form-label col-lg-3">Jenis Cabor</label>
                                <div class="col-lg-8"><input type="text"  class="form-control" disabled="disabled" value="<?php echo $schedule->game->name; ?>">
                                </div>
                            </div>
                            <div class="input text form-group row">
                                <label class="col-form-label col-lg-3">Nama Pertandingan</label>
                                <div class="col-lg-8"><input type="text"  class="form-control" disabled="disabled" value="<?php echo $schedule->name; ?>">
                                </div>
                            </div>
                            <div class="input text form-group row">
                                <label class="col-form-label col-lg-3">Tim 1</label>
                                <div class="col-lg-8"><input type="text"  class="form-control" disabled="disabled" value="<?php echo $schedule->team_name_1; ?>">
                                </div>
                            </div>
                            <div class="input text form-group row">
                                <label class="col-form-label col-lg-3">Skor Tim 1</label>
                                <div class="col-lg-8"><input type="text"  class="form-control" disabled="disabled" value="<?php echo $schedule->score_team_1; ?>">
                                </div>
                            </div>
                            <div class="input text form-group row">
                                <label class="col-form-label col-lg-3">Tim 2</label>
                                <div class="col-lg-8"><input type="text"  class="form-control" disabled="disabled" value="<?php echo $schedule->team_name_2; ?>">
                                </div>
                            </div>
                            <div class="input text form-group row">
                                <label class="col-form-label col-lg-3">Skor Tim 2</label>
                                <div class="col-lg-8"><input type="text"  class="form-control" disabled="disabled" value="<?php echo $schedule->score_team_2; ?>">
                                </div>
                            </div>
                            <div class="input text form-group row">
                                <label class="col-form-label col-lg-3">Waktu Pertandingan</label>
                                <div class="col-lg-8"><input type="text"  class="form-control" disabled="disabled" value="<?= $schedule->match_time->format('Y-m-d H:i'); ?>">
                                </div>
                            </div>
                            <div class="input text form-group row">
                                <label class="col-form-label col-lg-3">Keterangan Pertandingan</label>
                                <div class="col-8">
                                    <textarea class="form-control" placeholder="Keterangan Pertandingan" required="required" id="description" rows="5" disabled><?= $schedule->description; ?></textarea>
                                </div>
                            </div>
                            <div class="input text form-group row">
                                <label class="col-form-label col-lg-3">Status Pertandingan</label>
                                <div class="col-lg-8"><input type="text"  class="form-control" disabled="disabled" value="<?php echo $schedule->match_status->name; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-2">
                            </div>
                            <div class="col-10">
                                <a href="<?= $this->Url->build(['action' => 'schedules', $schedule->game_id]); ?>" class="btn btn-warning ">
                                    <?= __('Kembali') ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?= $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>

<?php $this->append('script'); ?>
<?php
$this->Html->script(['/admin-assets/js/pages/components/forms/layouts/repeater.js'],['block' => true]);
?>
<script>
    $('select').selectpicker();
    var arrows;
    if (KTUtil.isRTL()) {
        arrows = {
            leftArrow: '<i class=\"la la-angle-right\"></i>',
            rightArrow: '<i class=\"la la-angle-left\"></i>'
        }
    } else {
        arrows = {
            leftArrow: '<i class=\"la la-angle-left\"></i>',
            rightArrow: '<i class=\"la la-angle-right\"></i>'
        }
    }

</script>
<?php $this->end(); ?>

