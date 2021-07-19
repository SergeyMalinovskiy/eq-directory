<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Section */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="section-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('Наименование') ?>

    <?= $form->field($model, 'pid')->dropDownList($existingSections)->label('Родительский раздел') ?>

    <?= $form->field($model, 'creator_id')->textInput() ?>

    <?= $form->field($model, 'category_id')->dropDownList($existingSectionCategory)->label('Тип раздела') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
