<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%post}}".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $body
 * @property string|null $newsid
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%post}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['body'], 'string'],
            [['title', 'newsid'], 'string', 'max' => 255],
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
            'body' => 'Body',
            'newsid' => 'Newsid',
        ];
    }

    /**
     * {@inheritdoc}
     * @return PosrQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PosrQuery(get_called_class());
    }

    public function extraFields() {
        return ['user'];
    }

    public function getUser()
    {
        return '151515';
        // return $this->hasOne(User::className(), [ 'id' => 'order']);
        // https://www.bunao.win/2018/10/16/yii/RESTful/
    }

    public function getNewsid()
    {
        return $this->hasOne(News::className(), ['id' => 'newsid']);
    }
}
