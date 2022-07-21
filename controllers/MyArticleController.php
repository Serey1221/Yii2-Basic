<?php

namespace app\controllers;

class MyArticleController extends \yii\web\Controller
{
    // public $defaultAction = 'hello-serey';

    public function actionHelloSerey($id, $msg)
    {
        echo "Hello Serey " . $id . ' ' . $msg;
    }
}
