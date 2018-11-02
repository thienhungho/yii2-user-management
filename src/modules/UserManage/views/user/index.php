<?php
/* @var $this yii\web\View */
/* @var $searchModel thienhungho\UserManagement\modules\UserManage\search\UserSearch */

/* @var $dataProvider yii\data\ActiveDataProvider */

use kartik\grid\GridView;
use yii\helpers\Html;

$this->title = Yii::t('app', 'User');
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);
?>

<div class="user-index-head">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-lg-10">
            <p>
                <?= Html::a(Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?>
                <?= Html::a(Yii::t('app', 'Advance Search'), '#', ['class' => 'btn btn-info search-button']) ?>
            </p>
        </div>
        <div class="col-lg-2">
            <?php backend_per_page_form() ?>
        </div>
    </div>
    <div class="search-form" style="display:none">
        <?= $this->render('_search', ['model' => $searchModel]); ?>
    </div>
</div>

<div class="user-index">
    <?php
    $gridColumn = [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'class'           => 'yii\grid\CheckboxColumn',
            'checkboxOptions' => function($data) {
                return ['value' => $data->id];
            },
        ],
        [
            'class'         => 'kartik\grid\ExpandRowColumn',
            'width'         => '50px',
            'value'         => function($model, $key, $index, $column) {
                return GridView::ROW_COLLAPSED;
            },
            'detail'        => function($model, $key, $index, $column) {
                return Yii::$app->controller->renderPartial('_expand', ['model' => $model]);
            },
            'headerOptions' => ['class' => 'kartik-sheet-style'],
            'expandOneOnly' => true,
        ],
        [
            'attribute' => 'id',
            'visible'   => false,
        ],
        [
            'class'     => \yii\grid\DataColumn::className(),
            'format'    => 'raw',
            'attribute' => 'avatar',
            'value'     => function($model, $key, $index, $column) {
                return Html::a(
                    '<img style="max-width: 50px;" src=/' . \common\modules\media\Media::getOtherSizePath('thumbnail', $model->avatar) . '>',
                    \yii\helpers\Url::to(['/']), [
                    'data-pjax' => '0',
                    'target'    => '_blank',
                ]);
            },
        ],
        'username',
        'email:email',
        'full_name',
        [
            'format'    => 'raw',
            'attribute' => 'phone',
            'value'     => function($model, $key, $index, $column) {
                return Html::a($model->phone, 'tel:' . $model->phone);
            },
        ],
        'birth_date',
        [
            'format'    => 'url',
            'attribute' => 'facebook_url',
        ],
        [
            'format'              => 'raw',
            'attribute'           => 'status',
            'value'               => function($model, $key, $index, $column) {
                if ($model->status == \thienhungho\UserManagement\modules\UserBase\User::STATUS_DELETED) {
                    return '<span class="label-danger label">' . __t('app', 'Deleted') . '</span>';
                } elseif ($model->status == \thienhungho\UserManagement\modules\UserBase\User::STATUS_ACTIVE) {
                    return '<span class="label-success label">' . __t('app', 'Active') . '</span>';
                }
            },
            'filterType'          => GridView::FILTER_SELECT2,
            'filter'              => \yii\helpers\ArrayHelper::map([
                [
                    'value' => \thienhungho\UserManagement\modules\UserBase\User::STATUS_DELETED,
                    'name'  => __t('app', 'Deleted'),
                ],
                [
                    'value' => \thienhungho\UserManagement\modules\UserBase\User::STATUS_ACTIVE,
                    'name'  => __t('app', 'Active'),
                ],
            ], 'value', 'name'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions'  => [
                'placeholder' => Yii::t('app', 'Status'),
                'id'          => 'grid-search-status',
            ],
        ],
    ];
    $gridColumn[] = grid_view_default_active_column_cofig();
    ?>
    <?= GridView::widget([
        'dataProvider'   => $dataProvider,
        'filterModel'    => $searchModel,
        'columns'        => $gridColumn,
        'responsiveWrap' => false,
        'condensed'      => true,
        'pjax'           => true,
        'pjaxSettings'   => ['options' => ['id' => 'kv-pjax-container-user']],
        'panel'          => [
            'type'    => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
        ],
        'toolbar'        => grid_view_toolbar_config($dataProvider, $gridColumn),
    ]); ?>

    <div class="row">
        <div class="col-lg-2">
            <?= \kartik\widgets\Select2::widget([
                'name'    => 'action',
                'data'    => [
                    ACTION_DELETE                                     => __t('app', 'Delete'),
                    \thienhungho\UserManagement\modules\UserBase\User::STATUS_ACTIVE => __t('app', slug_to_text(STATUS_ACTIVE)),
                ],
                'theme'   => \kartik\widgets\Select2::THEME_BOOTSTRAP,
                'options' => [
                    'multiple'    => false,
                    'placeholder' => __t('app', 'Bulk Actions ...'),
                ],
            ]); ?>
        </div>
        <div class="col-lg-10">
            <?= Html::submitButton(__t('app', 'Apply'), [
                'class'        => 'btn btn-primary',
                'data-confirm' => __t('app', 'Are you want to do this?'),
            ]) ?>
        </div>
    </div>
</div>
