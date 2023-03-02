<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "restaurant_sch".
 *
 * @property int $sch_id
 * @property int $sch_rest_id
 * @property int $sch_day
 * @property string $sch_from
 * @property string $sch_to
 */
class RestaurantSch extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'restaurant_sch';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sch_rest_id', 'sch_day', 'sch_from', 'sch_to'], 'required'],
            [['sch_rest_id', 'sch_day'], 'integer'],
            [['sch_from', 'sch_to'], 'date'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sch_id' => 'Sch ID',
            'sch_rest_id' => 'Sch Rest ID',
            'sch_day' => 'Sch Day',
            'sch_from' => 'Sch From',
            'sch_to' => 'Sch To',
        ];
    }
}
