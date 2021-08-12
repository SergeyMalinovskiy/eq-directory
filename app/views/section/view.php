<?php

use app\models\Section;
use app\services\SectionService;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Section */
/* @var $includedContent array */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Sections', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$includedSections   = array_filter($includedContent, function($el) { return $el['type'] === 'section'; });
$includedEquipments = array_filter($includedContent, function($el) { return $el['type'] === 'equipment'; });

?>
<div class="section-view">

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
            /*[
                'attribute' => 'category_id',
                'value' => function(Section $el) {
                    $category = SectionService::getSectionCategoryNameById($el->category_id);

                    return $category;
                }
            ],*/
            'responsible_group_id',
            'created_at',
            'updated_at',
        ],
    ]) ?>

    <div>
        <?php if(isset($includedSections) && count($includedSections) > 0): ?>
            <h3>Разделы</h3>
            <div class="list-group">
                <?php foreach($includedSections as $item): ?>
                    <a href="<?= Url::toRoute(['/section/view', 'id' => $item['id']])?>" class="list-group-item list-group-item-action">
                        <?= $item['name']?>
                    </a>
                <?php endforeach?>
            </div>
        <?php endif ?>
    </div>

    <div>
        <?php if(isset($includedEquipments) && count($includedEquipments) > 0): ?>
            <h3>Оборудование</h3>
            <div class="list-group">
                <?php foreach($includedEquipments as $item): ?>
                    <a href="<?= Url::toRoute(['/equipment/view', 'id' => $item['id']])?>" class="list-group-item list-group-item-action">
                        <?= $item['title']?>
                    </a>
                <?php endforeach?>
            </div>
        <?php endif ?>
    </div>
</div>
