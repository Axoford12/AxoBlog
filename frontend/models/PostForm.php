<?php
/**
 * User: Axoford12
 * Date: 2/3/2017
 * Time: 6:03 PM
 */

namespace frontend\models;


use common\models\Posts;
use data;
use yii\base\Model;
use yii\web\NotFoundHttpException;

class PostForm extends Model
{

    public $id;
    public $content;
    public $title;
    public $label_img;
    public $tags;
    public $cat_id;
    public $summary;

    const EVENT_AFTER_CREATE = 'eventAfterCreate';

    public function rules()
    {
        return [
            [['title', 'id', 'content', 'cat_id'], 'required', 'message' => '必须要填哦！'],
            [['id', 'cat_id'], 'integer', 'message' => 'id必须是整数的嘛！'],
            ['title', 'string', 'min' => '4', 'max' => '50', 'message' => '标题要认真打的！'],
            ['summary', 'required', 'message' => '不写是不行的哦！'],
            ['summary', 'string', 'min' => 0, 'max' => 90, 'message' => '写那么长干嘛納？']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '标题',
            'content' => '内容',
            'tags' => '标签',
            'label_img' => '标签图',
            'cat_id' => '分类',
            'summary' => '写个小摘要吧!'
        ];
    }

    public function create()
    {
        $post = new Posts();

        $post->setAttributes($this->attributes);
        $post->created_at = time();
        $post->save();
        $data = array_merge($this->getAttributes(), $post->getAttributes());
        $this->_eventAfterCreate($data);


        return true;
    }

    public function getViewsById($id)
    {
        $res = Posts::find()->where(['id' => $id])->asArray()->one();
        if (!$res) {
            throw new NotFoundHttpException('没有文章');
        }
        return $res;
    }

    /**
     *  Be call after create
     * @param $data data of Event
     */
    public function _eventAfterCreate($data)
    {
        $this->on(self::EVENT_AFTER_CREATE, [$this, '_eventAddTag'], $data);
    }


}