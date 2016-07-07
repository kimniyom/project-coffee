<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EmployeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'พนักงาน';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-index">
    <div class="panel panel-default">
        <div class="panel-heading"><?= Html::encode($this->title) ?></div>

        <div class="panel-body">
            <p>
                <?= Html::a('Create Employee', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                //'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'id',
                    'name',
                    'lname',
                    'username',
                    'password',
                    // 'resgister',
                    // 'salary',
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]);
            ?>
        </div>
    </div>
</div>
