<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Setting */

$this->title = "แก้ไขข้อมูลร้าน";
//$this->params['breadcrumbs'][] = ['label' => 'Settings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

class t {

    public function settype($type = null) {
        if ($type == 0) {
            $t = "ขายแบบโต๊ะเดียว";
        } else {
            $t = "ขายแบบเลือกโต๊ะ";
        }

        return $t;
    }

}

$m = new t();
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <?= Html::a('แก้ไข', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </div>
    <div class="col-md-2 col-lg-2" style=" text-align: center;">

        <?= Html::img($model->getPhotoViewer(), ['style' => 'width:100px;', 'class' => 'img-rounded']); ?>

    </div>
    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'shopname',
            [                      // the owner name of the model
                'label' => 'รูปแบบการขาย',
                'foemat' => 'raw',
                'value' => $m->settype($model->defaulttable),
            ],
            //'defaulttable',
            //'logo',
            'wifi',
        ],
    ])
    ?>

</div>
