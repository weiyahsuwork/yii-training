<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\helpers\Url;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * 
     */
    public function actionSay($message = 'Hello')
    {
        // return $this->render('say', ['message' => $message]);
        // echo 'say  '.$message;
        // 轉跳到網頁中的特定地方 ， 像是有時候在導向的時候會到該網址中所指定的位置
        // echo Url::to(['post/view', 'id' => 100, '#' => 'content']);
        // 設定網頁的別名
        // Yii::setAlias('@example', 'http://example.com/');
        // echo Url::to('@example');

        // echo Url::canonical();

        // Url::remember();
        // echo Url::previous();
    }

    public function actionList(){
        // 返回多行. 每行都是列名和值的关联数组.
        // 如果该查询没有结果则返回空数组
        $news = Yii::$app->db->createCommand('SELECT * FROM news WHERE id=:id')
                    ->bindValue(':id', '1')
                    ->queryAll();
        echo '<pre>';
        echo '$news = '.var_export($news)."\n";

        // 新增
        $db = Yii::$app->db;
        $transaction = $db->beginTransaction();
        try {
            $db->createCommand("INSERT INTO `news` (`id`, `title`, `content`, `createAt`, `createBy`, `modifyAt`, `modifyBy`, `deleteAt`, `deleteBy`)
            VALUES (NULL, 'BCD2', 'BCD2', '2021-01-28 15:31:35', '89', NULL, NULL, NULL, NULL)")
            ->execute();
            
            $transaction->commit();
        } catch(\Exception $e) {
        // 回滾
            $transaction->rollBack();
            throw $e;
        } catch(\Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }

        // 查詢
        $query = new \yii\db\Query();
        $rows = $query->select(['id', 'title'])
            ->from('news')
            ->all();

        // join 查詢
        $query = new \yii\db\Query();
        $rows = $query->select(['news.id', 'news.title', 'post.id AS post'  , 'post.body'])
            ->from('news')
            ->join('LEFT JOIN', 'post', 'post.newsid = news.id')
            ->all();

    }
}
