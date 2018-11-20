<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Concert */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Concerts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="concert-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'date',
            [
                'attribute' => 'band',
                'Label' => 'Band',
                'value' => $model->band->band_name,
            ],
            'location',
            [
                'attribute' => 'country',
                'Label' => 'Country',
                'value' => $model->country->name,
            ],
            'description:ntext',
            [
                'attribute' => 'has_photo',
                'value' => $model->has_photo ? 'Yes' : 'No',
            ],
            'created_at',
            'updated_at',
            [
                'attribute' => 'band_photo',
                'format' => 'raw',
                'value' => $model->has_photo ? Html::img('@web/'.$model->photo_file_path, array('alt' => 'Server Band Concert Photo.', 'class' => 'viewBandConcertPhoto')) : '',
            ],
        ],
    ]) ?>

</div>
