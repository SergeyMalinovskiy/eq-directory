<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Section\SectionCategory */

$this->title = 'Create Section Category';
$this->params['breadcrumbs'][] = ['label' => 'Section Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="section-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
