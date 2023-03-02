<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "restaurant_sch_din".
 *
 * @property int $din_id
 * @property int $din_rest_id
 * @property int $din_day
 * @property string $din_from
 * @property string $din_to
 */
class RestaurantSchDin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'restaurant_sch_din';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['din_id', 'din_rest_id', 'din_day', 'din_from', 'din_to'], 'required'],
            [['din_id', 'din_rest_id', 'din_day'], 'integer'],
            [['din_from', 'din_to'], 'string', 'max' => 5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'din_id' => 'Din ID',
            'din_rest_id' => 'Din Rest ID',
            'din_day' => 'Din Day',
            'din_from' => 'Din From',
            'din_to' => 'Din To',
        ];
    }
}
