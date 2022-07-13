<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Dashboard</h3>
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
    <?php /*
    <?= $this->Form->create(null, ['class' => 'kt-form', 'templates' => 'AdminPanel.app_form', 'novalidate']); ?>
    <div class="form-group row">
        <label class="col-form-label col-lg-3 col-sm-12">Filtering Range Reports</label>
        <div class="col-lg-4">
            <div class='input-group pull-right' id='kt_daterangepicker'>
                <input type='text' class="form-control"  name="date" readonly  placeholder="Select date range" value="<?= @$date; ?>"/>
                <div class="input-group-append">
                    <span class="input-group-text"><i class="la la-calendar-check-o"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-1">
             <button type="submit" class="btn btn-brand">Filter</button>
        </div>
    </div>
    <?= $this->Form->end(); ?>

    <?php if(@$config_report):?>
        <div class="row">
            <div class="col-lg-12">
                <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">Report Counter</h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body kt-portlet__body--fluid">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Information Report</th>
                                    <th>Value</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $grandTotal = 0;?>
                                <?php foreach($config_report as $report):?>
                                <tr>
                                    <td><?= $report['name'];?></td>
                                    <td><?= $this->Number->format($report['amount']);?></td>
                                    <td><?= $this->Number->format($report['qty']);?></td>
                                    <?php
                                        $total = $report['qty'] * $report['amount'];
                                        $grandTotal += $total;
                                    ?>
                                    <td><?= $this->Number->format($total);?></td>
                                </tr>
                                <?php endforeach;?>
								<!--
                                <tr>
                                    <td colspan="3" class="text-right">Grand Total</td>
                                    <td><?= $this->Number->format($grandTotal);?></td>
                                </tr>
								-->
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    <?php endif;?>
    <?php */ ?>

    <div class="row">
        <div class="col-lg-6 col-xl-6 order-lg-1 order-xl-1">
            <!--begin::Portlet-->
            <div class="kt-portlet kt-portlet--height-fluid">
                <div class="kt-portlet__head kt-portlet__head--noborder">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title"><?= __('Total Berita');?></h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            <?= $this->Html->link('<i class="la la-arrow-right"></i>',['controller' => 'Blogs', 'action' => 'index'], ['class' => 'btn btn-clean btn-sm btn-icon btn-icon-md', 'escape' => false]);?>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body kt-portlet__body--fluid">
                    <div class="kt-widget-18">
                        <div class="kt-widget-18__summary">
                            <div class="kt-widget-18__total"><?= $this->Number->format($total_berita);?></div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Portlet-->
        </div>
        <div class="col-lg-6 col-xl-6 order-lg-1 order-xl-1">
            <!--begin::Portlet-->
            <div class="kt-portlet kt-portlet--height-fluid">
                <div class="kt-portlet__head kt-portlet__head--noborder">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title"><?= __('Total Pesan');?></h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            <?= $this->Html->link('<i class="la la-arrow-right"></i>',['controller' => 'Messages', 'action' => 'index'], ['class' => 'btn btn-clean btn-sm btn-icon btn-icon-md', 'escape' => false]);?>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body kt-portlet__body--fluid">
                    <div class="kt-widget-18">
                        <div class="kt-widget-18__summary">
                            <div class="kt-widget-18__total"><?= $this->Number->format($total_pesan);?></div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Portlet-->
        </div>
        <div class="col-lg-6 col-xl-6 order-lg-1 order-xl-1">
            <!--begin::Portlet-->
            <div class="kt-portlet kt-portlet--height-fluid">
                <div class="kt-portlet__head kt-portlet__head--noborder">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title"><?= __('Total Video Youtube');?></h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            <?= $this->Html->link('<i class="la la-arrow-right"></i>',['controller' => 'Videos', 'action' => 'index'], ['class' => 'btn btn-clean btn-sm btn-icon btn-icon-md', 'escape' => false]);?>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body kt-portlet__body--fluid">
                    <div class="kt-widget-18">
                        <div class="kt-widget-18__summary">
                            <div class="kt-widget-18__total"><?= $this->Number->format($total_video);?></div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Portlet-->
        </div>
        <div class="col-lg-6 col-xl-6 order-lg-1 order-xl-1">
            <!--begin::Portlet-->
            <div class="kt-portlet kt-portlet--height-fluid">
                <div class="kt-portlet__head kt-portlet__head--noborder">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title"><?= __('Total FAQ');?></h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            <?= $this->Html->link('<i class="la la-arrow-right"></i>',['controller' => 'Faqs', 'action' => 'index'], ['class' => 'btn btn-clean btn-sm btn-icon btn-icon-md', 'escape' => false]);?>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body kt-portlet__body--fluid">
                    <div class="kt-widget-18">
                        <div class="kt-widget-18__summary">
                            <div class="kt-widget-18__total"><?= $this->Number->format($total_faq);?></div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Portlet-->
        </div>
    </div>
    <?php
        $bg = [
            1 => 'kt-bg-success',
            2 => 'kt-bg-danger',
            3 => 'kt-bg-dark',
            4 => 'kt-bg-success'
        ]
    ?>
