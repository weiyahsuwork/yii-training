<?php

namespace app\controllers;

use app\models\News;
use app\models\NewsQuery;
use app\models\Post;
use Exception;
use Yii;
use yii\rest\ActiveController;
use \yii\db\Query;

class NewsController extends ActiveController
{
    public $modelClass = 'app\models\News';
    


    public function actions()
    {
        $actions = parent::actions();

        unset($actions['index']);
        unset($actions['view']);
        unset($actions['create']);  
        unset($actions['update']);  
        unset($actions['delete']);  
        return $actions; 
        // // 使用 "prepareDataProvider()" 方法自定义数据 provider 
        // $actions['create']['prepareDataProvider'] = [$this, 'prepareDataProvider'];

        // return $actions;
    }

    public function actionIndex(){


        $post = Post::findOne(1);
        echo ' $post= '.var_export($post)."\n";
        die;
        $news = new News();
        $res = $news->link('post', $post);
        echo '$res = '.var_export($res)."\n";
        try{
            $result = (new \yii\db\Query())
                ->select(['id', 'title', 'content'])
                ->from('news')
                ->where('isDelete=0')
                ->all();
        }catch(Exception $e){
            echo json_encode(['Select wrong!']);
        }
        echo json_encode($result);
    }

    public function actionView($id){

        try{
            // $result = (new NewsQuery())
            //     ->active()
                
            //     ->asArray()
            //     ->one();
            
            $result = (new \yii\db\Query())
                ->select(['id', 'title', 'content'])
                ->from('news')
                ->where('isDelete=0')
                ->andWhere('id=:id')
                ->addParams([':id' => $id])
                ->one();
         

        }catch(Exception $e){
            echo json_encode(['Select wrong!']);
        }
        if (empty($result)) {
            echo json_encode(['No select!']);
        }else{
            echo json_encode($result);
        }
    }

    public function actionCreate()
    {

        
        $post = Yii::$app->getRequest()->getBodyParams();
        // echo '$post = '.var_export($post)."\n";
        $data = [
            'title' => $post['title'] ?? NULL,
            'content' => $post['content'] ?? NULL,
            'createAt' => date('Y-m-d H:i:s'),
            'createBy' => "45",
        ];
        try{
            Yii::$app->db->createCommand()->insert('news', $data)->execute();
            // $response = Yii::$app->getResponse();
            // echo '$response = '.var_export($response)."\n";
        }catch(Exception $e){
            // echo '$e = '.var_export($e)."\n";
            echo json_encode(['Create wrong!!']);
            // exit;
            throw $e;
        }
        echo json_encode(['Create success!!']);
    }


    public function actionUpdate($id)
    {
        $model = News::find($id);
        $post = Yii::$app->getRequest()->getBodyParams();
        // echo '$post = '.var_export($post)."\n";
        if ($post['title']) {
            $data['title'] = $post['title'];
        }
        if ($post['content']) {
            $data['content'] = $post['content'];
        }
        $data['modifyAt'] = date('Y-m-d H:i:s');
        $data['modifyBy'] = "55";

        try{
            Yii::$app->db->createCommand()->update('news', $data, 'id='.$id)->execute();

        }catch(Exception $e){
            // echo '$e = '.var_export($e)."\n";
            echo json_encode(['Update wrong!!']);
            // exit;
            throw $e;
        }
        echo json_encode(['Update success!!']);
    }

    public function actionDelete($id)
    {

        $post = Yii::$app->getRequest()->getBodyParams();
        // echo '$post = '.var_export($post)."\n";
        $data = [
            'deleteAt' => date('Y-m-d H:i:s'),
            'deleteBy' => "65",
            'isDelete' => '1',
        ];
        try{
            Yii::$app->db->createCommand()->update('news', $data, 'id='.$id)->execute();
        }catch(Exception $e){
            // echo '$e = '.var_export($e)."\n";
            echo json_encode(['Delete wrong!!']);
            // exit;
            throw $e;
        }
        echo json_encode(['Delete success!!']);
    }


    // public function prepareDataProvider()
    // {
        // JOIN
        // $query = new Query();
        // $rows = $query->select(['news.id', 'news.title', 'post.id AS post'  , 'post.body'])
        //     ->from('news')
        //     ->join('LEFT JOIN', 'post', 'post.newsid = news.id')
        //     ->all();
       
        // 子查詢 count
        // $rows = Yii::$app->db->createCommand('SELECT * ,(SELECT COUNT(*) FROM `post`) AS `count` FROM news ')
        //         ->queryAll();

        // $query = new Query();
        // $subQuery = (new Query())->select('COUNT(*)')->from('post');
        // $rows = $query->select(['id', 'title','count' => $subQuery])
        // ->from('news')
        // ->all();

        // 條件
    //     $rows = Yii::$app->db->createCommand('SELECT * FROM news WHERE id == (SELECT newsid FROM post)')
    //             ->queryAll();
    //     return $rows;
    // }
}
