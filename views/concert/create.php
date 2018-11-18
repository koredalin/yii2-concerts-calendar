<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Concert */

$this->title = Yii::t('app', 'Create Concert');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Concerts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="concert-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'bandModel' => $bandModel,
        'bandPhotoModel' => $bandPhotoModel,
        'countries' => $countries,
    ]) ?>

</div>
