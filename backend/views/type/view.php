<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\form\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Type */

$this->title = $model->typename;
$this->params['breadcrumbs'][] = ['label' => 'ประเภท', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-view">
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
                    'typename',
                ],
            ])
            ?>

            <hr/>
            <h4>เพิ่ม Options</h4>
            <div class="type-form">

                <div class="row">
                    <div class="col-md-10 col-lg-10">
                        <input type="text" id="typename" class="form-control" placeholder="กรอกข้อมูล ..."/>
                    </div>
                    <div class="col-md-2 col-lg-2">
                        <button type="button" class="btn btn-success btn-block" onclick="save()">เพิ่ม</button>
                    </div>
                </div>
                
                <hr/>
                
                <div id="resultoptions"></div>
                
            </div>
        </div>
    </div>
</div>

<?php
    $this->registerJs('
        loadoptions();
            ');
?>

<script type="text/javascript">
    
    function save() {
        var url = "<?php echo Url::to(['type/createoptions']) ?>";
        var typename = $("#typename").val();
        var upper = "<?php echo $model->id ?>";
        var data = {
            typename: typename,
            upper: upper
        };

        if (typename == '') {
            $("#typename").focus();
            return false;
        }

        $.post(url, data, function (success) {
            loadoptions();
        });
    }
    
    function loadoptions(){
        var url = "<?php echo Url::to(['type/loadoptions']) ?>";
        var upper = "<?php echo $model->id ?>";
        var data = {
            upper: upper
        };

        $.post(url, data, function (result) {
            $("#resultoptions").html(result);
        });
    }
</script>
