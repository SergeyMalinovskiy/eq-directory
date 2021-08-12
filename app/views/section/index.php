<?php
/* @var $this yii\web\View */
/*  @var $this yii\web\View 
    @var $dataProvider yii\data\ActiveDataProvider
*/

use app\models\Section;
use app\services\SectionService;
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
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
    
                'id',
                'name',
                [
                    'attribute' => 'pid',
                    'format' => 'raw',
                    'value' => function(Section $el) {
                        $parentSectionName = SectionService::getSectionNameById($el->pid);
                        return $el->pid != 0 
                            ? Html::a($parentSectionName, [Url::toRoute(['section/view', 'id' => $el->pid])])
                            : $parentSectionName;
                    }
                ],
                'creator_id',
                'created_at',
                //'updated_at',
    
                ['class' => 'yii\grid\ActionColumn'],
            ]
        ]) ?>
    <?php else : ?>
        <div class="alert alert-warning" role="alert">
            Empty!
        </div>
    <?php endif ?>

