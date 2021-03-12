<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\helpers\Url;

/**
 * ProblemsController implements the CRUD actions for Problems model.
 */
class RolController extends Controller
{
	public $layout = "rol";
	public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                // 'only' => ['logout'],
                'rules' => [
                    [
                        // 'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@', '?'],
                    ],
                ],
            ],
        ];
    }
	public function actionIndex()
	{
		return $this->render('index');
	}
	public function actionTest()
	{
		return $this->render('test');
	}
	public function actionService()
	{
		if(Yii::$app->user->can('ochirish'))
		{
			return $this->render('service');
		}
		else
		{
			throw new \yii\web\BadRequestHttpException("Noto'g'ri o'tish.");
			//return $this->redirect(['rol/index']);
		}
		
	}
}