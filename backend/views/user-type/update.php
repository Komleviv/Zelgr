<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\usertype */

$this->title = 'Update Usertype: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Usertypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="usertype-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
