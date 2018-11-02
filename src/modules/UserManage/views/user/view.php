<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model thienhungho\UserManagement\modules\UserBase\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <div class="row">
        <div class="col-sm-8">
            <h2><?= Yii::t('app', 'User').' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-4" style="margin-top: 15px">
<?=             
             Html::a('<i class="fa glyphicon glyphicon-hand-up"></i> ' . Yii::t('app', 'PDF'), 
                ['pdf', 'id' => $model->id],
                [
                    'class' => 'btn btn-danger',
                    'target' => '_blank',
                    'data-toggle' => 'tooltip',
                    'title' => Yii::t('app', 'Will open the generated PDF file in a new window')
                ]
            )?>
            <?= Html::a(Yii::t('app', 'Save As New'), ['save-as-new', 'id' => $model->id], ['class' => 'btn btn-info']) ?>            
            <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ])
            ?>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'username',
        'email:email',
        'full_name',
        'job',
        'bio:ntext',
        'company',
        'tax_number',
        'address',
        'phone',
        'birth_date',
        'facebook_url:url',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);
?>
    </div>
    
<!--    <div class="row">-->
<?php
//if($providerBlock->totalCount){
//    $gridColumnBlock = [
//        ['class' => 'yii\grid\SerialColumn'],         [             'class' => 'yii\grid\CheckboxColumn', 'checkboxOptions' => function($data) {                 return ['value' => $data->id];             },         ],
//            ['attribute' => 'id', 'visible' => false],
//            'name',
//            'content:ntext',
//                        'language',
//            'assign_with',
//    ];
//    echo Gridview::widget([
//        'dataProvider' => $providerBlock,
//        'pjax' => true,
//        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-block']],
//        'panel' => [
//            'type' => GridView::TYPE_PRIMARY,
//            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Block')),
//        ],
//        'columns' => $gridColumnBlock
//    ]);
//}
//?>
<!---->
<!--    </div>-->
    
<!--    <div class="row">-->
<?php
//if($providerComment->totalCount){
//    $gridColumnComment = [
//        ['class' => 'yii\grid\SerialColumn'],         [             'class' => 'yii\grid\CheckboxColumn', 'checkboxOptions' => function($data) {                 return ['value' => $data->id];             },         ],
//            ['attribute' => 'id', 'visible' => false],
//            'content:ntext',
//            'author_name',
//            'author_email:email',
//            'author_url:url',
//            'author_ip',
//            'status',
//            'type',
//            'obj_type',
//            'obj_id',
//            'parent',
//                ];
//    echo Gridview::widget([
//        'dataProvider' => $providerComment,
//        'pjax' => true,
//        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-comment']],
//        'panel' => [
//            'type' => GridView::TYPE_PRIMARY,
//            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Comment')),
//        ],
//        'columns' => $gridColumnComment
//    ]);
//}
//?>

<!--    </div>-->
    
<!--    <div class="row">-->
<?php
//if($providerPost->totalCount){
//    $gridColumnPost = [
//        ['class' => 'yii\grid\SerialColumn'],         [             'class' => 'yii\grid\CheckboxColumn', 'checkboxOptions' => function($data) {                 return ['value' => $data->id];             },         ],
//            ['attribute' => 'id', 'visible' => false],
//            'title',
//            'slug',
//            'content:ntext',
//                        'feature_img',
//            'status',
//            'comment_status',
//            'post_parent',
//            'post_type',
//            'language',
//            'assign_with',
//    ];
//    echo Gridview::widget([
//        'dataProvider' => $providerPost,
//        'pjax' => true,
//        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-post']],
//        'panel' => [
//            'type' => GridView::TYPE_PRIMARY,
//            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Post')),
//        ],
//        'columns' => $gridColumnPost
//    ]);
//}
//?>
<!---->
<!--    </div>-->
    
<!--    <div class="row">-->
<?php
//if($providerProduct->totalCount){
//    $gridColumnProduct = [
//        ['class' => 'yii\grid\SerialColumn'],         [             'class' => 'yii\grid\CheckboxColumn', 'checkboxOptions' => function($data) {                 return ['value' => $data->id];             },         ],
//            ['attribute' => 'id', 'visible' => false],
//            'title',
//            'slug',
//            'description:ntext',
//            'content:ntext',
//                        'feature_img',
//            'sku',
//            'quantity',
//            'status',
//            'comment_status',
//            'rating_status',
//            'promotional_price',
//            'price',
//            'unit',
//            'gallery:ntext',
//            'product_parent',
//            'product_type',
//            'language',
//            'assign_with',
//    ];
//    echo Gridview::widget([
//        'dataProvider' => $providerProduct,
//        'pjax' => true,
//        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-product']],
//        'panel' => [
//            'type' => GridView::TYPE_PRIMARY,
//            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Product')),
//        ],
//        'columns' => $gridColumnProduct
//    ]);
//}
//?>
<!---->
<!--    </div>-->
    
<!--    <div class="row">-->
<?php
//if($providerTerm->totalCount){
//    $gridColumnTerm = [
//        ['class' => 'yii\grid\SerialColumn'],         [             'class' => 'yii\grid\CheckboxColumn', 'checkboxOptions' => function($data) {                 return ['value' => $data->id];             },         ],
//            ['attribute' => 'id', 'visible' => false],
//            'name',
//            'slug',
//            'description:ntext',
//                        'feature_img',
//            'term_parent',
//            'term_type',
//            'language',
//            'assign_with',
//    ];
//    echo Gridview::widget([
//        'dataProvider' => $providerTerm,
//        'pjax' => true,
//        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-term']],
//        'panel' => [
//            'type' => GridView::TYPE_PRIMARY,
//            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Term')),
//        ],
//        'columns' => $gridColumnTerm
//    ]);
//}
//?>
<!---->
<!--    </div>-->
</div>
