<?php

namespace app\models\search;
 
use app\models\ElasticConcert;
//use yii\base\Model;
use yii\elasticsearch\ActiveDataProvider;
use yii\elasticsearch\Query;
use yii\elasticsearch\QueryBuilder;
 
/**
* ArticlesSearch represents the model behind the search form about `app\models\Articles`.
*/
class ElasticConcertSearch extends ElasticConcert
 
{
 
   public function Searches($value)
   {
       $searchs      = $value['search'];
       $query        = new Query();
       $db           = ElasticConcert::getDb();
       $queryBuilder = new QueryBuilder($db);
       $match   = ['match' => ['concert_location' =>$searchs]];
       $query->query = $match;
       $build        = $queryBuilder->build($query);
       $re           = $query->search($db, $build);
       $dataProvider = new ActiveDataProvider([
           'query'      => $query,
           'pagination' => ['pageSize' => 10],
       ]);
 
       return $dataProvider;
   }
 
}