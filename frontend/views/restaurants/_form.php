<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
?>

<a href='<?= Url::to(['restaurants/view', 'id' => $model->id]); ?>' class='rest_list_href'> 
   <div>
      <img src='/frontend/views/restaurants/img/<?= $model->id; ?>/thm/thm.jpg' class='rest_list_img'>
   </div>
   <div class='rest_list_name'><h4><?= $model->rest_name; ?></h4></div>
   <div class='rest_list_district'><?= $model->rest_district; ?> мкр.</div>
   <div class='rest_list_type'></div>
</a>


