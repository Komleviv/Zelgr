<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Restaurants;

/**
 * RestaurantsSearch represents the model behind the search form of `common\models\Restaurants`.
 */
class RestaurantsSearch extends Restaurants
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'rest_verif', 'rest_open', 'rest_hits', 'rest_wifi', 'rest_parking'], 'integer'],
            [['rest_name', 'rest_desc', 'rest_adres', 'rest_tel', 'rest_site', 'rest_seat', 'rest_avr_bill', 'rest_cards', 'rest_forkids', 'rest_map', 'rest_feature', 'rest_additional'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Restaurants::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'rest_verif' => $this->rest_verif,
            'rest_open' => $this->rest_open,
            'rest_hits' => $this->rest_hits,
            'rest_wifi' => $this->rest_wifi,
            'rest_parking' => $this->rest_parking,
        ]);

        $query->andFilterWhere(['like', 'rest_name', $this->rest_name])
            ->andFilterWhere(['like', 'rest_desc', $this->rest_desc])
            ->andFilterWhere(['like', 'rest_adres', $this->rest_adres])
            ->andFilterWhere(['like', 'rest_tel', $this->rest_tel])
            ->andFilterWhere(['like', 'rest_site', $this->rest_site])
            ->andFilterWhere(['like', 'rest_seat', $this->rest_seat])
            ->andFilterWhere(['like', 'rest_avr_bill', $this->rest_avr_bill])
            ->andFilterWhere(['like', 'rest_cards', $this->rest_cards])
            ->andFilterWhere(['like', 'rest_forkids', $this->rest_forkids])
            ->andFilterWhere(['like', 'rest_map', $this->rest_map])
            ->andFilterWhere(['like', 'rest_feature', $this->rest_feature])
            ->andFilterWhere(['like', 'rest_additional', $this->rest_additional]);

        return $dataProvider;
    }
}
