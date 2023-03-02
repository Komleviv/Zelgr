
<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$this->registerCssFile('css/restaurants.css');
$this->title = "Ресторанный критик";
$this->params['breadcrumbs'][] = $this->title;

/* @var $this yii\web\View */

 $this->registerJs(
        '$("document").ready(function(){
            $("#search-form-pjax").on("pjax:end", function() {
            $.pjax.reload({container:"#search-result"});  //Обновляем GridView
        });
    });'
  );
?>
<?php Pjax::begin(['id' => 'search-form-pjax']); ?>
  <?php $form = ActiveForm::begin([
          'id' => 'search-form',
          'action' => Url::to(['/restaurants/index']),
          'method' => 'get',
          'options' => ['data-pjax' => true],
  ]); ?>
    <div class="container search" id="container_search"> 
      <div class="basic-search">      
           <div class="input-field">
              <button class="btn-search" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                   <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
                </svg>
              </button>
             <?= $form->field($searchModel, 'rest_name')->textInput()->label(false) ?>
           </div>      
      </div>
      <div class="advance-search" id="advance">
        <span class="desc">Параметры поиска</span>
        <div class="row first">
          <div class="input-field">
            <?  $items = ArrayHelper::map($cuisine,'rest_cuisine_id','rest_cuisine_title'); ?>
            <?= $form->field($searchModel, 'cms_cuisine_id')->dropDownList($items,['prompt'=>'Тип кухни'])->label(false); ?>
           </div>
          <div class="input-field">
            <?  $items = ArrayHelper::map($type,'rest_type_id','rest_type'); ?>
            <?= $form->field($searchModel, 'cms_type_id')->dropDownList($items,['prompt'=>'Тип заведения'])->label(false); ?>
           </div>
           <div class="input-field">
              <?  $items = array(
                  "1" => "1.0",
                  "2" => "2.0",
                  "3" => "3.0",
                  "4" => "4.0",
                  "5" => "5.0",
              ); ?>
              <?= $form->field($type[0], 'rest_type')->dropDownList($items,['prompt'=>'Рейтинг'])->label(false); ?>
           </div>
           <div class="input-field">
            <?   $items = array(
                  "1" => "1 мкр.",
                  "2" => "2 мкр.",
                  "3" => "3 мкр.",
                  "4" => "4 мкр.",
                  "5" => "5 мкр.",
                  "6" => "6 мкр.",
                  "7" => "7 мкр.",
                  "8" => "8 мкр.",
                  "9" => "9 мкр.",
                  "10" => "10 мкр.",
                  "11" => "11 мкр.",
                  "12" => "12 мкр.",
                  "14" => "14 мкр.",
                  "15" => "15 мкр.",
                  "16" => "16 мкр.",
                  "17" => "17 мкр.",
                  "18" => "18 мкр.",
                  "19" => "19 мкр.",
                  "20" => "20 мкр.",
                  "23" => "23 мкр.",
              ); ?>
            <?= $form->field($searchModel, 'rest_district')->dropDownList($items,['prompt'=>'Район'])->label(false); ?>
           </div>
          </div>
          <div class="row second">
           <div class="input-field">
             <div>
              <?=  $form->field($searchModel, 'rest_coffeetogo')->checkbox([
                  'label' => 'Кофе с собой 	&#9749;',
                  'labelOptions' => [
                      'style' => 'padding-left:20px;'
                  ],
                  'uncheck' => null
              ]); ?>
             </div>
           </div>
           <div class="input-field">
             <div>
                 <?//  $form->field($searchModel, 'rest_breakfast')->checkbox([
                   // 'label' => 'Завтрак &#129360;',
                   // 'labelOptions' => [
                   //     'style' => 'padding-left:20px;'
                   // ],
                   // 'uncheck' => null
              //  ]); ?>
             </div>
           </div>
           <div class="input-field">
             <div>
               <input type="checkbox" id="checkbox_breakfast" name="checkbox_breakfast" class="checkbox_search">
               <label for="checkbox_breakfast">Бизнес-ланч &#127858;</label>
             </div>
           </div>
            <div class="input-field">
             <div>
                <?=  $form->field($searchModel, 'rest_delivery')->checkbox([
                  'label' => 'Доставка &#128666;',
                  'labelOptions' => [
                      'style' => 'padding-left:20px;'
                  ],
                  'uncheck' => null
              ]); ?>
             </div>
           </div>
           <div class="input-field">
             <div>
                <?=  $form->field($searchModel, 'rest_veranda')->checkbox([
                  'label' => 'Веранда &#9970;',
                  'labelOptions' => [
                      'style' => 'padding-left:20px;'
                  ],
                  'uncheck' => null
              ]); ?>
             </div>
           </div>   
          </div>
          <div class="row second line">
           <div class="input-field">
             <div>
               <?=  $form->field($searchModel, 'rest_playground')->checkbox([
                  'label' => 'Детская игровая комната &#127904;',
                  'labelOptions' => [
                      'style' => 'padding-left:20px;'
                  ],
                  'uncheck' => null
              ]); ?>
             </div>
           </div>
           <div class="input-field">
             <div>
               <?=  $form->field($searchModel, 'rest_craft')->checkbox([
                  'label' => 'Крафтовое пиво &#127866;',
                  'labelOptions' => [
                      'style' => 'padding-left:20px;'
                  ],
                  'uncheck' => null
              ]); ?>
             </div>
           </div> 
           <div class="input-field">
             <div>
               <?=  $form->field($searchModel, 'rest_dark_kitchen')->checkbox([
                  'label' => 'Dark kitchen &#128104;',
                  'labelOptions' => [
                      'style' => 'padding-left:20px;'
                  ],
                  'uncheck' => null
              ]); ?>
             </div>
           </div>
          </div>
          <div class="row third">
           <div class="input-field">
            <div class="result-count">
              <span><? ?></span>заведений</div>
              <div class="group-btn">
                 <?= Html::resetButton('Сбросить', ['class' => 'btn-search']); ?>
                 <?= Html::submitButton('Искать', ['class' => 'btn-search']); ?>
              </div>
           </div>
          </div>
        </div> 
    </div>
  <?php ActiveForm::end(); ?>
<?php Pjax::end(); ?>
<script>
  // Скрипт отображения/скрытия меню поиска
  jQuery(function($){
    $(document).mouseup( function(e){ // событие клика по веб-документу
      var div = $( "#container_search" ); // id формы поиска
      var advance = $('.advance-search');
      if ( !div.is(e.target) // если клик был не по блоку с поиском
          && div.has(e.target).length === 0 ) { // и не по его дочерним элементам
            advance.hide(444); // скрываем его (скорость скрытия)
      } else {
            advance.show(444); // отображаем его (скорость отображения)
      }
    });
  });
</script>

<? Pjax::begin(['id' => 'search-result']); ?>
  <?= ListView::widget([
      'dataProvider' => $dataProvider,
//       'filterModel' => $searchModel,
      'layout' => "{items}\n{summary}\n<div>{pager}</div>",
      'itemView' => '_form',
//       'options' => [
//           'tag' => 'div',
//           'class' => 'news-list',
//           'id' => 'news-list',
//       ],
      'itemOptions' => [
                'tag' => 'div',
                'class' => 'rest_list',
            ],
      'emptyText' => 'Заведения не найдены',
      ]); 
  ?>
<? Pjax::end(); ?>
