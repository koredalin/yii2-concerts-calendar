<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\jui\DatePicker;

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

    <?php
    $dateFilter = '<div class="inner-addon right-addon">'.PHP_EOL;
    $dateFilter .= '<i class="glyphicon glyphicon-calendar"></i>'.PHP_EOL;
    $dateFilter .= DatePicker::widget([
            'model' => $searchModel,
            'attribute' => 'date',
            // https://www.yiiframework.com/extension/yiisoft/yii2-jui/doc/api/2.1/yii-jui-datepicker#$dateFormat-detail
            'dateFormat' => 'php:j F Y',
            'options' => ['class' => 'form-control', 'placeholder' => Yii::t('app', 'Search by date')],
        ]);
    $dateFilter .= '</div>'.PHP_EOL;
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'label' => 'Date',
                'attribute' => 'date',
                'format' => 'raw',
                'filter' => $dateFilter,
                'value' => function ($data) {
                    return date('j F Y', strtotime($data->date));
                },
            ],
            [
                'label' => 'Band Name',
                'attribute' => 'band_name',
                'filter' => Html::activeInput('text', $searchModel, 'band_name', ['class' => 'form-control']),
                'format' => 'raw',
                'value' => function ($data) {
                    return $data->band->band_name;
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
