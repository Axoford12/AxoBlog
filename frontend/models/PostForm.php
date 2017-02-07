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
            ['title', 'string', 'min' => 4, 'max' => 50, 'message' => '标题要认真打的！'],
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
            'cat_id' => '分类',
            'summary' => '写个小摘要吧!'
        ];
    }

    public function create()
    {
        $post = new Posts();
        $post = new Posts();
        $post->setAttributes($this->attributes);
        $post->created_at = time();
        $post->save();
        $this->attributes = $post->getAttributes();
        $data = array_merge($this->getAttributes(), $post->getAttributes());
        $this->_eventAfterCreate($data);
        return true;
    }

    public function getViewsById($id)
    {
        $res = Posts::find()->with('extend')->where(['id' => $id])->asArray()->one();
        if (!$res) {
            throw new NotFoundHttpException('没有文章');
        }
        return $res;
    }
    public static function getList($cond,$pageSize = 5,$curPage = 1,$orderBy = ['id' => SORT_DESC])
    {
        $post = new Posts();
        $select = ['id', 'title', 'is_valid', 'summary', 'cat_id', 'created_at'];
        $query = $post
            ->find()
            ->select($select)
            ->where($cond)
            ->with('extend')
            ->orderBy($orderBy);
        // Get Pages data
        $res = $post->getPages($curPage, $pageSize, $query); # TODO Implement this function
        // Format this data
        $res['data'] = self::_format($res['data']);# TODO Implement this function
    }
    private static function _format($data){
        foreach($data as $list){

        }
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