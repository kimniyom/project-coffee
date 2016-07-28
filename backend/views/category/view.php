<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Category;

$cat = new Category();
/* @var $this yii\web\View */
/* @var $model app\models\Category */

$this->title = $model->cat_name;
$this->params['breadcrumbs'][] = ['label' => 'หมวดสินค้า', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-view">
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
<div class="panel panel-default">
        <div class="panel-heading">
            <h4><?= Html::encode($this->title) ?></h4>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        </div>
        <div class="panel-body">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'cat_name',
            [                      // the owner name of the model
            'label' => 'status',
            'value' => $cat->getstatus($model->status),
        ],
        ],
    ]) ?>
        </div>
</div>
</div>
