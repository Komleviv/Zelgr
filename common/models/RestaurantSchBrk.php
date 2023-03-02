<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "restaurant_sch_brk".
 *
 * @property int $brk_id
 * @property int $brk_rest_id
 * @property int $brk_day
 * @property string $brk_from
 * @property string $brk_to
 */
class RestaurantSchBrk extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'restaurant_sch_brk';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['brk_id', 'brk_rest_id', 'brk_day', 'brk_from', 'brk_to'], 'required'],
            [['brk_id', 'brk_rest_id', 'brk_day'], 'integer'],
            [['brk_from', 'brk_to'], 'string', 'max' => 5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'brk_id' => 'Brk ID',
            'brk_rest_id' => 'Brk Rest ID',
            'brk_day' => 'Brk Day',
            'brk_from' => 'Brk From',
            'brk_to' => 'Brk To',
        ];
    }
}
