<?php
/**
 * User: Axoford12
 * Date: 2/3/2017
 * Time: 5:49 PM
 */

namespace frontend\controllers;


use common\models\Cats;
use frontend\models\PostForm;
use yii\web\Controller;

class PostController extends Controller
{
    public $layout = 'main';

    /**
     * 文章列表
     */
    public function actionIndex()
    {

        return $this->render('index');

    }

    public function actions()
    {
        return [
            'upload' => [
                'class' => 'common\widgets\file_upload\UploadAction',     //这里扩展地址别写错
                'config' => [
                    'imagePathFormat' => "/image/{yyyy}{mm}{dd}/{time}{rand:6}",
                ]
            ],
            'ueditor' => [
                'class' => 'common\widgets\ueditor\UeditorAction',
                'config' => [
                    //上传图片配置
                    'imageUrlPrefix' => "", /* 图片访问路径前缀 */
                    'imagePathFormat' => "/image/{yyyy}{mm}{dd}/{time}{rand:6}", /* 上传保存路径,可以自定义保存路径和文件名格式 */
                ]
            ]
        ];
    }

    public function actionCreate()
    {
        if (\Yii::$app->user->isGuest or (\Yii::$app->user->id != 1)) {
            \Yii::$app->response->statusCode = 403;
            return $this->render('Error');
        }
        $model = new PostForm();
        if ($model->load(\Yii::$app->request->post())) {
            if (!$model->create()) {

            } else {
                return $this->redirect(['post/view', 'id' => $model->id]);
            }
        }

        $cat = Cats::getAllCats();
        return $this->render('create', ['model' => $model, 'cat' => $cat]);
    }

}