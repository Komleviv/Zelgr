<?php

namespace frontend\controllers;

use Yii;
use common\models\Restaurants;
use common\models\RestaurantCuisine;
use common\models\RestaurantCuisineLink;
use common\models\RestaurantType;
use common\models\RestaurantTypeLink;
use common\models\RestaurantSch;
use common\models\RestaurantSchBrk;
use common\models\RestaurantSchDin;
use common\models\RestaurantMenu;
use frontend\models\search\RestaurantSearch;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;

class RestaurantsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $model = new Restaurants();
      
        $searchModel = new RestaurantSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
      
        $cuisine = RestaurantCuisine::find()->all();
        $type = RestaurantType::find()->all();
      
//         if(Yii::$app->request->isPjax){
//           $answer = true;
//           return $this->render('index',  [
//             'dataProvider' => $dataProvider,
//             'answer' => $answer,
//             'model' => $provider,
//          ]);
//         }
//        var_dump ($model);
        return $this->render('index', [
          'cuisine' => $cuisine,
          'type' => $type,
          'dataProvider' => $dataProvider,
          'searchModel' => $searchModel,
          'model' => $model,
         ]);
    }
  
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $cuisine = restaurantCuisineLink::find()->joinWith('restaurantCuisine')->where(['cms_restaurant_id' => $id])->all();
        $type = restaurantTypeLink::find()->joinWith('restaurantType')->where(['cms_restaurant_id' => $id])->all();
        $schedule = restaurantSch::find()->where(['sch_rest_id' => $id])->all();
        $scheduleBrk = restaurantSchBrk::find()->where(['brk_rest_id' => $id])->all();
        $scheduleDin = restaurantSchDin::find()->where(['din_rest_id' => $id])->all();
        $menu = restaurantMenu::find()->where(['menu_rest_id' => $id])->all();
      
//       	if(!Yii::$app->user->isGuest)
//         {
//           $object = new RatingForm([
//             'user_id' => Yii::$app->user->identity->id,
//             'sellers_id' => (int) $id,
//           ]);
//           if (Yii::$app->request->post())
//           {
//             $object->load(Yii::$app->request->post());
//             if($object->validate())
//             {
//               $object->save();
//               return $this->refresh();
//             }
//           }
//         }

        return $this->render('view', [
				'model' => $model,
        'cuisine' => $cuisine,
        'type' => $type,
        'schedule' => $schedule,
        'scheduleBrk' => $scheduleBrk,
        'scheduleDin' => $scheduleDin,
        'menu' => $menu,
        'object' => $object,
			]);
    }
  
   protected function findModel($id)
    {
        if (($model = Restaurants::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
