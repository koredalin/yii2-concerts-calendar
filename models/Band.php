<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "band".
 *
 * @property int $id
 * @property string $band_name
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Concert[] $concerts
 */
class Band extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'band';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['band_name'], 'required'],
            [['band_name'], 'string', 'max' => 255],
            [['band_name'], 'unique'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'band_name' => Yii::t('app', 'Band Name'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConcerts()
    {
        return $this->hasMany(Concert::className(), ['band_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\BandQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\BandQuery(get_called_class());
    }
}
