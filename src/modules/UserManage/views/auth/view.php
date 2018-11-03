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
        <div class="col-sm-8">
            <h2><?= t('app', 'Auth Item').' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-4" style="margin-top: 15px">
<?=             
             Html::a('<i class="fa glyphicon glyphicon-hand-up"></i> ' . t('app', 'PDF'),
                ['pdf', 'id' => $model->name],
                [
                    'class' => 'btn btn-danger',
                    'target' => '_blank',
                    'data-toggle' => 'tooltip',
                    'title' => t('app', 'Will open the generated PDF file in a new window')
                ]
            )?>
            <?= Html::a(t('app', 'Save As New'), ['save-as-new', 'id' => $model->name], ['class' => 'btn btn-info']) ?>
            <?= Html::a(t('app', 'Update'), ['update', 'id' => $model->name], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(t('app', 'Delete'), ['delete', 'id' => $model->name], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ])
            ?>
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
            'label' => t('app', 'Rule Name'),
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-auth-assignment']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(t('app', 'Auth Assignment')),
        ],
        'columns' => $gridColumnAuthAssignment
    ]);
}
?>

    </div>
    <div class="row">
        <h4>AuthRule<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnAuthRule = [
        'name',
        'data',
    ];
    echo DetailView::widget([
        'model' => $model->ruleName,
        'attributes' => $gridColumnAuthRule    ]);
    ?>
    
    <div class="row">
<?php
if($providerAuthItemChild->totalCount){
    $gridColumnAuthItemChild = [
        ['class' => 'yii\grid\SerialColumn'],         [             'class' => 'yii\grid\CheckboxColumn', 'checkboxOptions' => function($data) {                 return ['value' => $data->id];             },         ],
                            ];
    echo Gridview::widget([
        'dataProvider' => $providerAuthItemChild,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-auth-item-child']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(t('app', 'Auth Item Child')),
        ],
        'columns' => $gridColumnAuthItemChild
    ]);
}
?>

    </div>
</div>
