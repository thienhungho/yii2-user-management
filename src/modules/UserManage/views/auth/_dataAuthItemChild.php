<?php
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;

    $dataProvider = new ArrayDataProvider([
        'allModels' => $model->authItemChildren,
        'key' => function($model){
            return ['parent' => $model->parent, 'child' => $model->child];
        }
    ]);
    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'],         [             'class' => 'yii\grid\CheckboxColumn', 'checkboxOptions' => function($data) {                 return ['value' => $data->id];             },         ],
                [
            'class' => 'yii\grid\ActionColumn',
            'controller' => 'auth-item-child'
        ],
    ];
    
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
        'containerOptions' => ['style' => 'overflow: auto'],
        'pjax' => true,
        'beforeHeader' => [
            [
                'options' => ['class' => 'skip-export']
            ]
        ],
        'export' => [
            'fontAwesome' => true
        ],
        'bordered' => true,
        'striped' => true,
        'condensed' => true,
        'responsive' => true,
        'hover' => true,
        'showPageSummary' => false,
        'persistResize' => false,
    ]);
