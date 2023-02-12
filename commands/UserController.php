<?php

namespace app\commands;

use app\models\SignupForm;
use yii\console\Controller;
use yii\console\ExitCode;

/**
 * This command signup user
 */
class UserController extends Controller
{
    public $username;
    public $password;
    public $email;
    public $description;


    public function actionSignup($username, $password, $email, $description)
    {
        $model = new SignupForm();
        $model->username = $username;
        $model->password = $password;
        $model->email = $email;
        $model->description = $description;

        $code = $this->prompt('Зарегистрировать нового пользователя? (yes/no):', ['default' => 'no']);

        if ($code === 'no') {
            return ExitCode::UNSPECIFIED_ERROR;
        }

        if ($model->validate()) {
            echo 'Проверка данных пользователя проведена. Добавляем в БД ...' . PHP_EOL;

            if ($user = $model->signup()) {
                $userProfile = $user->getAttributes();
                echo 'Пользователь успешно добавлен в БД, со следующими параметрами:' . PHP_EOL;
                echo sprintf("%15s: %s" . PHP_EOL, 'id',$userProfile['id']);
                echo sprintf("%15s: %s" . PHP_EOL, 'username',$userProfile['username']);
                echo sprintf("%15s: %s" . PHP_EOL, 'email',$userProfile['email']);
                echo sprintf("%15s: %s" . PHP_EOL, 'description',$userProfile['description']);
            }
        } else {
            echo "NOT CORRECTED DATA" . PHP_EOL;
            return ExitCode::UNSPECIFIED_ERROR;
        }

        return ExitCode::OK;
    }

}
