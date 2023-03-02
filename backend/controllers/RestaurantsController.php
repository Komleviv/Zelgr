<?php

namespace backend\controllers;

use Yii;
use common\models\Restaurants;
use common\models\RestaurantCuisineLink;
use common\models\RestaurantTypeLink;
use common\models\RestaurantSch;
use backend\models\search\RestaurantsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RestaurantsController implements the CRUD actions for Restaurants model.
 */
class RestaurantsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Restaurants models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RestaurantsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Restaurants model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $cuisinelink = RestaurantCuisineLink::find($id);
        $cuisine =  $cuisinelink->getRestaurantCuisine();//restaurantCuisineLink::find()->joinWith('restaurantCuisine')->where(['cms_restaurant_id' => $id])->all();
        $type = restaurantTypeLink::find()->joinWith('restaurantType')->where(['cms_restaurant_id' => $id])->all();
        $schedule = restaurantSch::find()->where(['sch_rest_id' => $id])->all();
      
        return $this->render('view', [
            'model' => $model,
            'cuisine' => $cuisine,
        ]);
    }

    /**
     * Creates a new Restaurants model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Restaurants();
        $cuisine = restaurantCuisineLink::find()->joinWith('restaurantCuisine')->all();
       // $cuisine_rest = $model->getRestaurantСuisine();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
          
           // Проставляем текущую дату и время
            $model->touch('rest_date_create');
          
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'cuisine' => $cuisine,
           // 'cuisine_rest' => $cuisine_rest,
        ]);
    }

    /**
     * Updates an existing Restaurants model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $cuisinelink = RestaurantCuisineLink::find()->where(['cms_restaurant_id' => $id])->all();
        $cuisine = $cuisinelink->restaurantCuisine;//restaurantCuisineLink::find()->joinWith('restaurantCuisine')->where(['cms_restaurant_id' => $id])->all();
        $type = restaurantTypeLink::find()->joinWith('restaurantType')->where(['cms_restaurant_id' => $id])->all();
      
       // Проставляем текущую дату и время
        $model->touch('rest_date_update');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'cuisine' => $cuisine,
            'type' => $type,
        ]);
    }

    /**
     * Deletes an existing Restaurants model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

  // НЕ РАБОТАЕТ
    public function actionVerif($id)
    {
       $verif = Restaurants::findOne($id);
       $verif->rest_verif == 1 ? $verif->rest_verif = 0 : $verif->rest_verif = 1;
       $verif->save();
    }
  
    public function actionOpen($id)
    {
       $open = Restaurants::findOne($id);
       $open->rest_open == 1 ? $open->rest_open = 0 : $open->rest_open = 1;
       $open->save();
    }
  
    /**
     * Finds the Restaurants model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Restaurants the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Restaurants::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
