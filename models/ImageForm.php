<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class ImageForm extends Model
{
    /**
     * @var UploadedFile
     */
    public UploadedFile $imageFile;
    public Image $imageModel;

    public function rules()
    {
        return [
            [['imageFile'], 'image', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxSize' => 512000],
        ];
    }

    public function upload()
    {

        if ($this->validate()) {
            if (!$this->fileExists()) {
                $this->imageFile->saveAs(Yii::$app->getBasePath() . '/uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
                return $this->saveImageToDB();
            } else {
                //TODO - сделать проверку, что в БД нет информации о файле, который загрузили
                //TODO - добавить в БД признак уникальности полного имени файла
            }
        }

        return false;
    }

    private function fileExists(): bool
    {
        return file_exists(Yii::$app->getBasePath() . '/uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
    }

    private function saveImageToDB()
    {
        $image = new Image();
        $image->name = $this->imageFile->baseName;
        $image->filename = $this->imageFile->baseName . '.' . $this->imageFile->extension;

        return $image->save() ? $image : null;
    }
}
