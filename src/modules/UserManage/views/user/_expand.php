<?php
use yii\helpers\Html;
use kartik\tabs\TabsX;
use yii\helpers\Url;
$items = [
    [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('app', 'User')),
        'content' => $this->render('_detail', [
            'model' => $model,
        ]),
    ],
        [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('app', 'Block')),
        'content' => $this->render('_dataBlock', [
            'model' => $model,
            'row' => $model->blocks,
        ]),
    ],
            [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('app', 'Comment')),
        'content' => $this->render('_dataComment', [
            'model' => $model,
            'row' => $model->comments,
        ]),
    ],
            [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('app', 'Post')),
        'content' => $this->render('_dataPost', [
            'model' => $model,
            'row' => $model->posts,
        ]),
    ],
//            [
//        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('app', 'Product')),
//        'content' => $this->render('_dataProduct', [
//            'model' => $model,
//            'row' => $model->products,
//        ]),
//    ],
            [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('app', 'Term')),
        'content' => $this->render('_dataTerm', [
            'model' => $model,
            'row' => $model->terms,
        ]),
    ],
    ];
echo TabsX::widget([
    'items' => $items,
    'position' => TabsX::POS_ABOVE,
    'encodeLabels' => false,
    'class' => 'tes',
    'pluginOptions' => [
        'bordered' => true,
        'sideways' => true,
        'enableCache' => false
    ],
]);
?>
