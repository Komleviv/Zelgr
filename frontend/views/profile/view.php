<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\PermissionHelpers;

/**
* @var yii\web\View $this
* @var app\models\Profile $model
*/

$this->title = "Профиль " . $model->user->username;
$this->params['breadcrumbs'][] = ['label' => 'Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="profile-view">
	<h1><?= Html::encode($this->title) ?></h1>
	<p>
		<?Php
		 
		//this is not necessary but in here as example

		if (PermissionHelpers::userMustBeOwner('profile', $model->id)) {
			echo Html::a('Изменить', ['update', 'id' => $model->id],
								   ['class' => 'btn btn-primary']);
		} ?>

		<?= Html::a('Удалить', ['delete', 'id' => $model->id], [
			'class' => 'btn btn-danger',
			'data' => [
				'confirm' => Yii::t('app', 'Вы уверены, что хотите удалить свой профиль?'),
				'method' => 'post',
			],
		]) ?>
	</p>
	
	<?= DetailView::widget([
		'model' => $model,
		'attributes' => [
			//'id',
			'user.username',
			'first_name',
			'last_name',
			'birthdate',
			'gender.gender_name',
			'created_at',
			'updated_at',
			//'user_id',
		],
	]) ?>
</div>
