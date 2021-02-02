<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $body
 * @property string|null $newsid
 * @property int|null $position
 * @property int|null $newsid2
 *
 * @property News $newsid20
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['body'], 'string'],
            [['position', 'newsid2'], 'integer'],
            [['title', 'newsid'], 'string', 'max' => 255],
            [['newsid2'], 'exist', 'skipOnError' => true, 'targetClass' => News::className(), 'targetAttribute' => ['newsid2' => 'id']],
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
            'position' => 'Position',
            'newsid2' => 'Newsid2',
        ];
    }

    /**
     * Gets query for [[Newsid20]].
     *
     * @return \yii\db\ActiveQuery|NewsQuery
     */
    public function getNewsid20()
    {
        return $this->hasOne(News::className(), ['id' => 'newsid2']);
    }

    /**
     * {@inheritdoc}
     * @return PostQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PostQuery(get_called_class());
    }
    
    public function extraFields() {
        return [
            'goods'=>function(){
                return ['1','2','3'];
            },
        ];
    }
}
