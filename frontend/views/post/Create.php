<?php
/**
 * User: Axoford12
 * Date: 2/3/2017
 * Time: 6:14 PM
 */
# echo '1';
$this->title = '创建';
$this->params['breadcrumbs'][] = ['label' => '文章','url' => ['/post/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-lg-9">
        <div class="panel-title box-title">
            <span>创建文章</span>
        </div>
        <div class="panel-body">
            <?php $form = \yii\bootstrap\ActiveForm::begin()?>
            <?= $form->field($model,'title')->textInput(['maxlength' => true]); ?>
            <?= $form->field($model,'cat_id')->dropDownList($cat); ?>
            <?= $form->field($model, 'label_img')->widget('common\widgets\file_upload\FileUpload',[
                'config'=>[

                    'domain_url' => 'http://www.yii-china.com',
                ]
            ]) ?>
            <?= $form->field($model, 'content')->widget('common\widgets\ueditor\Ueditor',[
                'options'=>[
                    'initialFrameWidth' => 850,
                ]
            ]) ?>
            <div class="form-group">
                <?= \yii\bootstrap\Html::submitButton('发布', ['class' => 'btn btn-success', 'name' => 'submit-button']) ?>
            </div>
            <?php \yii\bootstrap\ActiveForm::end()?>
        </div>
    </div>
    <div class="col-lg-3">
        <span>Axo:</span>
        <p>暂时没啥想说的。。</p>
        <p>先放在这，以后放链接吧</p>
    </div>
</div>