</div>
<!-- end:: Content -->

<?php $this->append('script'); ?>
<?php
$this->Html->script([
    'https://cdn.amcharts.com/lib/4/core.js',
    'https://cdn.amcharts.com/lib/4/charts.js',
    'https://cdn.amcharts.com/lib/4/themes/animated.js'
],['block' => true]);
?>
    <script>
        var KTBootstrapDaterangepicker = {
            init: function() {
                ! function() {
                    var t = moment().subtract(29, "days"),
                        a = moment();
                    $("#kt_daterangepicker_2").daterangepicker({
                        buttonClasses: "btn btn-sm",
                        applyClass: "btn-primary",
                        cancelClass: "btn-secondary",
                        startDate: t,
                        endDate: a,
                        ranges: {
                            Today: [moment(), moment()],
                            Yesterday: [moment().subtract(1, "days"), moment().subtract(1, "days")],
                            "Last 7 Days": [moment().subtract(6, "days"), moment()],
                            "Last 30 Days": [moment().subtract(29, "days"), moment()],
                            "This Month": [moment().startOf("month"), moment().endOf("month")],
                            "Last Month": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")]
                        }
                    }, function(t, a, e) {
                        $("#kt_daterangepicker_2 .form-control").val(t.format("YYYY-MM-DD") + " - " + a.format("YYYY-MM-DD"))
                    })
                }()
            }
        };
        jQuery(document).ready(function() {
            KTBootstrapDaterangepicker.init()
        });

        am4core.ready(function() {

// Themes begin
            am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
            var chart = am4core.create("chartdiv", am4charts.PieChart);

// Add and configure Series
            var pieSeries = chart.series.push(new am4charts.PieSeries());
            pieSeries.dataFields.value = "total";
            pieSeries.dataFields.category = "tipe";

// Let's cut a hole in our Pie chart the size of 30% the radius
            chart.innerRadius = am4core.percent(30);

// Put a thick white border around each Slice
            pieSeries.slices.template.stroke = am4core.color("#fff");
            pieSeries.slices.template.strokeWidth = 2;
            pieSeries.slices.template.strokeOpacity = 1;
            pieSeries.slices.template
                // change the cursor on hover to make it apparent the object can be interacted with
                .cursorOverStyle = [
                {
                    "property": "cursor",
                    "value": "pointer"
                }
            ];

            pieSeries.alignLabels = false;
            pieSeries.labels.template.bent = true;
            pieSeries.labels.template.radius = 3;
            pieSeries.labels.template.padding(0,0,0,0);

            pieSeries.ticks.template.disabled = true;

// Create a base filter effect (as if it's not there) for the hover to return to
            var shadow = pieSeries.slices.template.filters.push(new am4core.DropShadowFilter);
            shadow.opacity = 0;

// Create hover state
            var hoverState = pieSeries.slices.template.states.getKey("hover"); // normally we have to create the hover state, in this case it already exists

// Slightly shift the shadow and make it more prominent on hover
            var hoverShadow = hoverState.filters.push(new am4core.DropShadowFilter);
            hoverShadow.opacity = 0.7;
            hoverShadow.blur = 5;

// Add a legend
            chart.legend = new am4charts.Legend();

            chart.data = <?php echo json_encode($chart); ?>

        }); // end am4core.ready()
    </script>
<?php $this->end(); ?>
