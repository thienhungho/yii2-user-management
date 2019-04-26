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
<?= Html::beginForm(['bulk']) ?>
<div class="user-index">
    <?php
    $gridColumn = [
        [
            'class'  => \kartik\grid\SerialColumn::className(),
            'vAlign' => GridView::ALIGN_MIDDLE,
        ],
        [
            'class'           => \kartik\grid\CheckboxColumn::className(),
            'checkboxOptions' => function($data) {
                return ['value' => $data->id];
            },
            'vAlign'          => GridView::ALIGN_MIDDLE,
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
            'class'     => \kartik\grid\DataColumn::className(),
            'format'    => 'raw',
            'attribute' => 'avatar',
            'value'     => function($model, $key, $index, $column) {
                return Html::a(
                    '<img style="max-width: 50px;" src=/' . get_other_img_size_path('thumbnail', $model->avatar) . '>',
                    \yii\helpers\Url::to(['/']), [
                    'data-pjax' => '0',
                    'target'    => '_blank',
                ]);
            },
            'vAlign'    => GridView::ALIGN_MIDDLE,
        ],
        [
            'attribute' => 'username',
            'vAlign'    => GridView::ALIGN_MIDDLE,
        ],
        [
            'attribute' => 'email',
            'format'    => 'email',
            'vAlign'    => GridView::ALIGN_MIDDLE,
        ],
        [
            'attribute' => 'full_name',
            'vAlign'    => GridView::ALIGN_MIDDLE,
        ],
        [
            'format'    => 'raw',
            'attribute' => 'phone',
            'value'     => function($model, $key, $index, $column) {
                return Html::a($model->phone, 'tel:' . $model->phone);
            },
            'vAlign'    => GridView::ALIGN_MIDDLE,
        ],
        [
            'attribute' => 'birth_date',
            'vAlign'    => GridView::ALIGN_MIDDLE,
        ],
        [
            'format'    => 'url',
            'attribute' => 'facebook_url',
            'vAlign'    => GridView::ALIGN_MIDDLE,
        ],
        [
            'format'              => 'raw',
            'attribute'           => 'status',
            'vAlign'              => GridView::ALIGN_MIDDLE,
            'value'               => function($model, $key, $index, $column) {
                if ($model->status == \thienhungho\UserManagement\models\User::STATUS_DELETED) {
                    return '<span class="label-danger label">' . t('app', 'Deleted') . '</span>';
                } elseif ($model->status == \thienhungho\UserManagement\models\User::STATUS_ACTIVE) {
                    return '<span class="label-success label">' . t('app', 'Active') . '</span>';
                }
            },
            'filterType'          => GridView::FILTER_SELECT2,
            'filter'              => \yii\helpers\ArrayHelper::map([
                [
                    'value' => \thienhungho\UserManagement\models\User::STATUS_DELETED,
                    'name'  => t('app', 'Deleted'),
                ],
                [
                    'value' => \thienhungho\UserManagement\models\User::STATUS_ACTIVE,
                    'name'  => t('app', 'Active'),
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
    $active_column = grid_view_default_active_column_cofig();
    $active_column['buttons']['change-password'] = function($url) {
        return \yii\helpers\Html::a('<span class="btn btn-xs purple"><span class="glyphicon glyphicon-lock"></span></span>', $url, ['title' => t('app', 'Change Password')]);
    };
    $active_column['template'] = '{view} {save-as-new} {update} {change-password} {delete}';
    $gridColumn[] = $active_column;
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
                    ACTION_DELETE                                          => t('app', 'Delete'),
                    \thienhungho\UserManagement\models\User::STATUS_ACTIVE => t('app', slug_to_text(STATUS_ACTIVE)),
                    \thienhungho\UserManagement\models\User::STATUS_PENDING => t('app', slug_to_text(STATUS_PENDING))
                ],
                'theme'   => \kartik\widgets\Select2::THEME_BOOTSTRAP,
                'options' => [
                    'multiple'    => false,
                    'placeholder' => t('app', 'Bulk Actions ...'),
                ],
            ]); ?>
        </div>
        <div class="col-lg-10">
            <?= Html::submitButton(t('app', 'Apply'), [
                'class'        => 'btn btn-primary',
                'data-confirm' => t('app', 'Are you want to do this?'),
            ]) ?>
        </div>
    </div>
</div>

<?= Html::endForm() ?>
