<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Concert */
/* @var $bandModel app\models\Band */
/* @var $bandPhotoModel app\models\BandPhoto */
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
    echo $form->field($bandPhotoModel, 'imageFile')->fileInput(['id' => 'imageSource']);
    ?>

    <div id="localImagePreview"></div>
    
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
