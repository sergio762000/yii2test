<?php

namespace app\models;

use yii\base\Model;

class UploadForm extends Model
{
    public $imageFile;

    public function rules()
    {
        return [
            [
                'file', 'image',
                'extensions' => ['jpg', 'jpeg', 'png', 'gif']
            ],
        ];
    }
}
