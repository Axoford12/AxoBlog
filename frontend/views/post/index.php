<div class="col-lg-8"><div class="panel">
        <div class="panel-title box-title">
            <span><?= $data['title'] ?></span>
            <?php if($this->context->more):?>
                <span class="pull-right"><a href="<?=$data['more']?>" class="font-12">更多»</a></span>
            <?php endif;?>

        </div>
        <div class="new-list">
            <?php foreach ($data['body'] as $list):?>
                <div class="panel-body border-bottom">
                    <div class="row">
                        <div class="col-lg-4 label-img-size">
                            <a href="#" class="post-label">
                                <?php if($list['label_img'] != '0'){
                                    $labelImgSrc = $list['label_img'];
                                }else{
                                    $labelImgSrc = "http://p5.img.cctvpic.com/nettv/ent/program/xinxiyouji/20110727/images/100529_5464_1311924643253.jpg";
                                }
                                ?>
                                <img src="<?=$labelImgSrc ?>" width="200" height="130">
                            </a>
                        </div>
                        <div class="col-lg-8 btn-group">
                            <h1><a href="<?=\yii\helpers\Url::to(['post/detail','id'=>$list['id']])?>"><?=$list['title']?></a></h1>
                            <span class="post-tags">
                        <span class="glyphicon glyphicon-time"></span><?=date('Y-m-d',$list['created_at'])?>&nbsp;
                        <span class="glyphicon glyphicon-eye-open"></span><?=isset($list['extend']['browser'])?$list['extend']['browser']:0?>&nbsp;
                        <span class="glyphicon glyphicon-comment"></span><a href="<?=\yii\helpers\Url::to(['post/detail','id'=>$list['id']])?>"><?=isset($list['extend']['comment'])?$list['extend']['comment']:0?></a>
                    </span>
                            <p class="post-content"><?=$list['summary']?></p>
                            <a href="<?=\yii\helpers\Url::to(['post/view','id'=>$list['id']])?>"><button class="btn btn-warning no-radius btn-sm pull-right">阅读全文</button></a>
                        </div>
                    </div>
                </div>
            <?php endforeach;?>
        </div>
        <?php if($this->context->page):?>
            <div class="page"><?=\yii\widgets\LinkPager::widget(['pagination' => $data['page']]);?></div>
        <?php endif;?>
    </div></div>
<div class="col-lg-4">
+
</div>
