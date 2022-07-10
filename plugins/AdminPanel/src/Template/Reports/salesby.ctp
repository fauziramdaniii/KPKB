<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $withdrawals
 * nevix
 */
?>

<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title"><?= __('Sales Users'); ?></h3>
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
    <?php  echo $this->Flash->render();?>
    <?= $this->Form->create(null, ['id'=>'form-filter', 'class' => 'kt-form', 'templates' => 'AdminPanel.app_form', 'novalidate']); ?>
    <div class="form-group row">
        <label class="col-form-label col-lg-3 col-sm-12">Filtering Range Reports</label>
        <div class="col-lg-4">
            <div class='input-group pull-right' id='kt_daterangepicker'>
                <input type='text' class="form-control"  id="date" name="date" readonly  placeholder="Select date range" value="<?= @$date; ?>"/>
                <div class="input-group-append">
                    <span class="input-group-text"><i class="la la-calendar-check-o"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <button type="submit" class="btn btn-brand" id="filter">Filter</button>
        </div>
    </div>
    <?= $this->Form->end(); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="kt-portlet kt-portlet--height-fluid">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title"><?= __('Sales Users'); ?></h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            <div class="dropdown dropdown-inline">
                                <button type="button" class="btn btn-default btn-bold btn-upper btn-font-sm  btn-export">
                                    <i class="la la-download"></i> Export
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <?= $this->Flash->render() ?>

                    <div class="table-responsive">
                        <table class="table table-hover table-striped" id="report_sales">
                            <thead>
                            <tr>
                                <th>Username</th>
                                <th>Total</th>
                                <th>Request Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($data as $value):?>
                                <tr>
                                    <td><?= $value['customer']['username'];?></td>
                                    <td>
										<?= $this->Number->precision($value['gross_total'],2);?>

									</td>
                                    <td><?= $value['created'];?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->append('script'); ?>
<script>

    var KTBootstrapDaterangepicker = {
        init: function() {
            ! function() {
                var t = moment().subtract(29, "days"),
                    a = moment();
                $("#kt_daterangepicker").daterangepicker({
                    buttonClasses: "btn btn-sm",
                    applyClass: "btn-primary",
                    cancelClass: "btn-secondary",
                    startDate: moment().subtract(6, "days"),
                    endDate: moment(),
                    ranges: {
                        Today: [moment(), moment()],
                        Yesterday: [moment().subtract(1, "days"), moment().subtract(1, "days")],
                        "Last 7 Days": [moment().subtract(6, "days"), moment()],
                        "Last 30 Days": [moment().subtract(29, "days"), moment()],
                        "This Month": [moment().startOf("month"), moment().endOf("month")],
                        "Last Month": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")]
                    }
                }, function(t, a, e) {
                    $("#kt_daterangepicker .form-control").val(t.format("YYYY-MM-DD") + " - " + a.format("YYYY-MM-DD"))
                })
            }()
        }
    };

    jQuery(document).ready(function() {
        KTBootstrapDaterangepicker.init();

            $(".btn-export").click(function(){
                $("#report_sales").table2excel({
                    exclude: ".noExl",
                    name: "Excel Document Name"
                });
            });


    });
</script>
<?php $this->end(); ?>



