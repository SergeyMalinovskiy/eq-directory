<?php

use app\models\Equipment\Equipment;
use app\models\Section;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Equipment\Equipment */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Equipments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="equipment-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'comment:ntext',
            'serial_number',
            'lan_ports_count',
            'uplink_ports_count',
            'mgt_ipv4_address',
            'monsys_ipv4_address',
            [
                'attribute' => 'pid',
                'format' => 'raw',
                'value' => function(Equipment $el) {
                    return Html::a(Equipment::getParentSectionName($el->pid), Url::toRoute(['/section/view', 'id' => $el->pid]));
                }
            ],
            'creator_id',
            'category_id',
            'responsible_group_id',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
