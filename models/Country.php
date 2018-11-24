<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "country".
 *
 * @property int $id
 * @property string $country_name
 * @property string $iso_abbr
 * @property string $un_abbr
 * @property string $dialing_code
 *
 * @property Concert[] $concerts
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'country';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['country_name', 'iso_abbr', 'un_abbr', 'dialing_code'], 'required'],
            [['country_name'], 'string', 'max' => 100],
            [['iso_abbr'], 'string', 'max' => 2],
            [['un_abbr'], 'string', 'max' => 3],
            [['dialing_code'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'country_name' => Yii::t('app', 'Country'),
            'iso_abbr' => Yii::t('app', 'Iso Abbr'),
            'un_abbr' => Yii::t('app', 'Un Abbr'),
            'dialing_code' => Yii::t('app', 'Dialing Code'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConcerts()
    {
        return $this->hasMany(Concert::className(), ['country_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\CountryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\CountryQuery(get_called_class());
    }
}
