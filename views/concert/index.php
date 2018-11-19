<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ConcertSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Concerts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="concert-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Concert'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'label' => 'Date',
                'attribute' => 'date',
                'format' => 'raw',
                'value' => function ($data) {
                    return date('j F Y', strtotime($data->date));
                },
            ],
            [
                'label' => 'Band Name',
                'attribute' => 'bandName',
                'filter' => Html::activeInput('text', $searchModel, 'bandName', ['class' => 'form-control']),
                'format' => 'raw',
                'value' => function ($data) {
                    return $data->band->name;
                },
            ],
            [
                'label' => 'Location',
                'attribute' => 'location',
                'format' => 'raw',
                'value' => function ($data) {
                    return $data->location . ' (' . $data->country->iso_abbr . ')';
                },
            ],
            [
                'label' => 'Thumbnail Photo',
                'attribute' => 'has_photo',
                'format' => 'raw',
                'value' => function ($data) {
                    return $data->has_photo ? 'yes' : 'no';
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
