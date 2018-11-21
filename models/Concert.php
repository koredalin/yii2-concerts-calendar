<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "concert".
 *
 * @property int $id
 * @property string $date
 * @property int $band_id
 * @property string $location
 * @property int $country_id
 * @property string $description
 * @property string $has_photo
 * @property string $photo_file_path
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Band $band
 * @property Country $country
 */
class Concert extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'concert';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date', 'band_id', 'location', 'country_id', 'description', 'has_photo'], 'required'],
            [['date'], 'date', 'format' => 'yyyy-MM-dd'],
            [['date', 'created_at', 'updated_at'], 'safe'],
            [['band_id', 'country_id', 'has_photo'], 'integer'],
            [['description'], 'string'],
            [['location'], 'string', 'max' => 255],
            [['photo_file_path'], 'string', 'max' => 50],
            [['band_id'], 'exist', 'skipOnError' => true, 'targetClass' => Band::className(), 'targetAttribute' => ['band_id' => 'id']],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['country_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'date' => Yii::t('app', 'Date'),
            'band_id' => Yii::t('app', 'Band ID'),
            'location' => Yii::t('app', 'Location'),
            'country_id' => Yii::t('app', 'Country'),
            'description' => Yii::t('app', 'Description'),
            'has_photo' => Yii::t('app', 'Has Photo'),
            'photo_file_path' => Yii::t('app', 'Photo File Path'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBand()
    {
        return $this->hasOne(Band::className(), ['id' => 'band_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'country_id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\ConcertQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\ConcertQuery(get_called_class());
    }
    
    public static function deleteBandPhoto($photoPath)
    {
        $photoPath = trim($photoPath);
        if (is_file($photoPath)) {
            unlink($photoPath);
        }
    }
}
