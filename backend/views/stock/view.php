<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Category;
use app\models\Unit;
use app\models\Stockproduct;
use common\models\System;

$config = new System();
/* @var $this yii\web\View */
/* @var $model app\models\Stock */

$this->title = "สินค้า";
$this->params['breadcrumbs'][] = ['label' => 'Stocks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stock-view">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4><?= Html::encode($this->title) ?></h4>
        </div>
        <div class="panel-body">

            <?=
            DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    [                      // the owner name of the model
                        'label' => 'สินค้า',
                        'foemat' => 'raw',
                        'value' => Stockproduct::find()->where(['id' => $model->product])->one()->productname,
                    ],
                    [                      // the owner name of the model
                        'label' => 'หมวด',
                        'foemat' => 'raw',
                        'value' => Category::find()->where(['id' => $model->category])->one()->cat_name,
                    ],
                    'number',
                    [                      // the owner name of the model
                        'label' => 'ขนาด',
                        'foemat' => 'raw',
                        'value' => $model->size." ".Unit::find()->where(['id' => $model->size_unit])->one()->unit,
                    ],
                    'total_cut',
                    [                      // the owner name of the model
                        'label' => 'วันที่นำเข้า',
                        'foemat' => 'raw',
                        'value' => $config->Thaidate($model->create_date)
                    ],
                ],
            ])
            ?>
        </div>
    </div>
</div>
