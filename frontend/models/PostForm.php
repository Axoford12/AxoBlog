<?php
/**
 * User: Axoford12
 * Date: 2/3/2017
 * Time: 6:03 PM
 */

namespace frontend\models;


use common\models\Posts;
use common\models\RelationPostTags;
use data;
use yii\base\Exception;
use yii\base\Model;
use yii\db\Query;
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
        $res = Posts::find()->with('relate')->where(['id' => $id])->asArray()->one();
        if (!$res) {
            throw new NotFoundHttpException('没有文章');
        }
        print_r($res);
    }

    /**
     *  Be call after create
     * @param $data data of Event
     */
    public function _eventAfterCreate($data)
    {
        $this->on(self::EVENT_AFTER_CREATE, [$this, '_eventAddTag'], $data);
        $this->trigger(self::EVENT_AFTER_CREATE);
    }

    public function _eventAddTag($event)
    {
        $tag = new TagForm();
        $tag->tags = $event->data['tags'];
        $tagsId = $tag->saveTags();
        print_r($event->data);
        print_r($tagsId);exit;
        // Cleat Post tags
        RelationPostTags::deleteAll(['post_id' => $event->data['id']]);
        // batch save tags
        if(!empty($tagsId)){
            $row = $tagsId;
            foreach ($tagsId as $k => $value){
                $row[$k]['post_id'] = $this->id;
                $row[$k]['tag_id'] = $value;
            }

            $res = (new Query())->createCommand()
                ->batchInsert(RelationPostTags::tableName(),['post_id','tag_id'],$row)
                ->execute();
            if(!$res){
                new Exception('Faild to save tags!');
            }
        }

    }

}