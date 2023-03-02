<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\Reviews;
use  common\models\Sellers;
/**
 * ContactForm is the model behind the contact form.
 */
class RatingForm extends Model
{
    public $user_id;
    public $sellers_id;
    public $dignities;
    public $disadvantages;
	public $note;
	public $rate = 0;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
		return [
			[['user_id', 'sellers_id'], 'required'],
			[['dignities', 'disadvantages'], 'string', 'max' => 512],
			[['note'], 'string'],
			[['sellers_id', 'user_id'], 'integer'],
			['rate', 'number'],
        ];
    }
	
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'dignities' => 'Достоинства',
			'disadvantages' => 'Недостатки',
			'note'  => 'отзыв',
			'rate'  => 'Ваша оценка',
        ];
    }
	
	public function save()
    {
        if($this->rate && (int)$this->rate > 0)
		{
			$rate = new Rating([
				'user_id' => $this->user_id,
				'sellers_id' => $this->sellers_id,
				'rate' => $this->rate,
			]);
			if(!$rate->validate())
			{
				foreach ($rate->errors as $key => $value)
				{
					Yii::$app->session->setFlash('danger', 'Ошибка: '.$value[0]);
					break;
				}
				return false;
			} else {
				$save = $rate->save();	
			}
			$seller = Sellers::findOne($this->sellers_id);
			$seller->rate = Rating::Calck($this->sellers_id);
			if(!$seller->validate())
			{
				foreach ($seller->errors as $key => $value)
				{
					Yii::$app->session->setFlash('danger', 'Ошибка: '.$value[0]);
					break;
				}
				return false;
			} else {
				$seller->save();
			}
		}
		
		if(!empty($this->dignities) && !empty($this->disadvantages))
		{
			$reviews = new Reviews([
				'user_id' => $this->user_id,
				'sellers_id' => $this->sellers_id,
				'dignities' => $this->dignities,
				'disadvantages' => $this->disadvantages,
				'note' => $this->note,
			]);
			if(!$reviews->validate())
			{
				foreach ($reviews->errors as $key => $value)
				{
					Yii::$app->session->setFlash('danger', 'Ошибка: '.$value[0]);
					break;
				}
				return false;
			}  else {
				$save = $reviews->save();	
			}
		}
		if($save){
			Yii::$app->session->setFlash('success', 'Ваше мнение учтено');
			return true;
		} else {
			Yii::$app->session->setFlash('danger', 'Что то пошло не так повторите попытку позже');
			return false;
		}
		
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    public function sendEmail($email)
    {
        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
            ->setReplyTo([$this->email => $this->name])
            ->setSubject($this->subject)
            ->setTextBody($this->body)
            ->send();
    }
}
