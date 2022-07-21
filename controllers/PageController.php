<?php

namespace app\controllers;

use yii\web\Controller;

class PageController extends Controller
{
    public function actionAbout($id)
    {
        $this->view->params['sharevariable'] = 'Hi I am Share';
        return $this->render('about', [
            'a' => $id,
            'b' => 2
        ]); //render a named view and applies a layout to the rendering result.
        // return $this->renderContent('<h1>Hello Channel Welcome to Myguy</h1>');// renders a static string by embedding 
        //return $this->renderPartial('about'); //renders a named view without any layout.
        //return $this->renderFile('@app/views/page/about.php');//renders a view specified in terms of a view file path or alias.
        //return $this->renderAjax('about');
    }
}
