<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\Country]].
 *
 * @see \app\models\Country
 */
class CountryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \app\models\Country[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\Country|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
	
	public static function getAllCountries() {
		$sqlStr = 'SELECT `id`, `country_name` FROM country';
		return \Yii::$app->db->createCommand($sqlStr)
						->queryAll();
	}
	
	public static function getAllCountriesDropdown() {
        $sqlArr = self::getAllCountries();
        $dropdownCountries = array();
        if (!is_array($sqlArr) || empty($sqlArr)) {
            return $dropdownCountries;
        }
        foreach ($sqlArr as $country) {
            $dropdownCountries[$country['id']] = $country['country_name'];
        }
        return $dropdownCountries;
	}
}
