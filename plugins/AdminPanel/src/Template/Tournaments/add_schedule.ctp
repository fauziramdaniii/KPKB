<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $productUnit
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
                        <h3 class="kt-portlet__head-title"><?= __('Tambah Jadwal Pertandingan') ?></h3>
                    </div>
                </div>
                <?= $this->Form->create($schedule,['class' => 'kt-form', 'templates' => 'AdminPanel.app_form', 'novalidate']); ?>
                <div class="kt-portlet__body">
                    <?php
                    echo $this->Flash->render();
                    $default_class = 'form-control';
                    $this->Form->setConfig('errorClass', 'is-invalid');
                        echo $this->Form->control('games',['class' => $default_class, 'id' => 'jenis-game', 'label' => 'Jenis Cabor', 'value' => $game->name, 'readonly' => 'readonly']);
                        echo $this->Form->control('name',['class' => $default_class, 'label' => 'Nama Pertandingan', 'placeholder' => 'Nama Pertandingan']);
                    ?>

                    <?php if($game->id == '1' || $game->id == '2' || $game->id == '5') : ?>

                        <div class="form-group row one-on-one">
                            <label class="col-form-label col-2">Tim 1</label>
                            <div class="col-7">
                                <input type="text" name="team_name_1" class="form-control" placeholder="Nama Tim Pertama" id="team_name_1" />
                            </div>
                        </div>
                        <div class="form-group row one-on-one">
                            <label class="col-form-label col-2">Tim 2</label>
                            <div class="col-7">
                                <input type="text" name="team_name_2" class="form-control" placeholder="Nama Tim Kedua" id="team_name_2" />
                            </div>
                        </div>

                    <?php elseif ($game->id == '3' || $game->id == '4') : ?>

                        <div class="form-group row many-to-many">
                            <label class="col-form-label col-2">Map</label>
                            <div class="col-7">
                                <input type="text" name="map" class="form-control" placeholder="Nama Map" id="map" />
                            </div>
                        </div>

                    <?php endif; ?>

                    <div class="form-group row">
                        <label class="col-form-label col-2">Waktu Pertandingan</label>
                        <div class="col-7">
                            <div class="input-group date">
                                <input type="text" name="match_time" class="form-control" placeholder="Pilih Tanggal (mm/dd/yyyy)" id="kt_datetimepicker_3" required="required"/>
                                <div class="input-group-append">
									<span class="input-group-text">
										<i class="la la-calendar-check-o"></i>
									</span>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-form-label col-2">Keterangan Pertandingan</label>
                        <div class="col-7">
                            <textarea name="description" class="form-control" placeholder="Keterangan Pertandingan" required="required" id="description" rows="5"></textarea>
                        </div>
                    </div>

                    <?php
                    echo $this->Form->control('match_status_id',['type' => 'select', 'options' => $status, 'empty' => 'Pilih Status Pertandingan', 'class' => $default_class, 'label' => 'Status Pertandingan']);
                    ?>

                </div>

                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-2">
                            </div>
                            <div class="col-10">
                                <button type="submit" class="btn btn-success">Tambahkan</button>
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
$this->Html->script(['/admin-assets/js/pages/components/forms/widgets/bootstrap-datetimepicker.js'],['block' => true]);
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

    $('#match_time').datepicker({
        rtl: KTUtil.isRTL(),
        todayHighlight: true,
        orientation: "bottom left",
        templates: arrows,
    });

</script>
<?php $this->end(); ?>

