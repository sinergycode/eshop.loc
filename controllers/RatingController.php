<?php
namespace app\controllers;

use Yii;
use app\models\Rating;
use yii\helpers\Json;
use app\models\Status;

class RatingController extends AppController {
     
    public $response = []; 
    public $post_id;
    public $points;
    
    
    public function actionGetParams() {
        $this->response['success'] = false;
        if(Yii::$app->request->post()) {
            $this->points = Yii::$app->request->post( 'points' );
            $this->post_id = Yii::$app->request->post( 'post_id' );
            $this->checkUserVoteStatus();
        }
        else {
            Yii::$app->end(); // параметры не получены --- ОШИБКА ?
        }
    }
    
    public function checkUserVoteStatus() {
        if (!Yii::$app->user->isGuest) { // user
            $user = Status::findOne(['post_id' => $this->post_id, 'user_id' => Yii::$app->user->getId()]);
            if(!$user->vote_status) { // has no vote
                $this->UpdateRating();
            }else { // voted
                // отправить ответ в котором ???
//                Yii::$app->end();
            }
        }else { // guest
            $user = Status::findOne(['post_id' => $this->post_id, 'user_ip' => $aaa]);
            if(!$user->vote_status) { // has no vote
                $this->UpdateRating();
            }else { // voted
                Yii::$app->end();
            }
        }
    }

    public function updateRating() {        
        $rating = Rating::findOne(['post_id'=> $this->post_id]);
        if($rating->post_id) {
            $rating = $this->calculateRating($rating);
        } else {
            $rating = $this->createRating();
        }
        $this->createVoteStatus();
        $this->createResponse($rating); // $user - ?
        $this->saveRating($rating);     
    }
    
    protected function createVoteStatus() {
        $status = new Status;
        $status->post_id = $this->post_id;
        $status->user_id = Yii::$app->user->getId();
        $status->vote_status = 1;
        $status->save();
    }
    
    protected function calculateRating($rating) {
        $rating->number_votes += 1;
        $rating->dec_avg = round((($this->points + $rating->total_points) / $rating->number_votes), 1);
        $rating->total_points += $this->points;
        return $rating;
    }
    
    protected function createRating() {
        $rating = new Rating();
        $rating->post_id = $this->post_id;
        $rating->number_votes = 1;
        $rating->dec_avg = $this->points;
        $rating->total_points = $this->points;
        return $rating;
    }
    
    protected function saveRating($rating){
        if($rating->save()) {
                echo Json::encode($this->response);
                Yii::$app->end();
        }else{
                echo 'not saved'; // error
        }
    }
    
    public function createResponse($rating) {
        $this->response['dec_avg'] = $rating->dec_avg;
        $this->response['number_votes'] = $rating->number_votes;
        $this->response['success'] = true;
        $this->response['is_guest'] = Yii::$app->user->isGuest;
//        $this->response['vote_status'] = $user->vote_status;

    }
    
}