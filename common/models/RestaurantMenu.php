<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "restaurant_menu".
 *
 * @property int $menu_id
 * @property int $menu_rest_id
 * @property string $menu_name
 * @property string $menu_url
 * @property string $menu_update
 */
class RestaurantMenu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'restaurant_menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['menu_rest_id', 'menu_name', 'menu_url'], 'required'],
            [['menu_rest_id'], 'integer'],
            [['menu_update'], 'safe'],
            [['menu_name'], 'string', 'max' => 128],
            [['menu_url'], 'string', 'max' => 256],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'menu_id' => 'Menu ID',
            'menu_rest_id' => 'Menu Rest ID',
            'menu_name' => 'Menu Name',
            'menu_url' => 'Menu Url',
            'menu_update' => 'Menu Update',
        ];
    }
}
