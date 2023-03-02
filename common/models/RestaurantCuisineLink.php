<?php

namespace common\models;

use yii\db\ActiveRecord;
use common\models\RestaurantCuisine;

use Yii;

/**
 * This is the model class for table "restaurant_cuisine_link".
 *
 * @property int $cms_restaurant_cuisine_id
 * @property int $cms_restaurant_id
 * @property int $cms_cuisine_id
 */
class RestaurantCuisineLink extends ActiveRecord
{
    /**
     * @inheritdoc
     */
  
    public static function tableName()
    {
        return 'restaurant_cuisine_link';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cms_restaurant_id', 'cms_cuisine_id'], 'required'],
            [['cms_restaurant_id', 'cms_cuisine_id'], 'integer'],
            [['rest_cuisine_title'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cms_restaurant_cuisine_id' => 'Cms Restaurant Cuisine ID',
            'cms_restaurant_id' => 'Cms Restaurant ID',
            'cms_cuisine_id' => 'Cms Cuisine ID',
            'rest_cuisine_title' => 'Тип',
        ];
    }
  
    public function getRestaurantCuisine()
    {
        return $this->hasOne(RestaurantCuisine::className(), ['rest_cuisine_id' => 'cms_cuisine_id']); // RestaurantCuisine =>  RestaurantCuisineLink
    }
}
