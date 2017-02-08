<?php

namespace common\widgets\ArticleList;
use frontend\models\PostForm;
use yii\bootstrap\Widget;
use yii\helpers\Url;

/**
 * User: Axoford12
 * Date: 2/8/2017
 * Time: 7:42 PM
 */
class ArticleList extends Widget

{

    public $more = true;
    public $page = false;
    public function run()
    {
        $res = PostForm::getList();
        $result['title'] = '';
        $result['more'] = Url::to(['post/index']);
        $result['body'] = $res['data'];
        return $this->render('index',['data' => $result]);
    }

}