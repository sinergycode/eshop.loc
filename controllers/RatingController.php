<?php
namespace app\controllers;
use app\models\Rating;
use Yii;
use yii\helpers\Json;

class RatingController extends AppController {
     
    public $response = []; 
    
//    public function actionUpdateRating() {
//        $this->response['success'] = false;
//        if(Yii::$app->request->post()) { 
//            $points = Yii::$app->request->post( 'points' );
//            $post_id = Yii::$app->request->post( 'post_id' );
//            $model = $this->getModel($post_id, $points);
//            $new_rating = $this->newRating($model, $points);
//            $this->response['dec_avg'] = $new_rating;
//            $this->response['success'] = true;
//            if($model->save()) {
//                    echo Json::encode ($this->response);
//                    Yii::$app->end();
//            }else{
////                    return $this->redirect(Yii::$app->request->referrer);
//                echo 'bad';
//            }
//        }
//    }
//    
//    public function newRating($model, $points) {
//        if($model->number_votes != 1) {
//            $model->number_votes += 1;
//            $model->dec_avg = round((($points + $model->total_points) / $model->number_votes), 1);
//            $model->total_points += $points;
//            return $model->dec_avg;
//        } else {
//            return $model->dec_avg;
//        }
//    }
//    
//    public function getModel($post_id, $points) {
//        if($post_id) {
//            $model = Rating::findOne(['post_id'=> $post_id]);  
//        }
//        else { 
//            $model = new Rating();
//            $model->post_id = $post_id;
//            $model->number_votes = 1;
//            $model->dec_avg = $points;
//            $model->total_points = $points;
//        }
//        return $model;
//    }
//  
//}
  
    
     public function actionUpdateRating() {
        $this->response['success'] = false;
        if(Yii::$app->request->post()) {
            $points = Yii::$app->request->post( 'points' );
            $post_id = Yii::$app->request->post( 'post_id' );
            $model = Rating::findOne(['post_id'=> $post_id]);
            if($model->post_id) {
                $model->number_votes += 1;
                $model->dec_avg = round((($points + $model->total_points) / $model->number_votes), 1);
                $model->total_points += $points;
            } else {
                $model = new Rating();
                $model->post_id = $post_id;
                $model->number_votes = 1;
                $model->dec_avg = $points;
                $model->total_points = $points;
            }
            $this->response['dec_avg'] = $model->dec_avg;
            $this->response['number_votes'] = $model->number_votes;
            $this->response['success'] = true;
            if($model->save()) {
                    echo Json::encode($this->response);
                    Yii::$app->end();
            }else{
                    echo 'not saved';
            }
        }
        
    }
    
    protected function calculateRating() {
        
    }
    
    protected function createModel() {
        
    }
    
}