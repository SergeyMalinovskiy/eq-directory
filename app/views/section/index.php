<?php
/* @var $this yii\web\View */
/*  @var $this yii\web\View 
    @var $dataProvider yii\data\ActiveDataProvider
*/

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="my-3">
    <div class="">
        <h3>Разделы</h3>
    </div>
    <hr>

    <div class="row mx-1 mb-2">
        <?= Html::a('Добавить раздел', Url::toRoute(['/section/create']), ['class' => 'btn btn-outline-primary']) ?>
    </div>

    <?php if ($dataProvider->totalCount) : ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider
        ]) ?>
    <?php else : ?>
        <div class="alert alert-warning" role="alert">
            Empty!
        </div>
    <?php endif ?>

