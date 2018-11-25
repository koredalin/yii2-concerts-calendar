<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\Concert]].
 *
 * @see \app\models\Concert
 */
class ConcertQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \app\models\Concert[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\Concert|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
	
	public function getNewestConcerts() {
		$sqlStr = "SELECT c.`id`, c.`date`, c.`location`, c.`description`, b.`band_name`, country.`country_name` AS country
                FROM concert AS c
                INNER JOIN band AS b
                ON c.`band_id` = b.`id`
                INNER JOIN country
                ON c.`country_id` = country.`id`
                WHERE c.`updated_at` >= DATE_SUB(NOW(), INTERVAL 2 HOUR);";
		return \Yii::$app->db->createCommand($sqlStr)
						->queryAll();
	}
}
