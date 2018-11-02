<?php
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;

    $dataProvider = new ArrayDataProvider([
        'allModels' => $model->terms,
        'key' => 'id'
    ]);
    $gridColumns = [
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
        [
            'class' => 'yii\grid\ActionColumn',
            'controller' => 'term'
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
