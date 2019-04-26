<?php

namespace thienhungho\UserManagement\modules\UserManage\controllers;

use thienhungho\UserManagement\models\ChangePasswordForm;
use thienhungho\UserManagement\models\ChangePasswordFormForAdmin;
use Yii;
use thienhungho\UserManagement\modules\UserBase\User;
use thienhungho\UserManagement\modules\UserManage\search\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(request()->queryParams);
        $dataProvider->sort->defaultOrder = ['id' => SORT_DESC];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $providerBlock = new \yii\data\ArrayDataProvider([
            'allModels' => $model->blocks,
        ]);
        $providerComment = new \yii\data\ArrayDataProvider([
            'allModels' => $model->comments,
        ]);
        $providerPost = new \yii\data\ArrayDataProvider([
            'allModels' => $model->posts,
        ]);
        $providerProduct = new \yii\data\ArrayDataProvider([
            'allModels' => $model->products,
        ]);
        $providerTerm = new \yii\data\ArrayDataProvider([
            'allModels' => $model->terms,
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'providerBlock' => $providerBlock,
            'providerComment' => $providerComment,
            'providerPost' => $providerPost,
            'providerProduct' => $providerProduct,
            'providerTerm' => $providerTerm,
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->loadAll(request()->post())) {
            $model->setPassword($model->password_hash);
            $model->generateAuthKey();
            if ($model->saveAll()) {
                set_flash('success_create_new_user', $array = [
                    'type'     => 'success',
                    'duration' => 3000,
                    'icon'     => 'glyphicon glyphicon-ok-sign',
                    'title'    => \t('app', 'Congratulations!'),
                    'message'  => \t('app','Your content has been saved'),
                ]);
                return $this->redirect(['update', 'id' => $model->id]);
            } else {
                set_flash('error_user_has_not_been_saved', $array = [
                    'type'     => 'danger',
                    'duration' => 3000,
                    'icon'     => 'glyphicon glyphicon-remove-sign',
                    'title'    => \t('app', 'An error has occurred!'),
                    'message'  => \t('app','Your content has not been saved'),
                ]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);

    }

    /**
     * @param $id
     *
     * @return string|\yii\web\Response
     * @throws \yii\web\HttpException
     */
    public function actionUpdate($id)
    {
        if (request()->post('_asnew') == '1') {
            $model = new User();
        }else{
            $model = $this->findModel($id);
        }

        if (!is_role('admin')) {
            throw new \yii\web\HttpException(403, t('app', 'You are not allowed to perform this action.'));
        }

        if ($model->loadAll(request()->post())) {
            if ($model->saveAll()) {
                set_flash_has_been_saved();
                return $this->redirect(['update', 'id' => $model->id]);
            } else {
                set_flash_has_not_been_saved();
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * @return string|\yii\web\Response
     * @throws \yii\base\Exception
     */
    public function actionChangePassword($id)
    {
        $model = $this->findModel($id);
        $changePasswordForm = new ChangePasswordFormForAdmin();
        if ($changePasswordForm->load(request()->post())) {
            if ($changePasswordForm->changePassword()) {
                set_flash_has_been_saved();
            } else {
                set_flash_has_not_been_saved();
            }
        }

        return $this->render('change-password', [
            'changePasswordForm' => $changePasswordForm,
            'model' => $model,
        ]);
    }

    /**
     * @param $id
     *
     * @return \yii\web\Response
     * @throws \yii\web\HttpException
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if (in_array('admin', $model->getRole()) && !is_role('admin')) {
            throw new \yii\web\HttpException(403, t('app', 'You are not allowed to perform this action.'));
        }
        if ($model->deleteWithRelated()) {
            set_flash('success_delete_post', $array = [
                'type'     => 'success',
                'duration' => 3000,
                'icon'     => 'glyphicon glyphicon-ok-sign',
                'title'    => \t('app', 'Congratulations!'),
                'message'  => \t('app','Your content has been removed'),
            ]);
        } else {
            set_flash('error_delete_post', $array = [
                'type'     => 'danger',
                'duration' => 3000,
                'icon'     => 'glyphicon glyphicon-remove-sign',
                'title'    => \t('app', 'An error has occurred!'),
                'message'  => \t('app','Your content has not been removed'),
            ]);
        }

        return $this->goBack(request()->referrer);
    }
    
    /**
     * 
     * Export User information into PDF format.
     * @param integer $id
     * @return mixed
     */
    public function actionPdf($id) {
        $model = $this->findModel($id);
        $providerBlock = new \yii\data\ArrayDataProvider([
            'allModels' => $model->blocks,
        ]);
        $providerComment = new \yii\data\ArrayDataProvider([
            'allModels' => $model->comments,
        ]);
        $providerPost = new \yii\data\ArrayDataProvider([
            'allModels' => $model->posts,
        ]);
        $providerProduct = new \yii\data\ArrayDataProvider([
            'allModels' => $model->products,
        ]);
        $providerTerm = new \yii\data\ArrayDataProvider([
            'allModels' => $model->terms,
        ]);

        $content = $this->renderAjax('_pdf', [
            'model' => $model,
            'providerBlock' => $providerBlock,
            'providerComment' => $providerComment,
            'providerPost' => $providerPost,
            'providerProduct' => $providerProduct,
            'providerTerm' => $providerTerm,
        ]);

        $pdf = new \kartik\mpdf\Pdf([
            'mode' => \kartik\mpdf\Pdf::MODE_UTF8,
            'format' => \kartik\mpdf\Pdf::FORMAT_A4,
            'orientation' => \kartik\mpdf\Pdf::ORIENT_PORTRAIT,
            'destination' => \kartik\mpdf\Pdf::DEST_BROWSER,
            'content' => $content,
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            'cssInline' => '.kv-heading-1{font-size:18px}',
            'options' => ['title' => \Yii::$app->name],
            'methods' => [
                'SetHeader' => [\Yii::$app->name],
                'SetFooter' => ['{PAGENO}'],
            ]
        ]);

        return $pdf->render();
    }

    /**
    * Creates a new User model by another data,
    * so user don't need to input all field from scratch.
    * If creation is successful, the browser will be redirected to the 'view' page.
    *
    * @param mixed $id
    * @return mixed
    */
    public function actionSaveAsNew($id) {
        $model = new User();

        if (request()->post('_asnew') != '1') {
            $model = $this->findModel($id);
        }

        if ($model->loadAll(request()->post())) {
            $model->setPassword($model->password_hash);
            $model->generateAuthKey();
            if ($model->saveAll()) {
                set_flash('success_create_new_user', $array = [
                    'type'     => 'success',
                    'duration' => 3000,
                    'icon'     => 'glyphicon glyphicon-ok-sign',
                    'title'    => \t('app', 'Congratulations!'),
                    'message'  => \t('app','Your content has been saved'),
                ]);
                return $this->redirect(['update', 'id' => $model->id]);
            } else {
                set_flash('error_user_has_not_been_saved', $array = [
                    'type'     => 'danger',
                    'duration' => 3000,
                    'icon'     => 'glyphicon glyphicon-remove-sign',
                    'title'    => \t('app', 'An error has occurred!'),
                    'message'  => \t('app','Your content has not been saved'),
                ]);
            }
        }

        return $this->render('saveAsNew', [
            'model' => $model,
        ]);
    }

    /**
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \yii\db\Exception
     */
    public function actionBulk()
    {
        $action = request()->post('action');
        $ids = request()->post('selection');
        if (!empty($ids)) {
            if ($action == ACTION_DELETE) {
                foreach ($ids as $id) {
                    $model = $this->findModel($id);
                    if ($model->deleteWithRelated()) {
                        set_flash_success_delete_content();
                    } else {
                        set_flash_error_delete_content();
                    }
                }
            } elseif (in_array($action, [
                \thienhungho\UserManagement\models\User::STATUS_ACTIVE,
                \thienhungho\UserManagement\models\User::STATUS_DELETED,
                \thienhungho\UserManagement\models\User::STATUS_PENDING,
            ])) {
                foreach ($ids as $id) {
                    $model = $this->findModel($id);
                    $model->status = $action;
                    if ($model->save()) {
                        set_flash_has_been_saved();
                    } else {
                        set_flash_has_not_been_saved();
                    }
                }
            }
        }

        return $this->goBack(request()->referrer);
    }
    
    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(t('app', 'The requested page does not exist.'));
        }
    }
    
    /**
    * Action to load a tabular form grid
    * for Block
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    public function actionAddBlock()
    {
        if (request()->isAjax) {
            $row = request()->post('Block');
            if((request()->post('isNewRecord') && request()->post('_action') == 'load' && empty($row)) || request()->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formBlock', ['row' => $row]);
        } else {
            throw new NotFoundHttpException(t('app', 'The requested page does not exist.'));
        }
    }
    
    /**
    * Action to load a tabular form grid
    * for Comment
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    public function actionAddComment()
    {
        if (request()->isAjax) {
            $row = request()->post('Comment');
            if((request()->post('isNewRecord') && request()->post('_action') == 'load' && empty($row)) || request()->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formComment', ['row' => $row]);
        } else {
            throw new NotFoundHttpException(t('app', 'The requested page does not exist.'));
        }
    }
    
    /**
    * Action to load a tabular form grid
    * for Post
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    public function actionAddPost()
    {
        if (request()->isAjax) {
            $row = request()->post('Post');
            if((request()->post('isNewRecord') && request()->post('_action') == 'load' && empty($row)) || request()->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formPost', ['row' => $row]);
        } else {
            throw new NotFoundHttpException(t('app', 'The requested page does not exist.'));
        }
    }
    
    /**
    * Action to load a tabular form grid
    * for Product
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    public function actionAddProduct()
    {
        if (request()->isAjax) {
            $row = request()->post('Product');
            if((request()->post('isNewRecord') && request()->post('_action') == 'load' && empty($row)) || request()->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formProduct', ['row' => $row]);
        } else {
            throw new NotFoundHttpException(t('app', 'The requested page does not exist.'));
        }
    }
    
    /**
    * Action to load a tabular form grid
    * for Term
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    public function actionAddTerm()
    {
        if (request()->isAjax) {
            $row = request()->post('Term');
            if((request()->post('isNewRecord') && request()->post('_action') == 'load' && empty($row)) || request()->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formTerm', ['row' => $row]);
        } else {
            throw new NotFoundHttpException(t('app', 'The requested page does not exist.'));
        }
    }
}
