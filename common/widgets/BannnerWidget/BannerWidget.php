<?php

namespace common\widgets\BannerWidget;
use common\models\Posts;
use yii\bootstrap\Widget;
/**
 * Class BannerWidget
 *  A widget that implements
 */
class BannerWidget extends Widget
{
    /**
     * @var array
     * Images array
     */
    private $item;

    public $limit = 4;

    /**
     * This function is an initial.
     * When There are no items found or defined
     * It will define default items
     */
    public function init(){
        // If call in none items.
        // Initial a new Item.
        if(empty($this->item)){
            $this->item = $this->_getItems();
        }
    }

    /**
     * @return string
     * Run when this widget be call.
     */
    public function run()
    {
        return $this->render('index');
    }

    private function _getItems(){
        $posts = Posts::find()
            ->select(['id','label_img'])
            ->limit($this->limit)
            ->asArray()
            ->all();
        print_r($posts);

    }
}