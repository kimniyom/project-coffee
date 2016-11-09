<?php

use yii\helpers\Url;
//use miloschuman\highcharts\Highcharts;
use app\models\Report;

$Report = new Report();
?>

<style type="text/css">
    #con_menu button{
        margin-bottom: 20px;
    }
</style>
<!--
<div style=" text-align: center;">
    <br/><br/>
    <h1><i class="fa fa-gear"></i> BackOffice DemoCoffee</h1><br/><br/>
</div>

<div class="row" style=" text-align: center;" id="con_menu">
    <div class="col-lg-2"></div>
    <div class="col-sm-6 col-md-6 col-lg-2">
        <a href="<?//php echo Url::to(['stock/index']) ?>">
            <button type="button" class="btn btn-default btn-block">
                <img src="<?//php echo Url::to('@web/images/shop-icon.png') ?>"/><br/>
                Stock สินค้า
            </button></a>
    </div>
    <div class="col-sm-6 col-md-6 col-lg-2">
        <a href="<?//php echo Url::to(['menu/index']) ?>">
            <button type="button" class="btn btn-default btn-block">
                <img src="<?//php echo Url::to('@web/images/food-icon.png') ?>"/><br/>
                เมนูอาหารและเครื่องดื่ม
            </button></a>
    </div>
    <div class="col-sm-6 col-md-6 col-lg-2">
        <a href="<?//php echo Url::to(['report/reportall']) ?>">
            <button type="button" class="btn btn-default btn-block">
                <img src="<?//php echo Url::to('@web/images/seo-icon.png') ?>"/><br/>
                รายงาน
            </button></a>
    </div>
    <div class="col-sm-6 col-md-6 col-lg-2">
        <a href="<?//php echo Url::to(['employee/index']) ?>">
            <button type="button" class="btn btn-default btn-block">
                <img src="<?//php echo Url::to('@web/images/users-icon.png') ?>"/><br/>
                พนักงาน
            </button></a>
    </div>
    <div class="col-lg-2"></div>
</div>
-->
<div class="row">
    <div class="col-sm-12 col-md-6 col-lg-6">
        <div class="box box-success">
            <div class="box-body">
                <div id="container-type"></div>
            </div>
        </div>
    </div>

    <div class="col-sm-12 col-md-6 col-lg-6">
        <div class="box box-warning">
            <div class="box-body">
                <div id="container-table"></div>
            </div>
        </div>
    </div>
</div>

<div class="box box-info">
    <div class="panel-body">
        <div id="container-chart"></div>
    </div>
</div>

<div class="box box-danger">
    <div class="panel-body">
        <div id="container-product" style=" color: #FFFFFF;"></div>
    </div>
</div>


<?php

$Y = date('Y');
$yearnow = ($Y + 543);

$result = $Report->Getincome();
$monrhArr = array();
$totalArr = array();
foreach ($result as $rs):
    $monrhArr[] = "'" . $rs['month_th'] . "'";
    $totalArr[] = $rs['total'];
endforeach;

$cat = implode(",", $monrhArr);
$val = implode(",", $totalArr);


$resultProduct = $Report->Getproduct();
foreach ($resultProduct as $rss):
    $menuArr[] = "'" . $rss['menu'] . "'";
    $totalmenuArr[] = number_format($rss['total'], 2);
endforeach;

$catProduct = implode(",", $menuArr);
$valProduct = implode(",", $totalmenuArr);

$resultType = $Report->GetType();
foreach ($resultType as $rsss):
    $typeArr[] = "{name:'" . $rsss['typename'] . "',y:" . $rsss['total'] . "}";
endforeach;

$catType = implode(",", $typeArr);


$resultTable = $Report->Gettable();
foreach ($resultTable as $rssss):
    //$tableArr[] = "{name:'" . "โต๊ะ ".$rssss['tables'] . "',y:" . $rssss['total'] . "}";
    $tableArr[] = "'โต๊ะ " . $rssss['tables'] . "'";
    $totaltableArr[] = number_format($rssss['total'], 2);
endforeach;

$cattable = implode(",", $tableArr);
$totaltable = implode(",", $totaltableArr);

$this->registerjs("
    $('#container-chart').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: 'ยอดขาย'
        },
        subtitle: {
            text: 'จำแนกรายเดือน'
        },
        xAxis: {
            categories: [" . $cat . "],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'จำนวนเงิน (บาท)'
            }
        },
        tooltip: {
            headerFormat: '<span style=\"font-size:10px\">{point.key}</span><table>',
            pointFormat: '<tr><td style=\"color:{series.color};padding:0\">{series.name}: </td>' +
                '<td style=\"padding:0\"><b>{point.y:.1f} บาท</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'จำนวนยอดขาย',
            //colorByPoint: true,
            color: 'green',
            data: [" . $val . "],
            dataLabels: {
                    enabled: true,
                },
        }]
    });
    
//Chart Product
        
            $('#container-product').highcharts({
        chart: {
            type: 'column'
            
        },
        title: {
            text: 'ยอดขาย',
        },
        subtitle: {
            text: 'จำแนกรายเมนู'
        },
        xAxis: {
            categories: [" . $catProduct . "],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'จำนวน (หน่วย)'
            }
        },
        tooltip: {
            headerFormat: '<span style=\"font-size:10px\">{point.key}</span><table>',
            pointFormat: '<tr><td style=\"color:{series.color};padding:0\">{series.name}: </td>' +
                '<td style=\"padding:0\"><b>{point.y} หน่วย</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0,
            }
        },
        series: [{
            name: 'จำนวน',
            colorByPoint: true,
            data: [" . $valProduct . "],
                dataLabels: {
                    enabled: true,
                    color: '#FFFFFF',
                },
        }]
    });

    //Chart Type
        
    $('#container-type').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        credits: {
            enabled: false
        },
        title: {
            text: 'ยอดขายสินค้าแต่ละประเภทในปี พ.ศ. $yearnow'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y} รายการ</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.y} รายการ',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            name: 'จำนวน',
            colorByPoint: true,
            data: [" . $catType . "]
        }]
    });
    

    //Chart Table
        
    $('#container-table').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: 'ยอดสั่ง'
        },
        subtitle: {
            text: 'แยกตามหมายเลขโต๊ะ'
        },
        xAxis: {
            categories: [" . $cattable . "],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'จำนวน Order'
            }
        },
        tooltip: {
            headerFormat: '<span style=\"font-size:10px\">{point.key}</span><table>',
            pointFormat: '<tr><td style=\"color:{series.color};padding:0\">{series.name}: </td>' +
                '<td style=\"padding:0\"><b>{point.y:.1f} Order</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'เลขโต๊ะ',
            //color: 'red',
            colorByPoint: true,
            data: [" . $totaltable . "],
            dataLabels: {
                enabled: true,
                //color: '#FFFFFF',
            },
        }]
    });

    "
)
?>

