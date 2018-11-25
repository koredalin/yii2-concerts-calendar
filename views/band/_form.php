<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Band */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="band-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'band_name')->textInput(['maxlength' => true]) ?>

    <?php // echo $form->field($model, 'created_at')->textInput(); ?>

    <?php // echo $form->field($model, 'updated_at')->textInput(); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
