<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Restaurants */
/* @var $form yii\widgets\ActiveForm */

//$cuisines = \yii\helpers\ArrayHelper::map($cuisine,'cms_restaurant_cuisine_id','rest_cuisine_title');
echo $cuisine['rest_cuisine_title'];
//$types = \yii\helpers\ArrayHelper::map($type,'cms_restaurant_type_id','rest_type');
echo $cuisine['rest_type'];
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

    <?= $form->field($model, 'rest_hits')->textInput() ?>
  
    <?= $form->field($model, 'cms_cuisine_id')->dropDownList($cuisines, ['prompt' => 'Выберите категорию'], [
                                                          'multiple' => 'multiple'
                                                      ])->label('Кухня') ?>

    <?= $form->field($model, 'rest_img')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'resr_img_name')->textInput(['maxlength' => true]) ?>

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


    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
