<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Restaurants */

$this->title = 'Редактирование ресторана: ' . $model->rest_name;
$this->params['breadcrumbs'][] = ['label' => 'Ресторанный критик', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="restaurants-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('update_form', [
        'model' => $model,
        'cuisine' => $cuisine,
        'type' => $type,
    ]) ?>

</div>
