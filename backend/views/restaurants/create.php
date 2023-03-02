<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Restaurants */

$this->title = 'Добавить ресторан';
$this->params['breadcrumbs'][] = ['label' => 'Ресторанный критик', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="restaurants-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('create_form', [
        'model' => $model,
        'cuisine' => $cuisine,
      //  'cuisine_rest' => $cuisine_rest,
    ]) ?>

</div>
