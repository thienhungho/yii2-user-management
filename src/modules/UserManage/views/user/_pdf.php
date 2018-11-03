<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model thienhungho\UserManagement\modules\UserBase\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => t('app', 'User'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= t('app', 'User').' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'username',
        'auth_key',
        'password_hash',
        'password_reset_token',
        'email:email',
        'full_name',
        'job',
        'bio:ntext',
        'company',
        'tax_number',
        'address',
        'avatar',
        'phone',
        'birth_date',
        'facebook_url:url',
        'status',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
if($providerBlock->totalCount){
    $gridColumnBlock = [
        ['class' => 'yii\grid\SerialColumn'],         [             'class' => 'yii\grid\CheckboxColumn', 'checkboxOptions' => function($data) {                 return ['value' => $data->id];             },         ],
        ['attribute' => 'id', 'visible' => false],
        'name',
        'content:ntext',
                'language',
        'assign_with',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerBlock,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(t('app', 'Block')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnBlock
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerComment->totalCount){
    $gridColumnComment = [
        ['class' => 'yii\grid\SerialColumn'],         [             'class' => 'yii\grid\CheckboxColumn', 'checkboxOptions' => function($data) {                 return ['value' => $data->id];             },         ],
        ['attribute' => 'id', 'visible' => false],
        'content:ntext',
        'author_name',
        'author_email:email',
        'author_url:url',
        'author_ip',
        'status',
        'type',
        'obj_type',
        'obj_id',
        'parent',
            ];
    echo Gridview::widget([
        'dataProvider' => $providerComment,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(t('app', 'Comment')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnComment
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerPost->totalCount){
    $gridColumnPost = [
        ['class' => 'yii\grid\SerialColumn'],         [             'class' => 'yii\grid\CheckboxColumn', 'checkboxOptions' => function($data) {                 return ['value' => $data->id];             },         ],
        ['attribute' => 'id', 'visible' => false],
        'title',
        'slug',
        'content:ntext',
                'feature_img',
        'status',
        'comment_status',
        'post_parent',
        'post_type',
        'language',
        'assign_with',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerPost,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(t('app', 'Post')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnPost
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerProduct->totalCount){
    $gridColumnProduct = [
        ['class' => 'yii\grid\SerialColumn'],         [             'class' => 'yii\grid\CheckboxColumn', 'checkboxOptions' => function($data) {                 return ['value' => $data->id];             },         ],
        ['attribute' => 'id', 'visible' => false],
        'title',
        'slug',
        'description:ntext',
        'content:ntext',
                'feature_img',
        'sku',
        'quantity',
        'status',
        'comment_status',
        'rating_status',
        'promotional_price',
        'price',
        'unit',
        'gallery:ntext',
        'product_parent',
        'product_type',
        'language',
        'assign_with',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerProduct,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(t('app', 'Product')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnProduct
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerTerm->totalCount){
    $gridColumnTerm = [
        ['class' => 'yii\grid\SerialColumn'],         [             'class' => 'yii\grid\CheckboxColumn', 'checkboxOptions' => function($data) {                 return ['value' => $data->id];             },         ],
        ['attribute' => 'id', 'visible' => false],
        'name',
        'slug',
        'description:ntext',
                'feature_img',
        'term_parent',
        'term_type',
        'language',
        'assign_with',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerTerm,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(t('app', 'Term')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnTerm
    ]);
}
?>
    </div>
</div>
