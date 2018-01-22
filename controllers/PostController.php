<?php

namespace app\controllers;
use app\models\Post;
use Yii;
use app\models\Status;

/**
 * Description of PostController
 *
 * @author user1
 */
class PostController extends AppController {
    
    // public $layout = 'basic';
    
    public function actionIndex($name  = 'гость') {
        $query = Post::find()->select('id, date, time, title, excerpt, author, post_rate')->orderBy('id DESC');
        $pages = new \yii\data\Pagination(['totalCount' => $query->count(), 'pageSize' => 3, 'pageSizeParam' => false, 'forcePageParam' => false]);
        $posts = $query->offset($pages->offset)->limit($pages->limit)->with('rating')->all();
	return $this->render('index', compact('posts', 'pages', 'rating'));
    }
    
    public function actionView() {
 	$id = \Yii::$app->request->get('id');
 	$post = Post::findOne($id);
        $user = Status::findOne(['post_id' => $id, 'user_id' => Yii::$app->user->getId()]);
        $this->setMeta('E-SHOPPER | ' . $post->title, $post->keywords, $post->description);
        if(empty($post)) throw new \yii\web\HttpException(404, 'Такой страницы нет');
        return $this->render('view', compact('post', 'user'));
    } 
    
}
