<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "rating".
 *
 * @property int $id
 * @property int $user_id
 * @property int $sellers_id
 * @property string $rate
 */
class Rating extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rating';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'sellers_id', 'rate'], 'required'],
            [['user_id', 'sellers_id'], 'integer'],
            [['rate'], 'string', 'max' => 5],
			['user_id', 'validuser'],
        ];
    }
	
	public function validuser($attribute, $params)
	{	
		$user = self::find()->where(['user_id' => $this->user_id])->andWhere(['sellers_id' => $this->sellers_id])->One();
		if ($user) {
			$this->addError($attribute, 'Вы уже голосовали!');
		}
	}

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'sellers_id' => 'Sellers ID',
            'rate' => 'Rate',
        ];
    }
	
	public static function Calck($seller)
	{
		$sum = self::find()->Where(['sellers_id' => $seller])->sum('rate');
		if($sum)
		{
			$count =  self::find()->Where(['sellers_id' => $seller])->count();
			$average = $sum / $count;
		}
		return ($sum) ? $average : 0;
	}
}
