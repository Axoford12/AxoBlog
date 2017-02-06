<?php
/**
 * User: Axoford12
 * Date: 2/4/2017
 * Time: 8:52 PM
 */
$this->title = $data['title'] . '  -Axo\'s Blog';
$this->params['breadcrumbs'][] = ['label' => '文章', 'url' => ['post/index']];
$this->params['breadcrumbs'][] = $data['title'];
?>
<div class="row">
    <div class="col-lg-9">
        <div class="page-title">
            <h1><?= $data['title'] ?></h1>
            <p>
                <?= $data['content']; ?>
            </p>
            <span>发布：<?= date('Y-m-d', $data['created_at']); ?></br></span>
            <span>本条内容已经被<?= isset($data['extend']['browser'])?$data['extend']['browser']:0 ?>个小伙伴围观</span>
        </div>
    </div>


    <div class="col-lg-3">

    </div>
</div>
