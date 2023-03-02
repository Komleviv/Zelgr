<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\search\RestaurantsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="restaurants-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'rest_verif') ?>

    <?= $form->field($model, 'rest_open') ?>

    <?= $form->field($model, 'rest_name') ?>

    <?= $form->field($model, 'rest_hits') ?>

    <?php // echo $form->field($model, 'rest_img') ?>

    <?php // echo $form->field($model, 'resr_img_name') ?>

    <?php // echo $form->field($model, 'rest_desc') ?>

    <?php // echo $form->field($model, 'rest_adres') ?>

    <?php // echo $form->field($model, 'rest_tel') ?>

    <?php // echo $form->field($model, 'rest_site') ?>

    <?php // echo $form->field($model, 'rest_seat') ?>

    <?php // echo $form->field($model, 'rest_avr_bill') ?>

    <?php // echo $form->field($model, 'rest_wifi') ?>

    <?php // echo $form->field($model, 'rest_cards') ?>

    <?php // echo $form->field($model, 'rest_parking') ?>

    <?php // echo $form->field($model, 'rest_map') ?>

    <?php // echo $form->field($model, 'rest_feature') ?>

    <?php // echo $form->field($model, 'rest_additional') ?>

    <?php // echo $form->field($model, 'comments') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
