<?php
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;

    $dataProvider = new ArrayDataProvider([
        'allModels' => $model->products,
        'key' => 'id'
    ]);
    $gridColumns = [
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
        [
            'class' => 'yii\grid\ActionColumn',
            'controller' => 'product'
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
