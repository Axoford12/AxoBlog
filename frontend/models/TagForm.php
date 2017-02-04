<?php
/**
 * User: Axoford12
 * Date: 2/4/2017
 * Time: 9:47 PM
 */

namespace frontend\models;


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

    /**
     * @return A rule of Tags
     */
    public function rules(){
        return [
            ['id','required'],
            ['tags','each','rule' => ['string']]
        ];
    }
    public function saveTags(){

    }
}