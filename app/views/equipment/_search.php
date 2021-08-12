<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\EquipmentAsset;

EquipmentAsset::register($this);

/* @var $this yii\web\View */
/* @var $model app\models\Equipment\EquipmentSearch */
/* @var $form yii\widgets\ActiveForm */

$model->sections = 0;

?>

<div class="equipment-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'sections')->dropDownList($sections, ['id' => 'sectionsDropDown'])->label('Выберите корпус') ?>

    <div style="display: none" id="sectionDropDownWrapper1">
        <?= $form->field($model, 'sections')->dropDownList([], ['id' => 'sectionsDropDown1'])->label('Выберите %type%') ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
