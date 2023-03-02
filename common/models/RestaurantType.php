<?php

namespace common\models;

use Yii;
use common\models\RestaurantTypeLink;

/**
 * This is the model class for table "restaurant_type".
 *
 * @property int $id
 * @property string $rest_type
 * @property string $rest_type_code
 */
class RestaurantType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'restaurant_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rest_type', 'rest_type_code'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rest_type' => 'Rest Type',
            'rest_type_code' => 'Rest Type Code',
        ];
    }
  
    public function getRestaurantTypeLink()
    {
        return $this->hasMany(restaurantTypeLink::className(), ['cms_type_id' => 'rest_type_id']); // RestaurantType =>  RestaurantTypeLink
    }
}
