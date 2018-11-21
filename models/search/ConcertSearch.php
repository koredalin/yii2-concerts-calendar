<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Concert;

/**
 * ConcertSearch represents the model behind the search form of `app\models\Concert`.
 */
class ConcertSearch extends Concert
{
    /**
     * @inheritdoc
     */
    // public band_id;
    public $band_name;
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'band_id', 'country_id'], 'integer'],
            [['date', 'location', 'description', 'created_at', 'updated_at', 'band_name'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Concert::find();
        $query->innerJoinWith('band', true);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['attributes' => ['date', 'band_name', 'location']],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
//        var_dump($this->date);
//        var_dump(date('Y-m-d', strtotime($this->date)));
        // grid filtering conditions
        $query->andFilterWhere([
//            'id' => $this->id,
            'date' => (isset($this->date) && trim($this->date) > 0) ? date('Y-m-d', strtotime($this->date)) : null,
//            'date' => $this->date,
//            'band_id' => $this->band_id,
//            'country_id' => $this->country_id,
//            'created_at' => $this->created_at,
//            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'band.name', $this->band_name]);

        return $dataProvider;
    }
}
