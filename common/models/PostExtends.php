<?php

namespace common\models;

/**
 * This is the model class for table "post_extends".
 *
 * @property integer $id
 * @property integer $post_id
 * @property integer $browser
 * @property integer $collect
 * @property integer $praise
 * @property integer $comment
 */
class PostExtends extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post_extends';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'browser', 'collect', 'praise', 'comment'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post_id' => 'Post ID',
            'browser' => 'Browser',
            'collect' => 'Collect',
            'praise' => 'Praise',
            'comment' => 'Comment',
        ];
    }

    /**
     * Update Article Statistics
     * @param $cond
     * @param $attribute
     * @param $num
     */
    public function upCounter($cond,$attribute,$num){
        $counter = $this->findOne($cond);
        if($counter){
            // This is a  new Article
            $this->setAttributes($cond);
            $this->$attribute = $num;
            $this->save();
        } else {
            // This article has been created but someone Explored her.
            $countData[$attribute] = $num;
            $counter->updateCounters($countData);
        }
    }
}
