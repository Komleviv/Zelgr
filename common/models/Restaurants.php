<?php

namespace common\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\base\Behavior;
use yii\db\Expression;
use common\models\RestaurantCuisine;
use common\models\RestaurantCuisineLink;
use common\models\RestaurantType;
use common\models\RestaurantTypeLink;
use common\models\RestaurantSch;

/**
 * This is the model class for table "restaurant".
 *
 * @property int $id
 * @property int $rest_verif
 * @property int $rest_open
 * @property string $rest_name
 * @property int $rest_hits
 * @property string $rest_img
 * @property string $resr_img_name
 * @property string $rest_desc
 * @property string $rest_adres
 * @property string $rest_tel
 * @property string $rest_site
 * @property string $rest_seat
 * @property string $rest_avr_bill
 * @property int $rest_wifi
 * @property string $rest_cards
 * @property string $rest_forkids
 * @property int $rest_parking
 * @property string $rest_map
 * @property string $rest_feature
 * @property string $rest_additional
 */
class Restaurants extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'restaurant';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rest_verif', 'rest_open', 'rest_district', 'rest_hits', 'rest_wifi', 'rest_parking', 'rest_delivery', 'rest_coffeetogo', 'rest_breakfast', 'rest_veranda', 'rest_craft', 'rest_playground', 'rest_dark_kitchen'], 'integer'],
            [['rest_name', 'rest_desc', 'rest_adres', 'rest_tel', 'rest_site', 'rest_seat', 'rest_avr_bill', 'rest_cards', 'rest_parking', 'rest_map', 'rest_feature', 'rest_additional'], 'required'],
            [['rest_desc'], 'string'],
            [['rest_name', 'rest_tel', 'rest_site', 'rest_instagram', 'rest_avr_bill'], 'string', 'max' => 128],
            [['rest_oid', 'rest_cards'], 'string', 'max' => 32],
            [['rest_adres', 'rest_feature', 'rest_forkids', 'rest_menu_link'], 'string', 'max' => 256],
            [['rest_seat', 'rest_map'], 'string', 'max' => 64],
            [['rest_additional'], 'string', 'max' => 512],
        ];
    }
  
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'rest_date_create',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'rest_date_update',
                ],
                'value' => new Expression('NOW()'), // unix timestamp
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rest_verif' => 'Проверен',
            'rest_open' => 'Открыт',
            'rest_name' => 'Название',
            'rest_hits' => 'Количество просмотров',
            'rest_desc' => 'Описание',
            'rest_adres' => 'Адрес',
            'rest_district' => 'Район',
            'rest_tel' => 'Телефон',
            'rest_site' => 'Сайт',
            'rest_instagram' => 'Instagram',
            'rest_seat' => 'Количество посадочных мест',
            'rest_avr_bill' => 'Средний счёт',
            'rest_wifi' => 'Wifi',
            'rest_cards' => 'Банковские карты',
            'rest_menu_link' => 'Ссылка на меню',
            'rest_breakfast' => 'Завтрак',
            'rest_delivery' => 'Доставка',
            'rest_veranda' => 'Веранда',
            'rest_coffeetogo' => 'Кофе с собой',
            'rest_craft' => 'Крафтовое пиво',
            'rest_playground' => 'Детсткая игровая комната',
            'rest_forkids' => 'Для детей',
            'rest_dark_kitchen' => 'Dark kitchen',
            'rest_parking' => 'Парковка',
            'rest_map' => 'Координаты',
            'rest_oid' => 'ID карточки организации в Яндекс',
            'rest_feature' => 'Rest Feature',
            'rest_additional' => 'Rest Additional',
            'rest_date_create' => 'Дата создания',
            'rest_date_update' => 'Дата обновления',
        ];
    }
  
   public static function getRestaurants()
    {
      $connection = \Yii::$app->db;
      $sql = "SELECT id, rest_name FROM restaurant WHERE rest_verif = 1 and rest_open = 1 ORDER BY rest_name";
      $command = $connection->createCommand($sql);
      $result = $command->queryAll();
    return $result;
    }
  
   // Выбор разновидностей кухни, представленной в ресторане
    public function getRestaurantCuisine()
    {
         return $this->hasMany(RestaurantCuisine::class, ['rest_cuisine_id' => 'cms_cuisine_id'])
           ->viaTable('restaurant_cuisine_link', ['cms_restaurant_id' => 'id']);
    }
  
    // Выбор типов ресторана
    public function getRestaurantType()
    {
         return $this->hasMany(RestaurantType::class, ['rest_type_id' => 'cms_type_id'])
           ->viaTable('restaurant_type_link', ['cms_restaurant_id' => 'id']);
    }
  
    // Выбор расписания конкретного заведения
    public function getRestaurantSch()
    {
         return $this->hasMany(RestaurantSch::tableName(), ['sch_rest_id' => 'id']);
    }
}
