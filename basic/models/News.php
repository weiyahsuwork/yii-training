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
 *
 * @property Post[] $posts
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

    /**
     * Gets query for [[Posts]].
     *
     * @return \yii\db\ActiveQuery|PostQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['newsid2' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return NewsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NewsQuery(get_called_class());
    }

    // 明确列出每个字段，适用于你希望数据表或
    // 模型属性修改时不导致你的字段修改（保持后端API兼容性）
    public function fields()
    {
        return [
            // 字段名和属性名相同
            'id',
            // 字段名为"titlename", 对应的属性名为"title"
            'titlename' => 'title',
            // 字段名为"name", 值由一个PHP回调函数定义
            'name' => function () {
                return 'weiya';
            },
        ];
    }
}
