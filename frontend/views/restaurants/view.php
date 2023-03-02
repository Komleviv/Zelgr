<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Carousel;
use mihaildev\ckeditor\CKEditor;
//use kartik\rating\StarRating;

$this->title = $model->rest_name;
 
// $this->params['breadcrumbs'][] = ['label' => 'Ресторанный критик', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>

<? echo $items_cuisine->title; ?>
  <div id="rest">
  <div id="rest_title"><?= $model->rest_name; ?></div>
    <div id="rest_type"><?
 // Получаем типы заведения, если их несколько, перечисляем их через запятую и выводим в скобках за названием заведения    
        foreach($type as $t) {
          if ($type_list == "") {
            $type_list = $t['restaurantType'][0]['rest_type'];  
          } else {
            $type_list .= ", " . $t['restaurantType'][0]['rest_type'];
          }
        } 
        echo " (" . $type_list . ")";
    ?></div>
    <div class="cuisine">
          <?    
            foreach($cuisine as $cu) {
              if ($cuisine_list == "") {
                $cuisine_list = $cu['restaurantCuisine']['rest_cuisine_title'];  
              } else {
                $cuisine_list .= ", " . $cu['restaurantCuisine']['rest_cuisine_title'];
              }
            } 
            echo ucwords($cuisine_list) . " кухня";
          ?>
    </div>
    <div id="rest_cover">
      <? 
        // Берем все изображения в папке для указанного ресторана
        $directory = '../../frontend/views/restaurants/img/'. $model->id . '/';
        $files = glob($directory . '*.jpg');
        $items = array();
        $i=0;
   
        // Формируем матрицу вывода для каждого изображения
        foreach($files as $f) { 
          $style = "background: url('../../" . $f ."') 50% 50% no-repeat; background-size: cover;";
          $items['items'][$i]['content'] .= '<div class="cover_container" style="'.$style.'"></div>';
          $i++;
        }
  
        // подставлем матрицу с изображениями в виджет карусели
        echo Carousel::widget ($items); 
      ?>
    </div>
  <div class="row">
    <div class="col-md-8">
     <div class="rest_desc">
        <h3>О заведении</h3>
       <div>
          <ul class='about_rest'>
            <? if ($model->rest_seat != '') { ?>
            <li id="rest_seat" class="list_desc">
              Количество мест<br><b><? echo $model->rest_seat; ?></b>
            </li><? } ?>
            <? if ($model->rest_avr_bill != '') { ?>
            <li id="rest_avr_bill" class="list_desc">
              Средний чек<br><b><span class="rub"><? echo $model->rest_avr_bill . "&nbsp;₽"; ?></span></b>
            </li><? } ?>
            <li id="rest_cards" class="list_desc">
              Банковские карты<br><b><? if ($model->rest_cards == 1) {
                                            echo "Принимаются";
                                         } else {
                                            echo "Не принимаются";
                                       } ?></b>
            </li>
            <? if (array_key_exists(0, $scheduleBrk)) { ?>
                <li id="rest_brk" class="list_desc">
                  Завтраки<br><b>с <? echo $scheduleBrk[0]['brk_from']; ?> до <? echo $scheduleBrk[0]['brk_to']; ?>
                  </li>
              <?  }
            ?>
          </ul>
       </div>
       <div class='rest_menu'>
          <?
            if (array_key_exists(0, $menu))
            { ?>
              <h3>Меню <? echo $model->rest_name; ?></h3>
            <?  foreach($menu as $me) {?>
         <a href='<? echo $me->menu_url; ?>' target='_blank'><? echo $me->menu_name; ?></a> <span class='menu_time_update'>(обновлено <? echo date('d.m.Y', strtotime($me->menu_update)); ?>)</span><br>
              <?}
            }
          ?>
       </div>
     </div>
       <?php if(!Yii::$app->user->isGuest) : ?>
         <a id="form-togle" class="gradient-button-submit" href="javascript:void(0);">Оставить отзыв</a>
       <?php endif; ?> 
      <section id="reviews-form" class="ptb-30 active" style="display:none">
        <div id="raiting">
            <?php $form = ActiveForm::begin(['id' => 'reviewform']); ?>
          <div class="row">
          <div class="col-sm-6">
            <legend>Достоинства</legend>

          </div>
          <div class="col-sm-6">
            <legend>Недостатки</legend>

          </div>
        </div>
        <div class="clearfix"></div>
          <div class="form-group">
             <? Html::submitButton('Добавить', ['class' => 'btn btn-primary', 'name' => 'review-button']) ?>
           <a id="submit-btn" class="btn btn-primary" href="javascript:void(0);">Добавить</a>
        </div>
        <?php ActiveForm::end(); ?>
        </div>
      </section> 
    </div>
    <div class="col-md-4">
    <div id="rest_cont" class="rest_cont">
      <div id="rest_info">
        <div id="map" style="width: 100%; height: 200px">
        <script src="//api-maps.yandex.ru/2.1/?lang=ru-RU&amp;apikey=1713210c-a293-4e84-bd21-137180858c24&amp;load=package.full"></script>
        <script type="text/javascript">
          ymaps.ready(function () {  
            var myMap = new ymaps.Map("YMapsID", {
              center: [<? echo $model->rest_map; ?>], 
              zoom: 15,
              controls: ['fullscreenControl']
            }),

            myPlacemark = new ymaps.GeoObject({
                // Описание геометрии.
                geometry: {
                    type: "Point",
                    coordinates: [<? echo $model->rest_map; ?>],
                },
                properties: {
                    iconCaption: <? echo "'".$model->rest_name."'"; ?>
                }
            }, {
                // Опции.
                // Иконка метки будет растягиваться под размер ее содержимого.
                preset: 'islands#darkGreenFoodIcon',
                // Метку можно перемещать.
                draggable: false
            });

            myMap.geoObjects.add(myPlacemark);
          });
        </script>
        <div id="YMapsID" style="height: 200px!important;"></div>
     </div>
	      <div id="rest_adr" class="list">
	        <b>Адрес:  </b><a href="yandexmaps://maps.yandex.ru/?oid=<? echo $model->rest_oid; ?>"><br><? echo $model->rest_adres; ?></a>
	      </div>
	      <? if ($model->rest_tel != '') { ?>
          <div id="rest_tel" class="list">
            <b>Телефон:  </b><br><a href="tel:<? echo $model->rest_tel; ?>"><? echo $model->rest_tel; ?></a>
	        </div><? } ?>
	      <? if ($model->rest_site != '') { ?>
          <div id="rest_site" class="list">
	         <b>Сайт:  </b><br><a target="_blank" href="<? echo $model->rest_site; ?>"><? echo $model->rest_site; ?></a>
	        </div><? } ?>
        <? if ($model->rest_instagram != '') { ?>
          <div id="rest_site" class="list">
	         <b>Instagram:  </b><br><a target="_blank" href="https://instagram.com/<? echo $model->rest_instagram; ?>"><? echo $model->rest_instagram; ?></a>
	        </div><? } ?>
          <div id="rest_schedule" class="list">
	         <b>Время работы:  </b><br><?
  // Если ресторан открыт, выводим зелёным время до закрытия
            if ($model->rest_open) {
              foreach($schedule as $s) {
                if (date("H:i") >= $s['sch_from'] and date("H:i") < $s['sch_to']) {
                  $schedule_list = "Открыто до " . date('H:i', strtotime($s['sch_to']));  
                  $schedule_css_class = 'schedule_open';
                } else {
  // Если ресторан закрыт, выводим красным время до открытия
                  $schedule_list .= "Закрыто до " . date('H:i', strtotime($s['sch_from']));
                  $schedule_css_class = 'schedule_close';
                }
              }
            } else {
  // Если ресторан больше не работает, выводим красным информацию об этом
              $schedule_list = "Больше не работает";  
              $schedule_css_class = 'schedule_close';
            }?>
              <a href="<?  ?>" class="<? echo $schedule_css_class; ?>"><? echo $schedule_list; ?></a>
            <?
  // Если в ресторане есть завтраки, выводим период подачи завтраков
               if (array_key_exists(0, $scheduleBrk)) {
               $breakfast_with = date('H:i', strtotime($scheduleBrk[0]['brk_from']));
               $breakfast_before = date('H:i', strtotime($scheduleBrk[0]['brk_to']));
               if (date("H:i") >= $breakfast_with and date("H:i") < $breakfast_before) {
  // Если в настоящий момент можно позавтракать, подсвечиваем зелёным
                  $schedule_css_class = 'schedule_open'; 
               } else {
  // Если в настоящий момент завтраки закончились, подсвечиваем красным
                  $schedule_css_class = 'schedule_close';
               }?>
              <br><a href="<?  ?>" class="<? echo $schedule_css_class; ?>">Завтраки с <? echo $breakfast_with; ?> до <? echo $breakfast_before; ?></a>    
            <?  }
  // Если в ресторане есть бизнес-ланчи, выводим период подачи бизнес-ланчей
               if (array_key_exists(0, $scheduleDin)) {
               $dinner_with = $scheduleDin[0]['din_from'];
               $dinner_before = $scheduleDin[0]['din_to'];
               if (date("H:i") >= $dinner_with and date("H:i") < $dinner_before) {
  // Если в настоящий момент можно пообедать, подсвечиваем зелёным
                  $schedule_css_class = 'schedule_open'; 
               } else {
  // Если в настоящий момент бизнес-ланчи закончились, подсвечиваем красным
                  $schedule_css_class = 'schedule_close';
               }?>
              <br><a href="<?  ?>" class="<? echo $schedule_css_class; ?>">Бизнес-ланч с <? echo $dinner_with; ?> до <? echo $dinner_before; ?></a>    
            <?  }
            ?>
	        </div>
      </div>
