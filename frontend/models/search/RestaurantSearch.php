<?php

namespace frontend\models\search;

use common\models\Restaurants;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

class RestaurantSearch extends Restaurants
{
  public $rest_cuisine_title;
  public $cms_cuisine_id;
  public $rest_type;
  public $cms_type_id;
  
  public function rules()
    {
        return [
            [['id', 'rest_district', 'rest_delivery', 'rest_coffeetogo', 'rest_delivery', 'rest_veranda', 'rest_craft', 'rest_playground', 'rest_dark_kitchen', 'cms_cuisine_id'],'integer'],
            [['rest_name', 'rest_cuisine_title', 'rest_type'],'string'],
        ];
    }
  
  public function search($params)
    {   
      $query = Restaurants::find()->where(['rest_verif' => '1'])->with('restaurantCuisine');
      $countQuery = clone $query;
  
      $dataProvider = new ActiveDataProvider([
          'query' => $query,
          'totalCount' => (int)$countQuery->count(),
          'pagination' => [
              'pageSize' => 6,
          ],
      ]);
    
      $this->load($params);
    
      if (!$this->validate()) {
            return $dataProvider;
        }

        $query->filterWhere(['id' => $this->id]);
        $query->andFilterWhere(['LIKE', 'rest_name', $this->rest_name])
              ->andFilterWhere(['rest_district' => $this->rest_district])
              ->andFilterWhere(['restaurantCuisine.cms_cuisine_id' => $this->cms_cuisine_id])
           //   ->andFilterWhere(['type.cms_type_id' => $this->rest_type])
           //   ->andFilterWhere(['rest_breakfast' => $this->rest_breakfast])
              ->andFilterWhere(['rest_delivery' => $this->rest_delivery])
              ->andFilterWhere(['rest_veranda' => $this->rest_veranda])
              ->andFilterWhere(['rest_coffeetogo' => $this->rest_coffeetogo])
              ->andFilterWhere(['rest_craft' => $this->rest_craft])
              ->andFilterWhere(['rest_playground' => $this->rest_playground])
              ->andFilterWhere(['rest_dark_kitchen' => $this->rest_dark_kitchen]);

        return $dataProvider;    
  }
}

?>