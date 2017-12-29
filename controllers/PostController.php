<?php

namespace app\controllers;
use app\models\Post;
use Yii;

/**
 * Description of PostController
 *
 * @author user1
 */
class PostController extends AppController {
    
    // public $layout = 'basic';
    
    public function actionIndex($name  = 'гость') {
        $query = Post::find()->select('id, title, excerpt')->orderBy('id DESC');
        $pages = new \yii\data\Pagination(['totalCount' => $query->count(), 'pageSize' => 2, 'pageSizeParam' => false, 'forcePageParam' => false]);
        $posts = $query->offset($pages->offset)->limit($pages->limit)->all();
	return $this->render('index', compact('posts', 'pages'));
    }
    
    public function actionView() {
 	$id = \Yii::$app->request->get('id');
 	$post = Post::findOne($id);
        $this->setMeta('E-SHOPPER | ' . $post->title, $post->keywords, $post->description);
        if(empty($post)) throw new \yii\web\HttpException(404, 'Такой страницы нет');
        return $this->render('view', compact('post'));
    } 
    
}
