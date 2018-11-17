<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Concert */
/* @var $bandModel app\models\Band */
/* @var $countryModel app\models\country */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="concert-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'band_id')->textInput() ?>

    <?= $form->field($model, 'location')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'country_id')->textInput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    
    <?php
    // https://www.yiiframework.com/doc/guide/2.0/en/input-file-upload
    // echo $imageForm = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);
    ?>

        <?php echo $imageForm->field($bandModel, 'imageFile')->fileInput(); ?>

        <button>Submit</button>

    <?php // ActiveForm::end() ?>

    <?php 
    // Not used inputs.
    // echo $form->field($model, 'created_at')->textInput();
    // echo $form->field($model, 'updated_at')->textInput();
    ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
