<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\modules\auth\AuthItem */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => t('app', 'Auth Item'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= t('app', 'Auth Item').' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        'name',
        'type',
        'description:ntext',
        [
                'attribute' => 'ruleName.name',
                'label' => t('app', 'Rule Name')
            ],
        'data',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
if($providerAuthAssignment->totalCount){
    $gridColumnAuthAssignment = [
        ['class' => 'yii\grid\SerialColumn'],         [             'class' => 'yii\grid\CheckboxColumn', 'checkboxOptions' => function($data) {                 return ['value' => $data->id];             },         ],
                'user_id',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerAuthAssignment,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(t('app', 'Auth Assignment')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnAuthAssignment
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerAuthItemChild->totalCount){
    $gridColumnAuthItemChild = [
        ['class' => 'yii\grid\SerialColumn'],         [             'class' => 'yii\grid\CheckboxColumn', 'checkboxOptions' => function($data) {                 return ['value' => $data->id];             },         ],
                    ];
    echo Gridview::widget([
        'dataProvider' => $providerAuthItemChild,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(t('app', 'Auth Item Child')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnAuthItemChild
    ]);
}
?>
    </div>
</div>
