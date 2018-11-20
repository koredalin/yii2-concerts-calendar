<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use app\models\Band;
use kartik\select2\Select2;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model app\models\Concert */
/* @var $bandModel app\models\Band */
/* @var $bandPhotoModel app\models\BandPhoto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="concert-form">
    <div id="concertLeftInputs">
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

        <div><strong>Date</strong></div>
        <div class="inner-addon right-addon">
            <i class="glyphicon glyphicon-calendar"></i>
            <?php
            echo DatePicker::widget([
                'model' => $model,
                'attribute' => 'date',
                'dateFormat' => 'yyyy-MM-dd',
                'options' => ['class' => 'form-control'],
            ]);
            ?>
        </div>

        <?php
        // Default Band Name Input
    //    echo $form->field($bandModel, 'name')->textInput();

        // Krajee Select2 Band Name Input
        $url = \yii\helpers\Url::to(['/band/namelist']);// Get the initial band description
        $bandName = empty($bandModel) ? '' : $bandModel->name;
        echo $form->field($bandModel, 'name')->widget(Select2::classname(), [
            'initValueText' => $bandName, // set the initial display text
            'options' => ['placeholder' => 'Search for a band ...'],
            'pluginOptions' => [
                'tags' => true,
                'allowClear' => true,
                'minimumInputLength' => 3,
                'language' => [
                    'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
                ],
                'ajax' => [
                    'url' => $url,
                    'dataType' => 'json',
                    'data' => new JsExpression('function(params) { return {q:params.term}; }')
                ],
                'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                'templateResult' => new JsExpression('function(band) { return band.text; }'),
                'templateSelection' => new JsExpression('function (band) { return band.text; }'),
            ],
        ]);
        ?>

        <?= $form->field($model, 'location')->textInput(['maxlength' => true]) ?>

        <?php
    //  Default Countries select
    //  echo $form->field($model, 'country_id')->
    //            dropDownList($countries, ['class' => 'form-control', 'prompt' => 'Choose a country',]);

        // Normal select with ActiveForm & model
        echo $form->field($model, 'country_id')->widget(Select2::classname(), [
            'data' => $countries,
    //        'language' => 'de',
            'options' => ['placeholder' => 'Select a country ...'],
            'pluginOptions' => [
                'allowClear' => false
            ],
        ]);
        ?>

        <?php
        // https://www.yiiframework.com/doc/guide/2.0/en/input-file-upload
        echo $form->field($bandPhotoModel, 'imageFile')->fileInput(['id' => 'imageSource']);
        ?>
    </div>

    <div id="localImagePreview">
        <?php
        if (is_file($model->photo_file_path)) {
            echo Html::img('@web/'.$model->photo_file_path, array('alt' => 'Server Band Concert Photo.'));
        }
        ?>
    </div>
    <div style="clear: both;"></div>
    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
    
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
