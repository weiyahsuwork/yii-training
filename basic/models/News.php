<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property string $title
 * @property string|null $content
 * @property string $createAt
 * @property string $createBy
 * @property string|null $modifyAt
 * @property string|null $modifyBy
 * @property string|null $deleteAt
 * @property string|null $deleteBy
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'createAt', 'createBy'], 'required'],
            [['content'], 'string'],
            [['createAt', 'modifyAt', 'deleteAt'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['createBy', 'modifyBy', 'deleteBy'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'content' => 'Content',
            'createAt' => 'Create At',
            'createBy' => 'Create By',
            'modifyAt' => 'Modify At',
            'modifyBy' => 'Modify By',
            'deleteAt' => 'Delete At',
            'deleteBy' => 'Delete By',
        ];
    }
}