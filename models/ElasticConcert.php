<?php

namespace app\models;

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
    public static function mapping()
    {
        return [
            static::type() => [
                'properties' => [
                    'id'               => ['type' => 'integer'],
                    'date'             => ['type' => 'date'],
                    'band_name'        => ['type' => 'string'],
                    'concert_location' => ['type' => 'string'],
                    'country_name'     => ['type' => 'string'],
                ]
            ],
        ];
    }

    /**
     * Set (update) mappings for this model
     */
    public static function updateMapping()
    {
        $db = static::getDb();
        $command = $db->createCommand();
        $command->setMapping(static::index(), static::type(), static::mapping());
    }

    /**
     * Create this model's index
     */
    public static function createIndex()
    {
        $db = static::getDb();
        $command = $db->createCommand();
        $command->createIndex(static::index(), [
        // Empty php arrays are converted to JSON arrays. Elasticsearch expects JSON object literals.
        // Epmty arrays leads to Java exception: "elasticsearch java.util.ArrayList cannot be cast to java.util.Map".
//            'settings' => [ /* ... */ ],
            'mappings' => static::mapping(),
            //'warmers' => [ /* ... */ ],
            //'aliases' => [ /* ... */ ],
            'creation_date' => date('Y-m-d H:i:s'),
        ]);
    }

    /**
     * Delete this model's index
     */
    public static function deleteIndex()
    {
        $db = static::getDb();
        $command = $db->createCommand();
        $command->deleteIndex(static::index(), static::type());
    }
}
