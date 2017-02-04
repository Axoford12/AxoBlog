<?php
/**
 * User: Axoford12
 * Date: 2/4/2017
 * Time: 9:47 PM
 */

namespace frontend\models;


use common\models\Tags;
use yii\base\Exception;
use yii\base\Model;

class TagForm extends Model
{
    /**
     * @var Id of a Tag
     */
    public $id;

    /**
     * @var Tag Name
     */
    public $tags;

    public function rules(){
        return [
            ['id','required'],
            ['tags','each','rule' => ['string']]
        ];
    }
    public function saveTags(){
        $ids = [];
        if(!empty($this->tags)){
            foreach ($this->tags as $tags) {
                $ids[] = $this->_saveTags($tags);
            }
        }
        return $ids;
    }

    /**
     * Save tags
     */
    public function _saveTags($tags){
        $model = new Tags();
        // Find this tag
        $res = $model->find()->where(['tag_name' => $tags])->one();
        // Don't find this tag
        if(!$res){
            $model->tag_name = $tags;
            $model->post_num = 1;
            if(!$model->save()){
                // Failed to save
                // throw a new Exception.
                throw new Exception('Can not save');

            } else {
                $model->updateCounters(['post_num' => 1]);
            }
            return $model->id;

        }
        return $res->id;
    }
}