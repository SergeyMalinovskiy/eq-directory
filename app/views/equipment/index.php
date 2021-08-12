<?php

use app\models\Equipment\Equipment;
use app\services\SectionService;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\Equipment\EquipmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Оборудование';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipment-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить оборудование', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= /*$this->render('_search', ['model' => $searchModel, 'sections' => $sections]);*/'' ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            [
                'attribute' => 'pid',
                'format' => 'raw',
                'value' => function(Equipment $el) {
                    $parentSectionName = SectionService::getSectionNameById($el->pid);
                    return $el->pid != 0 
                        ? Html::a($parentSectionName, [Url::toRoute(['section/view', 'id' => $el->pid])])
                        : $parentSectionName;
                }
            ],
            'comment:ntext',
            'serial_number',
            'lan_ports_count',
            //'uplink_ports_count',
            //'mgt_ipv4_address',
            //'monsys_ipv4_address',
            //'creator_id',
            //'category_id',
            //'responsible_group_id',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
