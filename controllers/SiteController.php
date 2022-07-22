<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\TestModel;

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

    // public function beforeAction($action)
    // {
    //     echo '<pre>';
    //     var_dump("controller before action");
    //     echo '</pre>';
    //     return parent::beforeAction($action);
    // }

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
    public function actionHello($message)
    {
        return $this->render(
            'hello',
            ['msg' => $message]
        );
    }
    public function actionTest()
    {

        $test = new TestModel();

        $post = [
            'name' => 'Serey',
            'surname' => 'Sruot',
            'age' => 21,
            'email' => 'Sereysruot007@gmial.com'
        ];
        $test->attributes = $post;
        //$test->name = 'Serey';
        //$test->surname = 'Sruot';
        //$test->email = 'Sereysruot007@gmial.com';
        //$test->age = 21;

        // foreach ($test as $attri => $value) {
        //     echo $test->getAttributeLabel($attri) . ' : ' . $value . '<br>';
        // }
        if ($test->validate()) {
            echo "OK";
        } else {
            echo '<pre>';
            var_dump($test->errors);
            echo '</pre>';
            echo "Error";
        }
        // $test['surname'] = 'Sruot';

        // echo $test->name;
        // echo '<pre>';
        // var_dump($test->getAttributeLabel('myAge'));
        // echo '</pre>';
        // echo $test->getAttributeLabel('mySurname');


    }
    public function actionRequest()
    {
        
    }
}
