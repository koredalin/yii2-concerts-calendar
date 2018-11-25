<?php

namespace app\models;

use Yii;
use yii\elasticsearch\ActiveRecord as ElasticActiveRecord;

/**
 * Description of ElasticConcert
 *
 * @author Hristo
 */
class ElasticConcert extends ElasticActiveRecord
{
    public function attributes()
    {
        return [
            'id', 'concert_date', 'band_name', 'concert_location', 'country_name',
        ];
    }
    
    
    
    /**
     * @return array This model's mapping
     */
//    public static function mapping()
//    {
//        return [
//            static::type() => [
//                'properties' => [
//                    'date'           => ['type' => 'string'],
//                    'band_name'    => ['type' => 'string'],
//                    'location' => ['type' => 'string'],
//                    'country_name'     => ['type' => 'string'],
//                ]
//            ],
//        ];
//    }

    /**
     * Set (update) mappings for this model
     */
//    public static function updateMapping()
//    {
//        $db = static::getDb();
//        $command = $db->createCommand();
//        $command->setMapping(static::index(), static::type(), static::mapping());
//    }

    /**
     * Create this model's index
     */
//    public static function createIndex()
//    {
//        $db = static::getDb();
//        $command = $db->createCommand();
//        $command->createIndex(static::index(), [
//            'settings' => [ /* ... */ ],
//            'mappings' => static::mapping(),
//            //'warmers' => [ /* ... */ ],
//            //'aliases' => [ /* ... */ ],
//            //'creation_date' => '...'
//        ]);
//    }

    /**
     * Delete this model's index
     */
//    public static function deleteIndex()
//    {
//        $db = static::getDb();
//        $command = $db->createCommand();
//        $command->deleteIndex(static::index(), static::type());
//    }
}
