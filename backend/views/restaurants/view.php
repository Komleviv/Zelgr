<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Restaurants */

$this->title = $model->rest_name;
$this->params['breadcrumbs'][] = ['label' => 'Ресторанный критик', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="restaurants-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'rest_verif',
            'rest_open',
            'rest_name',
            'rest_hits',
            'rest_img',
            'resr_img_name',
            'rest_desc:ntext',
            'rest_adres',
            'rest_tel',
            'rest_site',
            'rest_seat',
            'rest_avr_bill',
            'rest_wifi',
            'rest_cards',
            'rest_forkids',
            'rest_parking',
            'rest_map',
            'rest_feature',
            'rest_additional',
        ],
    ]) ?>

</div>
