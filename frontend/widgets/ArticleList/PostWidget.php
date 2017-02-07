<?php

/**
 * User: Axoford12
 * Date: 2/6/2017
 * Time: 9:39 PM
 */
namespace frontend\widgets;
use common\models\Posts;
use frontend\models\PostForm;
use yii\data\Pagination;
use yii\helpers\Url;

class PostWidget extends \yii\base\Widget
{
    public $title = '';
    public $limit =  6;
    public $more = true;
    public $page = false;

    public function run(){
        $curPage = \Yii::$app->request->get('page',1);
        $cond = ['=','is_valid',Posts::IS_VALID];
        $res = PostForm::getList($cond,$curPage,$this->limit);
        $result[ 'title'] = $this->title?:'文章';
        $result[ 'more'] = Url::to(['post/index']);
        $result[ 'body'] = $res['data'];

        if($this->page){
            $pages = new Pagination(['totalCount' => $res['count'],'pageSize' => $res['pageSize']]);
            $result[ 'page'] = $pages;
        }
        $this->render('index',['data' => $result]);
    }
}