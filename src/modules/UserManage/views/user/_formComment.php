<div class="form-group" id="add-comment">
<?php
use kartik\grid\GridView;
use kartik\builder\TabularForm;
use yii\data\ArrayDataProvider;
use yii\helpers\Html;
use yii\widgets\Pjax;

$dataProvider = new ArrayDataProvider([
    'allModels' => $row,
    'pagination' => [
        'pageSize' => -1
    ]
]);
echo TabularForm::widget([
    'dataProvider' => $dataProvider,
    'formName' => 'Comment',
    'checkboxColumn' => false,
    'actionColumn' => false,
    'attributeDefaults' => [
        'type' => TabularForm::INPUT_TEXT,
    ],
    'attributes' => [
        "id" => ['type' => TabularForm::INPUT_HIDDEN, 'columnOptions' => ['hidden'=>true]],
        'content' => ['type' => TabularForm::INPUT_TEXTAREA],
        'author_name' => ['type' => TabularForm::INPUT_TEXT],
        'author_email' => ['type' => TabularForm::INPUT_TEXT],
        'author_url' => ['type' => TabularForm::INPUT_TEXT],
        'author_ip' => ['type' => TabularForm::INPUT_TEXT],
        'status' => ['type' => TabularForm::INPUT_TEXT],
        'type' => ['type' => TabularForm::INPUT_TEXT],
        'obj_type' => ['type' => TabularForm::INPUT_TEXT],
        'obj_id' => ['type' => TabularForm::INPUT_TEXT],
        'parent' => ['type' => TabularForm::INPUT_TEXT],
        'del' => [
            'type' => 'raw',
            'label' => '',
            'value' => function($model, $key) {
                return
                    Html::hiddenInput('Children[' . $key . '][id]', (!empty($model['id'])) ? $model['id'] : "") .
                    Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' =>  Yii::t('app', 'Delete'), 'onClick' => 'delRowComment(' . $key . '); return false;', 'id' => 'comment-del-btn']);
            },
        ],
    ],
    'gridSettings' => [
        'panel' => [
            'heading' => false,
            'type' => GridView::TYPE_DEFAULT,
            'before' => false,
            'footer' => false,
            'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', 'Add Comment'), ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowComment()']),
        ]
    ]
]);
echo  "    </div>\n\n";
?>

