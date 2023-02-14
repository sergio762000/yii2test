<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Url;

/**
 * This is model class for table "{{%image}}".
 *
 * @property integer $id
 * @property string $name
 * @property string filename
 * @property integer uploaded_at
 */
class Image extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%image}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    public function getPosts()
    {
        return $this->hasMany(Post::class, ['id' => 'post_id']);
    }

    public function getLinks()
    {
        return [
            'self' => Url::to(['image/view', 'id' => $this->id], true),
        ];
    }
}
