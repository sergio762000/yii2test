<?php

namespace app\controllers;

use app\models\SignupForm;
use Yii;
use yii\rest\ActiveController;

class UsersController extends ActiveController
{
    public $modelClass = 'app\models\User';
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items'
    ];

    //TODO - регистрация пользователя
    public function actionSignup()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post(), '')) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $user;
                } else {
                    return $this->asJson([
                        'action' => 'Yii::$app->getUser()->login($user)',
                        'result' => Yii::$app->getUser()->login($user)
                    ]);
                }
            }

        } else {
            return $this->asJson([
                'model' => $model
            ]);
        }

    }
}
