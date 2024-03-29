<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Concert */

$this->title = 'Upload a Band photo';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Concerts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="concert-view">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($bandPhotoModel, 'imageFile')->fileInput() ?>

    <button>Submit</button>

    <?php ActiveForm::end() ?>

</div>
