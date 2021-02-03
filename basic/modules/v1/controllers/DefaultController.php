<?php

namespace app\modules\v1\controllers;

use yii\web\Controller;

/**
 * Default controller for the `v1` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        echo __LINE__ . "\n";
        echo 'index';
        // exit;
        return $this->render('index');
    }

    
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionView()
    {
        echo __LINE__."\n";
        echo 'View';
        exit;
        return $this->render('index');
    }
}
