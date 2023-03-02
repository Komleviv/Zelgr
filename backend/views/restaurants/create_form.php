<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
//use kartik-v\yii2-widget-fileinput\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\Restaurants */
/* @var $form yii\widgets\ActiveForm */

//$items_cus = \yii\helpers\ArrayHelper::map($cuisine,'id','title');
?>

<div class="restaurants-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'rest_verif')->checkbox([
        'label' => 'Проверен',
        'labelOptions' => [
            'style' => 'padding-left:20px;']
    ]); ?>

    <?= $form->field($model, 'rest_open')->checkbox([
        'label' => 'Работает',
        'labelOptions' => [
            'style' => 'padding-left:20px;']
    ]); ?>

    <?= $form->field($model, 'rest_name')->textInput(['maxlength' => true])->label('Название ресторана') ?>

    <?= $form->field($model, 'rest_desc')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'rest_adres')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rest_tel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rest_site')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rest_seat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rest_avr_bill')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rest_wifi')->checkbox([
        'label' => 'Бесплатный Wi-Fi',
        'labelOptions' => [
            'style' => 'padding-left:20px;']
    ]); ?>

    <?= $form->field($model, 'rest_cards')->textInput(['maxlength' => true]) ?>
  
     <?= $form->field($model, 'rest_forkids')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rest_parking')->textInput() ?>

    <?= $form->field($model, 'rest_map')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rest_feature')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rest_additional')->textInput(['maxlength' => true]) ?>

<div class="nvc-form">
 
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
	
 
 
</div>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
