<?php

namespace app\controllers;

use app\models\News;
use app\models\Post;
use Yii;
use yii\rest\ActiveController;

class PostController extends ActiveController
{
    public $modelClass = 'app\models\Post';

    public function actions()
    {
        $actions = parent::actions();

        unset($actions['create']);
        return $actions; 
    }

    public function actionCreate(){

        $posts = Yii::$app->getRequest()->getBodyParams();
        $news = News::findOne(1);
        $post = new Post();
        $post->title = $posts['title'];
        $post->body = $posts['body'];
        $post->link('newsid', $news);
 
        
    }
}
