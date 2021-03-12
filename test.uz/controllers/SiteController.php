<?php

namespace app\controllers;

use Yii;
use app\models\User;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Provinces;
use app\models\Whois;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actionFoyda()
    {
        return $this->render('foyda');
    }
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'foyda', 'about'],
                'rules' => [
                    [
                        'actions' => ['logout', 'foyda', 'about'],
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
        
        $user_id = Yii::$app->user->id;
        $u = User::findOne($user_id);
        return $this->render('about', ['userOne'=>$u]);
    }

    public function actionEditProfile($id)
    {
        if($id == Yii::$app->user->id)
        {
            $t = User::findOne($id);
        }
        else
        {
            $t = User::findOne(Yii::$app->user->id);
        }
        if($t->load(Yii::$app->request->post()))
        {
            if(!$t->save())
            {
                print_r($t->getErrors());
            }else{
                 $t->save();
                 return $this->redirect(['site/about']);
            }
            
        }
        return $this->render('editprofile', ['ep'=>$t]);
    }

    public function actionRegister()
    {
        $model = new \app\models\User();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $model->auth_time = date("Y-m-d H:i:s");
                $model->password = md5($model->password);
                $model->password_repeat = md5($model->password_repeat);
                if(!$model->save())
                {
                    print_r($model->getErrors());
                }
                else
                {
                    $model->save();
                }
                return;
            }
        }

        return $this->render('register', [
            'model' => $model,
        ]);
    }

}
