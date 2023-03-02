<?php

namespace common\models;

use yii\db\ActiveRecord;
use common\models\RestaurantType;

use Yii;

/**
 * This is the model class for table "restaurant_type_link".
 *
 * @property int $cms_restaurant_type_id
 * @property int $cms_restaurant_id
 * @property int $cms_type_id
 */
class RestaurantTypeLink extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'restaurant_type_link';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cms_restaurant_id', 'cms_type_id'], 'required'],
            [['cms_restaurant_id', 'cms_type_id'], 'integer'],
            [['rest_type'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cms_restaurant_type_id' => 'Cms Restaurant Type ID',
            'cms_restaurant_id' => 'Cms Restaurant ID',
            'cms_type_id' => 'Cms Type ID',
            'rest_type' => 'Тип',
        ];
    }
  
    public function getRestaurantType()
    {
        return $this->hasMany(restaurantType::className(), ['rest_type_id' => 'cms_type_id']); // RestaurantType =>  RestaurantTypeLink
    }
}
