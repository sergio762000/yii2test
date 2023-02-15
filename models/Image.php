<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\Expression;
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
        parent::behaviors();

        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    'beforeInsert' => ['uploaded_at'],
                    'beforeUpdate' => ['uploaded_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public function getPost(): ActiveQuery
    {
        return $this->hasMany(Post::class, ['id' => 'post_id'])
            ->viaTable('image_post', ['image_id' => 'id']);
    }

    public function getLinks()
    {
        return [
            'self' => Url::to(['image/view', 'id' => $this->id], true),
        ];
    }
}
