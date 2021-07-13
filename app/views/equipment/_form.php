<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Equipment\Equipment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="equipment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'serial_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lan_ports_count')->textInput() ?>

    <?= $form->field($model, 'uplink_ports_count')->textInput() ?>

    <?= $form->field($model, 'mgt_ipv4_address')->textInput() ?>

    <?= $form->field($model, 'monsys_ipv4_address')->textInput() ?>

    <?= $form->field($model, 'pid')->dropDownList($existingSections)->label('Родительский раздел') ?>

    <?= $form->field($model, 'responsible_group_id')->textInput() ?>

    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
