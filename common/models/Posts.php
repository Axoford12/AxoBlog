<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\ActiveRelationTrait;

/**
 * This is the model class for table "posts".
 *
 * @property integer $id
 * @property string $title
 * @property string $summary
 * @property string $content
 * @property string $label_img
 * @property integer $cat_id
 * @property integer $is_valid
 * @property integer $created_at
 * @property integer $updated_at
 */
class Posts extends ActiveRecord
{
    const IS_VALID = 1;
    const NO_VALID = 0;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['cat_id', 'is_valid', 'created_at', 'updated_at'], 'integer'],
            [['title', 'summary', 'label_img'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '标题',
            'summary' => '小摘要',
            'content' => '内容',
            'label_img' => '标签图',
            'cat_id' => '分类ID',
            'is_valid' => '有效性',
            'created_at' => '创建于：',
            'updated_at' => '修改于：',
        ];
    }
    public function getExtend(){
        return $this->hasOne(PostExtends::className(),['post_id' => 'id']);
    }
}
