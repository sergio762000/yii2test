<?php

namespace app\controllers;

use app\models\LoginForm;
use app\models\SignupForm;
use Yii;
use yii\filters\AccessControl;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;

class UsersController extends ActiveController
{
    public $modelClass = 'app\models\User';
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items'
    ];

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator']['only'] = ['view', 'index'];
        $behaviors['authenticator']['authMethods'] = [
            HttpBasicAuth::class,
            HttpBearerAuth::class,
        ];

        $behaviors['access'] = [
            'class' => AccessControl::class,
            'only' => ['signup', 'login'],
            'rules' => [
                [
                    'allow' => true,
                    'actions' => ['signup', 'login'],
                    'roles' => ['?'],
                ],
            ],
        ];

        return $behaviors;
    }

    public function actionSignup()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post(), '')) {
            if ($user = $model->signup()) {
                $response = Yii::$app->getResponse();
                $response->setStatusCode(201);
                if (Yii::$app->getUser()->login($user)) {
                    return $user;
                }
            }

        }
    }

    public function actionLogin()
    {
        $model = new LoginForm();
        $model->load(Yii::$app->request->bodyParams, '');
        if ($token = $model->login()) {
            return $token;
        } else {
            return $model;
        }
    }

    protected function verbs()
    {
        return [
            'login' => ['post'],
        ];
    }
}
