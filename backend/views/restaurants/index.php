<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Restaurants;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\RestaurantsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ресторанный критик';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="restaurants-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать новое заведение', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
             'class' => 'yii\grid\CheckboxColumn',
             'header' => 'Проверен',
             'checkboxOptions' => function ($model, $key, $index, $column) {
                $options1['onclick'] = 'restVerif('.$model->id.');';
                $options1['checked'] = $model->rest_verif ? true : false;
                return $options1;
             }
          ],
          [
             'class' => 'yii\grid\CheckboxColumn',
             'header' => 'Открыт',
             'checkboxOptions' => function ($model, $key, $index, $column) {
                $options2['onclick'] = 'restOpen('.$model->id.');';
                $options2['checked'] = $model->rest_open ? true : false;
                return $options2;
             }
          ],
            'rest_name',
            'rest_hits',
            //'rest_img',
            //'resr_img_name',
            //'rest_desc:ntext',
            'rest_adres',
            'rest_tel',
            'rest_site',
            //'rest_seat',
            //'rest_avr_bill',
            //'rest_wifi',
            'rest_cards',
            //'rest_forkids',
            //'rest_parking',
            //'rest_map',
            //'rest_feature',
            //'rest_additional',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
<script>      
    function restVerif(id){
    $.ajax({
        type: 'GET',
        url: '/backend/web/restaurants/verif',
        data: {id: id},
        success: function(result){
            console.log(result);
        }
      });
    }
     
    function restOpen(id){
    $.ajax({
        type: 'GET',
        url: '/backend/web/restaurants/open',
        data: {id: id},
        success: function(result){
            console.log(result);
        }
      });
    }
</script>