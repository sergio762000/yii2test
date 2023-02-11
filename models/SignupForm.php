<?php

namespace app\models;

use yii\base\Model;

class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $description;

    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => 'app\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => 'app\models\User', 'message' => 'This username has already been taken.'],
            ['email', 'string', 'max' => 255],

            ['password', 'required'],
            ['password', 'string', 'min' => 8],

            ['description', 'trim'],
            ['description', 'string', 'max' => 255],
        ];
    }

    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->status = User::STATUS_ACTIVE;
        $user->username = $this->username;
        $user->email = $this->email;
        $user->description = $this->description;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        return $user->save() ? $user : null;
    }
}