</div>
    </div>
  </div>
  <div id='banners'>
  </div>
</div>
<?php
$reviews = <<< JS
  $('#form-togle').on('click', function(){
	  if($('#reviews-form').hasClass('active')){
		 $('#reviews-form').removeClass('active').slideDown("slow");
	  } else {
		 $('#reviews-form').slideUp("slow").addClass('active');
	  }
  });
  $('#submit-btn').on('click', function() {
	  if($('#ratingform-rate').val() == ''){
		  if($('#ratingform-dignities').val() == '') {
			  $('.field-ratingform-dignities').removeClass('has-success').addClass('has-error');
		  } else { 
		      $('.field-ratingform-dignities').removeClass('has-error').addClass('has-success');
		  }
		  if($('#ratingform-disadvantages').val() == '') {
			  $('.field-ratingform-disadvantages').removeClass('has-success').addClass('has-error');
		  } else {
			  $('.field-ratingform-disadvantages').removeClass('has-error').addClass('has-success');
		  }
		  if($('.field-ratingform-disadvantages').hasClass('has-success') && $('.field-ratingform-dignities').hasClass('has-success')) {
			  $('#reviewform').submit();
		  }
		 
	  } else {
		  $('#reviewform').submit();
	  }
	
	
  });
JS;
$this->registerJs($reviews, yii\web\View::POS_READY);