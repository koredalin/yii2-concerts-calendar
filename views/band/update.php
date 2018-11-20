<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Band */

$this->title = Yii::t('app', 'Update Band: ' . $model->band_name, [
    'nameAttribute' => '' . $model->band_name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bands'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->band_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="band-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
