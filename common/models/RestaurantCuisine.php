<?php

namespace common\models;
use common\models\Restaurants;
use common\models\RestaurantCuisineLink;

use Yii;

/**
 * This is the model class for table "restaurant_cuisine".
 *
 * @property int $id
 * @property string $title
 */
class RestaurantCuisine extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'restaurant_cuisine';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rest_cuisine_title'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'rest_cuisine_id' => 'ID',
            'rest_cuisine_title' => 'Title',
        ];
    }
  
    public function getRestaurants()
    {
        return $this->hasMany(Restaurants::className(), ['cms_restaurant_id' => 'rest_cuisine_id'])
                   ->viaTable(RestaurantСuisineLink::tableName(), ['cms_cuisine_id' => 'id']);
    }
  
    public function getRestaurantCuisineLink()
    {
        return $this->hasMany(RestaurantsCuisineLink::className(), ['cms_cuisine_id' => 'rest_cuisine_id']);
    }
}
