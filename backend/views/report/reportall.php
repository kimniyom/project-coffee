
<?php

use app\models\Menu;
use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\Options;
use kartik\select2\Select2;
use app\models\Type;
use yii\helpers\ArrayHelper;
use app\models\Menu as menus;
/* @var $this yii\web\View */
/* @var $searchModel app\models\OrderlistSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$Options = new Options();
$this->title = 'การขายทั้งหมด';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-4 col-lg-4">
        <label>ประเภท</label>
        <select id="type" class="form-control">
            <option value="">== ทั้งหมด ==</option>
        </select>
    </div>
    <div class="col-md-4 col-lg-4">
        <label>เมนู</label>
        <?php
        // Multiple select without model
        echo Select2::widget([
            'name' => 'menu',
            'value' => '',
            'data' => ArrayHelper::map(menus::find()->all(), 'id', 'menu'),
            'theme' => Select2::THEME_BOOTSTRAP, // this is the default if theme is not set
            'options' => [
                 'id' => 'menu',
                'multiple' => true,
                'placeholder' => 'Select states ...'
            ]
        ]);
        ?>
    </div>
    <div class="col-md-4 col-lg-4">
        <label>ประเภท</label>
        <select id="type" class="form-control">
            <option value="">== ทั้งหมด ==</option>
        </select>
    </div>
</div>

<div class="orderlist-index">
    <h2><i class="fa fa-file-text-o"></i> <?= Html::encode($this->title) ?></h2>
    <div class="box box-default">
        <div class="box-body">
            <table class=" table table-striped" id="reportall">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ประเภท</th>
                        <th>รายการ</th>
                        <th style=" text-align: right;">ราคา</th>
                        <th style="text-align: center;">วันที่</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sum = 0;
                    $i = 0;
                    $sumProduct = 0;
                    foreach ($datas as $rs): $i++;
                        $dataOptions = $Options->Getdata($rs['order'], $rs['menu'], $rs['id']);
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $rs['typename'] ?></td>
                            <td>
                                <?php echo $rs['menuname'] ?>
                                <?php
                                $OptionsPrice = 0;
                                foreach ($dataOptions as $op):
                                    echo "<br/>+ " . $op['optionsname'] . "(" . $op['price'] . ")";
                                    $OptionsPrice = $OptionsPrice + $op['price'];
                                endforeach;
                                $sumProduct = ($rs['price'] + $OptionsPrice);
                                $sum = $sum + $sumProduct;
                                ?>
                            </td>
                            <td style=" text-align: right;"><?php echo number_format($sumProduct, 2) ?></td>
                            <td style="text-align: center;"><?php echo $rs['create_date'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" style=" text-align: center; font-weight: bold;">รวม</td>
                        <td style=" text-align: right; font-weight: bold;"><?php echo number_format($sum, 2) ?></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<?php
$this->registerJs('
        $(document).ready(function () {
        $("#reportall").DataTable();
    });')
?>
