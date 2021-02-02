<?php

namespace app\controllers;

use Yii;
use yii\rest\ActiveController;
use \yii\db\Query;

class NewsController extends ActiveController
{
    public $modelClass = 'app\models\News';
    


    // public function actions()
    // {
    //     $actions = parent::actions();

    //     // 使用 "prepareDataProvider()" 方法自定义数据 provider 
    //     $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];

    //     return $actions;
    // }

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
