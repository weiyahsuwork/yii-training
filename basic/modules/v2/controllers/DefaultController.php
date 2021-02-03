<?php

namespace app\modules\v2\controllers;

use yii\web\Controller;

/**
 * Default controller for the `v2` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        // echo "11111111";
        // die();
        return $this->render('index');
    }
}
