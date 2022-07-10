
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title"><?= __('Income Report'); ?></h3>
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
        <div class="col-lg-4">
            <button type="submit" class="btn btn-brand">Filter</button>
        </div>
    </div>
    <?= $this->Form->end(); ?>


    <div class="row">
        <div class="col-lg-12">
            <!--begin::Portlet-->
            <div class="kt-portlet kt-portlet--height-fluid">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title"><?= __('Income Report'); ?></h3>
                    </div>
                </div>
                <div class="kt-portlet__body kt-portlet__body--fluid">
                    <div class="kt-widget-9">
                        <div class="kt-widget-9__chart">
                            <div id="chartdiv" style="width: 100%;height: 500px;"></div>
                        </div>
                    </div>
                </div>


                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">Report Counter</h3>
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
                <div class="kt-portlet__body kt-portlet__body--fluid">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped" id="report_sales">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Total Cashpoint</th>
                                <!--                                --><?php //foreach($transaction_list as $product):?>
                                <!--                                    <th>--><?//= $product;?><!--</th>-->
                                <!--                                --><?php //endforeach;?>
                                <!--                                <th>Total</th>-->
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($reports as $report):?>
                                <tr>
                                    <td><?= $report['date'];?></td>
                                    <?php $total = 0;?>
                                    <?php foreach($transaction_list as $key => $product):?>
                                        <?php $total += $report[$key];?>
                                        <td><?= $this->Number->precision($report[$key],2);?></td>
                                    <?php endforeach;?>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                            <thead>
                                <tr>
                                    <th style="border: none;"><br></th>
                                </tr>
                            </thead>
                            <thead>
                            <tr>
                                <th>Total Bonus Cashpoint</th>
                                <th>Total Bonus Pensiun</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><?= $list_total_cashpoint['Total'] ? $this->Number->precision($list_total_cashpoint['Total'],2) : 0;?></td>
                                <?php $bonus_pensiun = $list_total_cashpoint['Total'] * 0.0075; ?>
                                <td><?= $bonus_pensiun ? $this->Number->precision($bonus_pensiun,2) : 0;?></td>
                            </tr>
                            </tbody>
                            <thead>
                            <tr>
                                <th>Bonus Pensiun berdasarkan tanggal (Klaim)</th>
                                <th>Bonus Pensiun berdasarkan tanggal (Belum Di Klaim)</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <?php $bonus_pensiun_claim = $list_total_cashpoint['Claim'] * 0.0075; ?>
                                <td><?= $bonus_pensiun_claim ? $this->Number->precision($bonus_pensiun_claim,2) : 0;?></td>
                                <?php $bonus_pensiun_notClaim = $list_total_cashpoint['notClaim'] * 0.0075; ?>
                                <td><?= $bonus_pensiun_notClaim ? $this->Number->precision($bonus_pensiun_notClaim,2) : 0;?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--end::Portlet-->

        </div>
    </div>
</div>

<?= $this->Html->script([
    '/js/amchart/core.js',
    '/js/amchart/charts.js',
    '/js/amchart/themes/animated.js',
],['block' => true])?>

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
                    },
                }, function(t, a, e) {
                    $("#kt_daterangepicker .form-control").val(t.format("YYYY-MM-DD") + " - " + a.format("YYYY-MM-DD"))
                })
            }()
        }
    };


    jQuery(document).ready(function() {
        KTBootstrapDaterangepicker.init()


        $(".btn-export").click(function(){
            $("#report_sales").table2excel({
                exclude: ".noExl",
                name: "Excel Document Name"
            });
        });

        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end

        // Create chart instance
        var chart = am4core.create("chartdiv", am4charts.XYChart);

        //

        // Increase contrast by taking evey second color
        chart.colors.step = 2;

        // Add data
        chart.data = generateChartData();

        // Create axes
        var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
        dateAxis.renderer.minGridDistance = 50;

        // Create series
        function createAxisAndSeries(field, name, opposite, bullet) {
            var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
            if(chart.yAxes.indexOf(valueAxis) != 0){
                valueAxis.syncWithAxis = chart.yAxes.getIndex(0);
            }

            var series = chart.series.push(new am4charts.LineSeries());
            series.dataFields.valueY = field;
            series.dataFields.dateX = "date";
            series.strokeWidth = 2;
            series.yAxis = valueAxis;
            series.name = name;
            series.tooltipText = "{name}: [bold]{valueY}[/]";
            series.tensionX = 0.8;
            series.showOnInit = true;

            var interfaceColors = new am4core.InterfaceColorSet();

            switch(bullet) {
                case "triangle":
                    var bullet = series.bullets.push(new am4charts.Bullet());
                    bullet.width = 12;
                    bullet.height = 12;
                    bullet.horizontalCenter = "middle";
                    bullet.verticalCenter = "middle";

                    var triangle = bullet.createChild(am4core.Triangle);
                    triangle.stroke = interfaceColors.getFor("background");
                    triangle.strokeWidth = 2;
                    triangle.direction = "top";
                    triangle.width = 12;
                    triangle.height = 12;
                    break;
                case "rectangle":
                    var bullet = series.bullets.push(new am4charts.Bullet());
                    bullet.width = 10;
                    bullet.height = 10;
                    bullet.horizontalCenter = "middle";
                    bullet.verticalCenter = "middle";

                    var rectangle = bullet.createChild(am4core.Rectangle);
                    rectangle.stroke = interfaceColors.getFor("background");
                    rectangle.strokeWidth = 2;
                    rectangle.width = 10;
                    rectangle.height = 10;
                    break;
                default:
                    var bullet = series.bullets.push(new am4charts.CircleBullet());
                    bullet.circle.stroke = interfaceColors.getFor("background");
                    bullet.circle.strokeWidth = 2;
                    break;
            }

            valueAxis.renderer.line.strokeOpacity = 1;
            valueAxis.renderer.line.strokeWidth = 2;
            valueAxis.renderer.line.stroke = series.stroke;
            valueAxis.renderer.labels.template.fill = series.stroke;
            valueAxis.renderer.opposite = opposite;
        }

        var products = JSON.parse('<?= json_encode($transaction_list);?>');

        $.each(products,function(k,v){
            createAxisAndSeries(k, v, false, "rectangle");
        });

        // Add legend
        chart.legend = new am4charts.Legend();

        // Add cursor
        chart.cursor = new am4charts.XYCursor();

        function generateChartData() {
            var data = JSON.parse('<?= json_encode($reports);?>');
            for (var i=0; i<data.length; i++){
                data[i].date = new Date(data[i].date);
            }
            return data;
        }

    });


</script>
<?php $this->end(); ?>
