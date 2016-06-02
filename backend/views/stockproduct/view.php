<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Category;

/* @var $this yii\web\View */
/* @var $model app\models\Stockproduct */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Stockproducts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stockproduct-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])
        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'productname',
            [                      // the owner name of the model
                'label' => 'หมวด',
                'foemat' => 'raw',
                'value' => Category::find()->where(['id' => $model->category])->one()->cat_name,
                    ],
                    'create_date',
                ],
            ])
            ?>

</div>
