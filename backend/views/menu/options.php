<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use app\models\Type;
use app\models\Category;
//use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\DepDrop;
use kartik\widgets\Select2;
use app\models\Stockproduct;
use app\models\Unit;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Menu */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-view">
    <div class="panel panel-default">
        <div class="panel-heading">
            <b>ข้อมูลรายการเมนู</b>
            <?= Html::a('แก้ไขเมนู', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-xs']) ?>
            <?=
            Html::a('ลบเมนู', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger btn-xs',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ])
            ?>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3 col-lg-4">
                    <input type="text" value="<?php echo "Menu : " . $model->menu; ?>" class="form-control" readonly="readonly" id="bold-text"/>
                </div>
                <div class="col-md-3 col-lg-4">
                    <?php $type = Type::find()->where(['id' => $model->type])->one()['typename'] ?>
                    <input type="text" value="<?php echo "ประเภท : " . $type; ?>" class="form-control" readonly="readonly" id="bold-text"/>
                </div>
                <div class="col-md-3 col-lg-4">
                    <input type="text" value="<?php echo "วันที่บันทึก : " . $model->create_date; ?>" class="form-control" readonly="readonly" id="bold-text"/>
                </div>
            </div>
        </div>
    </div>

</div>


