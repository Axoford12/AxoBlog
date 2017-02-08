<?php
use yii\helpers\Url;

?>
<div class="col-lg-8">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <?php foreach ($data as $k => $list): ?>
                <li data-target="#carousel-example-generic" data-slide-to="<?= $k ?>" class="active"></li>
            <?php endforeach; ?>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner home-banner" role="listbox">
            <?php foreach ($data as $k => $list): ?>
                <div class="item <?=$k == 0?'active':''?>">
                    <a href="<?= Url::to(['post/index'],['id' => $list['id']]) ?>"><img class="img-responsive" src="<?= $list['label_img'] != '0'
                            ? $list['label_img']
                            : 'http://p5.img.cctvpic.com/nettv/ent/program/xin'
                            .'xiyouji/20110727/images/100529_5464_1311924643253.jpg'?>" alt="Axo">
                        <div class="carousel-caption">

                        </div>
                    </a>
                </div>
            <?php endforeach; ?>

        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
        </a>
    </div>
    <?=\common\widgets\ArticleList\ArticleList::widget()?>
</div>
<div class="col-lg-3">

</div>